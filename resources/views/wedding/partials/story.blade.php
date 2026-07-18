<section id="story" class="py-20 md:py-32 section-bg overlay-warm" style="background-image: url('{{ asset('images/hero/story-bg.jpg') }}?v={{ $wedding->updated_at->timestamp ?? time() }}')">
    <div class="relative z-10 max-w-2xl mx-auto px-6">
        <p class="text-center text-rose-base/40 font-sans text-[10px] tracking-[0.5em] uppercase mb-3" data-reveal="fade">Our Journey</p>
        <h2 class="font-serif text-3xl md:text-5xl text-white font-normal tracking-wide text-center text-shadow mb-4" data-reveal="fade" data-reveal-delay="100">Love Story</h2>
        <div class="divider-ornament mb-24" data-reveal="fade" data-reveal-delay="200">
            <div class="divider-ornament-icon"></div>
        </div>
        <br>

        <div class="space-y-6">
            @foreach($wedding->stories as $index => $story)
            <div class="glass-rose rounded-2xl p-6 md:p-8 shadow-2xl accent-bar-top" data-reveal="up" data-reveal-delay="{{ $index * 150 }}">
                <span class="text-rose-base/50 font-sans text-[10px] tracking-[0.3em] uppercase">{{ $story->date_label }}</span>
                <h3 class="font-serif text-xl text-white font-normal mt-2 text-shadow">{{ $story->title }}</h3>
                <p class="font-sans text-sm text-champagne/60 font-normal leading-relaxed mt-3">{{ $story->description }}</p>
                @if($story->image)
                <div class="frame-round rounded-2xl mt-5 max-h-52">
                    <img src="{{ asset($story->image) }}" alt="{{ $story->title }}" class="w-full h-52 object-cover" loading="lazy" onerror="this.style.display='none'">
                </div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</section>
