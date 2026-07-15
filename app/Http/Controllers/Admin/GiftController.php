<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BankAccount;
use App\Models\Gift;
use App\Models\Wedding;
use Illuminate\Http\Request;

class GiftController extends Controller
{
    public function index()
    {
        $wedding = Wedding::firstOrFail();
        $gift = $wedding->gift;
        if (!$gift) {
            $gift = $wedding->gift()->create(['qris_enabled' => false]);
        }
        $bankAccounts = $gift->bankAccounts;
        return view('admin.gifts', compact('gift', 'bankAccounts'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'qris_enabled' => 'boolean',
            'qris_image' => 'nullable|string',
        ]);

        $wedding = Wedding::firstOrFail();
        $gift = $wedding->gift;
        if (!$gift) {
            $gift = $wedding->gift()->create();
        }
        $gift->update($request->only(['qris_enabled', 'qris_image']));

        return response()->json(['success' => true, 'message' => 'Gift berhasil disimpan.']);
    }

    public function storeBank(Request $request)
    {
        $request->validate([
            'bank_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:50',
            'account_holder' => 'required|string|max:255',
        ]);

        $wedding = Wedding::firstOrFail();
        $gift = $wedding->gift ?: $wedding->gift()->create(['qris_enabled' => false]);

        $bank = $gift->bankAccounts()->create($request->only(['bank_name', 'account_number', 'account_holder']));

        return response()->json(['success' => true, 'message' => 'Rekening berhasil ditambahkan.', 'data' => $bank]);
    }

    public function updateBank(Request $request, BankAccount $bankAccount)
    {
        $request->validate([
            'bank_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:50',
            'account_holder' => 'required|string|max:255',
        ]);

        $bankAccount->update($request->only(['bank_name', 'account_number', 'account_holder']));

        return response()->json(['success' => true, 'message' => 'Rekening berhasil diperbarui.', 'data' => $bankAccount]);
    }

    public function destroyBank(BankAccount $bankAccount)
    {
        $bankAccount->delete();
        return response()->json(['success' => true, 'message' => 'Rekening berhasil dihapus.']);
    }
}
