window.toggleBankNumber = function(btn, number) {
    const parent = btn.closest('.grid > div') || btn.parentElement.parentElement;
    const numEl = parent.querySelector('.bank-number');
    if (!numEl) return;

    if (numEl.textContent === number) {
        numEl.textContent = number.replace(/.(?=.{4})/g, 'x');
        btn.textContent = 'Lihat Rekening';
    } else {
        numEl.textContent = number;
        btn.textContent = 'Sembunyikan';
    }
};

window.copyToClipboard = function(text, btn) {
    const cleanText = text.replace(/\s/g, '');
    navigator.clipboard.writeText(cleanText).then(() => {
        const original = btn.textContent;
        btn.textContent = 'Tersalin!';
        btn.classList.add('!bg-green-600');
        setTimeout(() => {
            btn.textContent = original;
            btn.classList.remove('!bg-green-600');
        }, 2000);
    }).catch(() => {
        const textarea = document.createElement('textarea');
        textarea.value = cleanText;
        document.body.appendChild(textarea);
        textarea.select();
        document.execCommand('copy');
        document.body.removeChild(textarea);
        btn.textContent = 'Tersalin!';
        setTimeout(() => { btn.textContent = 'Salin'; }, 2000);
    });
};
