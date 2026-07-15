<section id="gift" class="py-16 md:py-24 bg-white">
    <div class="max-w-4xl mx-auto px-6">
        <h2 class="text-center font-serif text-3xl md:text-4xl font-bold text-gray-800 mb-4" data-reveal="fade">Wedding Gift</h2>
        <p class="text-center text-gold font-script text-2xl mb-12" data-reveal="scale">Kirim Hadiah</p>

        @if($wedding->gift && $wedding->gift->qris_enabled && $wedding->gift->qris_image)
        <div class="text-center mb-10" data-reveal="up">
            <div class="w-48 h-48 mx-auto rounded-xl overflow-hidden shadow-md">
                <img src="{{ asset($wedding->gift->qris_image) }}" alt="QRIS" class="w-full h-full object-cover">
            </div>
            <p class="text-sm text-gray-500 mt-3">Scan QRIS untuk mengirim hadiah</p>
        </div>
        @endif

        @if($wedding->gift && $wedding->gift->bankAccounts->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-2xl mx-auto">
            @foreach($wedding->gift->bankAccounts as $i => $bank)
            <div class="bg-cream rounded-xl p-6 shadow-sm border border-cream-dark hover:shadow-md transition-all duration-300 hover:-translate-y-1" data-reveal="{{ $i == 0 ? 'left' : 'right' }}" data-reveal-delay="{{ $i * 200 }}">
                <p class="font-bold text-gray-800 text-lg">{{ $bank->bank_name }}</p>
                <p class="text-2xl font-mono font-bold text-gold my-2 bank-number" data-full="{{ $bank->account_number }}">
                    {{ App\Helpers\BankHelper::mask($bank->account_number) }}
                </p>
                <p class="text-sm text-gray-600">a.n. {{ $bank->account_holder }}</p>
                <div class="flex gap-2 mt-4">
                    <button onclick="toggleBankNumber(this, '{{ $bank->account_number }}')" class="flex-1 py-2 border border-gold text-gold hover:bg-gold hover:text-white rounded-lg text-sm font-medium transition-colors">
                        Lihat Rekening
                    </button>
                    <button onclick="copyToClipboard('{{ $bank->account_number }}', this)" class="flex-1 py-2 bg-gold hover:bg-gold-dark text-white rounded-lg text-sm font-medium transition-colors">
                        Salin
                    </button>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center text-gray-400 py-10">
            <svg class="w-16 h-16 mx-auto mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 1114.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"/></svg>
            <p>Hadiah belum dikonfigurasi</p>
        </div>
        @endif
    </div>
</section>
