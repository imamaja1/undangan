<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,gif,webp|max:10240',
            'folder' => 'nullable|string|max:50',
        ]);

        $folder = $request->input('folder', 'gallery');
        $folder = preg_replace('/[^a-zA-Z0-9_-]/', '', $folder);

        $dir = public_path("images/{$folder}");
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $file = $request->file('image');
        $name = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $file->getClientOriginalName());
        $file->move($dir, $name);

        $path = "images/{$folder}/{$name}";

        return response()->json([
            'success' => true,
            'message' => 'File berhasil diupload.',
            'path' => $path,
        ]);
    }

    public function images()
    {
        $dir = public_path('images');
        if (!is_dir($dir)) {
            return response()->json([]);
        }

        $files = [];
        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($dir, \RecursiveDirectoryIterator::SKIP_DOTS)
        );

        foreach ($iterator as $file) {
            if ($file->isFile()) {
                $relative = str_replace(public_path(), '', $file->getPathname());
                $files[] = str_replace('\\', '/', $relative);
            }
        }

        sort($files);

        return response()->json($files);
    }
}
