<section id="hero" class="min-h-[100dvh] flex items-center justify-center section-bg overlay-darker" style="background-image: url('{{ asset('images/hero/hero-bg.jpg') }}')">
    <div class="relative z-10 w-full max-w-xl mx-auto px-6 text-center">
        <p class="text-white/40 font-sans text-[10px] tracking-[0.4em] uppercase mb-6 text-shadow" data-reveal="fade">The Wedding Of</p>
        <h2 class="font-serif text-4xl md:text-7xl text-white font-light mb-8 leading-tight tracking-wide text-shadow-lg" data-reveal="fade" data-reveal-delay="200">
            {{ $wedding->couple['groomName'] ?? '' }}
            <span class="block font-sans text-lg md:text-xl font-extralight my-3 text-white/40">&</span>
            {{ $wedding->couple['brideName'] ?? '' }}
        </h2>
        <div class="w-12 h-px bg-white/20 mx-auto mb-6" data-reveal="fade" data-reveal-delay="300"></div>
        <p class="text-white/50 font-sans text-sm tracking-[0.3em] uppercase" data-reveal="fade" data-reveal-delay="400">{{ $wedding->wedding_info['dateFormatted'] ?? '' }}</p>
        @if($wedding->quotes['quran'] ?? false)
        <div class="mt-12 glass rounded-2xl p-6 shadow-2xl" data-reveal="up" data-reveal-delay="600">
            <p class="font-sans text-xs text-gray-300 font-light leading-relaxed italic">"{{ $wedding->quotes['quran'] }}"</p>
            <p class="text-[10px] mt-3 text-white/40 tracking-wider">{{ $wedding->quotes['quranRef'] ?? '' }}</p>
        </div>
        @endif
    </div>
</section>
