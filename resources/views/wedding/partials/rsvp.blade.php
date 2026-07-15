<section id="rsvp" class="py-20 md:py-32 section-bg overlay-darker section-fade-top" style="background-image: url('{{ asset('images/hero/rsvp-bg.jpg') }}')">
    <input type="hidden" id="waNumber" value="{{ $wedding->wa_number ?? '' }}">
    <div class="relative z-10 max-w-lg mx-auto px-6">
        <h2 class="font-serif text-3xl md:text-4xl text-white font-light tracking-wide text-center text-shadow mb-16" data-reveal="fade">RSVP</h2>

        <form id="rsvpForm" class="glass rounded-2xl p-6 md:p-8 shadow-2xl space-y-5" onsubmit="sendRSVP(event)" data-reveal="up">
            <div>
                <label class="text-[10px] uppercase tracking-[0.3em] text-white/50 mb-2 block font-sans">Nama</label>
                <input type="text" id="rsvpName" required class="glass-input" placeholder="Nama lengkap">
            </div>
            <div>
                <label class="text-[10px] uppercase tracking-[0.3em] text-white/50 mb-2 block font-sans">Kehadiran</label>
                <select id="rsvpStatus" required class="glass-select">
                    <option value="">Pilih</option>
                    <option value="Hadir">Hadir</option>
                    <option value="Tidak Hadir">Tidak Hadir</option>
                </select>
            </div>
            <div>
                <label class="text-[10px] uppercase tracking-[0.3em] text-white/50 mb-2 block font-sans">Jumlah Tamu</label>
                <input type="number" id="rsvpGuests" min="1" value="1" class="glass-input">
            </div>
            <div>
                <label class="text-[10px] uppercase tracking-[0.3em] text-white/50 mb-2 block font-sans">Pesan</label>
                <textarea id="rsvpMessage" rows="3" class="glass-input" placeholder="Tulis pesan (opsional)"></textarea>
            </div>
            <button type="submit" class="ghost-btn w-full py-3.5">
                Kirim Konfirmasi
            </button>
        </form>
    </div>
</section>
