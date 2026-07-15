@extends('layouts.admin')

@section('content')
<div>
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-serif font-bold text-gray-800">Wedding Gift</h1>
            <p class="text-gray-500 text-sm mt-1">Atur QRIS dan rekening bank.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white rounded-xl shadow-sm border border-cream-dark p-6">
            <h2 class="text-lg font-serif font-bold text-gray-800 mb-4">QRIS</h2>
            <form id="qrisForm" onsubmit="saveQRIS(event)" class="space-y-3">
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="checkbox" id="qrisEnabled" name="qris_enabled" class="w-5 h-5 rounded border-cream-dark text-gold focus:ring-gold" {{ ($gift->qris_enabled ?? false) ? 'checked' : '' }}>
                    <span class="text-sm font-medium">Aktifkan QRIS</span>
                </label>
                <input type="hidden" id="qrisImage" name="qris_image" value="{{ $gift->qris_image ?? '' }}">
                <div>
                    <label class="text-xs text-gray-500">Upload QRIS Image</label>
                    <input type="file" accept="image/*" onchange="autoUpload(this, 'qrisImage', 'qrisPreview', 'icons')" class="w-full text-sm file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-gold file:text-white hover:file:bg-gold-dark file:transition-colors file:cursor-pointer">
                    <p class="text-xs text-gray-400 mt-1" id="qrisPathDisplay">{{ $gift->qris_image ?? '' }}</p>
                </div>
                <div class="w-40 h-40 mx-auto rounded-xl overflow-hidden border border-cream-dark">
                    <img id="qrisPreview" src="{{ $gift->qris_image ? asset($gift->qris_image) : '' }}" alt="QRIS Preview" class="w-full h-full object-cover {{ ($gift->qris_image ?? false) ? '' : 'hidden' }}">
                </div>
                <button type="submit" class="px-4 py-2 bg-gold hover:bg-gold-dark text-white rounded-lg text-sm font-medium">Simpan QRIS</button>
            </form>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-cream-dark p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-serif font-bold text-gray-800">Rekening Bank</h2>
                <button onclick="openBankModal()" class="px-3 py-1.5 bg-gold hover:bg-gold-dark text-white rounded-lg text-xs font-medium">+ Tambah</button>
            </div>
            <div class="space-y-3">
                @forelse($bankAccounts as $bank)
                <div class="flex items-start justify-between p-3 bg-cream rounded-lg">
                    <div>
                        <p class="font-semibold text-sm">{{ $bank->bank_name }}</p>
                        <p class="text-gold font-mono text-sm">{{ $bank->account_number }}</p>
                        <p class="text-xs text-gray-500">a.n. {{ $bank->account_holder }}</p>
                    </div>
                    <div class="flex gap-1">
                        <button onclick="editBank(this, {{ $bank->id }})" class="text-blue-600 text-xs hover:underline">Edit</button>
                        <button onclick="deleteBank('{{ $bank->id }}')" class="text-red-600 text-xs hover:underline">Hapus</button>
                    </div>
                </div>
                @empty
                <p class="text-gray-400 text-sm text-center py-4">Belum ada rekening bank.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

<div id="bankModal" class="fixed inset-0 z-50 hidden items-center justify-center">
    <div class="fixed inset-0 bg-black/50" onclick="closeBankModal()"></div>
    <div class="relative bg-white rounded-2xl shadow-xl max-w-md w-full mx-4 p-6">
        <h3 class="text-lg font-serif font-bold text-gray-800 mb-4" id="bankModalTitle">Tambah Rekening</h3>
        <form id="bankForm" class="space-y-3">
            <input type="hidden" id="bankId">
            <div><label class="text-xs text-gray-500">Nama Bank</label><input type="text" id="bankName" required class="w-full px-3 py-2 border border-cream-dark rounded-lg text-sm focus:ring-2 focus:ring-gold focus:border-gold outline-none" placeholder="Bank BCA"></div>
            <div><label class="text-xs text-gray-500">Nomor Rekening</label><input type="text" id="bankNumber" required class="w-full px-3 py-2 border border-cream-dark rounded-lg text-sm focus:ring-2 focus:ring-gold focus:border-gold outline-none"></div>
            <div><label class="text-xs text-gray-500">Atas Nama</label><input type="text" id="bankHolder" required class="w-full px-3 py-2 border border-cream-dark rounded-lg text-sm focus:ring-2 focus:ring-gold focus:border-gold outline-none"></div>
            <div class="flex gap-3 pt-2">
                <button type="button" onclick="closeBankModal()" class="flex-1 py-2 border border-cream-dark text-gray-700 rounded-lg text-sm font-medium">Batal</button>
                <button type="submit" class="flex-1 py-2 bg-gold hover:bg-gold-dark text-white rounded-lg text-sm font-medium">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
let bankData = @json($bankAccounts->toArray());

async function saveQRIS(e) {
    e.preventDefault();
    const data = {
        qris_enabled: document.getElementById('qrisEnabled').checked,
        qris_image: document.getElementById('qrisImage').value
    };
    try {
        const res = await fetch('{{ route("admin.gifts.update") }}', {
            method: 'POST', headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept': 'application/json' },
            body: JSON.stringify(data)
        });
        const r = await res.json();
        showToast(r.success ? r.message : 'Gagal', r.success ? 'success' : 'error');
    } catch(e) { showToast('Gagal.', 'error'); }
}

function openBankModal() {
    document.getElementById('bankModalTitle').textContent = 'Tambah Rekening';
    document.getElementById('bankId').value = '';
    document.getElementById('bankForm').reset();
    document.getElementById('bankModal').classList.remove('hidden');
    document.getElementById('bankModal').classList.add('flex');
}

function closeBankModal() {
    document.getElementById('bankModal').classList.add('hidden');
    document.getElementById('bankModal').classList.remove('flex');
}

function editBank(btn, id) {
    const b = bankData.find(s => s.id == id);
    if (!b) return;
    document.getElementById('bankModalTitle').textContent = 'Edit Rekening';
    document.getElementById('bankId').value = b.id;
    document.getElementById('bankName').value = b.bank_name;
    document.getElementById('bankNumber').value = b.account_number;
    document.getElementById('bankHolder').value = b.account_holder;
    document.getElementById('bankModal').classList.remove('hidden');
    document.getElementById('bankModal').classList.add('flex');
}

document.getElementById('bankForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    const id = document.getElementById('bankId').value;
    const data = {
        bank_name: document.getElementById('bankName').value,
        account_number: document.getElementById('bankNumber').value,
        account_holder: document.getElementById('bankHolder').value,
    };
    let url, method;
    if (id) {
        url = '{{ route("admin.gifts.updateBank", "__id__") }}'.replace('__id__', id);
        method = 'PUT';
    } else {
        url = '{{ route("admin.gifts.storeBank") }}';
        method = 'POST';
    }
    try {
        const res = await fetch(url, {
            method, headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept': 'application/json' },
            body: JSON.stringify(data)
        });
        const r = await res.json();
        if (r.success) { showToast(r.message, 'success'); location.reload(); }
        else showToast(r.message || 'Gagal', 'error');
    } catch(e) { showToast('Gagal.', 'error'); }
});

async function deleteBank(id) {
    if (!confirm('Hapus rekening ini?')) return;
    try {
        const res = await fetch('{{ route("admin.gifts.destroyBank", "__id__") }}'.replace('__id__', id), {
            method: 'DELETE', headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept': 'application/json' }
        });
        const r = await res.json();
        if (r.success) { showToast(r.message, 'success'); location.reload(); }
        else showToast(r.message || 'Gagal', 'error');
    } catch(e) { showToast('Gagal.', 'error'); }
}
</script>
@endpush
