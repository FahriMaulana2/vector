<div>
    <div class="mb-6">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-text-primary admin-heading">{{ $isEditing ? 'Edit' : 'Tambah' }} Kategori Produk</h1>
                <p class="text-text-secondary mt-1.5 text-sm">Kelola kategori produk.</p>
            </div>
            <a href="{{ route('admin.product-categories.index') }}" wire:navigate class="inline-flex items-center gap-2 px-4 py-2.5 bg-white text-text-secondary text-sm font-medium rounded-xl border border-border hover:bg-surface transition-all duration-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg> Kembali
            </a>
        </div>
    </div>
    <div class="max-w-2xl">
        <div class="bg-white rounded-2xl border border-border shadow-soft p-6">
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-text-primary mb-1.5">Nama <span class="text-red-500">*</span></label>
                    <input wire:model="name" type="text" class="w-full px-4 py-2.5 border border-border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all" placeholder="Nama kategori">
                    @error('name') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-text-primary mb-1.5">Slug</label>
                    <input wire:model="slug" type="text" class="w-full px-4 py-2.5 border border-border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all" placeholder="auto-generated">
                </div>
                <div>
                    <label class="block text-sm font-medium text-text-primary mb-1.5">Deskripsi</label>
                    <textarea wire:model="description" rows="3" class="w-full px-4 py-2.5 border border-border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all resize-none" placeholder="Deskripsi kategori"></textarea>
                </div>
                <label class="flex items-center gap-3 cursor-pointer">
                    <input wire:model="is_active" type="checkbox" class="w-4 h-4 text-primary focus:ring-primary/20 border-border rounded">
                    <span class="text-sm font-medium text-text-primary">Aktifkan</span>
                </label>
            </div>
        </div>
        <div class="flex gap-3 mt-6">
            <a href="{{ route('admin.product-categories.index') }}" wire:navigate class="flex-1 px-4 py-2.5 bg-white text-text-secondary text-sm font-medium rounded-xl border border-border hover:bg-surface transition-all duration-200 text-center">Batal</a>
            <button wire:click="save" wire:loading.attr="disabled" class="flex-1 px-4 py-2.5 bg-primary text-white text-sm font-semibold rounded-xl hover:bg-primary-dark transition-all duration-200 shadow-button disabled:opacity-60">
                <span wire:loading.remove wire:target="save">{{ $isEditing ? 'Perbarui' : 'Simpan' }}</span>
                <span wire:loading wire:target="save" class="flex items-center justify-center gap-2">
                    <svg class="animate-spin h-4 w-4" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg> Menyimpan...
                </span>
            </button>
        </div>
    </div>
</div>
