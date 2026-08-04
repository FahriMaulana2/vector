<div class="space-y-6">
    <!-- 1. PAGE HEADER -->
    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
        <div>
            <nav class="flex text-sm text-slate-500 mb-2" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2">
                    <li class="inline-flex items-center">
                        <a href="{{ route('admin.dashboard') }}" class="hover:text-[#0F2747] transition-colors">Admin</a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-3 h-3 text-slate-400 mx-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            <span class="text-slate-400">Kelola Website</span>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-3 h-3 text-slate-400 mx-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            <span class="font-medium text-[#0F2747]">Hero Section</span>
                        </div>
                    </li>
                </ol>
            </nav>
            <h1 class="text-2xl font-bold text-[#182B3A]">Hero Section</h1>
            <p class="text-sm text-slate-500 mt-1">Kelola konten utama yang ditampilkan pada bagian hero halaman depan OMH Vector.</p>
        </div>
        
        <a href="{{ route('admin.hero.create') }}" class="inline-flex items-center gap-2 bg-[#0F2747] hover:bg-[#081A31] text-white px-5 py-2.5 rounded-xl text-sm font-semibold shadow-sm hover:shadow-md transition-all duration-200">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah Hero
        </a>
    </div>

    <!-- 2. CARD UTAMA -->
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
        <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h2 class="text-lg font-semibold text-[#182B3A]">Daftar Hero Section</h2>
                <p class="text-sm text-slate-500 mt-1">Atur judul, deskripsi, gambar, tombol CTA, statistik, dan status tampilan utama website.</p>
            </div>
            
            <!-- 3. SEARCH -->
            <div class="relative w-full sm:w-72">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input wire:model.live="search" type="text" 
                       class="block w-full pl-10 pr-4 py-2.5 border border-slate-200 rounded-xl text-sm text-[#182B3A] placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#0F2747]/20 focus:border-[#0F2747] transition-all bg-slate-50/50 focus:bg-white" 
                       placeholder="Cari judul hero...">
            </div>
        </div>

        <!-- 4. DATA HERO -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/80 border-b border-slate-200 text-xs font-semibold text-slate-500 uppercase tracking-wider">
                        <th class="px-6 py-4">Konten Hero</th>
                        <th class="px-6 py-4">CTA</th>
                        <th class="px-6 py-4 text-center">Statistik</th>
                        <th class="px-6 py-4 text-center">Status</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($heroes as $hero)
                        <tr class="hover:bg-slate-50/50 transition-colors group">
                            <!-- Konten -->
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    <img src="{{ $hero->image ? Storage::url($hero->image) : 'https://placehold.co/72x52/e2e8f0/64748b?text=No+Image' }}" 
                                         alt="Hero Thumbnail" 
                                         class="w-[72px] h-[52px] rounded-lg object-cover border border-slate-200 shadow-sm flex-shrink-0">
                                    <div class="min-w-0">
                                        <p class="font-semibold text-[#182B3A] truncate">{{ $hero->title }}</p>
                                        <p class="text-sm text-slate-500 line-clamp-2 mt-0.5">{{ Str::limit($hero->description, 70) }}</p>
                                    </div>
                                </div>
                            </td>
                            
                            <!-- CTA -->
                            <td class="px-6 py-4">
                                @if($hero->button_text)
                                    <div class="flex flex-col gap-1">
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-[#F4B942]/10 text-[#926B12] border border-[#F4B942]/20 w-fit">
                                            {{ $hero->button_text }}
                                        </span>
                                        @if($hero->button_link)
                                            <span class="text-xs text-slate-400 truncate max-w-[150px]" title="{{ $hero->button_link }}">
                                                {{ $hero->button_link }}
                                            </span>
                                        @endif
                                    </div>
                                @else
                                    <span class="text-sm text-slate-400 italic">Tidak ada</span>
                                @endif
                            </td>
                            
                            <!-- Statistik -->
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-sm font-medium bg-slate-100 text-slate-700">
                                    <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                                    {{ $hero->statistics->count() }} Statistik
                                </span>
                            </td>
                            
                            <!-- Status -->
                            <td class="px-6 py-4 text-center">
                                @if($hero->is_active)
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold bg-green-50 text-green-700 border border-green-100">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                        Aktif
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold bg-slate-100 text-slate-600 border border-slate-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                                        Nonaktif
                                    </span>
                                @endif
                            </td>
                            
                            <!-- Aksi -->
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2 opacity-80 group-hover:opacity-100 transition-opacity">
                                    <a href="{{ route('admin.hero.edit', $hero->id) }}" 
                                       class="p-2 rounded-lg text-slate-500 hover:text-[#0F2747] hover:bg-[#0F2747]/5 transition-colors" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </a>
                                    <button wire:click="delete({{ $hero->id }})" 
                                            wire:confirm.prompt="Apakah Anda yakin ingin menghapus hero ini?\n\nKetik DELETE untuk konfirmasi|DELETE"
                                            class="p-2 rounded-lg text-slate-500 hover:text-red-600 hover:bg-red-50 transition-colors" title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <!-- 5. EMPTY STATE -->
                        <tr>
                            <td colspan="5" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mb-4">
                                        <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                    <h3 class="text-lg font-semibold text-[#182B3A] mb-1">Belum Ada Hero Section</h3>
                                    <p class="text-sm text-slate-500 max-w-sm mb-6">Tambahkan konten hero untuk ditampilkan pada bagian utama halaman depan website.</p>
                                    <a href="{{ route('admin.hero.create') }}" class="inline-flex items-center gap-2 bg-[#0F2747] hover:bg-[#081A31] text-white px-5 py-2.5 rounded-xl text-sm font-semibold shadow-sm hover:shadow-md transition-all duration-200">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                        Tambah Hero
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- 6. PAGINATION -->
        @if ($heroes->hasPages())
            <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50">
                {{ $heroes->links() }}
            </div>
        @endif
    </div>
</div>