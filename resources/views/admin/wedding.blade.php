@extends('layouts.admin')

@section('content')
<div class="space-y-8">
    <div>
        <h1 class="text-xl font-bold text-gray-900">Konfigurasi Undangan</h1>
        <p class="text-sm text-gray-500 mt-0.5">Edit data mempelai, acara, quotes, dan pengaturan lainnya.</p>
    </div>

    <form id="weddingConfigForm" class="space-y-6">
        {{-- Data Mempelai --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-sm font-semibold text-gray-600 uppercase tracking-wider">Data Mempelai</h2>
                <button type="button" onclick="saveWeddingConfig()" class="px-4 py-2 bg-gray-900 hover:bg-gray-800 text-white text-sm font-medium rounded-lg transition-colors shadow-sm">Simpan Mempelai</button>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <fieldset class="border border-gray-200 rounded-lg p-4">
                    <legend class="text-sm font-medium text-gray-700 px-2">Mempelai Pria</legend>
                    <div class="space-y-3">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Foto Mempelai Pria</label>
                            <input type="file" name="groom_photo" accept="image/*" class="w-full px-3 py-2 rounded-lg border border-gray-300 text-sm shadow-sm focus:ring-2 focus:ring-gray-900/10 focus:border-gray-900 outline-none transition">
                            <p class="text-xs text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengubah foto saat ini.</p>
                        </div>
                        <div><label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label><input type="text" name="couple[groomName]" class="w-full px-3 py-2 rounded-lg border border-gray-300 text-sm shadow-sm focus:ring-2 focus:ring-gray-900/10 focus:border-gray-900 outline-none transition"></div>
                        <div><label class="block text-sm font-medium text-gray-700 mb-1">Nama Panggilan</label><input type="text" name="couple[groomShort]" class="w-full px-3 py-2 rounded-lg border border-gray-300 text-sm shadow-sm focus:ring-2 focus:ring-gray-900/10 focus:border-gray-900 outline-none transition"></div>
                        <div><label class="block text-sm font-medium text-gray-700 mb-1">Orang Tua</label><input type="text" name="couple[groomParents]" class="w-full px-3 py-2 rounded-lg border border-gray-300 text-sm shadow-sm focus:ring-2 focus:ring-gray-900/10 focus:border-gray-900 outline-none transition"></div>
                        <div><label class="block text-sm font-medium text-gray-700 mb-1">Instagram URL</label><input type="url" name="couple[groomInstagram]" class="w-full px-3 py-2 rounded-lg border border-gray-300 text-sm shadow-sm focus:ring-2 focus:ring-gray-900/10 focus:border-gray-900 outline-none transition"></div>
                        <div><label class="block text-sm font-medium text-gray-700 mb-1">Instagram Handle</label><input type="text" name="couple[groomInstagramHandle]" class="w-full px-3 py-2 rounded-lg border border-gray-300 text-sm shadow-sm focus:ring-2 focus:ring-gray-900/10 focus:border-gray-900 outline-none transition"></div>
                    </div>
                </fieldset>
                <fieldset class="border border-gray-200 rounded-lg p-4">
                    <legend class="text-sm font-medium text-gray-700 px-2">Mempelai Wanita</legend>
                    <div class="space-y-3">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Foto Mempelai Wanita</label>
                            <input type="file" name="bride_photo" accept="image/*" class="w-full px-3 py-2 rounded-lg border border-gray-300 text-sm shadow-sm focus:ring-2 focus:ring-gray-900/10 focus:border-gray-900 outline-none transition">
                            <p class="text-xs text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengubah foto saat ini.</p>
                        </div>
                        <div><label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label><input type="text" name="couple[brideName]" class="w-full px-3 py-2 rounded-lg border border-gray-300 text-sm shadow-sm focus:ring-2 focus:ring-gray-900/10 focus:border-gray-900 outline-none transition"></div>
                        <div><label class="block text-sm font-medium text-gray-700 mb-1">Nama Panggilan</label><input type="text" name="couple[brideShort]" class="w-full px-3 py-2 rounded-lg border border-gray-300 text-sm shadow-sm focus:ring-2 focus:ring-gray-900/10 focus:border-gray-900 outline-none transition"></div>
                        <div><label class="block text-sm font-medium text-gray-700 mb-1">Orang Tua</label><input type="text" name="couple[brideParents]" class="w-full px-3 py-2 rounded-lg border border-gray-300 text-sm shadow-sm focus:ring-2 focus:ring-gray-900/10 focus:border-gray-900 outline-none transition"></div>
                        <div><label class="block text-sm font-medium text-gray-700 mb-1">Instagram URL</label><input type="url" name="couple[brideInstagram]" class="w-full px-3 py-2 rounded-lg border border-gray-300 text-sm shadow-sm focus:ring-2 focus:ring-gray-900/10 focus:border-gray-900 outline-none transition"></div>
                        <div><label class="block text-sm font-medium text-gray-700 mb-1">Instagram Handle</label><input type="text" name="couple[brideInstagramHandle]" class="w-full px-3 py-2 rounded-lg border border-gray-300 text-sm shadow-sm focus:ring-2 focus:ring-gray-900/10 focus:border-gray-900 outline-none transition"></div>
                    </div>
                </fieldset>
            </div>
        </div>

        {{-- Informasi Pernikahan --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-sm font-semibold text-gray-600 uppercase tracking-wider">Informasi Pernikahan</h2>
                <button type="button" onclick="saveWeddingConfig()" class="px-4 py-2 bg-gray-900 hover:bg-gray-800 text-white text-sm font-medium rounded-lg transition-colors shadow-sm">Simpan Info</button>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Tanggal (ISO)</label><input type="datetime-local" name="wedding_info[date]" class="w-full px-3 py-2 rounded-lg border border-gray-300 text-sm shadow-sm focus:ring-2 focus:ring-gray-900/10 focus:border-gray-900 outline-none transition"></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Display</label><input type="text" name="wedding_info[dateFormatted]" class="w-full px-3 py-2 rounded-lg border border-gray-300 text-sm shadow-sm focus:ring-2 focus:ring-gray-900/10 focus:border-gray-900 outline-none transition" placeholder="20 Agustus 2026"></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Hari</label><input type="text" name="wedding_info[day]" class="w-full px-3 py-2 rounded-lg border border-gray-300 text-sm shadow-sm focus:ring-2 focus:ring-gray-900/10 focus:border-gray-900 outline-none transition" placeholder="Kamis"></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Nama Gedung</label><input type="text" name="wedding_info[location]" class="w-full px-3 py-2 rounded-lg border border-gray-300 text-sm shadow-sm focus:ring-2 focus:ring-gray-900/10 focus:border-gray-900 outline-none transition"></div>
                <div class="md:col-span-2"><label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label><input type="text" name="wedding_info[address]" class="w-full px-3 py-2 rounded-lg border border-gray-300 text-sm shadow-sm focus:ring-2 focus:ring-gray-900/10 focus:border-gray-900 outline-none transition"></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Telepon</label><input type="text" name="wedding_info[phone]" class="w-full px-3 py-2 rounded-lg border border-gray-300 text-sm shadow-sm focus:ring-2 focus:ring-gray-900/10 focus:border-gray-900 outline-none transition"></div>
            </div>
        </div>

        {{-- Google Maps --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-sm font-semibold text-gray-600 uppercase tracking-wider">Google Maps</h2>
                <button type="button" onclick="saveWeddingConfig()" class="px-4 py-2 bg-gray-900 hover:bg-gray-800 text-white text-sm font-medium rounded-lg transition-colors shadow-sm">Simpan Maps</button>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Maps Embed URL</label><input type="url" name="wedding_info[mapsEmbed]" class="w-full px-3 py-2 rounded-lg border border-gray-300 text-sm shadow-sm focus:ring-2 focus:ring-gray-900/10 focus:border-gray-900 outline-none transition"></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Maps Direct Link</label><input type="url" name="wedding_info[mapsLink]" class="w-full px-3 py-2 rounded-lg border border-gray-300 text-sm shadow-sm focus:ring-2 focus:ring-gray-900/10 focus:border-gray-900 outline-none transition"></div>
            </div>
        </div>

        {{-- Teks & Quotes --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-sm font-semibold text-gray-600 uppercase tracking-wider">Teks & Quotes</h2>
                <button type="button" onclick="saveWeddingConfig()" class="px-4 py-2 bg-gray-900 hover:bg-gray-800 text-white text-sm font-medium rounded-lg transition-colors shadow-sm">Simpan Quotes</button>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Bismillah (Arabic)</label><input type="text" name="quotes[bismillah]" class="w-full px-3 py-2 rounded-lg border border-gray-300 text-sm shadow-sm focus:ring-2 focus:ring-gray-900/10 focus:border-gray-900 outline-none transition text-right" style="font-family: serif; font-size: 1.25rem;"></div>
                <div class="md:col-span-2"><label class="block text-sm font-medium text-gray-700 mb-1">Ayat Al-Quran</label><textarea name="quotes[quran]" rows="3" class="w-full px-3 py-2 rounded-lg border border-gray-300 text-sm shadow-sm focus:ring-2 focus:ring-gray-900/10 focus:border-gray-900 outline-none transition"></textarea></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Referensi Ayat</label><input type="text" name="quotes[quranRef]" class="w-full px-3 py-2 rounded-lg border border-gray-300 text-sm shadow-sm focus:ring-2 focus:ring-gray-900/10 focus:border-gray-900 outline-none transition"></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Salam Pembuka</label><input type="text" name="quotes[opening]" class="w-full px-3 py-2 rounded-lg border border-gray-300 text-sm shadow-sm focus:ring-2 focus:ring-gray-900/10 focus:border-gray-900 outline-none transition"></div>
                <div class="md:col-span-2"><label class="block text-sm font-medium text-gray-700 mb-1">Teks Pembuka</label><textarea name="quotes[openingText]" rows="3" class="w-full px-3 py-2 rounded-lg border border-gray-300 text-sm shadow-sm focus:ring-2 focus:ring-gray-900/10 focus:border-gray-900 outline-none transition"></textarea></div>
                <div class="md:col-span-2"><label class="block text-sm font-medium text-gray-700 mb-1">Teks Penutup</label><textarea name="quotes[closingText]" rows="3" class="w-full px-3 py-2 rounded-lg border border-gray-300 text-sm shadow-sm focus:ring-2 focus:ring-gray-900/10 focus:border-gray-900 outline-none transition"></textarea></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Salam Penutup</label><input type="text" name="quotes[footerClosing]" class="w-full px-3 py-2 rounded-lg border border-gray-300 text-sm shadow-sm focus:ring-2 focus:ring-gray-900/10 focus:border-gray-900 outline-none transition"></div>
            </div>
        </div>

        {{-- WhatsApp --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-sm font-semibold text-gray-600 uppercase tracking-wider">WhatsApp</h2>
                <button type="button" onclick="saveWeddingConfig()" class="px-4 py-2 bg-gray-900 hover:bg-gray-800 text-white text-sm font-medium rounded-lg transition-colors shadow-sm">Simpan WA</button>
            </div>
            <div class="max-w-md">
                <label class="block text-sm font-medium text-gray-700 mb-1">Nomor WA (format 628xxx)</label>
                <input type="text" name="wa_number" class="w-full px-3 py-2 rounded-lg border border-gray-300 text-sm shadow-sm focus:ring-2 focus:ring-gray-900/10 focus:border-gray-900 outline-none transition">
            </div>
        </div>

        {{-- Section Toggles --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-sm font-semibold text-gray-600 uppercase tracking-wider">Tampilan Section</h2>
                <button type="button" onclick="saveWeddingConfig()" class="px-4 py-2 bg-gray-900 hover:bg-gray-800 text-white text-sm font-medium rounded-lg transition-colors shadow-sm">Simpan Section</button>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                @php $sectionLabels = ['event'=>'Event','story'=>'Love Story','gallery'=>'Gallery','video'=>'Video','location'=>'Lokasi','rsvp'=>'RSVP','gift'=>'Wedding Gift','wish'=>'Ucapan']; @endphp
                @foreach($sectionLabels as $key => $label)
                <label class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg cursor-pointer hover:bg-gray-100 transition-colors">
                    <input type="hidden" name="sections[{{ $key }}][enabled]" value="false">
                    <input type="checkbox" name="sections[{{ $key }}][enabled]" value="true" class="w-5 h-5 rounded border-gray-300 text-gray-900 focus:ring-gray-900/20" checked onchange="this.previousElementSibling.value=this.checked?'true':'false'">
                    <span class="text-sm font-medium text-gray-700">{{ $label }}</span>
                </label>
                @endforeach
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
    const elements = document.querySelectorAll(`[name="${path}"]`);
    elements.forEach(el => {
        if (el.type === 'checkbox') {
            el.checked = value === true || value === 'true';
        } else if (el.type === 'hidden') {
            el.value = (value === true || value === 'true') ? 'true' : 'false';
        } else if (el.type === 'datetime-local' && value) {
            el.value = value.substring(0, 16);
        } else if (el.tagName === 'TEXTAREA' || el.tagName === 'INPUT') {
            el.value = value || '';
        }
    });
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
    // Laravel requires _method=PUT/PATCH for updates, but since route is POST, we just send as POST.
    
    try {
        const res = await fetch('{{ route("admin.wedding.update") }}', {
            method: 'POST',
            headers: { 
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 
                'Accept': 'application/json' 
            },
            body: fd
        });
        const result = await res.json();
        if (result.success) showToast(result.message, 'success');
        else showToast(result.message || 'Gagal menyimpan.', 'error');
    } catch(e) { showToast('Gagal menyimpan.', 'error'); }
}
</script>
@endpush
