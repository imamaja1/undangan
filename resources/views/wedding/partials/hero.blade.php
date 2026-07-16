<section id="hero" class="min-h-[100dvh] flex items-center justify-center section-bg overlay-warm" style="background-image: url('{{ asset('images/hero/hero-bg.jpg') }}?v={{ @filemtime(public_path('images/hero/hero-bg.jpg')) }}')">
    {{-- Decorative corners --}}
    <div class="corner-ornament corner-tl"></div>
    <div class="corner-ornament corner-tr"></div>
    <div class="corner-ornament corner-bl"></div>
    <div class="corner-ornament corner-br"></div>

    <div class="relative z-10 w-full max-w-xl mx-auto px-6 text-center">
        <p class="text-champagne/40 font-sans text-[10px] tracking-[0.5em] uppercase mb-6" data-reveal="fade">The Wedding Of</p>
        <h2 class="font-serif text-4xl md:text-7xl text-white font-normal mb-4 leading-tight tracking-wide text-shadow-lg" data-reveal="fade" data-reveal-delay="200">
            {{ $wedding->couple['groomName'] ?? '' }}
        </h2>
        <span class="block font-script text-4xl md:text-6xl text-rose-base/50 my-4" data-reveal="fade" data-reveal-delay="300">&</span>
        <h2 class="font-serif text-4xl md:text-7xl text-white font-normal mb-8 leading-tight tracking-wide text-shadow-lg" data-reveal="fade" data-reveal-delay="400">
            {{ $wedding->couple['brideName'] ?? '' }}
        </h2>
        <div class="divider-ornament my-8" data-reveal="fade" data-reveal-delay="500">
            <div class="divider-ornament-icon"></div>
        </div>
        <p class="text-champagne/50 font-sans text-sm tracking-[0.3em] uppercase" data-reveal="fade" data-reveal-delay="600">{{ $wedding->wedding_info['dateFormatted'] ?? '' }}</p>
        @if($wedding->quotes['quran'] ?? false)
        <div class="mt-12 glass rounded-2xl p-6 shadow-2xl" data-reveal="up" data-reveal-delay="700">
            <p class="font-sans text-xs text-champagne/70 font-normal leading-relaxed italic">"{{ $wedding->quotes['quran'] }}"</p>
            <p class="text-[10px] mt-3 text-rose-base/40 tracking-wider">{{ $wedding->quotes['quranRef'] ?? '' }}</p>
        </div>
        @endif
    </div>
</section>
