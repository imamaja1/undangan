<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Wedding;
use App\Models\Wish;

class DashboardController extends Controller
{
    public function index()
    {
        $wedding = Wedding::first();
        $wishCount = Wish::count();

        $storyCount = 0;
        $galleryCount = 0;
        $bankCount = 0;

        if ($wedding) {
            $storyCount = $wedding->stories()->count();
            $galleryCount = $wedding->galleries()->count();
            $bankCount = $wedding->gift?->bankAccounts()->count() ?? 0;
        }

        return view('admin.dashboard', compact('wedding', 'wishCount', 'storyCount', 'galleryCount', 'bankCount'));
    }
}
