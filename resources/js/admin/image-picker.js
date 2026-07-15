window.autoUpload = function(input, hiddenId, previewId, folder) {
    const file = input.files[0];
    if (!file) return;

    const formData = new FormData();
    formData.append('image', file);
    formData.append('folder', folder || 'gallery');

    const preview = document.getElementById(previewId);
    if (preview) {
        preview.src = URL.createObjectURL(file);
        preview.classList.remove('hidden');
    }

    const btn = input.nextElementSibling;
    const originalText = btn ? btn.textContent : '';
    if (btn) { btn.textContent = 'Uploading...'; btn.disabled = true; }

    fetch('/admin/upload', {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
        body: formData
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            const hidden = document.getElementById(hiddenId);
            if (hidden) hidden.value = data.path.replace(/^\//, '');
            showToast('Upload berhasil!', 'success');
        } else {
            showToast(data.message || 'Upload gagal', 'error');
        }
    })
    .catch(() => showToast('Upload gagal', 'error'))
    .finally(() => {
        if (btn) { btn.textContent = originalText; btn.disabled = false; }
    });
};
