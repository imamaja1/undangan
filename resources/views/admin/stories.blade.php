@extends('layouts.admin')

@section('content')
<div>
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-serif font-bold text-gray-800">Love Story</h1>
            <p class="text-gray-500 text-sm mt-1">Kelola cerita perjalanan cinta.</p>
        </div>
        <button onclick="openStoryModal()" class="px-4 py-2 bg-gold hover:bg-gold-dark text-white rounded-lg font-medium text-sm transition-colors">+ Tambah Story</button>
    </div>

    <div class="mb-4">
        <input type="text" id="storySearch" oninput="filterTable('storyTable', this.value)" placeholder="Cari story..." class="px-4 py-2 border border-cream-dark rounded-lg text-sm w-full max-w-xs focus:ring-2 focus:ring-gold focus:border-gold outline-none">
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-cream-dark overflow-hidden">
        <table class="w-full text-sm" id="storyTable">
            <thead class="bg-cream">
                <tr>
                    <th class="text-left px-4 py-3 font-semibold text-gray-700">#</th>
                    <th class="text-left px-4 py-3 font-semibold text-gray-700">Tanggal</th>
                    <th class="text-left px-4 py-3 font-semibold text-gray-700">Judul</th>
                    <th class="text-left px-4 py-3 font-semibold text-gray-700">Deskripsi</th>
                    <th class="text-left px-4 py-3 font-semibold text-gray-700">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($stories as $story)
                <tr class="border-t border-cream-dark hover:bg-cream/50">
                    <td class="px-4 py-3">{{ $loop->iteration }}</td>
                    <td class="px-4 py-3">{{ $story->date_label }}</td>
                    <td class="px-4 py-3 font-medium">{{ $story->title }}</td>
                    <td class="px-4 py-3 text-gray-500 max-w-xs truncate">{{ Str::limit($story->description, 60) }}</td>
                    <td class="px-4 py-3">
                        <div class="flex gap-2">
                            <button onclick="editStory(this, {{ $story->id }})" class="p-1.5 text-blue-600 hover:bg-blue-50 rounded transition-colors">Edit</button>
                            <button onclick="deleteStory('{{ $story->id }}')" class="p-1.5 text-red-600 hover:bg-red-50 rounded transition-colors">Hapus</button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="px-4 py-8 text-center text-gray-400">Belum ada story.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div id="storyModal" class="fixed inset-0 z-50 hidden items-center justify-center">
    <div class="fixed inset-0 bg-black/50" onclick="closeStoryModal()"></div>
    <div class="relative bg-white rounded-2xl shadow-xl max-w-lg w-full mx-4 p-6">
        <h3 class="text-lg font-serif font-bold text-gray-800 mb-4" id="storyModalTitle">Tambah Story</h3>
        <form id="storyForm" class="space-y-3">
            <input type="hidden" id="storyId">
            <div><label class="text-xs text-gray-500">Tanggal</label><input type="text" id="storyDateLabel" required class="w-full px-3 py-2 border border-cream-dark rounded-lg text-sm focus:ring-2 focus:ring-gold focus:border-gold outline-none"></div>
            <div><label class="text-xs text-gray-500">Judul</label><input type="text" id="storyTitle" required class="w-full px-3 py-2 border border-cream-dark rounded-lg text-sm focus:ring-2 focus:ring-gold focus:border-gold outline-none"></div>
            <div><label class="text-xs text-gray-500">Deskripsi</label><textarea id="storyDescription" rows="4" required class="w-full px-3 py-2 border border-cream-dark rounded-lg text-sm focus:ring-2 focus:ring-gold focus:border-gold outline-none"></textarea></div>
            <input type="hidden" id="storyImage" value="">
            <div>
                <label class="text-xs text-gray-500">Upload Gambar</label>
                <input type="file" accept="image/*" onchange="autoUpload(this, 'storyImage', 'storyPreview', 'story')" class="w-full text-sm file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-gold file:text-white hover:file:bg-gold-dark file:transition-colors file:cursor-pointer">
                <p class="text-xs text-gray-400 mt-1" id="storyPathDisplay"></p>
                <img id="storyPreview" class="hidden mt-2 w-full h-40 object-cover rounded-lg border border-cream-dark">
            </div>
            <div><label class="text-xs text-gray-500">Animasi</label><select id="storyAnimation" class="w-full px-3 py-2 border border-cream-dark rounded-lg text-sm focus:ring-2 focus:ring-gold focus:border-gold outline-none">
                <option value="fade-right">fade-right</option><option value="fade-left">fade-left</option><option value="fade-up">fade-up</option>
            </select></div>
            <div class="flex gap-3 pt-2">
                <button type="button" onclick="closeStoryModal()" class="flex-1 py-2 border border-cream-dark text-gray-700 rounded-lg text-sm font-medium">Batal</button>
                <button type="submit" class="flex-1 py-2 bg-gold hover:bg-gold-dark text-white rounded-lg text-sm font-medium">Simpan</button>
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

function closeStoryModal() {
    document.getElementById('storyModal').classList.add('hidden');
    document.getElementById('storyModal').classList.remove('flex');
}

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
    if (story.image) {
        preview.src = '/' + story.image;
        preview.classList.remove('hidden');
    } else {
        preview.classList.add('hidden');
    }
    document.getElementById('storyModal').classList.remove('hidden');
    document.getElementById('storyModal').classList.add('flex');
}

document.getElementById('storyForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    const id = document.getElementById('storyId').value;
    const data = {
        date_label: document.getElementById('storyDateLabel').value,
        title: document.getElementById('storyTitle').value,
        description: document.getElementById('storyDescription').value,
        image: document.getElementById('storyImage').value,
        animation: document.getElementById('storyAnimation').value,
    };
    const url = id ? '{{ route("admin.stories.update", "__id__") }}'.replace('__id__', id) : '{{ route("admin.stories.store") }}';
    const method = id ? 'PUT' : 'POST';
    try {
        const res = await fetch(url, {
            method,
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept': 'application/json' },
            body: JSON.stringify(data)
        });
        const r = await res.json();
        if (r.success) { showToast(r.message, 'success'); location.reload(); }
        else showToast(r.message || 'Gagal', 'error');
    } catch(e) { showToast('Gagal menyimpan.', 'error'); }
});

async function deleteStory(id) {
    if (!confirm('Hapus story ini?')) return;
    try {
        const res = await fetch('{{ route("admin.stories.destroy", "__id__") }}'.replace('__id__', id), {
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept': 'application/json' }
        });
        const r = await res.json();
        if (r.success) { showToast(r.message, 'success'); location.reload(); }
        else showToast(r.message || 'Gagal', 'error');
    } catch(e) { showToast('Gagal menghapus.', 'error'); }
}

function filterTable(tableId, query) {
    const rows = document.querySelectorAll(`#${tableId} tbody tr`);
    const q = query.toLowerCase();
    rows.forEach(row => {
        row.style.display = row.textContent.toLowerCase().includes(q) ? '' : 'none';
    });
}
</script>
@endpush
