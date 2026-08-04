<div>
    <div class="mb-6">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-text-primary admin-heading">Testimoni</h1>
                <p class="text-text-secondary mt-1.5 text-sm">Kelola testimoni pelanggan.</p>
            </div>
            <a href="{{ route('admin.testimonials.create') }}" wire:navigate class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary text-white text-sm font-semibold rounded-xl hover:bg-primary-dark transition-all duration-200 shadow-button hover:shadow-button-hover">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg> Tambah Testimoni
            </a>
        </div>
    </div>
    <div class="bg-white rounded-2xl border border-border shadow-soft overflow-hidden">
        <div class="p-6">
            @if($items->isEmpty())
                <div class="text-center py-12">
                    <svg class="mx-auto h-16 w-16 text-border" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                    <p class="mt-4 text-sm font-medium text-text-secondary">Belum ada testimoni</p>
                    <a href="{{ route('admin.testimonials.create') }}" wire:navigate class="inline-flex items-center gap-2 mt-4 px-4 py-2 bg-primary text-white text-sm font-medium rounded-xl hover:bg-primary-dark transition-colors">Tambah</a>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b border-border">
                                <th class="text-left py-3.5 px-3 text-xs font-semibold text-text-secondary uppercase tracking-wider">Nama</th>
                                <th class="text-left py-3.5 px-3 text-xs font-semibold text-text-secondary uppercase tracking-wider">Rating</th>
                                <th class="text-left py-3.5 px-3 text-xs font-semibold text-text-secondary uppercase tracking-wider">Featured</th>
                                <th class="text-left py-3.5 px-3 text-xs font-semibold text-text-secondary uppercase tracking-wider">Status</th>
                                <th class="text-right py-3.5 px-3 text-xs font-semibold text-text-secondary uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                            <tr class="border-b border-border/50 hover:bg-surface/50 transition-colors">
                                <td class="py-4 px-3"><p class="font-medium text-text-primary">{{ $item->name }}</p></td>
                                <td class="py-4 px-3"><span class="text-yellow-500 text-sm">{{ str_repeat('★', $item->rating) }}{{ str_repeat('☆', 5-$item->rating) }}</span></td>
                                <td class="py-4 px-3">
                                    @if($item->is_featured)
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-medium rounded-lg bg-yellow-100 text-yellow-700 border border-yellow-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-yellow-500"></span> Featured
                                        </span>
                                    @else
                                        <span class="text-xs text-text-secondary/50">Tidak</span>
                                    @endif
                                </td>
                                <td class="py-4 px-3">
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-medium rounded-lg {{ $item->is_active ? 'bg-emerald-100 text-emerald-700' : 'bg-gray-100 text-gray-600' }}">
                                        <span class="w-1.5 h-1.5 rounded-full {{ $item->is_active ? 'bg-emerald-500' : 'bg-gray-400' }}"></span>
                                        {{ $item->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </td>
                                <td class="py-4 px-3 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.testimonials.edit', $item) }}" wire:navigate class="p-2 text-text-secondary hover:text-primary hover:bg-primary/5 rounded-lg"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg></a>
                                        <button wire:click="delete({{ $item->id }})" wire:confirm="Yakin?" class="p-2 text-text-secondary hover:text-red-500 hover:bg-red-50 rounded-lg"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></button>
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
