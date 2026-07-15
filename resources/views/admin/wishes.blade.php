@extends('layouts.admin')

@section('content')
<div>
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-serif font-bold text-gray-800">Ucapan & Doa</h1>
            <p class="text-gray-500 text-sm mt-1">Lihat dan kelola ucapan dari tamu.</p>
        </div>
        <span class="text-sm text-gray-500">{{ $wishes->total() }} ucapan</span>
    </div>

    <div class="mb-4">
        <input type="text" id="wishSearch" oninput="filterTable('wishTable', this.value)" placeholder="Cari ucapan..." class="px-4 py-2 border border-cream-dark rounded-lg text-sm w-full max-w-xs focus:ring-2 focus:ring-gold focus:border-gold outline-none">
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-cream-dark overflow-hidden">
        <table class="w-full text-sm" id="wishTable">
            <thead class="bg-cream">
                <tr>
                    <th class="text-left px-4 py-3 font-semibold text-gray-700">#</th>
                    <th class="text-left px-4 py-3 font-semibold text-gray-700">Nama</th>
                    <th class="text-left px-4 py-3 font-semibold text-gray-700">Ucapan</th>
                    <th class="text-left px-4 py-3 font-semibold text-gray-700">Tanggal</th>
                    <th class="text-left px-4 py-3 font-semibold text-gray-700">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($wishes as $wish)
                <tr class="border-t border-cream-dark hover:bg-cream/50">
                    <td class="px-4 py-3">{{ $wishes->firstItem() + $loop->index }}</td>
                    <td class="px-4 py-3 font-medium">{{ $wish->name }}</td>
                    <td class="px-4 py-3 text-gray-500 max-w-xs truncate">{{ $wish->message }}</td>
                    <td class="px-4 py-3 text-xs text-gray-400">{{ $wish->created_at->format('d M Y H:i') }}</td>
                    <td class="px-4 py-3">
                        <button onclick="deleteWish('{{ $wish->id }}')" class="p-1.5 text-red-600 hover:bg-red-50 rounded transition-colors text-xs">Hapus</button>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="px-4 py-8 text-center text-gray-400">Belum ada ucapan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $wishes->links() }}
    </div>
</div>
@endsection

@push('scripts')
<script>
async function deleteWish(id) {
    if (!confirm('Hapus ucapan ini?')) return;
    try {
        const res = await fetch('{{ route("admin.wishes.destroy", "__id__") }}'.replace('__id__', id), {
            method: 'DELETE', headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept': 'application/json' }
        });
        const r = await res.json();
        if (r.success) { showToast(r.message, 'success'); location.reload(); }
        else showToast(r.message || 'Gagal', 'error');
    } catch(e) { showToast('Gagal menghapus.', 'error'); }
}

function filterTable(tableId, query) {
    document.querySelectorAll(`#${tableId} tbody tr`).forEach(row => {
        row.style.display = row.textContent.toLowerCase().includes(query.toLowerCase()) ? '' : 'none';
    });
}
</script>
@endpush
