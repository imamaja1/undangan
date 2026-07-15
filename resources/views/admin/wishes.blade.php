@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-xl font-bold text-gray-900">Ucapan & Doa</h1>
            <p class="text-sm text-gray-500 mt-0.5">Lihat dan kelola ucapan dari tamu.</p>
        </div>
        <span class="text-sm text-gray-500 font-medium">{{ $wishes->total() }} ucapan</span>
    </div>

    <div>
        <input type="text" id="wishSearch" oninput="filterTable('wishTable', this.value)" placeholder="Cari ucapan..." class="w-full sm:max-w-xs px-3 py-2 rounded-lg border border-gray-300 text-sm shadow-sm focus:ring-2 focus:ring-gray-900/10 focus:border-gray-900 outline-none transition">
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <table class="w-full text-sm" id="wishTable">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200">
                    <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">#</th>
                    <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Nama</th>
                    <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Ucapan</th>
                    <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Tanggal</th>
                    <th class="text-right px-4 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($wishes as $wish)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-4 py-3 text-gray-500">{{ $wishes->firstItem() + $loop->index }}</td>
                    <td class="px-4 py-3 font-medium text-gray-900">{{ $wish->name }}</td>
                    <td class="px-4 py-3 text-gray-600 max-w-xs truncate">{{ $wish->message }}</td>
                    <td class="px-4 py-3 text-gray-400 text-xs">{{ $wish->created_at->format('d M Y H:i') }}</td>
                    <td class="px-4 py-3 text-right">
                        <button onclick="deleteWish('{{ $wish->id }}')" class="px-2.5 py-1.5 text-xs font-medium text-red-500 hover:text-red-700 hover:bg-red-50 rounded-md transition-colors">Hapus</button>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="px-4 py-12 text-center text-sm text-gray-400">Belum ada ucapan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div>
        {{ $wishes->links() }}
    </div>
</div>
@endsection

@push('scripts')
<script>
async function deleteWish(id) { if (!confirm('Hapus?')) return; try { const res = await fetch('{{ route("admin.wishes.destroy", "__id__") }}'.replace('__id__', id), { method:'DELETE', headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept':'application/json' } }); const r = await res.json(); if (r.success) { showToast(r.message, 'success'); location.reload(); } else showToast(r.message || 'Gagal', 'error'); } catch(e) { showToast('Gagal.', 'error'); } }
function filterTable(tableId, query) { document.querySelectorAll(`#${tableId} tbody tr`).forEach(row => { row.style.display = row.textContent.toLowerCase().includes(query.toLowerCase()) ? '' : 'none'; }); }
</script>
@endpush
