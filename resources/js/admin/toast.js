window.showToast = function(message, type) {
    type = type || 'info';
    const colors = {
        success: 'border-emerald-500',
        error: 'border-red-500',
        warning: 'border-amber-500',
        info: 'border-blue-500'
    };
    const icons = {
        success: `<svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>`,
        error: `<svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>`,
        warning: `<svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>`,
        info: `<svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>`,
    };
    const titles = { success: 'Berhasil', error: 'Gagal', warning: 'Perhatian', info: 'Info' };

    const container = document.getElementById('toastContainer');
    if (!container) return;

    const toast = document.createElement('div');
    toast.className = `bg-white rounded-xl shadow-lg border-l-4 ${colors[type] || colors.info} p-4 pr-6 min-w-[300px] max-w-sm flex items-start gap-3 animate-slideUp`;
    toast.innerHTML = `
        <div class="shrink-0 mt-0.5">${icons[type] || icons.info}</div>
        <div class="flex-1 min-w-0">
            <p class="text-sm font-semibold text-gray-900">${titles[type]}</p>
            <p class="text-sm text-gray-600 mt-0.5">${message}</p>
        </div>
        <button onclick="this.parentElement.remove()" class="text-gray-400 hover:text-gray-600 shrink-0">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
    `;
    container.appendChild(toast);
    setTimeout(() => { toast.style.opacity = '0'; toast.style.transition = 'opacity 0.3s'; setTimeout(() => toast.remove(), 300); }, 4000);
};

const style = document.createElement('style');
style.textContent = `@keyframes slideUp { from { opacity: 0; transform: translateY(16px); } to { opacity: 1; transform: translateY(0); } } .animate-slideUp { animation: slideUp 0.3s ease; }`;
document.head.appendChild(style);
