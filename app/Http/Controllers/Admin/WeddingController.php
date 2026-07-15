<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\WeddingRequest;
use App\Models\Wedding;

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
        $wedding->update([
            'couple' => $request->input('couple'),
            'wedding_info' => $request->input('wedding_info'),
            'quotes' => $request->input('quotes'),
            'wa_number' => $request->input('wa_number'),
            'sections' => $request->input('sections'),
        ]);

        return response()->json(['success' => true, 'message' => 'Konfigurasi berhasil disimpan.']);
    }
}
