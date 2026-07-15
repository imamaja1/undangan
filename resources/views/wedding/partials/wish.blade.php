<section id="wish" class="py-16 md:py-24 bg-cream">
    <div class="max-w-2xl mx-auto px-6">
        <h2 class="text-center font-serif text-3xl md:text-4xl font-bold text-gray-800 mb-4" data-reveal="fade">Ucapan & Doa</h2>
        <p class="text-center text-gold font-script text-2xl mb-12" data-reveal="scale">Wedding Wish</p>

        <form id="wishForm" class="space-y-4 mb-12 bg-white rounded-xl p-6 shadow-sm border border-cream-dark" data-url="{{ route('wishes.store') }}" onsubmit="submitWish(event)" data-reveal="up">
            @csrf
            <div>
                <input type="text" id="wishName" required class="w-full px-4 py-2.5 border border-cream-dark rounded-lg focus:ring-2 focus:ring-gold focus:border-gold outline-none" placeholder="Nama">
            </div>
            <div>
                <textarea id="wishMessage" rows="3" required class="w-full px-4 py-2.5 border border-cream-dark rounded-lg focus:ring-2 focus:ring-gold focus:border-gold outline-none" placeholder="Tulis ucapan dan doa..."></textarea>
            </div>
            <button type="submit" class="w-full py-3 bg-gold hover:bg-gold-dark text-white rounded-lg font-medium transition-colors shadow-md">
                Kirim Ucapan
            </button>
        </form>

        <div id="wishList" class="space-y-4 max-h-[500px] overflow-y-auto pr-1 scrollbar-thin scrollbar-thumb-gold/30 scrollbar-track-transparent">
            @foreach($wedding->wishes->take(15) as $wish)
            <div class="bg-white rounded-xl p-5 shadow-sm border border-cream-dark">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-10 h-10 bg-gold/10 rounded-full flex items-center justify-center text-gold font-bold text-sm">
                        {{ strtoupper(substr($wish->name, 0, 1)) }}
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800">{{ $wish->name }}</p>
                        <p class="text-xs text-gray-400">{{ $wish->created_at->format('d M Y, H:i') }}</p>
                    </div>
                </div>
                <p class="text-gray-600 text-sm">{{ $wish->message }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>
