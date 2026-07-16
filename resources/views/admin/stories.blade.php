@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-xl font-bold text-gray-900">Love Story</h1>
            <p class="text-sm text-gray-500 mt-0.5">Kelola cerita perjalanan cinta.</p>
        </div>
        <button onclick="openStoryModal()" class="inline-flex items-center gap-2 px-4 py-2.5 bg-gray-900 hover:bg-gray-800 text-white text-sm font-medium rounded-lg transition-colors shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah Story
        </button>
    </div>

    <div>
        <input type="text" id="storySearch" oninput="filterTable('storyTable', this.value)" placeholder="Cari story..." class="w-full sm:max-w-xs px-3 py-2 rounded-lg border border-gray-300 text-sm shadow-sm focus:ring-2 focus:ring-gray-900/10 focus:border-gray-900 outline-none transition">
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden overflow-x-auto">
        <table class="w-full text-sm" id="storyTable">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200">
                    <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">#</th>
                    <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Tanggal</th>
                    <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Judul</th>
                    <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Deskripsi</th>
                    <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($stories as $story)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-4 py-3 text-gray-500">{{ $loop->iteration }}</td>
                    <td class="px-4 py-3 text-gray-700">{{ $story->date_label }}</td>
                    <td class="px-4 py-3 font-medium text-gray-900">{{ $story->title }}</td>
                    <td class="px-4 py-3 text-gray-500 max-w-xs truncate">{{ Str::limit($story->description, 60) }}</td>
                    <td class="px-4 py-3">
                        <div class="flex items-center gap-1">
                            <button onclick="editStory(this, {{ $story->id }})" class="px-2.5 py-1.5 text-xs font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-md transition-colors">Edit</button>
                            <button onclick="deleteStory('{{ $story->id }}')" class="px-2.5 py-1.5 text-xs font-medium text-red-500 hover:text-red-700 hover:bg-red-50 rounded-md transition-colors">Hapus</button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="px-4 py-12 text-center text-sm text-gray-400">Belum ada story.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div id="storyModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
    <div class="fixed inset-0 bg-black/40 backdrop-blur-sm" onclick="closeStoryModal()"></div>
    <div class="relative bg-white rounded-2xl shadow-xl max-w-lg w-full p-6">
        <div class="flex items-center justify-between mb-5">
            <h3 class="text-lg font-semibold text-gray-900" id="storyModalTitle">Tambah Story</h3>
            <button onclick="closeStoryModal()" class="text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <form id="storyForm" class="space-y-4">
            <input type="hidden" id="storyId">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                <input type="text" id="storyDateLabel" required class="w-full px-3 py-2 rounded-lg border border-gray-300 text-sm shadow-sm focus:ring-2 focus:ring-gray-900/10 focus:border-gray-900 outline-none transition" placeholder="Januari 2022">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Judul</label>
                <input type="text" id="storyTitle" required class="w-full px-3 py-2 rounded-lg border border-gray-300 text-sm shadow-sm focus:ring-2 focus:ring-gray-900/10 focus:border-gray-900 outline-none transition">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                <textarea id="storyDescription" rows="4" required class="w-full px-3 py-2 rounded-lg border border-gray-300 text-sm shadow-sm focus:ring-2 focus:ring-gray-900/10 focus:border-gray-900 outline-none transition"></textarea>
            </div>
            <input type="hidden" id="storyImage" value="">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Gambar</label>
                <input type="file" accept="image/*" onchange="autoUpload(this, 'storyImage', 'storyPreview', 'story')" class="w-full text-sm file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-gray-900 file:text-white hover:file:bg-gray-800 file:cursor-pointer file:transition-colors">
                <p class="text-xs text-gray-400 mt-1" id="storyPathDisplay"></p>
                <img id="storyPreview" class="hidden mt-2 w-full h-40 object-cover rounded-lg border border-gray-200">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Animasi</label>
                <select id="storyAnimation" class="w-full px-3 py-2 rounded-lg border border-gray-300 text-sm shadow-sm focus:ring-2 focus:ring-gray-900/10 focus:border-gray-900 outline-none transition">
                    <option value="fade-right">fade-right</option><option value="fade-left">fade-left</option><option value="fade-up">fade-up</option>
                </select>
            </div>
            <div class="flex gap-3 pt-2">
                <button type="button" onclick="closeStoryModal()" class="flex-1 px-4 py-2.5 border border-gray-300 text-gray-700 font-medium text-sm rounded-lg hover:bg-gray-50 transition-colors">Batal</button>
                <button type="submit" class="flex-1 px-4 py-2.5 bg-gray-900 hover:bg-gray-800 text-white font-medium text-sm rounded-lg transition-colors shadow-sm">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
let storyData = @json($stories->toArray());

function openStoryModal() {
    document.getElementById('storyModalTitle').textContent = 'Tambah Story';
    document.getElementById('storyId').value = '';
    document.getElementById('storyImage').value = '';
    document.getElementById('storyForm').reset();
    document.getElementById('storyPathDisplay').textContent = '';
    document.getElementById('storyPreview').classList.add('hidden');
    document.getElementById('storyPreview').src = '';
    document.getElementById('storyModal').classList.remove('hidden');
    document.getElementById('storyModal').classList.add('flex');
}

function closeStoryModal() { document.getElementById('storyModal').classList.add('hidden'); document.getElementById('storyModal').classList.remove('flex'); }

function editStory(btn, id) {
    const story = storyData.find(s => s.id == id);
    if (!story) return;
    document.getElementById('storyModalTitle').textContent = 'Edit Story';
    document.getElementById('storyId').value = story.id;
    document.getElementById('storyDateLabel').value = story.date_label;
    document.getElementById('storyTitle').value = story.title;
    document.getElementById('storyDescription').value = story.description;
    document.getElementById('storyImage').value = story.image || '';
    document.getElementById('storyAnimation').value = story.animation || 'fade-right';
    document.getElementById('storyPathDisplay').textContent = story.image || '';
    const preview = document.getElementById('storyPreview');
    if (story.image) { preview.src = '/' + story.image; preview.classList.remove('hidden'); } else { preview.classList.add('hidden'); }
    document.getElementById('storyModal').classList.remove('hidden');
    document.getElementById('storyModal').classList.add('flex');
}

document.getElementById('storyForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    const id = document.getElementById('storyId').value;
    const data = { date_label: document.getElementById('storyDateLabel').value, title: document.getElementById('storyTitle').value, description: document.getElementById('storyDescription').value, image: document.getElementById('storyImage').value, animation: document.getElementById('storyAnimation').value };
    const url = id ? '{{ route("admin.stories.update", "__id__") }}'.replace('__id__', id) : '{{ route("admin.stories.store") }}';
    try {
        const res = await fetch(url, { method: id ? 'PUT' : 'POST', headers: { 'Content-Type':'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept':'application/json' }, body: JSON.stringify(data) });
        const r = await res.json();
        if (r.success) { showToast(r.message, 'success'); location.reload(); } else showToast(r.message || 'Gagal', 'error');
    } catch(e) { showToast('Gagal menyimpan.', 'error'); }
});

async function deleteStory(id) {
    if (!confirm('Hapus story ini?')) return;
    try {
        const res = await fetch('{{ route("admin.stories.destroy", "__id__") }}'.replace('__id__', id), { method:'DELETE', headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept':'application/json' } });
        const r = await res.json();
        if (r.success) { showToast(r.message, 'success'); location.reload(); } else showToast(r.message || 'Gagal', 'error');
    } catch(e) { showToast('Gagal menghapus.', 'error'); }
}

function filterTable(tableId, query) {
    document.querySelectorAll(`#${tableId} tbody tr`).forEach(row => {
        row.style.display = row.textContent.toLowerCase().includes(query.toLowerCase()) ? '' : 'none';
    });
}
</script>
@endpush
