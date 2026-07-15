<div id="confirmDeleteModal" class="fixed inset-0 z-50 hidden items-center justify-center">
    <div class="fixed inset-0 bg-black/50" onclick="closeConfirmDelete()"></div>
    <div class="relative bg-white rounded-2xl shadow-xl max-w-sm w-full mx-4 p-6 text-center">
        <div class="w-14 h-14 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-7 h-7 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
        </div>
        <h3 class="text-lg font-semibold text-gray-800 mb-2">Konfirmasi Hapus</h3>
        <p id="confirmDeleteMessage" class="text-sm text-gray-500 mb-6">Hapus data ini?</p>
        <div class="flex gap-3">
            <button onclick="closeConfirmDelete()" class="flex-1 py-2 border border-cream-dark text-gray-700 rounded-lg text-sm font-medium hover:bg-cream transition-colors">Batal</button>
            <button id="confirmDeleteBtn" class="flex-1 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg text-sm font-medium transition-colors">Hapus</button>
        </div>
    </div>
</div>

<script>
let confirmDeleteCallback = null;
function confirmDelete(message, callback) {
    document.getElementById('confirmDeleteMessage').textContent = message;
    confirmDeleteCallback = callback;
    document.getElementById('confirmDeleteBtn').onclick = () => {
        closeConfirmDelete();
        if (confirmDeleteCallback) confirmDeleteCallback();
    };
    document.getElementById('confirmDeleteModal').classList.remove('hidden');
    document.getElementById('confirmDeleteModal').classList.add('flex');
}
function closeConfirmDelete() {
    document.getElementById('confirmDeleteModal').classList.add('hidden');
    document.getElementById('confirmDeleteModal').classList.remove('flex');
}
</script>
