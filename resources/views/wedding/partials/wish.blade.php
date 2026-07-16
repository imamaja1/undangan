<section id="wish" class="py-20 md:py-32 section-bg overlay-warm-dark section-fade-top" style="background-image: url('{{ asset('images/hero/wish-bg.jpg') }}?v={{ @filemtime(public_path('images/hero/wish-bg.jpg')) }}')">
    <div class="relative z-10 max-w-lg mx-auto px-6">
        <p class="text-center text-rose-base/40 font-sans text-[10px] tracking-[0.5em] uppercase mb-3" data-reveal="fade">Ucapan & Doa</p>
        <h2 class="font-serif text-3xl md:text-5xl text-white font-normal tracking-wide text-center text-shadow mb-4" data-reveal="fade" data-reveal-delay="100">Wedding Wish</h2>
        <div class="divider-ornament mb-12" data-reveal="fade" data-reveal-delay="200">
            <div class="divider-ornament-icon"></div>
        </div>

        <form id="wishForm" class="glass-rose rounded-2xl p-6 md:p-8 shadow-2xl space-y-4 mb-10" data-url="{{ route('wishes.store') }}" onsubmit="submitWish(event)" data-reveal="up" data-reveal-delay="300">
            @csrf
            <div>
                <label class="text-[10px] uppercase tracking-[0.3em] text-rose-base/50 mb-2 block font-sans">Nama</label>
                <input type="text" id="wishName" required class="glass-input" placeholder="Nama Anda">
            </div>
            <div>
                <label class="text-[10px] uppercase tracking-[0.3em] text-rose-base/50 mb-2 block font-sans">Ucapan & Doa</label>
                <textarea id="wishMessage" rows="4" required class="glass-input" placeholder="Tulis ucapan dan doa..."></textarea>
            </div>
            <button type="submit" class="ghost-btn w-full py-3.5">
                Kirim Ucapan
            </button>
        </form>

        <div id="wishList" class="space-y-4 max-h-[500px] overflow-y-auto pr-1">
            @foreach($wedding->wishes->take(15) as $wish)
            <div class="glass rounded-2xl p-5 shadow-xl">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-9 h-9 bg-rose-base/10 rounded-full flex items-center justify-center text-rose-base font-sans text-xs font-medium border border-rose-base/20">
                        {{ strtoupper(substr($wish->name, 0, 1)) }}
                    </div>
                    <div>
                        <p class="font-sans text-sm text-rose-light font-medium">{{ $wish->name }}</p>
                        <p class="text-[10px] text-champagne/30">{{ $wish->created_at->format('d M Y, H:i') }}</p>
                    </div>
                </div>
                <p class="font-sans text-sm text-champagne/60 font-normal leading-relaxed">{{ $wish->message }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>
