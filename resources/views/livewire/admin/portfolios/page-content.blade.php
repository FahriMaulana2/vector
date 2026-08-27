<div class="space-y-6">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <nav class="mb-2 flex text-sm text-slate-500" aria-label="Breadcrumb">
                <ol class="inline-flex items-center gap-2">
                    <li><a href="{{ route('admin.dashboard') }}" class="transition-colors hover:text-[#0F2747]">Admin</a></li>
                    <li class="text-slate-400">/</li>
                    <li class="font-medium text-[#0F2747]" aria-current="page">Halaman Portfolio</li>
                </ol>
            </nav>
            <h1 class="text-2xl font-bold text-[#182B3A]">Halaman Portfolio</h1>
            <p class="mt-1 text-sm text-slate-500">Kelola teks dan konten halaman /portfolio.</p>
        </div>
        <button type="submit" form="portfolio-page-content-form" wire:loading.attr="disabled" class="inline-flex items-center justify-center rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 disabled:cursor-wait disabled:opacity-60">
            <span wire:loading.remove wire:target="save">Simpan Perubahan</span>
            <span wire:loading wire:target="save">Menyimpan...</span>
        </button>
    </div>

    @if(session('success'))
        <div class="flex items-center gap-2 rounded-xl border border-green-200 bg-green-50 p-4 text-sm text-green-700">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('success') }}
        </div>
    @endif

    <form id="portfolio-page-content-form" wire:submit="save" class="space-y-6">
        <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="mb-5">
                <h2 class="text-base font-semibold text-[#182B3A]">Hero Section</h2>
                <p class="mt-1 text-sm text-slate-500">Teks pembuka yang tampil di bagian atas halaman portfolio.</p>
            </div>
            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                <div>
                    <label for="hero_badge_text" class="mb-1.5 block text-sm font-medium text-slate-700">Teks Badge <span class="text-red-500">*</span></label>
                    <input id="hero_badge_text" wire:model="hero_badge_text" type="text" class="admin-content-input @error('hero_badge_text') border-red-300 @enderror">
                    @error('hero_badge_text')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="hero_title_line1" class="mb-1.5 block text-sm font-medium text-slate-700">Judul Baris Pertama <span class="text-red-500">*</span></label>
                    <input id="hero_title_line1" wire:model="hero_title_line1" type="text" class="admin-content-input @error('hero_title_line1') border-red-300 @enderror">
                    @error('hero_title_line1')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>
                <div class="md:col-span-2">
                    <label for="hero_title_line2" class="mb-1.5 block text-sm font-medium text-slate-700">Judul Baris Gold <span class="text-red-500">*</span></label>
                    <input id="hero_title_line2" wire:model="hero_title_line2" type="text" class="admin-content-input @error('hero_title_line2') border-red-300 @enderror">
                    @error('hero_title_line2')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>
                <div class="md:col-span-2">
                    <label for="hero_description" class="mb-1.5 block text-sm font-medium text-slate-700">Deskripsi Hero <span class="text-red-500">*</span></label>
                    <textarea id="hero_description" wire:model="hero_description" rows="4" class="admin-content-input resize-none @error('hero_description') border-red-300 @enderror"></textarea>
                    @error('hero_description')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>
            </div>
        </section>

        <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="mb-5">
                <h2 class="text-base font-semibold text-[#182B3A]">Quote Section</h2>
                <p class="mt-1 text-sm text-slate-500">Pesan utama dan penjelasan singkat di bawah grid portfolio.</p>
            </div>
            <div class="space-y-5">
                <div>
                    <label for="quote_text" class="mb-1.5 block text-sm font-medium text-slate-700">Teks Kutipan <span class="text-red-500">*</span></label>
                    <textarea id="quote_text" wire:model="quote_text" rows="3" class="admin-content-input resize-none @error('quote_text') border-red-300 @enderror"></textarea>
                    @error('quote_text')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="quote_description" class="mb-1.5 block text-sm font-medium text-slate-700">Deskripsi Quote <span class="text-red-500">*</span></label>
                    <textarea id="quote_description" wire:model="quote_description" rows="3" class="admin-content-input resize-none @error('quote_description') border-red-300 @enderror"></textarea>
                    @error('quote_description')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>
            </div>
        </section>

        <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="mb-5">
                <h2 class="text-base font-semibold text-[#182B3A]">CTA Section</h2>
                <p class="mt-1 text-sm text-slate-500">Ajakan konsultasi yang tampil di bagian bawah halaman.</p>
            </div>
            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                <div class="md:col-span-2">
                    <label for="cta_title" class="mb-1.5 block text-sm font-medium text-slate-700">Judul CTA <span class="text-red-500">*</span></label>
                    <input id="cta_title" wire:model="cta_title" type="text" class="admin-content-input @error('cta_title') border-red-300 @enderror">
                    @error('cta_title')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>
                <div class="md:col-span-2">
                    <label for="cta_description" class="mb-1.5 block text-sm font-medium text-slate-700">Deskripsi CTA <span class="text-red-500">*</span></label>
                    <textarea id="cta_description" wire:model="cta_description" rows="3" class="admin-content-input resize-none @error('cta_description') border-red-300 @enderror"></textarea>
                    @error('cta_description')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="cta_button_primary_text" class="mb-1.5 block text-sm font-medium text-slate-700">Tombol Utama <span class="text-red-500">*</span></label>
                    <input id="cta_button_primary_text" wire:model="cta_button_primary_text" type="text" class="admin-content-input @error('cta_button_primary_text') border-red-300 @enderror">
                    @error('cta_button_primary_text')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="cta_button_secondary_text" class="mb-1.5 block text-sm font-medium text-slate-700">Tombol Sekunder <span class="text-red-500">*</span></label>
                    <input id="cta_button_secondary_text" wire:model="cta_button_secondary_text" type="text" class="admin-content-input @error('cta_button_secondary_text') border-red-300 @enderror">
                    @error('cta_button_secondary_text')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>
            </div>
        </section>
    </form>

    <style>
        .admin-content-input {
            display: block;
            width: 100%;
            border: 1px solid #e2e8f0;
            border-radius: 0.75rem;
            background: rgb(248 250 252 / 0.5);
            padding: 0.625rem 1rem;
            font-size: 0.875rem;
            color: #182b3a;
            outline: none;
            transition: all 150ms ease;
        }
        .admin-content-input:focus {
            border-color: #0f2747;
            background: white;
            box-shadow: 0 0 0 3px rgb(15 39 71 / 0.12);
        }
    </style>
</div>
