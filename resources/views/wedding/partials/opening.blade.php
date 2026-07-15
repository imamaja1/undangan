<section id="opening" class="min-h-screen flex items-center justify-center section-bg overlay-dark" style="background-image: url('{{ asset('images/hero/opening-bg.jpg') }}')">
    <div class="relative z-10 w-full max-w-lg mx-auto px-6 text-center py-16">
        <div class="glass rounded-2xl p-8 md:p-14 shadow-2xl" data-reveal="fade">
            <p class="font-serif text-xl md:text-2xl text-white/80 font-light italic leading-relaxed text-shadow">
                {{ $wedding->quotes['opening'] ?? 'Assalamu\'alaikum Wr. Wb.' }}
            </p>
            <div class="w-12 h-px bg-white/20 mx-auto my-6"></div>
            <p class="font-sans text-sm text-gray-300 font-light leading-relaxed">
                {{ $wedding->quotes['openingText'] ?? '' }}
            </p>
        </div>
    </div>
</section>
