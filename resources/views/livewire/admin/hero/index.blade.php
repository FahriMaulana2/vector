<div>
    <!-- 1. PAGE HEADER -->
    <div class="mb-6">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-text-primary admin-heading">Hero Section</h1>
                <p class="text-text-secondary mt-1.5 text-sm">Kelola konten utama yang ditampilkan pada bagian hero halaman depan OMH Vector.</p>
            </div>
            <a href="{{ route('admin.hero.create') }}" wire:navigate
               class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary text-white text-sm font-semibold rounded-xl hover:bg-primary-dark transition-all duration-200 shadow-button hover:shadow-button-hover">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Hero
            </a>
        </div>
    </div>

    <!-- 2. CARD UTAMA -->
    <div class="bg-white rounded-2xl border border-border shadow-soft overflow-hidden">
        <!-- Card Header -->
        <div class="p-6 border-b border-border flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h2 class="text-lg font-semibold text-text-primary admin-heading">Daftar Hero Section</h2>
                <p class="text-sm text-text-secondary mt-1">Atur judul, deskripsi, gambar, tombol CTA, statistik, dan status tampilan utama website.</p>
            </div>

            <!-- SEARCH -->
            <div class="relative w-full sm:w-72">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input wire:model.live="search" type="text"
                       class="block w-full pl-10 pr-4 py-2.5 border border-border rounded-xl text-sm text-text-primary placeholder-text-secondary focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all bg-surface/50 focus:bg-white"
                       placeholder="Cari judul hero...">
            </div>
        </div>

        <!-- 3. DATA HERO (LIST/CARD) -->
        <div class="p-6">
            @forelse ($heroes as $hero)
                @php
                    $hasImage = $hero->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($hero->image);
                    $imageUrl = $hasImage ? \Illuminate\Support\Facades\Storage::url($hero->image) : null;
                    $statCount = $hero->statistics->count();
                @endphp
                <div class="group flex flex-col md:flex-row gap-5 p-4 md:p-5 rounded-2xl border border-border/70 hover:border-primary/20 hover:shadow-card transition-all duration-300 {{ $loop->first ? '' : 'mt-4' }}">
                    <!-- Thumbnail -->
                    <div class="flex-shrink-0">
                        @if($hasImage)
                            <img src="{{ $imageUrl }}" alt="{{ $hero->title }}"
                                 class="w-full md:w-[160px] h-44 md:h-[120px] object-cover rounded-xl border border-border shadow-soft" />
                        @else
                            <div class="w-full md:w-[160px] h-44 md:h-[120px] rounded-xl bg-surface border border-dashed border-border flex flex-col items-center justify-center gap-2">
                                <svg class="w-8 h-8 text-text-secondary/60" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <span class="text-xs font-medium text-text-secondary">Gambar Hero Belum Tersedia</span>
                            </div>
                        @endif
                    </div>

                    <!-- Content -->
                    <div class="flex-1 min-w-0">
                        <div class="flex flex-wrap items-start justify-between gap-3">
                            <div class="min-w-0">
                                <h3 class="text-base font-semibold text-text-primary admin-heading leading-snug">{{ $hero->title }}</h3>
                                <p class="text-sm text-text-secondary mt-1 line-clamp-2">{{ Str::limit($hero->description, 120) }}</p>
                            </div>
                            <!-- Status -->
                            @if($hero->is_active)
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-100 flex-shrink-0">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    Aktif
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold bg-slate-100 text-slate-600 border border-slate-200 flex-shrink-0">
                                    <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                                    Nonaktif
                                </span>
                            @endif
                        </div>

                        <!-- CTA -->
                        <div class="mt-3 flex flex-wrap items-center gap-2">
                            @if($hero->button_text)
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-medium bg-accent/10 text-accent-dark border border-accent/20">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l8 5-8 5M5 12h16"></path></svg>
                                    {{ $hero->button_text }}
                                </span>
                                @if($hero->button_link)
                                    <span class="text-xs text-text-secondary font-mono truncate max-w-[200px]" title="{{ $hero->button_link }}">{{ $hero->button_link }}</span>
                                @endif
                            @else
                                <span class="text-xs text-text-secondary italic">Tidak ada CTA</span>
                            @endif
                        </div>

                        <!-- Footer: statistik + aksi -->
                        <div class="mt-4 pt-4 border-t border-border/70 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                            <div class="flex items-center gap-2">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-sm font-medium bg-surface text-text-secondary">
                                    <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                                    {{ $statCount }} Statistik
                                </span>
                            </div>

                            <!-- Aksi -->
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.hero.edit', $hero->id) }}" wire:navigate
                                   class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-lg text-sm font-medium text-primary bg-primary/5 hover:bg-primary/10 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    Edit
                                </a>
                                <button wire:click="delete({{ $hero->id }})"
                                        wire:confirm.prompt="Apakah Anda yakin ingin menghapus hero ini?\n\nKetik DELETE untuk konfirmasi|DELETE"
                                        class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-lg text-sm font-medium text-red-600 bg-red-50 hover:bg-red-100 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    Hapus
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <!-- EMPTY STATE -->
                <div class="text-center py-16">
                    <div class="mx-auto w-16 h-16 bg-surface rounded-full flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <h3 class="text-lg font-semibold text-text-primary admin-heading mb-1">Belum Ada Hero Section</h3>
                    <p class="text-sm text-text-secondary max-w-sm mx-auto mb-6">Tambahkan konten hero untuk ditampilkan pada bagian utama halaman depan website.</p>
                    <a href="{{ route('admin.hero.create') }}" wire:navigate
                       class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary text-white text-sm font-semibold rounded-xl hover:bg-primary-dark transition-all duration-200 shadow-button hover:shadow-button-hover">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Tambah Hero
                    </a>
                </div>
            @endforelse
        </div>

        <!-- 4. PAGINATION -->
        @if ($heroes->hasPages())
            <div class="px-6 py-4 border-t border-border bg-surface/50">
                {{ $heroes->links() }}
            </div>
        @endif
    </div>
</div>
