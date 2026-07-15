@extends('layouts.admin')

@section('content')
<div>
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-serif font-bold text-gray-800">Gallery</h1>
            <p class="text-gray-500 text-sm mt-1">Upload dan atur foto gallery.</p>
        </div>
        <button onclick="openGalleryModal()" class="px-4 py-2 bg-gold hover:bg-gold-dark text-white rounded-lg font-medium text-sm transition-colors">+ Tambah Foto</button>
    </div>

    <div class="mb-4">
        <input type="text" id="gallerySearch" oninput="filterTable('galleryTable', this.value)" placeholder="Cari foto..." class="px-4 py-2 border border-cream-dark rounded-lg text-sm w-full max-w-xs focus:ring-2 focus:ring-gold focus:border-gold outline-none">
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-cream-dark overflow-hidden">
        <table class="w-full text-sm" id="galleryTable">
            <thead class="bg-cream">
                <tr>
                    <th class="text-left px-4 py-3 font-semibold text-gray-700">#</th>
                    <th class="text-left px-4 py-3 font-semibold text-gray-700">Preview</th>
                    <th class="text-left px-4 py-3 font-semibold text-gray-700">Judul</th>
                    <th class="text-left px-4 py-3 font-semibold text-gray-700">File</th>
                    <th class="text-left px-4 py-3 font-semibold text-gray-700">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($galleries as $gallery)
                <tr class="border-t border-cream-dark hover:bg-cream/50">
                    <td class="px-4 py-3">{{ $loop->iteration }}</td>
                    <td class="px-4 py-3">
                        <div class="w-16 h-12 rounded overflow-hidden bg-cream-dark">
                            <img src="{{ asset($gallery->src) }}" alt="{{ $gallery->alt }}" class="w-full h-full object-cover" onerror="this.style.display='none'">
                        </div>
                    </td>
                    <td class="px-4 py-3 font-medium">{{ $gallery->title }}</td>
                    <td class="px-4 py-3 text-gray-500 text-xs">{{ $gallery->src }}</td>
                    <td class="px-4 py-3">
                        <div class="flex gap-2">
                            <button onclick="editGallery(this, {{ $gallery->id }})" class="p-1.5 text-blue-600 hover:bg-blue-50 rounded transition-colors text-xs">Edit</button>
                            <button onclick="deleteGallery('{{ $gallery->id }}')" class="p-1.5 text-red-600 hover:bg-red-50 rounded transition-colors text-xs">Hapus</button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="px-4 py-8 text-center text-gray-400">Belum ada foto.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div id="galleryModal" class="fixed inset-0 z-50 hidden items-center justify-center">
    <div class="fixed inset-0 bg-black/50" onclick="closeGalleryModal()"></div>
    <div class="relative bg-white rounded-2xl shadow-xl max-w-lg w-full mx-4 p-6">
        <h3 class="text-lg font-serif font-bold text-gray-800 mb-4" id="galleryModalTitle">Tambah Foto</h3>
        <form id="galleryForm" class="space-y-3">
            <input type="hidden" id="galleryId">
            <input type="hidden" id="gallerySrc" value="">
            <div>
                <label class="text-xs text-gray-500">Upload Gambar</label>
                <div class="flex gap-2 items-start">
                    <input type="file" accept="image/*" onchange="autoUpload(this, 'gallerySrc', 'galleryPreview', 'gallery')" class="w-full text-sm file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-gold file:text-white hover:file:bg-gold-dark file:transition-colors file:cursor-pointer">
                </div>
                <p class="text-xs text-gray-400 mt-1" id="galleryPath"></p>
                <img id="galleryPreview" class="hidden mt-2 w-full h-40 object-cover rounded-lg border border-cream-dark">
            </div>
            <div><label class="text-xs text-gray-500">Alt Text</label><input type="text" id="galleryAlt" class="w-full px-3 py-2 border border-cream-dark rounded-lg text-sm focus:ring-2 focus:ring-gold focus:border-gold outline-none"></div>
            <div><label class="text-xs text-gray-500">Judul</label><input type="text" id="galleryTitle" class="w-full px-3 py-2 border border-cream-dark rounded-lg text-sm focus:ring-2 focus:ring-gold focus:border-gold outline-none"></div>
            <div class="flex gap-3 pt-2">
                <button type="button" onclick="closeGalleryModal()" class="flex-1 py-2 border border-cream-dark text-gray-700 rounded-lg text-sm font-medium">Batal</button>
                <button type="submit" class="flex-1 py-2 bg-gold hover:bg-gold-dark text-white rounded-lg text-sm font-medium">Simpan</button>
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

function closeGalleryModal() {
    document.getElementById('galleryModal').classList.add('hidden');
    document.getElementById('galleryModal').classList.remove('flex');
}

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
    if (g.src) {
        preview.src = '/' + g.src;
        preview.classList.remove('hidden');
    } else {
        preview.classList.add('hidden');
    }
    document.getElementById('galleryModal').classList.remove('hidden');
    document.getElementById('galleryModal').classList.add('flex');
}

document.getElementById('galleryForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    const id = document.getElementById('galleryId').value;
    const src = document.getElementById('gallerySrc').value;
    if (!src) { showToast('Pilih gambar terlebih dahulu.', 'error'); return; }
    const data = {
        src: src,
        alt: document.getElementById('galleryAlt').value,
        title: document.getElementById('galleryTitle').value,
    };
    const url = id ? '{{ route("admin.galleries.update", "__id__") }}'.replace('__id__', id) : '{{ route("admin.galleries.store") }}';
    const method = id ? 'PUT' : 'POST';
    try {
        const res = await fetch(url, {
            method, headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept': 'application/json' },
            body: JSON.stringify(data)
        });
        const r = await res.json();
        if (r.success) { showToast(r.message, 'success'); location.reload(); }
        else showToast(r.message || 'Gagal', 'error');
    } catch(e) { showToast('Gagal menyimpan.', 'error'); }
});

async function deleteGallery(id) {
    if (!confirm('Hapus foto ini?')) return;
    try {
        const res = await fetch('{{ route("admin.galleries.destroy", "__id__") }}'.replace('__id__', id), {
            method: 'DELETE', headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept': 'application/json' }
        });
        const r = await res.json();
        if (r.success) { showToast(r.message, 'success'); location.reload(); }
        else showToast(r.message || 'Gagal', 'error');
    } catch(e) { showToast('Gagal menghapus.', 'error'); }
}

function filterTable(tableId, query) {
    const rows = document.querySelectorAll(`#${tableId} tbody tr`);
    rows.forEach(row => { row.style.display = row.textContent.toLowerCase().includes(query.toLowerCase()) ? '' : 'none'; });
}
</script>
@endpush
