@extends('layouts.admin')

@section('content')
<div>
    <div class="mb-6">
        <h1 class="text-2xl font-serif font-bold text-gray-800">Konfigurasi Undangan</h1>
        <p class="text-gray-500 text-sm mt-1">Edit data mempelai, acara, quotes, dan pengaturan lainnya.</p>
    </div>

    <form id="weddingConfigForm" class="space-y-8">
        <div class="bg-white rounded-xl shadow-sm border border-cream-dark p-6">
            <h2 class="text-lg font-serif font-bold text-gray-800 mb-4">Data Mempelai</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <fieldset class="border border-cream-dark rounded-lg p-4">
                    <legend class="text-sm font-semibold text-gold px-2">Mempelai Pria</legend>
                    <div class="space-y-3">
                        <div><label class="text-xs text-gray-500">Nama Lengkap</label><input type="text" name="couple[groomName]" class="w-full px-3 py-2 border border-cream-dark rounded-lg text-sm focus:ring-2 focus:ring-gold focus:border-gold outline-none"></div>
                        <div><label class="text-xs text-gray-500">Nama Panggilan</label><input type="text" name="couple[groomShort]" class="w-full px-3 py-2 border border-cream-dark rounded-lg text-sm focus:ring-2 focus:ring-gold focus:border-gold outline-none"></div>
                        <div><label class="text-xs text-gray-500">Orang Tua</label><input type="text" name="couple[groomParents]" class="w-full px-3 py-2 border border-cream-dark rounded-lg text-sm focus:ring-2 focus:ring-gold focus:border-gold outline-none"></div>
                        <div><label class="text-xs text-gray-500">Instagram URL</label><input type="url" name="couple[groomInstagram]" class="w-full px-3 py-2 border border-cream-dark rounded-lg text-sm focus:ring-2 focus:ring-gold focus:border-gold outline-none"></div>
                        <div><label class="text-xs text-gray-500">Instagram Handle</label><input type="text" name="couple[groomInstagramHandle]" class="w-full px-3 py-2 border border-cream-dark rounded-lg text-sm focus:ring-2 focus:ring-gold focus:border-gold outline-none"></div>
                    </div>
                </fieldset>
                <fieldset class="border border-cream-dark rounded-lg p-4">
                    <legend class="text-sm font-semibold text-gold px-2">Mempelai Wanita</legend>
                    <div class="space-y-3">
                        <div><label class="text-xs text-gray-500">Nama Lengkap</label><input type="text" name="couple[brideName]" class="w-full px-3 py-2 border border-cream-dark rounded-lg text-sm focus:ring-2 focus:ring-gold focus:border-gold outline-none"></div>
                        <div><label class="text-xs text-gray-500">Nama Panggilan</label><input type="text" name="couple[brideShort]" class="w-full px-3 py-2 border border-cream-dark rounded-lg text-sm focus:ring-2 focus:ring-gold focus:border-gold outline-none"></div>
                        <div><label class="text-xs text-gray-500">Orang Tua</label><input type="text" name="couple[brideParents]" class="w-full px-3 py-2 border border-cream-dark rounded-lg text-sm focus:ring-2 focus:ring-gold focus:border-gold outline-none"></div>
                        <div><label class="text-xs text-gray-500">Instagram URL</label><input type="url" name="couple[brideInstagram]" class="w-full px-3 py-2 border border-cream-dark rounded-lg text-sm focus:ring-2 focus:ring-gold focus:border-gold outline-none"></div>
                        <div><label class="text-xs text-gray-500">Instagram Handle</label><input type="text" name="couple[brideInstagramHandle]" class="w-full px-3 py-2 border border-cream-dark rounded-lg text-sm focus:ring-2 focus:ring-gold focus:border-gold outline-none"></div>
                    </div>
                </fieldset>
            </div>
            <div class="flex justify-end mt-4">
                <button type="button" onclick="saveWeddingConfig()" class="px-4 py-2 bg-gold hover:bg-gold-dark text-white rounded-lg text-sm font-medium transition-colors">Simpan Mempelai</button>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-cream-dark p-6">
            <h2 class="text-lg font-serif font-bold text-gray-800 mb-4">Informasi Pernikahan</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div><label class="text-xs text-gray-500">Tanggal (ISO)</label><input type="datetime-local" name="wedding_info[date]" class="w-full px-3 py-2 border border-cream-dark rounded-lg text-sm focus:ring-2 focus:ring-gold focus:border-gold outline-none"></div>
                <div><label class="text-xs text-gray-500">Tanggal Display</label><input type="text" name="wedding_info[dateFormatted]" class="w-full px-3 py-2 border border-cream-dark rounded-lg text-sm focus:ring-2 focus:ring-gold focus:border-gold outline-none" placeholder="20 Agustus 2026"></div>
                <div><label class="text-xs text-gray-500">Hari</label><input type="text" name="wedding_info[day]" class="w-full px-3 py-2 border border-cream-dark rounded-lg text-sm focus:ring-2 focus:ring-gold focus:border-gold outline-none" placeholder="Kamis"></div>
                <div><label class="text-xs text-gray-500">Nama Gedung</label><input type="text" name="wedding_info[location]" class="w-full px-3 py-2 border border-cream-dark rounded-lg text-sm focus:ring-2 focus:ring-gold focus:border-gold outline-none"></div>
                <div class="md:col-span-2"><label class="text-xs text-gray-500">Alamat</label><input type="text" name="wedding_info[address]" class="w-full px-3 py-2 border border-cream-dark rounded-lg text-sm focus:ring-2 focus:ring-gold focus:border-gold outline-none"></div>
                <div><label class="text-xs text-gray-500">Telepon</label><input type="text" name="wedding_info[phone]" class="w-full px-3 py-2 border border-cream-dark rounded-lg text-sm focus:ring-2 focus:ring-gold focus:border-gold outline-none"></div>
            </div>
            <div class="flex justify-end mt-4">
                <button type="button" onclick="saveWeddingConfig()" class="px-4 py-2 bg-gold hover:bg-gold-dark text-white rounded-lg text-sm font-medium transition-colors">Simpan Info</button>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-cream-dark p-6">
            <h2 class="text-lg font-serif font-bold text-gray-800 mb-4">Google Maps</h2>
            <div class="space-y-3">
                <div><label class="text-xs text-gray-500">Maps Embed URL</label><input type="url" name="wedding_info[mapsEmbed]" class="w-full px-3 py-2 border border-cream-dark rounded-lg text-sm focus:ring-2 focus:ring-gold focus:border-gold outline-none"></div>
                <div><label class="text-xs text-gray-500">Maps Direct Link</label><input type="url" name="wedding_info[mapsLink]" class="w-full px-3 py-2 border border-cream-dark rounded-lg text-sm focus:ring-2 focus:ring-gold focus:border-gold outline-none"></div>
            </div>
            <div class="flex justify-end mt-4">
                <button type="button" onclick="saveWeddingConfig()" class="px-4 py-2 bg-gold hover:bg-gold-dark text-white rounded-lg text-sm font-medium transition-colors">Simpan Maps</button>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-cream-dark p-6">
            <h2 class="text-lg font-serif font-bold text-gray-800 mb-4">Teks dan Quotes</h2>
            <div class="space-y-3">
                <div><label class="text-xs text-gray-500">Bismillah (Arabic)</label><input type="text" name="quotes[bismillah]" class="w-full px-3 py-2 border border-cream-dark rounded-lg text-sm focus:ring-2 focus:ring-gold focus:border-gold outline-none text-right font-script text-xl"></div>
                <div><label class="text-xs text-gray-500">Ayat Al-Quran</label><textarea name="quotes[quran]" rows="3" class="w-full px-3 py-2 border border-cream-dark rounded-lg text-sm focus:ring-2 focus:ring-gold focus:border-gold outline-none"></textarea></div>
                <div><label class="text-xs text-gray-500">Referensi Ayat</label><input type="text" name="quotes[quranRef]" class="w-full px-3 py-2 border border-cream-dark rounded-lg text-sm focus:ring-2 focus:ring-gold focus:border-gold outline-none"></div>
                <div><label class="text-xs text-gray-500">Salam Pembuka</label><input type="text" name="quotes[opening]" class="w-full px-3 py-2 border border-cream-dark rounded-lg text-sm focus:ring-2 focus:ring-gold focus:border-gold outline-none"></div>
                <div><label class="text-xs text-gray-500">Teks Pembuka</label><textarea name="quotes[openingText]" rows="3" class="w-full px-3 py-2 border border-cream-dark rounded-lg text-sm focus:ring-2 focus:ring-gold focus:border-gold outline-none"></textarea></div>
                <div><label class="text-xs text-gray-500">Teks Penutup</label><textarea name="quotes[closingText]" rows="3" class="w-full px-3 py-2 border border-cream-dark rounded-lg text-sm focus:ring-2 focus:ring-gold focus:border-gold outline-none"></textarea></div>
                <div><label class="text-xs text-gray-500">Salam Penutup</label><input type="text" name="quotes[footerClosing]" class="w-full px-3 py-2 border border-cream-dark rounded-lg text-sm focus:ring-2 focus:ring-gold focus:border-gold outline-none"></div>
            </div>
            <div class="flex justify-end mt-4">
                <button type="button" onclick="saveWeddingConfig()" class="px-4 py-2 bg-gold hover:bg-gold-dark text-white rounded-lg text-sm font-medium transition-colors">Simpan Quotes</button>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-cream-dark p-6">
            <h2 class="text-lg font-serif font-bold text-gray-800 mb-4">WhatsApp</h2>
            <div><label class="text-xs text-gray-500">Nomor WA (format 628xxx)</label><input type="text" name="wa_number" class="w-full px-3 py-2 border border-cream-dark rounded-lg text-sm focus:ring-2 focus:ring-gold focus:border-gold outline-none max-w-md"></div>
            <div class="flex justify-end mt-4">
                <button type="button" onclick="saveWeddingConfig()" class="px-4 py-2 bg-gold hover:bg-gold-dark text-white rounded-lg text-sm font-medium transition-colors">Simpan WA</button>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-cream-dark p-6">
            <h2 class="text-lg font-serif font-bold text-gray-800 mb-4">Tampilan Section</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                @php $sectionLabels = ['event'=>'Event','story'=>'Love Story','gallery'=>'Gallery','video'=>'Video','location'=>'Lokasi','rsvp'=>'RSVP','gift'=>'Wedding Gift','wish'=>'Ucapan']; @endphp
                @foreach($sectionLabels as $key => $label)
                <label class="flex items-center gap-3 p-3 bg-cream rounded-lg cursor-pointer hover:bg-cream-dark/50 transition-colors">
                    <input type="hidden" name="sections[{{ $key }}][enabled]" value="false">
                    <input type="checkbox" name="sections[{{ $key }}][enabled]" value="true" class="w-5 h-5 rounded border-cream-dark text-gold focus:ring-gold" checked onchange="this.previousElementSibling.value=this.checked?'true':'false'">
                    <span class="text-sm font-medium text-gray-700">{{ $label }}</span>
                </label>
                @endforeach
            </div>
            <div class="flex justify-end mt-4">
                <button type="button" onclick="saveWeddingConfig()" class="px-4 py-2 bg-gold hover:bg-gold-dark text-white rounded-lg text-sm font-medium transition-colors">Simpan Section</button>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    @if(isset($wedding))
    populateForm(@json($wedding));
    @endif
});

function setVal(path, value) {
    const el = document.querySelector(`[name="${path}"]`);
    if (!el) return;
    if (el.type === 'checkbox') {
        el.checked = value === true || value === 'true';
        if (el.previousElementSibling && el.previousElementSibling.type === 'hidden') {
            el.previousElementSibling.value = el.checked ? 'true' : 'false';
        }
    } else if (el.type === 'datetime-local' && value) {
        el.value = value.substring(0, 16);
    } else if (el.tagName === 'TEXTAREA' || el.tagName === 'INPUT') {
        el.value = value || '';
    }
}

function populateForm(data) {
    Object.entries(data.couple || {}).forEach(([k, v]) => setVal(`couple[${k}]`, v));
    Object.entries(data.wedding_info || {}).forEach(([k, v]) => setVal(`wedding_info[${k}]`, v));
    Object.entries(data.quotes || {}).forEach(([k, v]) => setVal(`quotes[${k}]`, v));
    setVal('wa_number', data.wa_number);
    if (data.sections) {
        Object.entries(data.sections).forEach(([k, v]) => {
            if (typeof v === 'object' && v.enabled !== undefined) {
                setVal(`sections[${k}][enabled]`, v.enabled);
            }
        });
    }
}

async function saveWeddingConfig() {
    const fd = new FormData(document.getElementById('weddingConfigForm'));
    const data = {};
    for (let [key, value] of fd.entries()) {
        const match = key.match(/(\w+)\[(\w+)\](?:\[(\w+)\])?/);
        if (!match) { data[key] = value; continue; }
        const [, parent, child, grandchild] = match;
        if (!data[parent]) data[parent] = {};
        if (grandchild) {
            if (!data[parent][child]) data[parent][child] = {};
            data[parent][child][grandchild] = value;
        } else {
            data[parent][child] = value;
        }
    }
    try {
        const res = await fetch('{{ route("admin.wedding.update") }}', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept': 'application/json' },
            body: JSON.stringify(data)
        });
        const result = await res.json();
        if (result.success) showToast(result.message, 'success');
        else showToast(result.message || 'Gagal menyimpan.', 'error');
    } catch(e) { showToast('Gagal menyimpan.', 'error'); }
}
</script>
@endpush
