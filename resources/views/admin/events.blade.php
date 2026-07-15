@extends('layouts.admin')

@section('content')
<div>
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-serif font-bold text-gray-800">Event</h1>
            <p class="text-gray-500 text-sm mt-1">Atur jadwal akad dan resepsi.</p>
        </div>
        <button onclick="saveEvents()" class="px-6 py-2.5 bg-gold hover:bg-gold-dark text-white rounded-lg font-medium transition-colors shadow-sm">Simpan</button>
    </div>
    <form id="eventsForm" class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach([['key'=>'akad','title'=>'Akad Nikah'], ['key'=>'resepsi','title'=>'Resepsi']] as $ev)
        <div class="bg-white rounded-xl shadow-sm border border-cream-dark p-6">
            <h3 class="font-serif font-bold text-lg text-gold mb-4">{{ $ev['title'] }}</h3>
            <div class="space-y-3">
                <div><label class="text-xs text-gray-500">Judul</label><input type="text" name="{{ $ev['key'] }}[title]" value="{{ $ev['title'] }}" class="w-full px-3 py-2 border border-cream-dark rounded-lg text-sm focus:ring-2 focus:ring-gold focus:border-gold outline-none"></div>
                <input type="hidden" name="{{ $ev['key'] }}[icon]" value="{{ $ev['key'] === 'akad' ? 'bi-book' : 'bi-cup' }}">
                <div><label class="text-xs text-gray-500">Tanggal</label><input type="text" name="{{ $ev['key'] }}[date]" class="w-full px-3 py-2 border border-cream-dark rounded-lg text-sm focus:ring-2 focus:ring-gold focus:border-gold outline-none" placeholder="Kamis, 20 Agustus 2026"></div>
                <div><label class="text-xs text-gray-500">Waktu</label><input type="text" name="{{ $ev['key'] }}[time]" class="w-full px-3 py-2 border border-cream-dark rounded-lg text-sm focus:ring-2 focus:ring-gold focus:border-gold outline-none" placeholder="08:00 - 10:00 WIB"></div>
                <div><label class="text-xs text-gray-500">Venue</label><input type="text" name="{{ $ev['key'] }}[venue]" class="w-full px-3 py-2 border border-cream-dark rounded-lg text-sm focus:ring-2 focus:ring-gold focus:border-gold outline-none"></div>
                <div><label class="text-xs text-gray-500">Alamat</label><textarea name="{{ $ev['key'] }}[address]" rows="2" class="w-full px-3 py-2 border border-cream-dark rounded-lg text-sm focus:ring-2 focus:ring-gold focus:border-gold outline-none"></textarea></div>
                <div><label class="text-xs text-gray-500">Google Calendar Link</label><input type="url" name="{{ $ev['key'] }}[calendar_link]" class="w-full px-3 py-2 border border-cream-dark rounded-lg text-sm focus:ring-2 focus:ring-gold focus:border-gold outline-none"></div>
            </div>
        </div>
        @endforeach
    </form>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    @if(isset($events) && $events->count())
    const events = @json($events);
    events.forEach(ev => {
        Object.entries(ev).forEach(([k,v]) => {
            if (['id','wedding_id','type','created_at','updated_at'].includes(k)) return;
            const el = document.querySelector(`[name="${ev.type}[${k}]"]`);
            if (el) el.value = v || '';
        });
    });
    @endif
});

async function saveEvents() {
    const fd = new FormData(document.getElementById('eventsForm'));
    const data = { akad: {}, resepsi: {} };
    for (let [k, v] of fd.entries()) {
        const match = k.match(/(akad|resepsi)\[(.+)\]/);
        if (match) data[match[1]][match[2]] = v;
    }
    try {
        const res = await fetch('{{ route("admin.events.update") }}', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept': 'application/json' },
            body: JSON.stringify(data)
        });
        const r = await res.json();
        showToast(r.success ? r.message : 'Gagal', r.success ? 'success' : 'error');
    } catch(e) { showToast('Gagal menyimpan.', 'error'); }
}
</script>
@endpush
