@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div>
        <h1 class="text-xl font-bold text-gray-900">Wedding Gift</h1>
        <p class="text-sm text-gray-500 mt-0.5">Atur QRIS dan rekening bank.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- QRIS --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-sm font-semibold text-gray-600 uppercase tracking-wider mb-4">QRIS</h2>
            <form id="qrisForm" onsubmit="saveQRIS(event)" class="space-y-4">
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="checkbox" id="qrisEnabled" name="qris_enabled" class="w-5 h-5 rounded border-gray-300 text-gray-900 focus:ring-gray-900/20" {{ ($gift->qris_enabled ?? false) ? 'checked' : '' }}>
                    <span class="text-sm font-medium text-gray-700">Aktifkan QRIS</span>
                </label>
                <input type="hidden" id="qrisImage" name="qris_image" value="{{ $gift->qris_image ?? '' }}">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Upload QRIS Image</label>
                    <input type="file" accept="image/*" onchange="autoUpload(this, 'qrisImage', 'qrisPreview', 'icons')" class="w-full text-sm file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-gray-900 file:text-white hover:file:bg-gray-800 file:cursor-pointer file:transition-colors">
                    <p class="text-xs text-gray-400 mt-1" id="qrisPathDisplay">{{ $gift->qris_image ?? '' }}</p>
                </div>
                <div class="w-40 h-40 mx-auto rounded-xl overflow-hidden border border-gray-200">
                    <img id="qrisPreview" src="{{ $gift->qris_image ? asset($gift->qris_image) : '' }}" alt="QRIS Preview" class="w-full h-full object-cover {{ ($gift->qris_image ?? false) ? '' : 'hidden' }}">
                </div>
                <button type="submit" class="px-4 py-2 bg-gray-900 hover:bg-gray-800 text-white text-sm font-medium rounded-lg transition-colors shadow-sm">Simpan QRIS</button>
            </form>
        </div>

        {{-- Bank Accounts --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-sm font-semibold text-gray-600 uppercase tracking-wider">Rekening Bank</h2>
                <button onclick="openBankModal()" class="px-3 py-1.5 bg-gray-900 hover:bg-gray-800 text-white text-xs font-medium rounded-lg transition-colors">+ Tambah</button>
            </div>
            <div class="space-y-3">
                @forelse($bankAccounts as $bank)
                <div class="flex items-start justify-between p-3 bg-gray-50 rounded-lg border border-gray-100">
                    <div>
                        <p class="font-medium text-sm text-gray-900">{{ $bank->bank_name }}</p>
                        <p class="text-gray-600 font-mono text-sm">{{ $bank->account_number }}</p>
                        <p class="text-xs text-gray-400">a.n. {{ $bank->account_holder }}</p>
                    </div>
                    <div class="flex gap-1">
                        <button onclick="editBank(this, {{ $bank->id }})" class="text-xs font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-200 rounded-md px-2 py-1 transition-colors">Edit</button>
                        <button onclick="deleteBank('{{ $bank->id }}')" class="text-xs font-medium text-red-500 hover:text-red-700 hover:bg-red-50 rounded-md px-2 py-1 transition-colors">Hapus</button>
                    </div>
                </div>
                @empty
                <p class="text-sm text-gray-400 text-center py-4">Belum ada rekening bank.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

<div id="bankModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
    <div class="fixed inset-0 bg-black/40 backdrop-blur-sm" onclick="closeBankModal()"></div>
    <div class="relative bg-white rounded-2xl shadow-xl max-w-md w-full p-6">
        <div class="flex items-center justify-between mb-5">
            <h3 class="text-lg font-semibold text-gray-900" id="bankModalTitle">Tambah Rekening</h3>
            <button onclick="closeBankModal()" class="text-gray-400 hover:text-gray-600"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>
        </div>
        <form id="bankForm" class="space-y-4">
            <input type="hidden" id="bankId">
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Nama Bank</label><input type="text" id="bankName" required class="w-full px-3 py-2 rounded-lg border border-gray-300 text-sm shadow-sm focus:ring-2 focus:ring-gray-900/10 focus:border-gray-900 outline-none transition" placeholder="Bank BCA"></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Nomor Rekening</label><input type="text" id="bankNumber" required class="w-full px-3 py-2 rounded-lg border border-gray-300 text-sm shadow-sm focus:ring-2 focus:ring-gray-900/10 focus:border-gray-900 outline-none transition"></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Atas Nama</label><input type="text" id="bankHolder" required class="w-full px-3 py-2 rounded-lg border border-gray-300 text-sm shadow-sm focus:ring-2 focus:ring-gray-900/10 focus:border-gray-900 outline-none transition"></div>
            <div class="flex gap-3 pt-2">
                <button type="button" onclick="closeBankModal()" class="flex-1 px-4 py-2.5 border border-gray-300 text-gray-700 font-medium text-sm rounded-lg hover:bg-gray-50 transition-colors">Batal</button>
                <button type="submit" class="flex-1 px-4 py-2.5 bg-gray-900 hover:bg-gray-800 text-white font-medium text-sm rounded-lg transition-colors shadow-sm">Simpan</button>
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
    const data = { qris_enabled: document.getElementById('qrisEnabled').checked, qris_image: document.getElementById('qrisImage').value };
    try {
        const res = await fetch('{{ route("admin.gifts.update") }}', { method:'POST', headers: { 'Content-Type':'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept':'application/json' }, body: JSON.stringify(data) });
        const r = await res.json();
        showToast(r.success ? r.message : 'Gagal', r.success ? 'success' : 'error');
    } catch(e) { showToast('Gagal.', 'error'); }
}

function openBankModal() { document.getElementById('bankModalTitle').textContent='Tambah Rekening'; document.getElementById('bankId').value=''; document.getElementById('bankForm').reset(); document.getElementById('bankModal').classList.remove('hidden'); document.getElementById('bankModal').classList.add('flex'); }
function closeBankModal() { document.getElementById('bankModal').classList.add('hidden'); document.getElementById('bankModal').classList.remove('flex'); }
function editBank(btn, id) {
    const b = bankData.find(s=>s.id==id); if(!b)return;
    document.getElementById('bankModalTitle').textContent='Edit Rekening'; document.getElementById('bankId').value=b.id;
    document.getElementById('bankName').value=b.bank_name; document.getElementById('bankNumber').value=b.account_number; document.getElementById('bankHolder').value=b.account_holder;
    document.getElementById('bankModal').classList.remove('hidden'); document.getElementById('bankModal').classList.add('flex');
}
document.getElementById('bankForm').addEventListener('submit', async function(e) {
    e.preventDefault(); const id=document.getElementById('bankId').value;
    const data={bank_name:document.getElementById('bankName').value, account_number:document.getElementById('bankNumber').value, account_holder:document.getElementById('bankHolder').value};
    let url,method; if(id){url='{{ route("admin.gifts.updateBank","__id__") }}'.replace('__id__',id); method='PUT';}else{url='{{ route("admin.gifts.storeBank") }}'; method='POST';}
    try { const res=await fetch(url,{method,headers:{'Content-Type':'application/json','X-CSRF-TOKEN':document.querySelector('meta[name="csrf-token"]').content,'Accept':'application/json'},body:JSON.stringify(data)}); const r=await res.json(); if(r.success){showToast(r.message,'success');location.reload();}else showToast(r.message||'Gagal','error'); } catch(e){showToast('Gagal.','error');}
});
async function deleteBank(id) { if(!confirm('Hapus?'))return; try{const res=await fetch('{{ route("admin.gifts.destroyBank","__id__") }}'.replace('__id__',id),{method:'DELETE',headers:{'X-CSRF-TOKEN':document.querySelector('meta[name="csrf-token"]').content,'Accept':'application/json'}});const r=await res.json();if(r.success){showToast(r.message,'success');location.reload();}else showToast(r.message||'Gagal','error');}catch(e){showToast('Gagal.','error');} }
</script>
@endpush
