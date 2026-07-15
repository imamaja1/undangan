<section id="wish" class="py-20 md:py-32 section-bg overlay-darker section-fade-top" style="background-image: url('{{ asset('images/hero/wish-bg.jpg') }}')">
    <div class="relative z-10 max-w-lg mx-auto px-6">
        <h2 class="font-serif text-3xl md:text-4xl text-white font-light tracking-wide text-center text-shadow mb-16" data-reveal="fade">Wedding Wish</h2>

        <form id="wishForm" class="glass rounded-2xl p-6 md:p-8 shadow-2xl space-y-4 mb-10" data-url="{{ route('wishes.store') }}" onsubmit="submitWish(event)" data-reveal="up">
            @csrf
            <div>
                <label class="text-[10px] uppercase tracking-[0.3em] text-white/50 mb-2 block font-sans">Nama</label>
                <input type="text" id="wishName" required class="glass-input" placeholder="Nama Anda">
            </div>
            <div>
                <label class="text-[10px] uppercase tracking-[0.3em] text-white/50 mb-2 block font-sans">Ucapan & Doa</label>
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
                    <div class="w-9 h-9 glass rounded-full flex items-center justify-center text-white font-sans text-xs font-medium">
                        {{ strtoupper(substr($wish->name, 0, 1)) }}
                    </div>
                    <div>
                        <p class="font-sans text-sm text-white font-medium">{{ $wish->name }}</p>
                        <p class="text-[10px] text-white/30">{{ $wish->created_at->format('d M Y, H:i') }}</p>
                    </div>
                </div>
                <p class="font-sans text-sm text-gray-300 font-light leading-relaxed">{{ $wish->message }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>
