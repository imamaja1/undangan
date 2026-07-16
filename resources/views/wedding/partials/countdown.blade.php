<section id="countdown" class="py-20 md:py-32 section-bg overlay-warm-dark section-fade-top" style="background-image: url('{{ asset('images/hero/countdown-bg.jpg') }}')">
    <input type="hidden" id="countdownTarget" value="{{ $wedding->wedding_info['date'] ?? '' }}">
    <div class="particle-container" id="countdownParticles"></div>
    <div class="relative z-10 max-w-xl mx-auto px-6 text-center">
        <p class="text-rose-base/40 font-sans text-[10px] tracking-[0.4em] uppercase mb-3" data-reveal="fade">Save The Date</p>
        <h2 class="font-serif text-3xl md:text-5xl text-white font-normal tracking-wide text-shadow mb-3" data-reveal="fade" data-reveal-delay="100">{{ $wedding->wedding_info['dateFormatted'] ?? '' }}</h2>
        <div class="divider-ornament mb-10" data-reveal="fade" data-reveal-delay="150">
            <div class="divider-ornament-icon"></div>
        </div>

        <div class="glass-rose rounded-2xl p-6 md:p-10 shadow-2xl" data-reveal="fadeScale" data-reveal-delay="200">
            <div class="grid grid-cols-4 gap-4 md:gap-8">
                <div class="text-center">
                    <span class="block countdown-num text-3xl md:text-6xl" id="countdownDays">0</span>
                    <span class="text-[10px] text-champagne/40 font-sans uppercase tracking-[0.2em] mt-2 block">Days</span>
                </div>
                <div class="text-center">
                    <span class="block countdown-num text-3xl md:text-6xl" id="countdownHours">0</span>
                    <span class="text-[10px] text-champagne/40 font-sans uppercase tracking-[0.2em] mt-2 block">Hours</span>
                </div>
                <div class="text-center">
                    <span class="block countdown-num text-3xl md:text-6xl" id="countdownMinutes">0</span>
                    <span class="text-[10px] text-champagne/40 font-sans uppercase tracking-[0.2em] mt-2 block">Mins</span>
                </div>
                <div class="text-center">
                    <span class="block countdown-num text-3xl md:text-6xl" id="countdownSeconds">0</span>
                    <span class="text-[10px] text-champagne/40 font-sans uppercase tracking-[0.2em] mt-2 block">Secs</span>
                </div>
            </div>
        </div>

        <button onclick="document.getElementById('rsvpForm')?.scrollIntoView({behavior:'smooth'})" class="ghost-btn mt-10 px-12 py-3.5 text-xs" data-reveal="up" data-reveal-delay="400">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            Save the Date
        </button>
    </div>
</section>
