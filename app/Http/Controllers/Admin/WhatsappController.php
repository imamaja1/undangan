<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Wedding;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WhatsappController extends Controller
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
        $apiKey = $this->getApiKey();
        $isEnvConfigured = !empty(env('AUTOMATION_KEY'));
        return view('admin.whatsapp', compact('apiKey', 'isEnvConfigured'));
    }

    public function saveKey(Request $request)
    {
        $request->validate(['wa_api_key' => 'required|string']);
        $wedding = Wedding::firstOrFail();
        $info = $wedding->wedding_info ?? [];
        $info['wa_api_key'] = $request->input('wa_api_key');
        $wedding->update(['wedding_info' => $info]);

        return response()->json(['success' => true, 'message' => 'API Key berhasil disimpan.']);
    }

    public function generateKey(Request $request)
    {
        try {
            // 1. Register Application
            $registerResponse = Http::withoutVerifying()->timeout(10)->post("{$this->baseUrl}/api/v1/auth/register", [
                'name' => config('app.name', 'SuratUndangan') . ' WA Gateway',
                'description' => 'Automated registration from admin panel'
            ]);

            if (!$registerResponse->successful() || !$registerResponse->json('id')) {
                return response()->json(['error' => 'Gagal mendaftar aplikasi di server otomasi: ' . $registerResponse->body()], 400);
            }

            $appId = $registerResponse->json('id');

            // 2. Generate API Key
            $keyResponse = Http::withoutVerifying()->timeout(10)->post("{$this->baseUrl}/api/v1/auth/api-key", [
                'applicationId' => (int) $appId,
                'name' => 'production-key',
                'permissions' => ["whatsapp"]
            ]);

            if ($keyResponse->successful() && $keyResponse->json('key')) {
                $key = $keyResponse->json('key');
                
                // Auto save to database
                $wedding = Wedding::firstOrFail();
                $info = $wedding->wedding_info ?? [];
                $info['wa_api_key'] = $key;
                $wedding->update(['wedding_info' => $info]);

                return response()->json(['success' => true, 'key' => $key, 'message' => 'Aplikasi berhasil didaftarkan dan API Key tersimpan!']);
            }

            return response()->json(['error' => 'Gagal generate key: ' . $keyResponse->body()], 400);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Koneksi ke server gagal: ' . $e->getMessage()], 500);
        }
    }

    public function status()
    {
        if (empty($this->getApiKey())) {
            return response()->json(['state' => 'idle', 'isReady' => false, 'error' => 'API Key belum disetting.']);
        }
        try {
            $response = Http::withoutVerifying()->withHeaders(['x-api-key' => $this->getApiKey()])
                            ->timeout(10)
                            ->get("{$this->baseUrl}/api/v1/whatsapp/status");
            return response()->json($response->json(), $response->status());
        } catch (\Exception $e) {
            return response()->json(['state' => 'disconnected', 'isReady' => false, 'error' => 'Koneksi ke server gagal.']);
        }
    }

    public function qr()
    {
        try {
            $response = Http::withoutVerifying()->withHeaders(['x-api-key' => $this->getApiKey()])
                            ->timeout(10)
                            ->get("{$this->baseUrl}/api/v1/whatsapp/qr");
            return response()->json($response->json(), $response->status());
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal mengambil QR.'], 500);
        }
    }

    public function send(Request $request)
    {
        $request->validate(['to' => 'required|string', 'message' => 'required|string']);
        try {
            $response = Http::withoutVerifying()->withHeaders(['x-api-key' => $this->getApiKey()])
                            ->timeout(15)
                            ->post("{$this->baseUrl}/api/v1/whatsapp/send", [
                                'to' => $request->input('to'),
                                'message' => $request->input('message')
                            ]);
            return response()->json($response->json(), $response->status());
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal mengirim pesan.'], 500);
        }
    }

    public function logout()
    {
        try {
            $response = Http::withoutVerifying()->withHeaders(['x-api-key' => $this->getApiKey()])
                            ->timeout(15)
                            ->post("{$this->baseUrl}/api/v1/whatsapp/session/logout");
            return response()->json($response->json(), $response->status());
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal logout.'], 500);
        }
    }
}
