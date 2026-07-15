window.submitWish = async function(e) {
    e.preventDefault();
    const form = e.target;
    const name = document.getElementById('wishName')?.value?.trim();
    const message = document.getElementById('wishMessage')?.value?.trim();

    if (!name || !message) { alert('Mohon isi nama dan ucapan.'); return; }

    const token = document.querySelector('meta[name="csrf-token"]')?.content;
    const wishUrl = form.dataset.url || form.action;

    try {
        const res = await fetch(wishUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ name, message })
        });
        const data = await res.json();

        if (data.success) {
            const list = document.getElementById('wishList');
            if (list) {
                const card = document.createElement('div');
                card.className = 'bg-white rounded-xl p-5 shadow-sm border border-cream-dark animate-fadeIn';
                card.innerHTML = `
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-10 h-10 bg-gold/10 rounded-full flex items-center justify-center text-gold font-bold text-sm">${name.charAt(0).toUpperCase()}</div>
                        <div>
                            <p class="font-semibold text-gray-800">${name}</p>
                            <p class="text-xs text-gray-400">Baru saja</p>
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm">${message}</p>
                `;
                list.insertBefore(card, list.firstChild);
            }
            form.reset();
        }
    } catch (err) {
        alert('Gagal mengirim ucapan. Silakan coba lagi.');
    }
};
