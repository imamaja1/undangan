<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    private array $sections = [
        'cover'     => 'Cover',
        'hero'      => 'Hero',
        'opening'   => 'Opening',
        'couple'    => 'Couple',
        'countdown' => 'Countdown',
        'story'     => 'Story',
        'event'     => 'Event',
        'gallery'   => 'Gallery',
        'video'     => 'Video',
        'location'  => 'Location',
        'rsvp'      => 'RSVP',
        'gift'      => 'Gift',
        'wish'      => 'Wish',
        'footer'    => 'Footer',
    ];

    public function index()
    {
        $assets = [];
        foreach ($this->sections as $key => $label) {
            $path = public_path("images/hero/{$key}-bg.jpg");
            $assets[$key] = [
                'label'   => $label,
                'file'    => "images/hero/{$key}-bg.jpg",
                'exists'  => file_exists($path),
                'url'     => file_exists($path) ? asset("images/hero/{$key}-bg.jpg") . '?v=' . filemtime($path) : null,
                'size'    => file_exists($path) ? $this->formatSize(filesize($path)) : null,
                'updated' => file_exists($path) ? date('d M Y H:i', filemtime($path)) : null,
            ];
        }

        $audioPath = public_path('audio/wedding.mp3');
        $audio = [
            'label'   => 'Background Music',
            'file'    => 'audio/wedding.mp3',
            'exists'  => file_exists($audioPath) && filesize($audioPath) > 0,
            'url'     => (file_exists($audioPath) && filesize($audioPath) > 0) ? asset('audio/wedding.mp3') : null,
            'size'    => (file_exists($audioPath) && filesize($audioPath) > 0) ? $this->formatSize(filesize($audioPath)) : null,
        ];

        return view('admin.assets', compact('assets', 'audio'));
    }

    public function uploadBg(Request $request)
    {
        $request->validate([
            'image'  => 'required|image|mimes:jpg,jpeg,png,webp|max:20480',
            'section' => 'required|string|in:' . implode(',', array_keys($this->sections)),
        ]);

        $section = $request->input('section');
        $dir = public_path('images/hero');
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $request->file('image')->move($dir, "{$section}-bg.jpg");

        $url = asset("images/hero/{$section}-bg.jpg?v=" . time());

        return response()->json([
            'success' => true,
            'message' => "Background {$this->sections[$section]} berhasil diupload.",
            'url'     => $url,
        ]);
    }

    public function uploadAudio(Request $request)
    {
        $request->validate([
            'audio' => 'required|mimes:mp3,mpeg,wav,ogg|max:30720',
        ]);

        $dir = public_path('audio');
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $request->file('audio')->move($dir, 'wedding.mp3');

        return response()->json([
            'success' => true,
            'message' => 'Background music berhasil diupload.',
        ]);
    }

    private function formatSize(int $bytes): string
    {
        if ($bytes >= 1048576) return round($bytes / 1048576, 1) . ' MB';
        if ($bytes >= 1024) return round($bytes / 1024, 1) . ' KB';
        return $bytes . ' B';
    }
}
