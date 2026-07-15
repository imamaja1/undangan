@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-xl font-bold text-gray-900">Gallery</h1>
            <p class="text-sm text-gray-500 mt-0.5">Upload dan atur foto gallery.</p>
        </div>
        <button onclick="openGalleryModal()" class="inline-flex items-center gap-2 px-4 py-2.5 bg-gray-900 hover:bg-gray-800 text-white text-sm font-medium rounded-lg transition-colors shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah Foto
        </button>
    </div>

    <div>
        <input type="text" id="gallerySearch" oninput="filterTable('galleryTable', this.value)" placeholder="Cari foto..." class="w-full sm:max-w-xs px-3 py-2 rounded-lg border border-gray-300 text-sm shadow-sm focus:ring-2 focus:ring-gray-900/10 focus:border-gray-900 outline-none transition">
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <table class="w-full text-sm" id="galleryTable">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200">
                    <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">#</th>
                    <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Preview</th>
                    <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Judul</th>
                    <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">File</th>
                    <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($galleries as $gallery)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-4 py-3 text-gray-500">{{ $loop->iteration }}</td>
                    <td class="px-4 py-3">
                        <div class="w-14 h-10 rounded overflow-hidden bg-gray-100 border border-gray-200">
                            <img src="{{ asset($gallery->src) }}" alt="{{ $gallery->alt }}" class="w-full h-full object-cover" onerror="this.style.display='none'">
                        </div>
                    </td>
                    <td class="px-4 py-3 font-medium text-gray-900">{{ $gallery->title }}</td>
                    <td class="px-4 py-3 text-gray-400 text-xs font-mono">{{ $gallery->src }}</td>
                    <td class="px-4 py-3">
                        <div class="flex items-center gap-1">
                            <button onclick="editGallery(this, {{ $gallery->id }})" class="px-2.5 py-1.5 text-xs font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-md transition-colors">Edit</button>
                            <button onclick="deleteGallery('{{ $gallery->id }}')" class="px-2.5 py-1.5 text-xs font-medium text-red-500 hover:text-red-700 hover:bg-red-50 rounded-md transition-colors">Hapus</button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="px-4 py-12 text-center text-sm text-gray-400">Belum ada foto.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div id="galleryModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
    <div class="fixed inset-0 bg-black/40 backdrop-blur-sm" onclick="closeGalleryModal()"></div>
    <div class="relative bg-white rounded-2xl shadow-xl max-w-lg w-full p-6">
        <div class="flex items-center justify-between mb-5">
            <h3 class="text-lg font-semibold text-gray-900" id="galleryModalTitle">Tambah Foto</h3>
            <button onclick="closeGalleryModal()" class="text-gray-400 hover:text-gray-600"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>
        </div>
        <form id="galleryForm" class="space-y-4">
            <input type="hidden" id="galleryId">
            <input type="hidden" id="gallerySrc" value="">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Upload Gambar</label>
                <input type="file" accept="image/*" onchange="autoUpload(this, 'gallerySrc', 'galleryPreview', 'gallery')" class="w-full text-sm file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-gray-900 file:text-white hover:file:bg-gray-800 file:cursor-pointer file:transition-colors">
                <p class="text-xs text-gray-400 mt-1" id="galleryPath"></p>
                <img id="galleryPreview" class="hidden mt-2 w-full h-40 object-cover rounded-lg border border-gray-200">
            </div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Alt Text</label><input type="text" id="galleryAlt" class="w-full px-3 py-2 rounded-lg border border-gray-300 text-sm shadow-sm focus:ring-2 focus:ring-gray-900/10 focus:border-gray-900 outline-none transition"></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Judul</label><input type="text" id="galleryTitle" class="w-full px-3 py-2 rounded-lg border border-gray-300 text-sm shadow-sm focus:ring-2 focus:ring-gray-900/10 focus:border-gray-900 outline-none transition"></div>
            <div class="flex gap-3 pt-2">
                <button type="button" onclick="closeGalleryModal()" class="flex-1 px-4 py-2.5 border border-gray-300 text-gray-700 font-medium text-sm rounded-lg hover:bg-gray-50 transition-colors">Batal</button>
                <button type="submit" class="flex-1 px-4 py-2.5 bg-gray-900 hover:bg-gray-800 text-white font-medium text-sm rounded-lg transition-colors shadow-sm">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
let galleryData = @json($galleries->toArray());

function openGalleryModal() {
    document.getElementById('galleryModalTitle').textContent = 'Tambah Foto';
    document.getElementById('galleryId').value = '';
    document.getElementById('gallerySrc').value = '';
    document.getElementById('galleryForm').reset();
    document.getElementById('galleryPath').textContent = '';
    document.getElementById('galleryPreview').classList.add('hidden');
    document.getElementById('galleryPreview').src = '';
    document.getElementById('galleryModal').classList.remove('hidden');
    document.getElementById('galleryModal').classList.add('flex');
}
function closeGalleryModal() { document.getElementById('galleryModal').classList.add('hidden'); document.getElementById('galleryModal').classList.remove('flex'); }
function editGallery(btn, id) {
    const g = galleryData.find(s => s.id == id);
    if (!g) return;
    document.getElementById('galleryModalTitle').textContent = 'Edit Foto';
    document.getElementById('galleryId').value = g.id;
    document.getElementById('gallerySrc').value = g.src;
    document.getElementById('galleryAlt').value = g.alt || '';
    document.getElementById('galleryTitle').value = g.title || '';
    document.getElementById('galleryPath').textContent = g.src || '';
    const preview = document.getElementById('galleryPreview');
    if (g.src) { preview.src = '/' + g.src; preview.classList.remove('hidden'); } else { preview.classList.add('hidden'); }
    document.getElementById('galleryModal').classList.remove('hidden');
    document.getElementById('galleryModal').classList.add('flex');
}
document.getElementById('galleryForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    const id = document.getElementById('galleryId').value;
    const src = document.getElementById('gallerySrc').value;
    if (!src) { showToast('Pilih gambar dahulu.', 'error'); return; }
    const data = { src: src, alt: document.getElementById('galleryAlt').value, title: document.getElementById('galleryTitle').value };
    const url = id ? '{{ route("admin.galleries.update", "__id__") }}'.replace('__id__', id) : '{{ route("admin.galleries.store") }}';
    try {
        const res = await fetch(url, { method: id ? 'PUT' : 'POST', headers: { 'Content-Type':'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept':'application/json' }, body: JSON.stringify(data) });
        const r = await res.json();
        if (r.success) { showToast(r.message, 'success'); location.reload(); } else showToast(r.message || 'Gagal', 'error');
    } catch(e) { showToast('Gagal menyimpan.', 'error'); }
});
async function deleteGallery(id) { if (!confirm('Hapus foto ini?')) return; try { const res = await fetch('{{ route("admin.galleries.destroy", "__id__") }}'.replace('__id__', id), { method:'DELETE', headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept':'application/json' } }); const r = await res.json(); if (r.success) { showToast(r.message, 'success'); location.reload(); } else showToast(r.message || 'Gagal', 'error'); } catch(e) { showToast('Gagal.', 'error'); } }
function filterTable(tableId, query) { document.querySelectorAll(`#${tableId} tbody tr`).forEach(row => { row.style.display = row.textContent.toLowerCase().includes(query.toLowerCase()) ? '' : 'none'; }); }
</script>
@endpush
