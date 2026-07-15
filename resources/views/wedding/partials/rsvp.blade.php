<section id="rsvp" class="py-16 md:py-24 bg-cream">
    <input type="hidden" id="waNumber" value="{{ $wedding->wa_number ?? '' }}">
    <div class="max-w-lg mx-auto px-6">
        <h2 class="text-center font-serif text-3xl md:text-4xl font-bold text-gray-800 mb-4" data-reveal="fade">RSVP</h2>
        <p class="text-center text-gold font-script text-2xl mb-12" data-reveal="scale">Konfirmasi Kehadiran</p>

        <form id="rsvpForm" class="space-y-4 bg-white rounded-xl p-6 shadow-sm border border-cream-dark" onsubmit="sendRSVP(event)" data-reveal="up">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                <input type="text" id="rsvpName" required class="w-full px-4 py-2.5 border border-cream-dark rounded-lg focus:ring-2 focus:ring-gold focus:border-gold outline-none transition" placeholder="Nama lengkap" data-reveal-delay="100">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Kehadiran</label>
                <select id="rsvpStatus" required class="w-full px-4 py-2.5 border border-cream-dark rounded-lg focus:ring-2 focus:ring-gold focus:border-gold outline-none transition">
                    <option value="">-- Pilih --</option>
                    <option value="Hadir">Hadir</option>
                    <option value="Tidak Hadir">Tidak Hadir</option>
                    <option value="Masih Ragu">Masih Ragu</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah Tamu</label>
                <input type="number" id="rsvpGuests" min="1" value="1" class="w-full px-4 py-2.5 border border-cream-dark rounded-lg focus:ring-2 focus:ring-gold focus:border-gold outline-none transition">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Pesan</label>
                <textarea id="rsvpMessage" rows="3" class="w-full px-4 py-2.5 border border-cream-dark rounded-lg focus:ring-2 focus:ring-gold focus:border-gold outline-none transition" placeholder="Tulis pesan (opsional)"></textarea>
            </div>
            <button type="submit" class="w-full py-3 bg-gold hover:bg-gold-dark text-white rounded-lg font-medium transition-all duration-300 shadow-md hover:shadow-lg hover:-translate-y-0.5">
                Kirim Konfirmasi
            </button>
        </form>
    </div>
</section>
