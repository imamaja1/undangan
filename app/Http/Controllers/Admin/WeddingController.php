<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\WeddingRequest;
use App\Models\Wedding;
use Illuminate\Support\Facades\Storage;

class WeddingController extends Controller
{
    public function edit()
    {
        $wedding = Wedding::firstOrFail();
        return view('admin.wedding', compact('wedding'));
    }

    public function update(WeddingRequest $request)
    {
        $wedding = Wedding::firstOrFail();
        $coupleData = $request->input('couple');
        
        $coupleData['groomPhoto'] = $wedding->couple['groomPhoto'] ?? null;
        $coupleData['bridePhoto'] = $wedding->couple['bridePhoto'] ?? null;

        if ($request->hasFile('groom_photo')) {
            if (!empty($wedding->couple['groomPhoto'])) {
                Storage::disk('public')->delete($wedding->couple['groomPhoto']);
            }
            $path = $request->file('groom_photo')->store('couple', 'public');
            $coupleData['groomPhoto'] = $path;
        }

        if ($request->hasFile('bride_photo')) {
            if (!empty($wedding->couple['bridePhoto'])) {
                Storage::disk('public')->delete($wedding->couple['bridePhoto']);
            }
            $path = $request->file('bride_photo')->store('couple', 'public');
            $coupleData['bridePhoto'] = $path;
        }

        $wedding->update([
            'couple' => $coupleData,
            'wedding_info' => $request->input('wedding_info'),
            'quotes' => $request->input('quotes'),
            'wa_number' => $request->input('wa_number'),
            'sections' => $request->input('sections'),
        ]);

        return response()->json(['success' => true, 'message' => 'Konfigurasi berhasil disimpan.']);
    }
}
