document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('[data-tab]').forEach(tab => {
        tab.addEventListener('click', function() {
            const target = this.dataset.tab;
            document.querySelectorAll('[data-tab]').forEach(t => {
                t.classList.remove('bg-gray-800', 'text-white');
                t.classList.add('text-gray-400', 'hover:text-white', 'hover:bg-gray-800/50');
            });
            this.classList.add('bg-gray-800', 'text-white');
            this.classList.remove('text-gray-400', 'hover:text-white', 'hover:bg-gray-800/50');
            document.querySelectorAll('[data-tab-content]').forEach(content => content.classList.add('hidden'));
            const targetEl = document.querySelector(`[data-tab-content="${target}"]`);
            if (targetEl) targetEl.classList.remove('hidden');
        });
    });
});
