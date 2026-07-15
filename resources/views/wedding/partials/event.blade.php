<section id="event" class="py-16 md:py-24 bg-cream">
    <div class="max-w-5xl mx-auto px-6">
        <h2 class="text-center font-serif text-3xl md:text-4xl font-bold text-gray-800 mb-4" data-reveal="fade">Acara</h2>
        <p class="text-center text-gold font-script text-2xl mb-12" data-reveal="scale">Wedding Event</p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @foreach($wedding->events as $i => $event)
            <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-lg transition-all duration-300 hover:-translate-y-1" data-reveal="{{ $i == 0 ? 'left' : 'right' }}" data-reveal-delay="{{ $i * 200 }}">
                <div class="bg-gold text-white py-4 px-6 text-center">
                    <h3 class="font-serif text-xl font-bold">{{ $event->title }}</h3>
                </div>
                <div class="p-6 space-y-4">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-gold mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <div>
                            <p class="text-sm text-gray-500">Tanggal</p>
                            <p class="font-medium">{{ $event->date }}</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-gold mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <div>
                            <p class="text-sm text-gray-500">Waktu</p>
                            <p class="font-medium">{{ $event->time }}</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-gold mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <div>
                            <p class="font-medium">{{ $event->venue }}</p>
                            <p class="text-sm text-gray-500">{{ $event->address }}</p>
                        </div>
                    </div>
                    @if($event->calendar_link)
                    <a href="{{ $event->calendar_link }}" target="_blank" class="block w-full text-center py-2.5 border border-gold text-gold rounded-lg hover:bg-gold hover:text-white transition-colors font-medium text-sm mt-4">
                        Simpan ke Kalender
                    </a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
