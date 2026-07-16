<section id="rsvp" class="py-20 md:py-32 section-bg overlay-warm-dark section-fade-top" style="background-image: url('{{ asset('images/hero/rsvp-bg.jpg') }}?v={{ file_exists(public_path('images/hero/rsvp-bg.jpg')) ? filemtime(public_path('images/hero/rsvp-bg.jpg')) : time() }}')">
    <input type="hidden" id="waNumber" value="{{ $wedding->wa_number ?? '' }}">
    <div class="particle-container" id="rsvpParticles"></div>
    <div class="relative z-10 max-w-lg mx-auto px-6">
        <p class="text-center text-rose-base/40 font-sans text-[10px] tracking-[0.5em] uppercase mb-3" data-reveal="fade">Konfirmasi</p>
        <h2 class="font-serif text-3xl md:text-5xl text-white font-normal tracking-wide text-center text-shadow mb-4" data-reveal="fade" data-reveal-delay="100">RSVP</h2>
        <div class="divider-ornament mb-16" data-reveal="fade" data-reveal-delay="200">
            <div class="divider-ornament-icon"></div>
        </div>

        <form id="rsvpForm" class="glass-rose rounded-2xl p-6 md:p-8 shadow-2xl space-y-5" onsubmit="sendRSVP(event)" data-reveal="up" data-reveal-delay="300">
            <div>
                <label class="text-[10px] uppercase tracking-[0.3em] text-rose-base/50 mb-2 block font-sans">Nama</label>
                <input type="text" id="rsvpName" required class="glass-input" placeholder="Nama lengkap">
            </div>
            <div>
                <label class="text-[10px] uppercase tracking-[0.3em] text-rose-base/50 mb-2 block font-sans">Kehadiran</label>
                <select id="rsvpStatus" required class="glass-select">
                    <option value="">Pilih</option>
                    <option value="Hadir">Hadir</option>
                    <option value="Tidak Hadir">Tidak Hadir</option>
                </select>
            </div>
            <div>
                <label class="text-[10px] uppercase tracking-[0.3em] text-rose-base/50 mb-2 block font-sans">Jumlah Tamu</label>
                <input type="number" id="rsvpGuests" min="1" value="1" class="glass-input">
            </div>
            <div>
                <label class="text-[10px] uppercase tracking-[0.3em] text-rose-base/50 mb-2 block font-sans">Pesan</label>
                <textarea id="rsvpMessage" rows="3" class="glass-input" placeholder="Tulis pesan (opsional)"></textarea>
            </div>
            <button type="submit" class="ghost-btn w-full py-3.5">
                Kirim Konfirmasi
            </button>
        </form>
    </div>
</section>
