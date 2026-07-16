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
                card.className = 'glass rounded-2xl p-5 shadow-xl animate-wishIn';
                card.innerHTML = `
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-9 h-9 bg-rose-base/10 rounded-full flex items-center justify-center text-rose-base font-sans text-xs font-medium border border-rose-base/20">${name.charAt(0).toUpperCase()}</div>
                        <div>
                            <p class="font-sans text-sm text-rose-light font-medium">${name}</p>
                            <p class="text-[10px] text-champagne/30">Baru saja</p>
                        </div>
                    </div>
                    <p class="font-sans text-sm text-champagne/60 font-normal leading-relaxed">${message}</p>
                `;
                list.insertBefore(card, list.firstChild);
            }
            form.reset();
            showToast?.('Ucapan berhasil dikirim!', 'success');
        }
    } catch (err) {
        alert('Gagal mengirim ucapan. Silakan coba lagi.');
    }
};
