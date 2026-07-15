<section id="hero" class="relative min-h-screen flex items-center justify-center bg-cover bg-center bg-no-repeat" style="background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('{{ asset('images/hero/wedding-hero.jpg') }}')">
    <div class="text-center text-white px-6 py-20 max-w-3xl">
        <p class="font-script text-5xl md:text-7xl text-gold mb-6" data-reveal="fade" data-reveal-delay="200">
            {{ $wedding->quotes['bismillah'] ?? '' }}
        </p>
        <h2 class="font-serif text-4xl md:text-6xl font-bold mb-4" data-reveal="left" data-reveal-delay="400">
            {{ $wedding->couple['groomName'] ?? '' }}
        </h2>
        <p class="font-script text-5xl md:text-7xl text-gold my-4" data-reveal="scale" data-reveal-delay="600">&</p>
        <h2 class="font-serif text-4xl md:text-6xl font-bold mb-8" data-reveal="right" data-reveal-delay="400">
            {{ $wedding->couple['brideName'] ?? '' }}
        </h2>
        <p class="text-xl md:text-2xl mb-4" data-reveal="fade" data-reveal-delay="700">{{ $wedding->wedding_info['dateFormatted'] ?? '' }}</p>
        @if($wedding->quotes['quran'] ?? false)
        <div class="mt-10 bg-white/10 backdrop-blur-sm rounded-xl p-6 max-w-lg mx-auto" data-reveal="up" data-reveal-delay="800">
            <p class="text-sm italic leading-relaxed">"{{ $wedding->quotes['quran'] }}"</p>
            <p class="text-xs mt-2 text-gold">{{ $wedding->quotes['quranRef'] ?? '' }}</p>
        </div>
        @endif
    </div>
</section>
