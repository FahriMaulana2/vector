<div>
    <div class="mb-6">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-text-primary admin-heading">{{ $isEditing ? 'Edit' : 'Tambah' }} Tentang Kami</h1>
                <p class="text-text-secondary mt-1.5 text-sm">Kelola konten tentang perusahaan.</p>
            </div>
            <a href="{{ route('admin.about.index') }}" wire:navigate class="inline-flex items-center gap-2 px-4 py-2.5 bg-white text-text-secondary text-sm font-medium rounded-xl border border-border hover:bg-surface transition-all duration-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali
            </a>
        </div>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-2xl border border-border shadow-soft p-6">
                <h2 class="text-lg font-semibold text-text-primary admin-heading mb-4">Informasi Perusahaan</h2>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-text-primary mb-1.5">Judul <span class="text-red-500">*</span></label>
                        <input wire:model="title" type="text" class="w-full px-4 py-2.5 border border-border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all" placeholder="Judul section">
                        @error('title') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-text-primary mb-1.5">Subjudul</label>
                        <input wire:model="subtitle" type="text" class="w-full px-4 py-2.5 border border-border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all" placeholder="Subjudul">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-text-primary mb-1.5">Deskripsi</label>
                        <textarea wire:model="description" rows="4" class="w-full px-4 py-2.5 border border-border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all resize-none" placeholder="Deskripsi perusahaan"></textarea>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-text-primary mb-1.5">Visi</label>
                            <textarea wire:model="vision" rows="3" class="w-full px-4 py-2.5 border border-border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all resize-none" placeholder="Visi perusahaan"></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-text-primary mb-1.5">Misi</label>
                            <textarea wire:model="mission" rows="3" class="w-full px-4 py-2.5 border border-border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all resize-none" placeholder="Misi perusahaan"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="space-y-6">
            <div class="bg-white rounded-2xl border border-border shadow-soft p-6">
                <h2 class="text-lg font-semibold text-text-primary admin-heading mb-4">Pengaturan</h2>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-text-primary mb-1.5">Tahun Pengalaman</label>
                        <input wire:model="years_experience" type="number" class="w-full px-4 py-2.5 border border-border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all">
                    </div>
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input wire:model="is_active" type="checkbox" class="w-4 h-4 text-primary focus:ring-primary/20 border-border rounded">
                        <span class="text-sm font-medium text-text-primary">Aktifkan</span>
                    </label>
                </div>
            </div>
            <div class="bg-white rounded-2xl border border-border shadow-soft p-6">
                <h2 class="text-lg font-semibold text-text-primary admin-heading mb-4">Gambar</h2>
                @if($existing_image && !$image)
                    <img src="{{ asset('storage/'.$existing_image) }}" class="w-full h-40 object-cover rounded-xl mb-4">
                @endif
                @if($image)
                    <img src="{{ $image->temporaryUrl() }}" class="w-full h-40 object-cover rounded-xl mb-4">
                @endif
                <input wire:model="image" type="file" accept="image/*" class="w-full text-sm text-text-secondary file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20 transition-colors">
                @error('image') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>
            <div class="flex gap-3">
                <a href="{{ route('admin.about.index') }}" wire:navigate class="flex-1 px-4 py-2.5 bg-white text-text-secondary text-sm font-medium rounded-xl border border-border hover:bg-surface transition-all duration-200 text-center">Batal</a>
                <button wire:click="save" wire:loading.attr="disabled" class="flex-1 px-4 py-2.5 bg-primary text-white text-sm font-semibold rounded-xl hover:bg-primary-dark transition-all duration-200 shadow-button disabled:opacity-60">
                    <span wire:loading.remove wire:target="save">{{ $isEditing ? 'Perbarui' : 'Simpan' }}</span>
                    <span wire:loading wire:target="save" class="flex items-center justify-center gap-2">
                        <svg class="animate-spin h-4 w-4" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg>
                        Menyimpan...
                    </span>
                </button>
            </div>
        </div>
    </div>
</div>
