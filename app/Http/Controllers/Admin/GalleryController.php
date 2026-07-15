<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GalleryRequest;
use App\Models\Gallery;
use App\Models\Wedding;

class GalleryController extends Controller
{
    public function index()
    {
        $wedding = Wedding::firstOrFail();
        $galleries = $wedding->galleries;
        return view('admin.galleries', compact('galleries', 'wedding'));
    }

    public function store(GalleryRequest $request)
    {
        $wedding = Wedding::firstOrFail();
        $maxOrder = $wedding->galleries()->max('sort_order') ?? 0;

        $gallery = $wedding->galleries()->create([
            ...$request->validated(),
            'sort_order' => $maxOrder + 1,
        ]);

        return response()->json(['success' => true, 'message' => 'Foto berhasil ditambahkan.', 'data' => $gallery]);
    }

    public function update(GalleryRequest $request, Gallery $gallery)
    {
        $gallery->update($request->validated());
        return response()->json(['success' => true, 'message' => 'Foto berhasil diperbarui.', 'data' => $gallery]);
    }

    public function destroy(Gallery $gallery)
    {
        $gallery->delete();
        return response()->json(['success' => true, 'message' => 'Foto berhasil dihapus.']);
    }
}
