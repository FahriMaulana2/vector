<div>
    <div class="mb-6">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-text-primary admin-heading">FAQ</h1>
                <p class="text-text-secondary mt-1.5 text-sm">Kelola daftar Frequently Asked Questions (FAQ) OMH Vector.</p>
            </div>
            <a href="{{ route('admin.faqs.create') }}" wire:navigate class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary text-white text-sm font-semibold rounded-xl hover:bg-primary-dark transition-all duration-200 shadow-button hover:shadow-button-hover">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah FAQ
            </a>
        </div>
    </div>

    @if(session()->has('success'))
        <div class="mb-4 flex items-center gap-2 px-4 py-3 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm font-medium">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-4">
        <div class="relative max-w-md">
            <svg class="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-text-secondary/60" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari pertanyaan atau jawaban..." class="w-full pl-10 pr-4 py-2.5 border border-border rounded-xl text-sm bg-white focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all">
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-border shadow-soft overflow-hidden">
        <div class="p-6">
            @if($items->isEmpty())
                <div class="text-center py-12">
                    <svg class="mx-auto h-16 w-16 text-border" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <p class="mt-4 text-sm font-medium text-text-secondary">Belum ada FAQ</p>
                    <a href="{{ route('admin.faqs.create') }}" wire:navigate class="inline-flex items-center gap-2 mt-4 px-4 py-2 bg-primary text-white text-sm font-medium rounded-xl hover:bg-primary-dark transition-colors">Tambah FAQ</a>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b border-border">
                                <th class="text-left py-3.5 px-3 text-xs font-semibold text-text-secondary uppercase tracking-wider">Pertanyaan</th>
                                <th class="text-left py-3.5 px-3 text-xs font-semibold text-text-secondary uppercase tracking-wider">Jawaban</th>
                                <th class="text-left py-3.5 px-3 text-xs font-semibold text-text-secondary uppercase tracking-wider">Status</th>
                                <th class="text-left py-3.5 px-3 text-xs font-semibold text-text-secondary uppercase tracking-wider">Tanggal</th>
                                <th class="text-right py-3.5 px-3 text-xs font-semibold text-text-secondary uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                            <tr class="border-b border-border/50 hover:bg-surface/50 transition-colors">
                                <td class="py-4 px-3"><p class="font-medium text-text-primary max-w-xs truncate">{{ $item->question }}</p></td>
                                <td class="py-4 px-3"><p class="text-xs text-text-secondary line-clamp-2 max-w-md">{{ $item->answer }}</p></td>
                                <td class="py-4 px-3">
                                    <button wire:click="toggleActive({{ $item->id }})" wire:confirm="Ubah status FAQ ini?" class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-medium rounded-lg transition-colors {{ $item->is_active ? 'bg-emerald-100 text-emerald-700 hover:bg-emerald-200' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                                        <span class="w-1.5 h-1.5 rounded-full {{ $item->is_active ? 'bg-emerald-500' : 'bg-gray-400' }}"></span>
                                        {{ $item->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </button>
                                </td>
                                <td class="py-4 px-3 text-xs text-text-secondary">{{ $item->created_at->format('d M Y') }}</td>
                                <td class="py-4 px-3 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.faqs.edit', $item) }}" wire:navigate class="p-2 text-text-secondary hover:text-primary hover:bg-primary/5 rounded-lg"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg></a>
                                        <button wire:click="delete({{ $item->id }})" wire:confirm="Yakin ingin menghapus FAQ ini?" class="p-2 text-text-secondary hover:text-red-500 hover:bg-red-50 rounded-lg"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">{{ $items->links() }}</div>
            @endif
        </div>
    </div>
</div>
