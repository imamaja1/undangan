@extends('layouts.admin')

@section('content')
<div>
    <h1 class="text-xl font-bold text-gray-900">Asset & Media</h1>
    <p class="text-sm text-gray-500 mt-0.5">Upload gambar background untuk setiap section landing page dan background music.</p>

    <div class="mt-8">
        <h2 class="text-sm font-semibold text-gray-600 uppercase tracking-wider mb-1">Background Section</h2>
        <p class="text-xs text-gray-400 mb-4">14 section landing page. Upload file JPG/PNG/WebP (maks 20MB).</p>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-7 gap-4">
            @foreach($assets as $key => $asset)
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow">
                <div class="aspect-[3/2] bg-gray-100 relative overflow-hidden">
                    @if($asset['exists'])
                    <img src="{{ $asset['url'] }}" alt="{{ $asset['label'] }}" class="w-full h-full object-cover">
                    @else
                    <div class="w-full h-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    @endif
                    <div class="absolute bottom-0 inset-x-0 bg-gradient-to-t from-black/60 to-transparent px-2 py-1.5">
                        <span class="text-white text-[10px] font-medium">{{ $asset['label'] }}</span>
                    </div>
                </div>
                <div class="p-3">
                    @if($asset['exists'])
                    <p class="text-[10px] text-gray-400">{{ $asset['size'] }} &middot; {{ $asset['updated'] }}</p>
                    @else
                    <p class="text-[10px] text-red-400">Belum diupload</p>
                    @endif
                    <div class="flex gap-1 mt-2">
                        <label class="flex-1 text-center text-[10px] font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-md py-1.5 cursor-pointer transition-colors border border-gray-200">
                            <span id="label-{{ $key }}">Upload</span>
                            <input type="file" accept="image/*" class="hidden" onchange="uploadBg(this, '{{ $key }}')">
                        </label>
                        @if($asset['exists'])
                        <button onclick="deleteBg('{{ $key }}')" class="flex-1 text-center text-[10px] font-medium text-red-500 bg-red-50 hover:bg-red-100 rounded-md py-1.5 cursor-pointer transition-colors border border-red-200">Hapus</button>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="mt-10">
        <h2 class="text-sm font-semibold text-gray-600 uppercase tracking-wider mb-1">Background Music</h2>
        <p class="text-xs text-gray-400 mb-4">Upload MP3/WAV/OGG (maks 30MB).</p>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 flex items-center gap-6 max-w-xl">
            <div class="w-16 h-16 bg-gray-100 rounded-xl flex items-center justify-center shrink-0">
                @if($audio['exists'])
                <svg class="w-8 h-8 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"/></svg>
                @else
                <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"/></svg>
                @endif
            </div>
            <div class="flex-1 min-w-0">
                @if($audio['exists'])
                <p class="font-medium text-gray-800 text-sm">wedding.mp3</p>
                <p class="text-xs text-gray-400 mt-0.5">{{ $audio['size'] }}</p>
                <audio controls class="mt-2 w-full h-8" preload="none">
                    <source src="{{ $audio['url'] }}" type="audio/mpeg">
                </audio>
                @else
                <p class="font-medium text-red-500 text-sm">Belum diupload</p>
                <p class="text-xs text-gray-400 mt-0.5">Upload background music untuk undangan</p>
                @endif
            </div>
            <label class="shrink-0 px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-medium rounded-lg cursor-pointer transition-colors border border-gray-200" id="audioLabel">
                Upload
                <input type="file" accept="audio/mpeg,audio/wav,audio/ogg" class="hidden" onchange="uploadAudio(this)">
            </label>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
async function uploadBg(input, section) {
    const file = input.files[0];
    if (!file) return;

    const label = document.getElementById('label-' + section);
    if (!label) return;
    const original = label.textContent;
    label.textContent = 'Uploading...';
    label.classList.add('pointer-events-none', 'opacity-50');

    const formData = new FormData();
    formData.append('image', file);
    formData.append('section', section);

    try {
        const res = await fetch('{{ route("admin.assets.uploadBg") }}', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept': 'application/json' },
            body: formData
        });
        const data = await res.json();
        if (data.success) {
            showToast(data.message, 'success');
            setTimeout(() => location.reload(), 600);
        } else {
            showToast(data.message || 'Upload gagal', 'error');
        }
    } catch(e) {
        showToast('Upload gagal: ' + e.message, 'error');
    }

    label.textContent = original;
    label.classList.remove('pointer-events-none', 'opacity-50');
}

async function deleteBg(section) {
    if (!confirm('Hapus background section ini?')) return;
    try {
        const res = await fetch('{{ route("admin.assets.deleteBg", "__section__") }}'.replace('__section__', section), {
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept': 'application/json' }
        });
        const data = await res.json();
        if (data.success) {
            showToast(data.message, 'success');
            setTimeout(() => location.reload(), 400);
        } else {
            showToast(data.message || 'Gagal menghapus', 'error');
        }
    } catch(e) {
        showToast('Gagal menghapus', 'error');
    }
}

async function uploadAudio(input) {
    const file = input.files[0];
    if (!file) return;

    const label = document.getElementById('audioLabel');
    if (!label) return;
    const original = label.textContent;
    label.textContent = 'Uploading...';
    label.classList.add('pointer-events-none', 'opacity-50');

    const formData = new FormData();
    formData.append('audio', file);

    try {
        const res = await fetch('{{ route("admin.assets.uploadAudio") }}', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept': 'application/json' },
            body: formData
        });
        const data = await res.json();
        if (data.success) {
            showToast(data.message, 'success');
            setTimeout(() => location.reload(), 600);
        } else {
            showToast(data.message || 'Upload gagal', 'error');
        }
    } catch(e) {
        showToast('Upload gagal: ' + e.message, 'error');
    }

    label.textContent = original;
    label.classList.remove('pointer-events-none', 'opacity-50');
}
</script>
@endpush
