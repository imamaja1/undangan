<?php

namespace App\Http\Controllers;

use App\Models\Wedding;

class WeddingPageController extends Controller
{
    public function index()
    {
        $wedding = Wedding::with([
            'events', 'stories', 'galleries', 'gift.bankAccounts', 'wishes'
        ])->first();

        if (!$wedding) {
            abort(404, 'Undangan belum dikonfigurasi.');
        }

        $guestName = request()->query('to', 'Tamu Undangan');

        return view('wedding.index', compact('wedding', 'guestName'));
    }
}
