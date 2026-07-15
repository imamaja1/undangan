<section id="gift" class="py-20 md:py-32 section-bg overlay-dark" style="background-image: url('{{ asset('images/hero/gift-bg.jpg') }}')">
    <div class="relative z-10 max-w-3xl mx-auto px-6">
        <h2 class="font-serif text-3xl md:text-4xl text-white font-light tracking-wide text-center text-shadow mb-16" data-reveal="fade">Wedding Gift</h2>

        @if($wedding->gift && $wedding->gift->bankAccounts->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($wedding->gift->bankAccounts as $i => $bank)
            <div class="glass rounded-2xl p-6 md:p-8 shadow-2xl" data-reveal="{{ $i == 0 ? 'left' : 'right' }}" data-reveal-delay="{{ $i * 200 }}">
                <p class="font-serif text-xl text-white font-light text-shadow">{{ $bank->bank_name }}</p>
                <p class="font-mono text-xl md:text-2xl text-white/90 my-3 bank-number font-light tracking-wider" data-full="{{ $bank->account_number }}">
                    {{ App\Helpers\BankHelper::mask($bank->account_number) }}
                </p>
                <p class="text-white/50 text-xs font-sans font-light">a.n. {{ $bank->account_holder }}</p>
                <div class="flex gap-3 mt-6">
                    <button onclick="toggleBankNumber(this, '{{ $bank->account_number }}')" class="flex-1 ghost-btn py-2.5 text-[10px]">
                        Lihat
                    </button>
                    <button onclick="copyToClipboard('{{ $bank->account_number }}', this)" class="flex-1 ghost-btn py-2.5 text-[10px]">
                        Salin
                    </button>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center text-white/20 py-16">
            <p class="font-sans text-sm font-light">Hadiah belum dikonfigurasi</p>
        </div>
        @endif
    </div>
</section>
