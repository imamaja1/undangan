<section id="couple" class="py-20 md:py-32 section-bg overlay-dark" style="background-image: url('{{ asset('images/hero/couple-bg.jpg') }}')">
    <div class="relative z-10 max-w-4xl mx-auto px-6">
        <h2 class="font-serif text-3xl md:text-4xl text-white font-light tracking-wide text-center text-shadow mb-16" data-reveal="fade">The Couple</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-start">
            <div class="text-center" data-reveal="left">
                <div class="w-44 h-44 md:w-52 md:h-52 mx-auto rounded-full overflow-hidden border-2 border-white/30 shadow-2xl mb-8">
                    <img src="{{ asset('images/groom/groom.jpg') }}" alt="{{ $wedding->couple['groomName'] ?? '' }}" class="w-full h-full object-cover" loading="lazy" onerror="this.src='data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%22300%22 height=%22300%22><rect fill=%22%23111%22 width=%22300%22 height=%22300%22/><text x=%2250%25%22 y=%2250%25%22 text-anchor=%22middle%22 dy=%22.3em%22 fill=%22%23fff%22 font-size=%2252%22>G</text></svg>'">
                </div>
                <h3 class="font-serif text-2xl md:text-3xl font-light text-white text-shadow">{{ $wedding->couple['groomName'] ?? '' }}</h3>
                <p class="text-white/50 mt-2 text-xs font-sans font-light">{{ $wedding->couple['groomParents'] ?? '' }}</p>
            </div>
            <div class="text-center" data-reveal="right">
                <div class="w-44 h-44 md:w-52 md:h-52 mx-auto rounded-full overflow-hidden border-2 border-white/30 shadow-2xl mb-8">
                    <img src="{{ asset('images/bride/bride.jpg') }}" alt="{{ $wedding->couple['brideName'] ?? '' }}" class="w-full h-full object-cover" loading="lazy" onerror="this.src='data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%22300%22 height=%22300%22><rect fill=%22%23111%22 width=%22300%22 height=%22300%22/><text x=%2250%25%22 y=%2250%25%22 text-anchor=%22middle%22 dy=%22.3em%22 fill=%22%23fff%22 font-size=%2252%22>B</text></svg>'">
                </div>
                <h3 class="font-serif text-2xl md:text-3xl font-light text-white text-shadow">{{ $wedding->couple['brideName'] ?? '' }}</h3>
                <p class="text-white/50 mt-2 text-xs font-sans font-light">{{ $wedding->couple['brideParents'] ?? '' }}</p>
            </div>
        </div>
    </div>
</section>
