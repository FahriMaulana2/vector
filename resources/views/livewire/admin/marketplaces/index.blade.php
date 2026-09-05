<div>
    {{-- Header Section --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-800 tracking-tight">Kelola Marketplace</h1>
            <p class="text-sm text-slate-500 mt-1">Kelola toko marketplace official (Shopee, Tokopedia, TikTok Shop, dll) dan status operasionalnya.</p>
        </div>
        <div>
            <a href="{{ route('admin.marketplaces.create') }}" wire:navigate class="inline-flex items-center gap-2 px-4 py-2.5 bg-[#173B6C] hover:bg-[#1E4F91] text-white font-medium text-sm rounded-xl transition-all shadow-sm shadow-[#173B6C]/20 cursor-pointer">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                <span>Tambah Marketplace</span>
            </a>
        </div>
    </div>

    {{-- Flash Message --}}
    @if (session()->has('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
             class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl flex items-center justify-between shadow-sm">
            <div class="flex items-center gap-3">
                <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="text-sm font-medium">{{ session('success') }}</span>
            </div>
            <button @click="show = false" class="text-emerald-500 hover:text-emerald-700">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    @endif

    {{-- Filter & Search Bar --}}
    <div class="bg-white rounded-2xl p-4 border border-slate-200/80 shadow-sm mb-6 flex flex-col sm:flex-row items-center justify-between gap-4">
        <div class="relative w-full sm:w-80">
            <input type="text" 
                   wire:model.live.debounce.300ms="search" 
                   placeholder="Cari toko atau platform..." 
                   class="w-full pl-10 pr-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#173B6C]/20 focus:border-[#173B6C]">
            <svg class="w-4 h-4 text-slate-400 absolute left-3.5 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </div>
        <div class="flex items-center gap-3 w-full sm:w-auto">
            <select wire:model.live="statusFilter" class="w-full sm:w-auto text-sm bg-slate-50 border border-slate-200 rounded-xl px-3 py-2.5 text-slate-600 focus:outline-none focus:ring-2 focus:ring-[#173B6C]/20">
                <option value="">Semua Status</option>
                <option value="active">Aktif</option>
                <option value="maintenance">Maintenance</option>
            </select>
        </div>
    </div>

    {{-- Table List --}}
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/80 border-b border-slate-200/80 text-xs font-semibold text-slate-500 uppercase tracking-wider">
                        <th class="px-6 py-4">Logo & Toko</th>
                        <th class="px-6 py-4">Platform</th>
                        <th class="px-6 py-4">Urutan</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse($marketplaces as $item)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl border border-slate-200 bg-slate-50 flex items-center justify-center overflow-hidden flex-shrink-0">
                                        @if($item->logo_url)
                                            <img src="{{ asset('storage/'.$item->logo_url) }}" alt="{{ $item->store_name }}" class="w-full h-full object-cover">
                                        @else
                                            <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                            </svg>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="font-semibold text-slate-800">{{ $item->store_name }}</p>
                                        @if($item->store_url)
                                            <a href="{{ $item->store_url }}" target="_blank" class="text-xs text-blue-600 hover:underline inline-flex items-center gap-1">
                                                <span>{{ Str::limit($item->store_url, 30) }}</span>
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                                </svg>
                                            </a>
                                        @else
                                            <span class="text-xs text-slate-400 italic">URL tidak diisi</span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold bg-slate-100 text-slate-700 uppercase tracking-wider border border-slate-200">
                                    {{ $availablePlatforms[$item->platform] ?? $item->platform }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-xs font-mono bg-slate-100 text-slate-600 px-2 py-1 rounded-md">
                                    {{ $item->display_order }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <button type="button" 
                                        wire:click="toggleStatus({{ $item->id }})"
                                        class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-medium transition-all cursor-pointer border {{ $item->is_active ? 'bg-emerald-50 text-emerald-700 border-emerald-200 hover:bg-emerald-100' : 'bg-amber-50 text-amber-700 border-amber-200 hover:bg-amber-100' }}">
                                    <span class="w-2 h-2 rounded-full {{ $item->is_active ? 'bg-emerald-500' : 'bg-amber-500' }}"></span>
                                    <span>{{ $item->is_active ? 'Aktif' : 'Maintenance' }}</span>
                                </button>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.marketplaces.edit', $item) }}" wire:navigate
                                            class="p-2 text-slate-500 hover:text-[#173B6C] hover:bg-slate-100 rounded-lg transition-colors cursor-pointer"
                                            title="Edit Marketplace">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </a>
                                    <button wire:click="confirmDelete({{ $item->id }})" 
                                            class="p-2 text-slate-500 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors cursor-pointer"
                                            title="Hapus Marketplace">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-slate-400">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-12 h-12 text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                    </svg>
                                    <p class="text-sm font-medium">Belum ada marketplace terdaftar.</p>
                                    <p class="text-xs text-slate-400 mt-1">Klik tombol "Tambah Marketplace" untuk mulai menambahkan toko.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Delete Confirmation Modal --}}
    @if($showDeleteModal)
    <div class="fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="fixed inset-0 bg-black/50 backdrop-blur-sm" wire:click="closeDeleteModal"></div>
        <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-md p-6 z-10">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-slate-800">Hapus Marketplace</h3>
                    <p class="text-sm text-slate-500">Tindakan ini tidak dapat dibatalkan.</p>
                </div>
            </div>

            <div class="mb-6 p-4 bg-red-50 border border-red-100 rounded-xl">
                <p class="text-sm text-slate-700">
                    Apakah Anda yakin ingin menghapus marketplace <strong class="text-red-600">{{ $deletingStoreName }}</strong>?
                </p>
                @if($deletingCampaignCount > 0)
                    <p class="text-xs text-red-600 mt-2 font-medium">
                        ⚠️ Marketplace ini memiliki {{ $deletingCampaignCount }} popup campaign terkait yang juga akan terpengaruh.
                    </p>
                @endif
            </div>

            <div class="flex items-center justify-end gap-3">
                <button type="button" wire:click="closeDeleteModal" class="px-4 py-2 text-sm font-medium text-slate-600 hover:text-slate-800 rounded-xl transition-colors">
                    Batal
                </button>
                <button type="button" wire:click="delete" class="px-5 py-2 text-sm font-medium bg-red-600 hover:bg-red-700 text-white rounded-xl shadow-sm transition-all">
                    Ya, Hapus
                </button>
            </div>
        </div>
    </div>
    @endif
</div>