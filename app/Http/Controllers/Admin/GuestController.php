<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guest;
use App\Models\Wedding;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GuestController extends Controller
{
    private $baseUrl = 'https://otomasi.punyaku.online';

    private function getApiKey()
    {
        $envKey = env('AUTOMATION_KEY');
        if (!empty($envKey)) {
            return $envKey;
        }

        $wedding = Wedding::first();
        return $wedding->wedding_info['wa_api_key'] ?? '';
    }

    public function index()
    {
        $wedding = Wedding::with('guests')->firstOrFail();
        $guests = $wedding->guests;
        $template = $wedding->wedding_info['wa_template'] ?? "Kepada Yth. {{nama}},\n\nTanpa mengurangi rasa hormat, kami bermaksud mengundang Bapak/Ibu/Saudara/i untuk hadir di acara pernikahan kami.\n\nKehadiran Anda adalah kebahagiaan bagi kami.\n\nTerima kasih.\n\nSilakan buka tautan undangan berikut untuk detail acara:\n{{link}}";

        return view('admin.guests', compact('guests', 'template'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:50',
        ]);

        $wedding = Wedding::firstOrFail();
        $guest = $wedding->guests()->create([
            'name' => $request->name,
            'phone' => $request->phone,
            'status' => 'pending'
        ]);

        return response()->json(['success' => true, 'guest' => $guest]);
    }

    public function update(Request $request, Guest $guest)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:50',
        ]);

        $guest->update([
            'name' => $request->name,
            'phone' => $request->phone,
        ]);

        return response()->json(['success' => true, 'guest' => $guest]);
    }

    public function destroy(Guest $guest)
    {
        $guest->delete();
        return response()->json(['success' => true]);
    }

    public function bulkPaste(Request $request)
    {
        $request->validate([
            'data' => 'required|string'
        ]);

        $wedding = Wedding::firstOrFail();
        $lines = explode("\n", trim($request->data));
        $added = 0;

        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line)) continue;

            $parts = explode("\t", $line);
            $name = trim($parts[0] ?? '');
            $phone = trim($parts[1] ?? '');

            if ($name) {
                $wedding->guests()->create([
                    'name' => $name,
                    'phone' => $phone,
                    'status' => 'pending'
                ]);
                $added++;
            }
        }

        return response()->json(['success' => true, 'message' => "$added tamu berhasil ditambahkan."]);
    }

    public function saveTemplate(Request $request)
    {
        $request->validate(['template' => 'required|string']);
        
        $wedding = Wedding::firstOrFail();
        $info = $wedding->wedding_info ?? [];
        $info['wa_template'] = $request->template;
        $wedding->update(['wedding_info' => $info]);

        return response()->json(['success' => true, 'message' => 'Template berhasil disimpan.']);
    }

    public function sendWa(Request $request, Guest $guest)
    {
        $apiKey = $this->getApiKey();
        if (empty($apiKey)) {
            return response()->json(['error' => 'API Key WhatsApp belum dikonfigurasi.'], 400);
        }

        if (empty($guest->phone)) {
            return response()->json(['error' => 'Nomor WA tamu belum diisi.'], 400);
        }

        $wedding = Wedding::firstOrFail();
        $template = $wedding->wedding_info['wa_template'] ?? "Kepada Yth. {{nama}},\n\nTanpa mengurangi rasa hormat, kami bermaksud mengundang Bapak/Ibu/Saudara/i untuk hadir di acara pernikahan kami.\n\nKehadiran Anda adalah kebahagiaan bagi kami.\n\nTerima kasih.\n\nSilakan buka tautan undangan berikut untuk detail acara:\n{{link}}";
        
        // Generate personalized message
        $link = route('wedding.index') . '?to=' . urlencode($guest->name);
        
        $message = preg_replace('/\{\{\s*nama\s*\}\}/i', $guest->name, $template);
        $message = preg_replace('/\{\{\s*link\s*\}\}/i', $link, $message);

        try {
            $response = Http::withoutVerifying()->withHeaders(['x-api-key' => $apiKey])
                            ->timeout(15)
                            ->post("{$this->baseUrl}/api/v1/whatsapp/send", [
                                'to' => $guest->phone,
                                'message' => $message
                            ]);

            if ($response->successful() && $response->json('status')) {
                $guest->update(['status' => 'sent']);
                return response()->json(['success' => true, 'message' => 'Berhasil terkirim.', 'status' => 'sent']);
            }

            $guest->update(['status' => 'failed']);
            return response()->json(['error' => 'Gagal: ' . $response->body()], 400);
        } catch (\Exception $e) {
            $guest->update(['status' => 'failed']);
            return response()->json(['error' => 'Koneksi gagal: ' . $e->getMessage()], 500);
        }
    }
}
