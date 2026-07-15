<div id="toastContainer" class="fixed bottom-6 right-6 z-50 space-y-3"></div>

<script>
function showToast(message, type) {
    type = type || 'info';
    const colors = {
        success: 'bg-green-500',
        error: 'bg-red-500',
        warning: 'bg-yellow-500',
        info: 'bg-blue-500'
    };
    const icons = {
        success: 'OK',
        error: 'XX',
        warning: '!!',
        info: 'ii'
    };

    const toast = document.createElement('div');
    toast.className = `${colors[type] || colors.info} text-white px-5 py-3 rounded-xl shadow-lg flex items-center gap-3 animate-slideUp min-w-[280px]`;
    toast.innerHTML = `
        <span class="font-bold text-sm">${icons[type] || 'ii'}</span>
        <span class="text-sm">${message}</span>
    `;
    document.getElementById('toastContainer').appendChild(toast);

    setTimeout(() => {
        toast.style.opacity = '0';
        toast.style.transform = 'translateX(100%)';
        toast.style.transition = 'all 0.3s ease';
        setTimeout(() => toast.remove(), 300);
    }, 3000);
}
</script>

<style>
@keyframes slideUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}
.animate-slideUp { animation: slideUp 0.3s ease; }
</style>
