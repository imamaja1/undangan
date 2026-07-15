<section id="story" class="py-20 md:py-32 section-bg overlay-dark" style="background-image: url('{{ asset('images/hero/story-bg.jpg') }}')">
    <div class="relative z-10 max-w-2xl mx-auto px-6">
        <h2 class="font-serif text-3xl md:text-4xl text-white font-light tracking-wide text-center text-shadow mb-16" data-reveal="fade">Love Story</h2>

        <div class="space-y-6">
            @foreach($wedding->stories as $index => $story)
            <div class="glass rounded-2xl p-6 md:p-8 shadow-2xl" data-reveal="up" data-reveal-delay="{{ $index * 150 }}">
                <span class="text-white/40 font-sans text-[10px] tracking-[0.3em] uppercase">{{ $story->date_label }}</span>
                <h3 class="font-serif text-xl text-white font-light mt-2 text-shadow">{{ $story->title }}</h3>
                <p class="font-sans text-sm text-gray-300 font-light leading-relaxed mt-3">{{ $story->description }}</p>
                @if($story->image)
                <div class="arch-img mt-5 max-h-52">
                    <img src="{{ asset($story->image) }}" alt="{{ $story->title }}" class="w-full h-52 object-cover" loading="lazy" onerror="this.style.display='none'">
                </div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</section>
