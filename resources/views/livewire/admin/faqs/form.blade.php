<div>
    <div class="mb-6">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-text-primary admin-heading">{{ $isEditing ? 'Edit' : 'Tambah' }} FAQ</h1>
                <p class="text-text-secondary mt-1.5 text-sm">Kelola pertanyaan yang ditampilkan di landing page.</p>
            </div>
            <a href="{{ route('admin.faqs.index') }}" wire:navigate class="inline-flex items-center gap-2 px-4 py-2.5 bg-white text-text-secondary text-sm font-medium rounded-xl border border-border hover:bg-surface transition-all duration-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg> Kembali
            </a>
        </div>
    </div>

    @if(session()->has('success'))
        <div class="mb-4 flex items-center gap-2 px-4 py-3 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm font-medium">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-2xl border border-border shadow-soft p-6">
                <h2 class="text-lg font-semibold text-text-primary admin-heading mb-4">Informasi FAQ</h2>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-text-primary mb-1.5">Pertanyaan <span class="text-red-500">*</span></label>
                        <input wire:model="question" type="text" class="w-full px-4 py-2.5 border border-border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all" placeholder="Tulis pertanyaan">
                        @error('question') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-text-primary mb-1.5">Jawaban <span class="text-red-500">*</span></label>
                        <textarea wire:model="answer" rows="6" class="w-full px-4 py-2.5 border border-border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all resize-none" placeholder="Tulis jawaban"></textarea>
                        @error('answer') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="space-y-6">
            <div class="bg-white rounded-2xl border border-border shadow-soft p-6">
                <h2 class="text-lg font-semibold text-text-primary admin-heading mb-4">Status</h2>
                <label class="flex items-center gap-3 cursor-pointer">
                    <input wire:model="is_active" type="checkbox" class="w-4 h-4 text-primary focus:ring-primary/20 border-border rounded">
                    <span class="text-sm font-medium text-text-primary">Aktifkan FAQ</span>
                </label>
                <p class="mt-2 text-xs text-text-secondary">FAQ dengan status aktif akan ditampilkan di landing page.</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('admin.faqs.index') }}" wire:navigate class="flex-1 px-4 py-2.5 bg-white text-text-secondary text-sm font-medium rounded-xl border border-border hover:bg-surface transition-all duration-200 text-center">Batal</a>
                <button wire:click="save" wire:loading.attr="disabled" class="flex-1 px-4 py-2.5 bg-primary text-white text-sm font-semibold rounded-xl hover:bg-primary-dark transition-all duration-200 shadow-button disabled:opacity-60">
                    <span wire:loading.remove wire:target="save">{{ $isEditing ? 'Perbarui' : 'Simpan' }}</span>
                    <span wire:loading wire:target="save" class="flex items-center justify-center gap-2">
                        <svg class="animate-spin h-4 w-4" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg> Menyimpan...
                    </span>
                </button>
            </div>
        </div>
    </div>
</div>
