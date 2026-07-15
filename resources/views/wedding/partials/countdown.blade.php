<section id="countdown" class="py-16 md:py-24 bg-cover bg-center bg-no-repeat" style="background-image: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('{{ asset('images/hero/wedding-hero.jpg') }}')">
    <input type="hidden" id="countdownTarget" value="{{ $wedding->wedding_info['date'] ?? '' }}">
    <div class="max-w-4xl mx-auto px-6 text-center text-white">
        <h2 class="font-serif text-3xl md:text-4xl font-bold mb-2" data-reveal="fade">Menuju Hari Bahagia</h2>
        <p class="text-gold font-script text-2xl mb-10" data-reveal="scale">Countdown</p>
        <div class="grid grid-cols-4 gap-4 md:gap-6">
            <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 md:p-6 countdown-pulse" data-reveal="up" data-reveal-delay="100">
                <span class="block text-3xl md:text-5xl font-bold text-gold" id="countdownDays">0</span>
                <span class="text-xs md:text-sm mt-1">Hari</span>
            </div>
            <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 md:p-6 countdown-pulse" data-reveal="up" data-reveal-delay="200">
                <span class="block text-3xl md:text-5xl font-bold text-gold" id="countdownHours">0</span>
                <span class="text-xs md:text-sm mt-1">Jam</span>
            </div>
            <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 md:p-6 countdown-pulse" data-reveal="up" data-reveal-delay="300">
                <span class="block text-3xl md:text-5xl font-bold text-gold" id="countdownMinutes">0</span>
                <span class="text-xs md:text-sm mt-1">Menit</span>
            </div>
            <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 md:p-6 countdown-pulse" data-reveal="up" data-reveal-delay="400">
                <span class="block text-3xl md:text-5xl font-bold text-gold" id="countdownSeconds">0</span>
                <span class="text-xs md:text-sm mt-1">Detik</span>
            </div>
        </div>
    </div>
</section>
