<div>
    <div class="mb-6">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-text-primary admin-heading">{{ $isEditing ? 'Edit' : 'Tambah' }} Milestone</h1>
                <p class="text-text-secondary mt-1.5 text-sm">Tonggak sejarah/pencapaian perusahaan yang tampil di timeline halaman Tentang Kami.</p>
            </div>
            <a href="{{ route('admin.about.milestones.index') }}" wire:navigate
               class="inline-flex items-center gap-2 px-4 py-2.5 bg-white text-text-secondary text-sm font-medium rounded-xl border border-border hover:bg-surface transition-all duration-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-2xl border border-border shadow-soft p-6">
                <h2 class="text-lg font-semibold text-text-primary admin-heading mb-4">Informasi Milestone</h2>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-text-primary mb-1.5">Tahun <span class="text-red-500">*</span></label>
                        <input wire:model="year" type="number" min="1990" max="2100" class="w-full px-4 py-2.5 border border-border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all" placeholder="Contoh: 2019">
                        @error('year') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-text-primary mb-1.5">Judul Pencapaian <span class="text-red-500">*</span></label>
                        <input wire:model="title" type="text" class="w-full px-4 py-2.5 border border-border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all" placeholder="Contoh: Perusahaan berdiri">
                        @error('title') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-text-primary mb-1.5">Deskripsi (Opsional)</label>
                        <textarea wire:model="description" rows="3" class="w-full px-4 py-2.5 border border-border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all resize-none" placeholder="Ceritakan pencapaian ini secara singkat..."></textarea>
                        @error('description') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-text-primary mb-1.5">Urutan (dalam tahun yang sama)</label>
                        <input wire:model="sort_order" type="number" min="0" class="w-full px-4 py-2.5 border border-border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all" placeholder="0">
                        @error('sort_order') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input wire:model="is_active" type="checkbox" class="w-4 h-4 text-primary focus:ring-primary/20 border-border rounded">
                        <span class="text-sm font-medium text-text-primary">Aktifkan (tampilkan di timeline)</span>
                    </label>
                </div>
            </div>
        </div>
        <div class="space-y-6">
            <div class="bg-white rounded-2xl border border-border shadow-soft p-6">
                <h2 class="text-lg font-semibold text-text-primary admin-heading mb-3">Pratinjau</h2>
                <div class="relative pl-6 border-l-2 border-gold/40">
                    <span class="absolute -left-[9px] top-1 w-4 h-4 rounded-full bg-gold border-2 border-white shadow-sm"></span>
                    <p class="text-xs font-bold text-gold-dark font-mono">{{ $year ?: now()->year }}</p>
                    <p class="font-heading text-sm font-semibold text-navy mt-0.5">{{ $title ?: 'Judul pencapaian' }}</p>
                    @if($description)
                        <p class="text-xs text-ink-soft mt-1 leading-relaxed">{{ $description }}</p>
                    @endif
                </div>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('admin.about.milestones.index') }}" wire:navigate class="flex-1 px-4 py-2.5 bg-white text-text-secondary text-sm font-medium rounded-xl border border-border hover:bg-surface transition-all duration-200 text-center">Batal</a>
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
