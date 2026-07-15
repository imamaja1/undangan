document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('[data-tab]').forEach(tab => {
        tab.addEventListener('click', function() {
            const target = this.dataset.tab;
            
            document.querySelectorAll('[data-tab]').forEach(t => t.classList.remove('border-gold', 'text-gold'));
            this.classList.add('border-gold', 'text-gold');
            
            document.querySelectorAll('[data-tab-content]').forEach(content => {
                content.classList.add('hidden');
            });
            
            const targetEl = document.querySelector(`[data-tab-content="${target}"]`);
            if (targetEl) targetEl.classList.remove('hidden');
        });
    });
});
