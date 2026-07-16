<section id="gift" class="py-20 md:py-32 section-bg overlay-warm" style="background-image: url('{{ asset('images/hero/gift-bg.jpg') }}?v={{ @filemtime(public_path('images/hero/gift-bg.jpg')) }}')">
    <div class="relative z-10 max-w-3xl mx-auto px-6">
        <p class="text-center text-rose-base/40 font-sans text-[10px] tracking-[0.5em] uppercase mb-3" data-reveal="fade">Kirim Hadiah</p>
        <h2 class="font-serif text-3xl md:text-5xl text-white font-normal tracking-wide text-center text-shadow mb-4" data-reveal="fade" data-reveal-delay="100">Wedding Gift</h2>
        <div class="divider-ornament mb-16" data-reveal="fade" data-reveal-delay="200">
            <div class="divider-ornament-icon"></div>
        </div>

        @if($wedding->gift && $wedding->gift->bankAccounts->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($wedding->gift->bankAccounts as $i => $bank)
            <div class="glass-rose rounded-2xl p-6 md:p-8 shadow-2xl accent-bar-top" data-reveal="{{ $i == 0 ? 'left' : 'right' }}" data-reveal-delay="{{ $i * 200 }}">
                <p class="font-serif text-xl text-rose-light font-normal text-shadow">{{ $bank->bank_name }}</p>
                <p class="font-mono text-xl md:text-2xl text-champagne/80 my-3 bank-number font-normal tracking-wider" data-full="{{ $bank->account_number }}">
                    {{ App\Helpers\BankHelper::mask($bank->account_number) }}
                </p>
                <p class="text-champagne/40 text-xs font-sans font-normal">a.n. {{ $bank->account_holder }}</p>
                <div class="flex gap-3 mt-6">
                    <button onclick="toggleBankNumber(this, '{{ $bank->account_number }}')" class="flex-1 ghost-btn py-2.5 text-[10px]">Lihat</button>
                    <button onclick="copyToClipboard('{{ $bank->account_number }}', this)" class="flex-1 ghost-btn py-2.5 text-[10px]">Salin</button>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center text-champagne/20 py-16">
            <p class="font-sans text-sm font-normal">Hadiah belum dikonfigurasi</p>
        </div>
        @endif
    </div>
</section>
