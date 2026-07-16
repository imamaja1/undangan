<section id="opening" class="min-h-screen flex items-center justify-center section-bg overlay-warm" style="background-image: url('{{ asset('images/hero/opening-bg.jpg') }}?v={{ @filemtime(public_path('images/hero/opening-bg.jpg')) }}')">
    <div class="particle-container" id="openingParticles"></div>
    <div class="relative z-10 w-full max-w-lg mx-auto px-6 text-center py-16">
        <div class="glass-rose rounded-3xl p-8 md:p-14 shadow-2xl" data-reveal="fadeScale">
            <div class="divider-ornament mb-8">
                <div class="divider-ornament-icon"></div>
            </div>
            <p class="font-script text-3xl md:text-4xl text-rose-base/70 mb-6 text-shadow">
                {{ $wedding->quotes['opening'] ?? 'Assalamu\'alaikum Wr. Wb.' }}
            </p>
            <div class="w-12 h-px bg-rose-base/20 mx-auto my-6"></div>
            <p class="font-sans text-sm text-champagne/70 font-normal leading-relaxed">
                {{ $wedding->quotes['openingText'] ?? '' }}
            </p>
            <div class="divider-ornament mt-8">
                <div class="divider-ornament-icon"></div>
            </div>
        </div>
    </div>
</section>
