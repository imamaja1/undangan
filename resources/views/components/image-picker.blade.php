<div x-data="imagePicker()" class="space-y-3">
    <div class="flex gap-3">
        <select x-model="folder" class="px-3 py-2 border border-cream-dark rounded-lg text-sm focus:ring-2 focus:ring-gold focus:border-gold outline-none">
            <option value="">Semua folder</option>
            <option value="hero">hero</option>
            <option value="groom">groom</option>
            <option value="bride">bride</option>
            <option value="story">story</option>
            <option value="gallery">gallery</option>
            <option value="event">event</option>
            <option value="icons">icons</option>
            <option value="decoration">decoration</option>
        </select>
        <input type="file" @change="uploadImage($event)" accept="image/*" class="hidden" id="imageUpload">
        <button type="button" onclick="document.getElementById('imageUpload').click()" class="px-3 py-2 bg-gold hover:bg-gold-dark text-white rounded-lg text-sm font-medium">Upload</button>
    </div>
    <div class="grid grid-cols-3 md:grid-cols-4 gap-3 max-h-60 overflow-y-auto p-1">
        <template x-for="img in filteredImages" :key="img">
            <div class="aspect-square rounded-lg overflow-hidden border-2 cursor-pointer hover:border-gold transition-colors" :class="selected === img ? 'border-gold' : 'border-cream-dark'" @click="selectImage(img)">
                <img :src="img" alt="" class="w-full h-full object-cover" loading="lazy">
            </div>
        </template>
    </div>
    <p class="text-xs text-gray-400" x-text="selected || 'Belum ada gambar dipilih'"></p>
</div>

<script>
function imagePicker() {
    return {
        folder: '',
        selected: '',
        images: [],
        get filteredImages() {
            if (!this.folder) return this.images;
            return this.images.filter(img => img.includes('/' + this.folder + '/'));
        },
        selectImage(img) {
            this.selected = img;
            const inputEl = document.getElementById(this.$el.closest('[data-input]')?.dataset?.input);
            if (inputEl) inputEl.value = img;
        },
        async uploadImage(e) {
            const file = e.target.files[0];
            if (!file) return;
            const formData = new FormData();
            formData.append('image', file);
            formData.append('folder', this.folder || 'gallery');
            try {
                const res = await fetch('/admin/upload', {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
                    body: formData
                });
                const data = await res.json();
                if (data.success) {
                    this.images.unshift(data.path);
                    showToast('Upload berhasil!', 'success');
                }
            } catch(err) {
                showToast('Upload gagal!', 'error');
            }
        },
        async fetchImages() {
            try {
                const res = await fetch('/admin/images');
                const data = await res.json();
                this.images = data;
            } catch(e) {}
        },
        init() {
            this.fetchImages();
        }
    }
}
</script>
