<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Http\Requests\WishRequest;
use App\Models\Wedding;

class WishController extends Controller
{
    public function store(WishRequest $request)
    {
        $wedding = Wedding::firstOrFail();

        $wish = $wedding->wishes()->create($request->validated());

        return response()->json(['success' => true, 'message' => 'Ucapan berhasil dikirim.', 'data' => $wish]);
    }
}
