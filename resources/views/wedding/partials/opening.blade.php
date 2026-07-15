<section id="opening" class="py-16 md:py-24 bg-white">
    <div class="max-w-3xl mx-auto px-6 text-center">
        <p class="font-script text-3xl md:text-4xl text-gold mb-6" data-reveal="fade">
            {{ $wedding->quotes['opening'] ?? 'Assalamu\'alaikum Wr. Wb.' }}
        </p>
        <p class="text-gray-700 leading-relaxed text-base md:text-lg" data-reveal="up" data-reveal-delay="200">
            {{ $wedding->quotes['openingText'] ?? '' }}
        </p>
    </div>
</section>
