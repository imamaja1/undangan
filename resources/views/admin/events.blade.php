@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-xl font-bold text-gray-900">Event</h1>
            <p class="text-sm text-gray-500 mt-0.5">Atur jadwal akad dan resepsi.</p>
        </div>
        <button onclick="saveEvents()" class="px-4 py-2 bg-gray-900 hover:bg-gray-800 text-white text-sm font-medium rounded-lg transition-colors shadow-sm">Simpan</button>
    </div>

    <form id="eventsForm" class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach([['key'=>'akad','title'=>'Akad Nikah'], ['key'=>'resepsi','title'=>'Resepsi']] as $ev)
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-sm font-semibold text-gray-600 uppercase tracking-wider mb-4">{{ $ev['title'] }}</h3>
            <div class="space-y-4">
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Judul</label><input type="text" name="{{ $ev['key'] }}[title]" value="{{ $ev['title'] }}" class="w-full px-3 py-2 rounded-lg border border-gray-300 text-sm shadow-sm focus:ring-2 focus:ring-gray-900/10 focus:border-gray-900 outline-none transition"></div>
                <input type="hidden" name="{{ $ev['key'] }}[icon]" value="{{ $ev['key'] === 'akad' ? 'bi-book' : 'bi-cup' }}">
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label><input type="text" name="{{ $ev['key'] }}[date]" class="w-full px-3 py-2 rounded-lg border border-gray-300 text-sm shadow-sm focus:ring-2 focus:ring-gray-900/10 focus:border-gray-900 outline-none transition" placeholder="Kamis, 20 Agustus 2026"></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Waktu</label><input type="text" name="{{ $ev['key'] }}[time]" class="w-full px-3 py-2 rounded-lg border border-gray-300 text-sm shadow-sm focus:ring-2 focus:ring-gray-900/10 focus:border-gray-900 outline-none transition" placeholder="08:00 - 10:00 WIB"></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Venue</label><input type="text" name="{{ $ev['key'] }}[venue]" class="w-full px-3 py-2 rounded-lg border border-gray-300 text-sm shadow-sm focus:ring-2 focus:ring-gray-900/10 focus:border-gray-900 outline-none transition"></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label><textarea name="{{ $ev['key'] }}[address]" rows="2" class="w-full px-3 py-2 rounded-lg border border-gray-300 text-sm shadow-sm focus:ring-2 focus:ring-gray-900/10 focus:border-gray-900 outline-none transition"></textarea></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Google Calendar Link</label><input type="url" name="{{ $ev['key'] }}[calendar_link]" class="w-full px-3 py-2 rounded-lg border border-gray-300 text-sm shadow-sm focus:ring-2 focus:ring-gray-900/10 focus:border-gray-900 outline-none transition"></div>
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
