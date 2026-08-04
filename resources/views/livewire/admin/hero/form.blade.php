<div class="space-y-6">
    <!-- 1. HEADER FORM -->
    <div>
        <nav class="flex text-sm text-slate-500 mb-2" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2">
                <li class="inline-flex items-center">
                    <a href="{{ route('admin.dashboard') }}" class="hover:text-[#0F2747] transition-colors">Admin</a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-3 h-3 text-slate-400 mx-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        <a href="{{ route('admin.hero.index') }}" class="hover:text-[#0F2747] transition-colors">Kelola Website</a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-3 h-3 text-slate-400 mx-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        <a href="{{ route('admin.hero.index') }}" class="hover:text-[#0F2747] transition-colors">Hero Section</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-3 h-3 text-slate-400 mx-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        <span class="font-medium text-[#0F2747]">{{ isset($hero) ? 'Edit Hero' : 'Tambah Hero' }}</span>
                    </div>
                </li>
            </ol>
        </nav>
        <h1 class="text-2xl font-bold text-[#182B3A]">{{ isset($hero) ? 'Edit Hero' : 'Tambah Hero' }}</h1>
        <p class="text-sm text-slate-500 mt-1">Tambah atau perbarui konten utama yang akan ditampilkan pada halaman depan OMH Vector.</p>
    </div>

    <!-- 2. LAYOUT FORM (2 Kolom Desktop, 1 Kolom Mobile) -->
    <form wire:submit="save" class="space-y-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <!-- 3. KOLOM KIRI (65-70%) -->
            <div class="lg:col-span-2 space-y-6">
                
                <!-- CARD 1: INFORMASI UTAMA -->
                <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6">
                    <h3 class="text-base font-semibold text-[#182B3A] mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-[#0F2747]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Informasi Utama
                    </h3>
                    <div class="space-y-4">
                        <div>
                            <label for="title" class="block text-sm font-medium text-slate-700 mb-1.5">Judul Hero <span class="text-red-500">*</span></label>
                            <input wire:model.live="title" type="text" id="title" 
                                   class="block w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm text-[#182B3A] placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#0F2747]/20 focus:border-[#0F2747] transition-all bg-slate-50/50 focus:bg-white @error('title') border-red-300 focus:ring-red-200 focus:border-red-400 @enderror" 
                                   placeholder="Contoh: Solusi Cetak & Branding Terpercaya">
                            @error('title') <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="description" class="block text-sm font-medium text-slate-700 mb-1.5">Deskripsi Hero</label>
                            <textarea wire:model.live="description" id="description" rows="4" 
                                      class="block w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm text-[#182B3A] placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#0F2747]/20 focus:border-[#0F2747] transition-all bg-slate-50/50 focus:bg-white resize-none @error('description') border-red-300 focus:ring-red-200 focus:border-red-400 @enderror" 
                                      placeholder="Jelaskan secara singkat nilai utama yang ditawarkan..."></textarea>
                            @error('description') <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <!-- CARD 2: CALL TO ACTION -->
                <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6">
                    <h3 class="text-base font-semibold text-[#182B3A] mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-[#0F2747]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"></path></svg>
                        Call To Action (CTA)
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="button_text" class="block text-sm font-medium text-slate-700 mb-1.5">Teks Tombol</label>
                            <input wire:model.live="button_text" type="text" id="button_text" 
                                   class="block w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm text-[#182B3A] placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#0F2747]/20 focus:border-[#0F2747] transition-all bg-slate-50/50 focus:bg-white" 
                                   placeholder="Contoh: Lihat Layanan">
                        </div>
                        <div>
                            <label for="button_link" class="block text-sm font-medium text-slate-700 mb-1.5">Link Tujuan</label>
                            <input wire:model.live="button_link" type="text" id="button_link" 
                                   class="block w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm text-[#182B3A] placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#0F2747]/20 focus:border-[#0F2747] transition-all bg-slate-50/50 focus:bg-white" 
                                   placeholder="Contoh: /services">
                        </div>
                    </div>
                </div>

                <!-- CARD 3: PENGATURAN TAMPILAN -->
                <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6">
                    <h3 class="text-base font-semibold text-[#182B3A] mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-[#0F2747]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        Pengaturan Tampilan
                    </h3>
                    <div class="flex items-center justify-between p-4 bg-slate-50 rounded-xl border border-slate-100">
                        <div>
                            <p class="text-sm font-medium text-[#182B3A]">Status Tampilan</p>
                            <p class="text-xs text-slate-500 mt-0.5">Aktifkan untuk menampilkan hero section di halaman depan.</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" wire:model.live="is_active" class="sr-only peer">
                            <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-[#0F2747]/20 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#0F2747]"></div>
                            <span class="ml-3 text-sm font-medium text-slate-700">{{ $is_active ? 'Aktif' : 'Nonaktif' }}</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- 4. KOLOM KANAN (30-35%) -->
            <div class="lg:col-span-1 space-y-6">
                <!-- CARD: GAMBAR HERO -->
                <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6 sticky top-6">
                    <h3 class="text-base font-semibold text-[#182B3A] mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-[#0F2747]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        Gambar Hero
                    </h3>
                    
                    <div class="space-y-4">
                        <!-- Preview Gambar -->
                        @if($image)
                            <div class="relative group rounded-xl overflow-hidden border border-slate-200 aspect-video">
                                <img src="{{ $image->temporaryUrl() }}" alt="Preview" class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                    <button type="button" wire:click="$set('image', null)" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded-lg text-xs font-medium flex items-center gap-1.5 transition-colors">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        Hapus
                                    </button>
                                </div>
                            </div>
                        @else
                            <!-- Area Upload -->
                            <label class="flex flex-col items-center justify-center w-full h-48 border-2 border-dashed border-slate-300 rounded-xl cursor-pointer bg-slate-50 hover:bg-slate-100 hover:border-[#0F2747]/40 transition-all group">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-8 h-8 mb-3 text-slate-400 group-hover:text-[#0F2747] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                    <p class="mb-1 text-sm text-slate-600 font-medium"><span class="text-[#0F2747]">Klik untuk memilih</span> atau tarik gambar</p>
                                    <p class="text-xs text-slate-400">PNG, JPG, atau WEBP (Maks. 2MB)</p>
                                </div>
                                <input wire:model.live="image" type="file" class="hidden" accept="image/png, image/jpeg, image/webp" />
                            </label>
                        @endif
                        
                        @error('image') 
                            <p class="text-xs text-red-600 flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                {{ $message }}
                            </p> 
                        @enderror

                        <!-- Loading Indicator Upload -->
                        <div wire:loading wire:target="image" class="flex items-center justify-center gap-2 text-sm text-[#0F2747]">
                            <svg class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Mengunggah gambar...
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 5. TOMBOL FORM -->
        <div class="flex flex-col sm:flex-row items-center justify-end gap-3 pt-4 border-t border-slate-200">
            <a href="{{ route('admin.hero.index') }}" class="w-full sm:w-auto px-6 py-2.5 border border-slate-300 rounded-xl text-sm font-semibold text-slate-700 bg-white hover:bg-slate-50 transition-colors text-center">
                Batal
            </a>
            <button type="submit" 
                    wire:loading.attr="disabled" 
                    wire:target="save"
                    class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-2.5 border border-transparent rounded-xl text-sm font-semibold text-white bg-[#0F2747] hover:bg-[#081A31] shadow-sm hover:shadow-md transition-all disabled:opacity-70 disabled:cursor-not-allowed">
                <svg wire:loading.remove wire:target="save" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                <svg wire:loading wire:target="save" class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span wire:loading.remove wire:target="save">{{ isset($hero) ? 'Simpan Perubahan' : 'Simpan Hero' }}</span>
                <span wire:loading wire:target="save">Menyimpan...</span>
            </button>
        </div>
    </form>
</div>

<style>
    /* Custom scrollbar untuk textarea agar lebih rapi */
    textarea::-webkit-scrollbar {
        width: 6px;
    }
    textarea::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 4px;
    }
    textarea::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 4px;
    }
    textarea::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
</style>