<section id="couple" class="py-20 md:py-32 section-bg overlay-warm" style="background-image: url('{{ asset('images/hero/couple-bg.jpg') }}')">
    <div class="particle-container" id="coupleParticles"></div>
    <div class="relative z-10 max-w-4xl mx-auto px-6">
        <p class="text-center text-rose-base/40 font-sans text-[10px] tracking-[0.5em] uppercase mb-3" data-reveal="fade">Mempelai</p>
        <h2 class="font-serif text-3xl md:text-5xl text-white font-normal tracking-wide text-center text-shadow mb-4" data-reveal="fade" data-reveal-delay="100">The Couple</h2>
        <div class="divider-ornament mb-16" data-reveal="fade" data-reveal-delay="200">
            <div class="divider-ornament-icon"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-start">
            <div class="text-center" data-reveal="left">
                <div class="frame-round rounded-full w-52 h-52 md:w-60 md:h-60 mx-auto mb-8">
                    <img src="{{ asset('images/groom/groom.jpg') }}" alt="{{ $wedding->couple['groomName'] ?? '' }}" class="w-full h-full object-cover" loading="lazy" onerror="this.src='data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%22300%22 height=%22400%22><rect fill=%22%231a1410%22 width=%22300%22 height=%22400%22/><text x=%2250%25%22 y=%2250%25%22 text-anchor=%22middle%22 dy=%22.3em%22 fill=%22%23E8B4B8%22 font-size=%2248%22>G</text></svg>'">
                </div>
                <h3 class="font-serif text-2xl md:text-3xl font-normal text-rose-light text-shadow">{{ $wedding->couple['groomName'] ?? '' }}</h3>
                <p class="text-champagne/50 mt-2 text-xs font-sans font-normal">{{ $wedding->couple['groomParents'] ?? '' }}</p>
            </div>
            <div class="text-center" data-reveal="right">
                <div class="frame-round rounded-full w-52 h-52 md:w-60 md:h-60 mx-auto mb-8">
                    <img src="{{ asset('images/bride/bride.jpg') }}" alt="{{ $wedding->couple['brideName'] ?? '' }}" class="w-full h-full object-cover" loading="lazy" onerror="this.src='data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%22300%22 height=%22400%22><rect fill=%22%231a1410%22 width=%22300%22 height=%22400%22/><text x=%2250%25%22 y=%2250%25%22 text-anchor=%22middle%22 dy=%22.3em%22 fill=%22%23E8B4B8%22 font-size=%2248%22>B</text></svg>'">
                </div>
                <h3 class="font-serif text-2xl md:text-3xl font-normal text-rose-light text-shadow">{{ $wedding->couple['brideName'] ?? '' }}</h3>
                <p class="text-champagne/50 mt-2 text-xs font-sans font-normal">{{ $wedding->couple['brideParents'] ?? '' }}</p>
            </div>
        </div>
    </div>
</section>
