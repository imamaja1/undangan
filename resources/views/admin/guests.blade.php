@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-xl font-bold text-gray-900">Buku Tamu & WA Blast</h1>
            <p class="text-sm text-gray-500 mt-0.5">Kelola daftar tamu dan kirim undangan otomatis via WhatsApp.</p>
        </div>
        <div class="flex gap-2">
            <button onclick="openTemplateModal()" class="px-4 py-2 bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 text-sm font-medium rounded-lg transition-colors shadow-sm">
                Template Pesan
            </button>
            <button onclick="openPasteModal()" class="px-4 py-2 bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 text-sm font-medium rounded-lg transition-colors shadow-sm flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                Paste Excel
            </button>
            <button onclick="blastAll()" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-lg transition-colors shadow-sm flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                Blast Semua
            </button>
        </div>
    </div>

    {{-- Spreadsheet Table --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-gray-600">
                <thead class="bg-gray-50 border-b border-gray-200 text-gray-700 uppercase tracking-wider text-xs font-semibold">
                    <tr>
                        <th class="px-4 py-3 w-12 text-center">#</th>
                        <th class="px-4 py-3">Nama Tamu</th>
                        <th class="px-4 py-3">Nomor WA</th>
                        <th class="px-4 py-3 w-32 text-center">Status</th>
                        <th class="px-4 py-3 w-40 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100" id="guestTableBody">
                    @forelse($guests as $index => $guest)
                    <tr class="hover:bg-gray-50/50 group" id="row-{{ $guest->id }}">
                        <td class="px-4 py-3 text-center text-gray-400">{{ $index + 1 }}</td>
                        <td class="px-4 py-2">
                            <input type="text" value="{{ $guest->name }}" onchange="updateGuest({{ $guest->id }}, 'name', this.value)" class="w-full bg-transparent border-0 border-b border-transparent hover:border-gray-300 focus:border-gray-900 focus:ring-0 px-1 py-1 transition-colors">
                        </td>
                        <td class="px-4 py-2">
                            <input type="text" value="{{ $guest->phone }}" onchange="updateGuest({{ $guest->id }}, 'phone', this.value)" placeholder="628..." class="w-full bg-transparent border-0 border-b border-transparent hover:border-gray-300 focus:border-gray-900 focus:ring-0 px-1 py-1 transition-colors">
                        </td>
                        <td class="px-4 py-3 text-center">
                            @if($guest->status === 'sent')
                                <span class="px-2 py-1 bg-emerald-100 text-emerald-700 text-xs font-medium rounded-md">Terkirim</span>
                            @elseif($guest->status === 'failed')
                                <span class="px-2 py-1 bg-red-100 text-red-700 text-xs font-medium rounded-md">Gagal</span>
                            @else
                                <span class="px-2 py-1 bg-gray-100 text-gray-600 text-xs font-medium rounded-md">Belum</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-right space-x-2">
                            <button onclick="sendWa({{ $guest->id }})" class="text-emerald-600 hover:text-emerald-800 font-medium text-xs px-2 py-1 rounded hover:bg-emerald-50 transition-colors">Kirim</button>
                            <button onclick="deleteGuest({{ $guest->id }})" class="text-red-500 hover:text-red-700 font-medium text-xs px-2 py-1 rounded hover:bg-red-50 transition-colors">Hapus</button>
                        </td>
                    </tr>
                    @empty
                    <tr id="emptyRow"><td colspan="5" class="px-4 py-8 text-center text-gray-400">Belum ada daftar tamu.</td></tr>
                    @endforelse
                </tbody>
                {{-- Quick Add Row --}}
                <tfoot class="bg-gray-50/50 border-t border-gray-200">
                    <tr>
                        <td class="px-4 py-3 text-center text-gray-400 font-medium">+</td>
                        <td class="px-4 py-2">
                            <input type="text" id="newName" placeholder="Ketik nama baru..." class="w-full bg-white border border-gray-200 rounded-md shadow-sm focus:border-gray-900 focus:ring-1 focus:ring-gray-900 px-3 py-1.5 text-sm transition-colors" onkeypress="if(event.key==='Enter') document.getElementById('newPhone').focus()">
                        </td>
                        <td class="px-4 py-2">
                            <input type="text" id="newPhone" placeholder="628..." class="w-full bg-white border border-gray-200 rounded-md shadow-sm focus:border-gray-900 focus:ring-1 focus:ring-gray-900 px-3 py-1.5 text-sm transition-colors" onkeypress="if(event.key==='Enter') addGuest()">
                        </td>
                        <td class="px-4 py-3 text-center text-xs text-gray-400">Otomatis</td>
                        <td class="px-4 py-3 text-right">
                            <button onclick="addGuest()" class="px-3 py-1.5 bg-gray-900 hover:bg-gray-800 text-white text-xs font-medium rounded-md transition-colors shadow-sm">Tambah</button>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

{{-- Modal Paste Excel --}}
<div id="pasteModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
    <div class="fixed inset-0 bg-black/40 backdrop-blur-sm" onclick="closePasteModal()"></div>
    <div class="relative bg-white rounded-2xl shadow-xl max-w-lg w-full p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-900">Paste dari Excel / Sheets</h3>
            <button onclick="closePasteModal()" class="text-gray-400 hover:text-gray-600"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>
        </div>
        <p class="text-sm text-gray-500 mb-4">Copy kolom <strong>Nama</strong> dan <strong>Nomor WA</strong> dari Excel/Google Sheets Anda, lalu paste (tempel) di kotak bawah ini.</p>
        <textarea id="pasteData" rows="6" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm shadow-sm focus:ring-2 focus:ring-gray-900/10 outline-none resize-none font-mono text-xs whitespace-pre" placeholder="Budi Santoso&#9;628123456789&#10;Siti Aminah&#9;628987654321"></textarea>
        <div class="flex gap-3 pt-4">
            <button onclick="closePasteModal()" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 font-medium text-sm rounded-lg hover:bg-gray-50">Batal</button>
            <button onclick="processPaste()" class="flex-1 px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white font-medium text-sm rounded-lg shadow-sm">Proses Data</button>
        </div>
    </div>
</div>

{{-- Modal Template WA --}}
<div id="templateModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
    <div class="fixed inset-0 bg-black/40 backdrop-blur-sm" onclick="closeTemplateModal()"></div>
    <div class="relative bg-white rounded-2xl shadow-xl max-w-lg w-full p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-900">Template Pesan WhatsApp</h3>
            <button onclick="closeTemplateModal()" class="text-gray-400 hover:text-gray-600"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>
        </div>
        <p class="text-xs text-gray-500 mb-4">Gunakan <code>@{{nama}}</code> untuk menyisipkan nama tamu dan <code>@{{link}}</code> untuk link undangan unik mereka.</p>
        <textarea id="waTemplate" rows="10" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm shadow-sm focus:ring-2 focus:ring-gray-900/10 outline-none">{{ $template }}</textarea>
        <div class="flex gap-3 pt-4">
            <button onclick="closeTemplateModal()" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 font-medium text-sm rounded-lg hover:bg-gray-50">Tutup</button>
            <button onclick="saveTemplate()" class="flex-1 px-4 py-2 bg-gray-900 hover:bg-gray-800 text-white font-medium text-sm rounded-lg shadow-sm">Simpan Template</button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
async function addGuest() {
    const name = document.getElementById('newName').value.trim();
    const phone = document.getElementById('newPhone').value.trim();
    if(!name) return showToast('Nama wajib diisi', 'error');

    try {
        const res = await fetch('{{ route("admin.guests.store") }}', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept': 'application/json' },
            body: JSON.stringify({ name, phone })
        });
        const data = await res.json();
        if(data.success) {
            location.reload(); // Reload for simplicity in updating table
        }
    } catch(e) { showToast('Gagal menambah data', 'error'); }
}

async function updateGuest(id, field, value) {
    try {
        const res = await fetch('{{ route("admin.guests.update", "__id__") }}'.replace('__id__', id), {
            method: 'PUT',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept': 'application/json' },
            body: JSON.stringify({ [field]: value, _field_only: true }) // Back-end expects both normally, but since we rely on model updates, let's just reload or ensure the backend handles partial updates.
        });
        // Actually, our backend requires both. Let's modify the backend or just send both.
        // For this UI, we will rely on full page reload if it fails.
        // Wait, the backend currently requires both `name` and `phone`. 
        // Let's modify the fetch to just reload or let it be handled by a better backend.
    } catch(e) {}
}

// Fixed updateGuest function (since backend validates both name and phone)
async function updateGuest(id, field, value) {
    const row = document.getElementById('row-' + id);
    const inputs = row.querySelectorAll('input');
    const name = inputs[0].value;
    const phone = inputs[1].value;

    try {
        await fetch('{{ route("admin.guests.update", "__id__") }}'.replace('__id__', id), {
            method: 'PUT',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept': 'application/json' },
            body: JSON.stringify({ name, phone })
        });
        showToast('Tersimpan', 'success');
    } catch(e) { showToast('Gagal menyimpan', 'error'); }
}

async function deleteGuest(id) {
    if(!confirm('Hapus tamu ini?')) return;
    try {
        const res = await fetch('{{ route("admin.guests.destroy", "__id__") }}'.replace('__id__', id), {
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept': 'application/json' }
        });
        if(res.ok) {
            document.getElementById('row-' + id).remove();
            showToast('Tamu dihapus', 'success');
        }
    } catch(e) {}
}

function openPasteModal() { document.getElementById('pasteModal').classList.remove('hidden'); document.getElementById('pasteModal').classList.add('flex'); }
function closePasteModal() { document.getElementById('pasteModal').classList.add('hidden'); document.getElementById('pasteModal').classList.remove('flex'); }

async function processPaste() {
    const data = document.getElementById('pasteData').value;
    if(!data.trim()) return;
    try {
        const res = await fetch('{{ route("admin.guests.bulkPaste") }}', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept': 'application/json' },
            body: JSON.stringify({ data })
        });
        const result = await res.json();
        if(result.success) {
            showToast(result.message, 'success');
            setTimeout(() => location.reload(), 1000);
        }
    } catch(e) { showToast('Gagal memproses data', 'error'); }
}

function openTemplateModal() { document.getElementById('templateModal').classList.remove('hidden'); document.getElementById('templateModal').classList.add('flex'); }
function closeTemplateModal() { document.getElementById('templateModal').classList.add('hidden'); document.getElementById('templateModal').classList.remove('flex'); }

async function saveTemplate() {
    const template = document.getElementById('waTemplate').value;
    try {
        const res = await fetch('{{ route("admin.guests.saveTemplate") }}', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept': 'application/json' },
            body: JSON.stringify({ template })
        });
        const result = await res.json();
        if(result.success) {
            showToast(result.message, 'success');
            closeTemplateModal();
        }
    } catch(e) { showToast('Gagal menyimpan template', 'error'); }
}

async function sendWa(id) {
    const btn = event.target;
    const oriText = btn.textContent;
    btn.textContent = '...';
    btn.disabled = true;

    try {
        const res = await fetch('{{ route("admin.guests.sendWa", "__id__") }}'.replace('__id__', id), {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept': 'application/json' }
        });
        const data = await res.json();
        if(res.ok && data.success) {
            showToast('Terkirim!', 'success');
            setTimeout(() => location.reload(), 500);
        } else {
            showToast(data.error || 'Gagal', 'error');
            btn.textContent = 'Gagal';
        }
    } catch(e) {
        showToast('Error koneksi', 'error');
        btn.textContent = 'Error';
    }
}

async function blastAll() {
    if(!confirm('Kirim ke SEMUA tamu yang berstatus Belum? Ini mungkin memakan waktu.')) return;
    
    // Temukan semua ID tamu yang belum dikirim
    // Untuk keamanan & memori, idealnya dilakukan via Job Queue di backend.
    // Tapi karena ini web sederhana, kita trigger satu per satu via frontend agar ada visual progress
    const rows = document.querySelectorAll('tbody tr[id^="row-"]');
    const pendingIds = [];
    
    rows.forEach(row => {
        const statusSpan = row.querySelector('td:nth-child(4) span');
        if (statusSpan && statusSpan.textContent.trim() === 'Belum') {
            pendingIds.push(row.id.replace('row-', ''));
        }
    });

    if(pendingIds.length === 0) {
        return showToast('Tidak ada tamu dengan status Belum.', 'error');
    }

    showToast(`Memulai blast ke ${pendingIds.length} tamu...`, 'success');
    
    for(let i = 0; i < pendingIds.length; i++) {
        const id = pendingIds[i];
        const btn = document.querySelector(`#row-${id} td:last-child button:first-child`);
        if(btn) {
            btn.textContent = '...';
            try {
                const res = await fetch('{{ route("admin.guests.sendWa", "__id__") }}'.replace('__id__', id), {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept': 'application/json' }
                });
                const data = await res.json();
                if(res.ok && data.success) {
                    btn.textContent = 'OK';
                    btn.className = 'text-emerald-600 font-medium text-xs px-2 py-1 rounded';
                    const span = document.querySelector(`#row-${id} td:nth-child(4) span`);
                    span.className = 'px-2 py-1 bg-emerald-100 text-emerald-700 text-xs font-medium rounded-md';
                    span.textContent = 'Terkirim';
                } else {
                    btn.textContent = 'Gagal';
                    btn.className = 'text-red-500 font-medium text-xs px-2 py-1 rounded';
                }
            } catch(e) {
                btn.textContent = 'Error';
            }
        }
        
        // Jeda acak 4-8 detik antar pesan agar tidak diblokir WA (Anti-Spam / Rate Limit)
        if (i < pendingIds.length - 1) {
            const delaySeconds = Math.floor(Math.random() * (8 - 4 + 1) + 4);
            const blastBtn = document.querySelector('button[onclick="blastAll()"]');
            const originalHTML = blastBtn.innerHTML;
            
            for(let sec = delaySeconds; sec > 0; sec--) {
                blastBtn.innerHTML = `<svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Jeda ${sec} detik...`;
                await new Promise(r => setTimeout(r, 1000));
            }
            blastBtn.innerHTML = originalHTML;
        }
    }
    showToast('Blast selesai!', 'success');
    document.querySelector('button[onclick="blastAll()"]').innerHTML = `<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg> Blast Semua`;
}
</script>
@endpush
