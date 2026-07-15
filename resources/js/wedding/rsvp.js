window.sendRSVP = function(e) {
    e.preventDefault();
    const name = document.getElementById('rsvpName')?.value || '';
    const status = document.getElementById('rsvpStatus')?.value || '';
    const guests = document.getElementById('rsvpGuests')?.value || '1';
    const message = document.getElementById('rsvpMessage')?.value || '';
    const waEl = document.getElementById('waNumber');
    const wa = waEl ? waEl.value : '';

    if (!wa) { alert('Nomor WhatsApp belum dikonfigurasi.'); return; }

    const text = `*RSVP Undangan*\n\nNama: ${name}\nKehadiran: ${status}\nJumlah Tamu: ${guests}\nPesan: ${message}`;
    window.open(`https://wa.me/${wa}?text=${encodeURIComponent(text)}`, '_blank');
};
