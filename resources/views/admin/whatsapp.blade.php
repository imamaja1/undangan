@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-xl font-bold text-gray-900">Otomasi WhatsApp</h1>
            <p class="text-sm text-gray-500 mt-0.5">Kelola gateway WhatsApp untuk kirim pesan otomatis ke tamu.</p>
        </div>
        <div id="statusBadge" class="px-3 py-1 bg-gray-100 text-gray-600 text-xs font-semibold uppercase tracking-wider rounded-full shadow-sm">
            Mengecek...
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- Section Kiri: Pengaturan & Uji Coba --}}
        <div class="space-y-6">
            {{-- API Key Form --}}
            @if($isEnvConfigured)
            <div class="bg-emerald-50 rounded-xl shadow-sm border border-emerald-200 p-6">
                <div class="flex items-center gap-3">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <div>
                        <h2 class="text-sm font-semibold text-emerald-800 uppercase tracking-wider">Otomatis Terkonfigurasi</h2>
                        <p class="text-xs text-emerald-600 mt-1">Sistem membaca API Key secara otomatis dari file .env (AUTOMATION_KEY).</p>
                    </div>
                </div>
            </div>
            @else
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h2 class="text-sm font-semibold text-gray-600 uppercase tracking-wider mb-4">Konfigurasi API Key</h2>
                <form id="waConfigForm" onsubmit="saveApiKey(event)" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">API Key (x-api-key)</label>
                        <input type="password" id="waApiKey" name="wa_api_key" value="{{ $apiKey }}" class="w-full px-3 py-2 rounded-lg border border-gray-300 text-sm shadow-sm focus:ring-2 focus:ring-gray-900/10 focus:border-gray-900 outline-none transition" placeholder="ak_..." required>
                        <p class="text-xs text-gray-400 mt-1">Jika belum punya, Anda bisa generate baru menggunakan form di bawah.</p>
                    </div>
                    <button type="submit" class="px-4 py-2 bg-gray-900 hover:bg-gray-800 text-white text-sm font-medium rounded-lg transition-colors shadow-sm">Simpan Kunci Manual</button>
                </form>

                <hr class="my-6 border-gray-100">

                <h3 class="text-sm font-semibold text-gray-600 uppercase tracking-wider mb-4">Generate API Key Baru</h3>
                <form id="waGenerateForm" onsubmit="generateApiKey(event)" class="space-y-4">
                    <p class="text-xs text-gray-500 mb-2">Klik tombol di bawah ini, dan sistem akan otomatis mendaftarkan aplikasi Anda ke server Otomasi dan menanamkan kuncinya.</p>
                    <button type="submit" id="btnGenerate" class="w-full px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors shadow-sm">Daftar & Generate Kunci Otomatis</button>
                </form>
            </div>
            @endif

            {{-- Uji Coba Kirim Pesan --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6" id="testMessageSection" style="display: none;">
                <h2 class="text-sm font-semibold text-gray-600 uppercase tracking-wider mb-4">Uji Coba Kirim Pesan</h2>
                <form id="waSendForm" onsubmit="testSendMessage(event)" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Tujuan (628...)</label>
                        <input type="text" id="waTo" required class="w-full px-3 py-2 rounded-lg border border-gray-300 text-sm shadow-sm focus:ring-2 focus:ring-gray-900/10 focus:border-gray-900 outline-none transition" placeholder="628123456789">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pesan</label>
                        <textarea id="waMessage" rows="3" required class="w-full px-3 py-2 rounded-lg border border-gray-300 text-sm shadow-sm focus:ring-2 focus:ring-gray-900/10 focus:border-gray-900 outline-none transition" placeholder="Halo, ini pesan percobaan dari Panel Admin!"></textarea>
                    </div>
                    <button type="submit" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-lg transition-colors shadow-sm" id="btnSend">Kirim Pesan Uji Coba</button>
                </form>
            </div>
        </div>

        {{-- Section Kanan: QR Code Scanner --}}
        <div class="space-y-6">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 flex flex-col items-center justify-center text-center min-h-[350px]">
                <h2 class="text-sm font-semibold text-gray-600 uppercase tracking-wider mb-2 w-full text-left">Status Koneksi</h2>
                
                <div id="qrContainer" class="flex flex-col items-center justify-center space-y-4 w-full flex-1">
                    <p class="text-gray-500 text-sm" id="qrStatusText">Sedang memuat status...</p>
                    
                    {{-- QR Image Box --}}
                    <div id="qrImageBox" class="hidden p-2 bg-white rounded-xl border border-gray-100 shadow-sm">
                        <img id="qrImage" src="" alt="QR Code WhatsApp" class="w-48 h-48">
                    </div>
                    
                    {{-- Action Buttons --}}
                    <div class="flex gap-2 mt-4">
                        <button id="btnRefreshStatus" onclick="checkStatus()" class="px-3 py-1.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-medium rounded-lg transition-colors border border-gray-200">Refresh Status</button>
                        <button id="btnInit" onclick="forceInit()" class="hidden px-3 py-1.5 bg-blue-50 hover:bg-blue-100 text-blue-600 text-xs font-medium rounded-lg transition-colors border border-blue-200">Minta QR Baru</button>
                        <button id="btnLogoutWa" onclick="logoutWa()" class="hidden px-3 py-1.5 bg-red-50 hover:bg-red-100 text-red-500 text-xs font-medium rounded-lg transition-colors border border-red-200">Logout Sesi</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
let pollingInterval = null;

document.addEventListener('DOMContentLoaded', () => {
    checkStatus();
});

async function saveApiKey(e) {
    e.preventDefault();
    const btn = e.target.querySelector('button');
    const oriText = btn.textContent;
    btn.textContent = 'Menyimpan...';
    btn.disabled = true;

    try {
        const res = await fetch('{{ route("admin.whatsapp.saveKey") }}', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept': 'application/json' },
            body: JSON.stringify({ wa_api_key: document.getElementById('waApiKey').value })
        });
        const data = await res.json();
        if(data.success) {
            showToast(data.message, 'success');
            checkStatus(); // re-check with new key
        } else {
            showToast(data.message || 'Gagal menyimpan.', 'error');
        }
    } catch(err) {
        showToast('Terjadi kesalahan.', 'error');
    }
    btn.textContent = oriText;
    btn.disabled = false;
}

async function generateApiKey(e) {
    e.preventDefault();
    const btn = document.getElementById('btnGenerate');
    const oriText = btn.textContent;
    btn.textContent = 'Memproses...';
    btn.disabled = true;

    try {
        const res = await fetch('{{ route("admin.whatsapp.generateKey") }}', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept': 'application/json' },
            body: JSON.stringify({})
        });
        const data = await res.json();
        if (data.success) {
            showToast(data.message, 'success');
            document.getElementById('waApiKey').value = data.key;
            checkStatus();
        } else {
            showToast(data.error || 'Gagal generate key.', 'error');
        }
    } catch (err) {
        showToast('Terjadi kesalahan koneksi.', 'error');
    }
    btn.textContent = oriText;
    btn.disabled = false;
}

async function checkStatus() {
    clearTimeout(pollingInterval);
    const badge = document.getElementById('statusBadge');
    const qrText = document.getElementById('qrStatusText');
    const qrBox = document.getElementById('qrImageBox');
    const btnLogout = document.getElementById('btnLogoutWa');
    const btnInit = document.getElementById('btnInit');
    const testSect = document.getElementById('testMessageSection');
    
    try {
        const res = await fetch('{{ route("admin.whatsapp.status") }}');
        const data = await res.json();

        // Handle Laravel side errors (e.g., no key)
        if(data.error && data.state === 'idle') {
            updateUI(badge, 'BELUM DISET', 'bg-gray-100 text-gray-600');
            qrText.textContent = 'Silakan masukkan API Key terlebih dahulu.';
            qrBox.classList.add('hidden');
            testSect.style.display = 'none';
            btnInit.classList.add('hidden');
            return;
        }

        const state = data.state || 'error';
        
        if (state === 'ready') {
            updateUI(badge, 'TERHUBUNG', 'bg-emerald-100 text-emerald-600');
            qrText.innerHTML = '<span class="text-emerald-500 font-medium">WhatsApp siap digunakan!</span><br><span class="text-xs text-gray-400">Pesan akan langsung terkirim.</span>';
            qrBox.classList.add('hidden');
            btnLogout.classList.remove('hidden');
            btnInit.classList.add('hidden');
            testSect.style.display = 'block';
        } 
        else if (state === 'awaiting_scan') {
            updateUI(badge, 'SCAN QR', 'bg-amber-100 text-amber-600');
            qrText.innerHTML = 'Scan QR di bawah ini dengan aplikasi WhatsApp Anda:<br><span class="text-xs text-gray-400">Setelan > Perangkat Tertaut > Tautkan Perangkat</span>';
            testSect.style.display = 'none';
            btnLogout.classList.add('hidden');
            btnInit.classList.add('hidden');
            await loadQR();
            // Poll faster when waiting for scan
            pollingInterval = setTimeout(checkStatus, 5000);
        }
        else if (state === 'initializing') {
            updateUI(badge, 'MEMULAI...', 'bg-blue-100 text-blue-600');
            qrText.textContent = 'Server sedang memuat WhatsApp, harap tunggu...';
            qrBox.classList.add('hidden');
            testSect.style.display = 'none';
            btnLogout.classList.add('hidden');
            btnInit.classList.add('hidden');
            pollingInterval = setTimeout(checkStatus, 3000);
        }
        else {
            updateUI(badge, 'TERPUTUS', 'bg-red-100 text-red-600');
            qrText.innerHTML = `<span class="text-red-500">Koneksi Terputus (${state}).</span><br><span class="text-xs text-gray-500">Silakan klik "Minta QR Baru" untuk memulai sesi baru.</span>`;
            qrBox.classList.add('hidden');
            testSect.style.display = 'none';
            btnInit.classList.remove('hidden');
            if(state !== 'logged_out') btnLogout.classList.remove('hidden');
        }
    } catch(err) {
        updateUI(badge, 'GAGAL KONEKSI', 'bg-red-100 text-red-600');
        qrText.textContent = 'Tidak dapat terhubung ke server proxy Laravel.';
        btnInit.classList.add('hidden');
    }
}

async function forceInit() {
    showToast('Meminta sesi baru...', 'success');
    document.getElementById('btnInit').classList.add('hidden');
    await loadQR();
    setTimeout(checkStatus, 2000);
}

function updateUI(badge, text, classes) {
    badge.textContent = text;
    badge.className = `px-3 py-1 text-xs font-semibold uppercase tracking-wider rounded-full shadow-sm ${classes}`;
}

async function loadQR() {
    try {
        const res = await fetch('{{ route("admin.whatsapp.qr") }}');
        const data = await res.json();
        if(data.qr) {
            document.getElementById('qrImageBox').classList.remove('hidden');
            document.getElementById('qrImage').src = 'https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=' + encodeURIComponent(data.qr);
        }
    } catch(err) {
        console.error('Gagal meload QR');
    }
}

async function testSendMessage(e) {
    e.preventDefault();
    const btn = document.getElementById('btnSend');
    const ori = btn.textContent;
    btn.textContent = 'Mengirim...';
    btn.disabled = true;

    try {
        const res = await fetch('{{ route("admin.whatsapp.send") }}', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept': 'application/json' },
            body: JSON.stringify({ 
                to: document.getElementById('waTo').value,
                message: document.getElementById('waMessage').value
            })
        });
        const data = await res.json();
        if(res.ok && data.status) {
            showToast(`Pesan sukses dengan status: ${data.status}`, 'success');
        } else {
            showToast(data.error || 'Gagal mengirim pesan', 'error');
        }
    } catch(err) {
        showToast('Koneksi bermasalah saat mengirim pesan.', 'error');
    }
    btn.textContent = ori;
    btn.disabled = false;
}

async function logoutWa() {
    if(!confirm('Yakin ingin mengeluarkan sesi WhatsApp ini? Anda harus scan QR lagi nanti.')) return;
    try {
        const res = await fetch('{{ route("admin.whatsapp.logout") }}', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept': 'application/json' }
        });
        showToast('Sesi dikeluarkan.', 'success');
        setTimeout(checkStatus, 2000);
    } catch(err) {
        showToast('Gagal logout', 'error');
    }
}
</script>
@endpush
