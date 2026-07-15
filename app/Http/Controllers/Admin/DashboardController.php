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
        return view('admin.dashboard', compact('wedding', 'wishCount'));
    }
}
