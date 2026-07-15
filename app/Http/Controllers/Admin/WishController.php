<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Wedding;
use App\Models\Wish;

class WishController extends Controller
{
    public function index()
    {
        $wedding = Wedding::firstOrFail();
        $wishes = $wedding->wishes()->latest()->paginate(15);
        return view('admin.wishes', compact('wishes'));
    }

    public function destroy(Wish $wish)
    {
        $wish->delete();
        return response()->json(['success' => true, 'message' => 'Ucapan berhasil dihapus.']);
    }
}
