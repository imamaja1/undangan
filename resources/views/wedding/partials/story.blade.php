<section id="story" class="py-16 md:py-24 bg-white">
    <div class="max-w-4xl mx-auto px-6">
        <h2 class="text-center font-serif text-3xl md:text-4xl font-bold text-gray-800 mb-4" data-reveal="fade">Love Story</h2>
        <p class="text-center text-gold font-script text-2xl mb-12" data-reveal="scale">Perjalanan Cinta Kami</p>

        <div class="space-y-12">
            @foreach($wedding->stories as $index => $story)
            <div class="flex flex-col {{ $index % 2 == 0 ? 'md:flex-row' : 'md:flex-row-reverse' }} items-center gap-6 md:gap-10">
                <div class="w-full md:w-1/2" data-reveal="{{ $index % 2 == 0 ? 'left' : 'right' }}" data-reveal-delay="{{ $index * 100 }}">
                    <div class="rounded-xl overflow-hidden shadow-md hover:shadow-lg transition-shadow">
                        @if($story->image)
                        <img src="{{ asset($story->image) }}" alt="{{ $story->title }}" class="w-full h-56 object-cover" onerror="this.style.display='none'">
                        @else
                        <div class="w-full h-56 bg-cream-dark flex items-center justify-center">
                            <svg class="w-12 h-12 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="w-full md:w-1/2 text-center md:text-left" data-reveal="{{ $index % 2 == 0 ? 'right' : 'left' }}" data-reveal-delay="{{ $index * 100 + 100 }}">
                    <span class="text-gold font-semibold text-sm">{{ $story->date_label }}</span>
                    <h3 class="font-serif text-2xl font-bold text-gray-800 mt-1">{{ $story->title }}</h3>
                    <p class="text-gray-600 mt-3 leading-relaxed">{{ $story->description }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
