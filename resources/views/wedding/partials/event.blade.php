<section id="event" class="py-20 md:py-32 section-bg overlay-warm-dark section-fade-top" style="background-image: url('{{ asset('images/hero/event-bg.jpg') }}?v={{ @filemtime(public_path('images/hero/event-bg.jpg')) }}')">
    <div class="relative z-10 max-w-4xl mx-auto px-6">
        <p class="text-center text-rose-base/40 font-sans text-[10px] tracking-[0.5em] uppercase mb-3" data-reveal="fade">Wedding Day</p>
        <h2 class="font-serif text-3xl md:text-5xl text-white font-normal tracking-wide text-center text-shadow mb-4" data-reveal="fade" data-reveal-delay="100">The Event</h2>
        <div class="divider-ornament mb-16" data-reveal="fade" data-reveal-delay="200">
            <div class="divider-ornament-icon"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @foreach($wedding->events as $i => $event)
            <div class="glass-rose rounded-2xl p-6 md:p-8 shadow-2xl accent-bar-top" data-reveal="{{ $i == 0 ? 'left' : 'right' }}" data-reveal-delay="{{ $i * 200 }}">
                <h3 class="font-serif text-xl text-rose-light font-normal text-shadow mb-6">{{ $event->title }}</h3>
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <svg class="w-4 h-4 text-rose-base/50 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span class="font-sans text-sm text-champagne/70 font-normal">{{ $event->date }}</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <svg class="w-4 h-4 text-rose-base/50 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span class="font-sans text-sm text-champagne/70 font-normal">{{ $event->time }}</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <svg class="w-4 h-4 text-rose-base/50 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <span class="font-sans text-sm text-champagne/70 font-normal">{{ $event->venue }}</span>
                    </div>
                </div>
                @if($event->calendar_link)
                <a href="{{ $event->calendar_link }}" target="_blank" class="ghost-btn w-full mt-6">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    Add to Calendar
                </a>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</section>
