<div>
    <div class="mb-6">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-text-primary admin-heading">Pertanyaan Umum (FAQ)</h1>
                <p class="text-text-secondary mt-1.5 text-sm">Kelola daftar pertanyaan umum.</p>
            </div>
            <a href="{{ route('admin.faqs.create') }}" wire:navigate class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary text-white text-sm font-semibold rounded-xl hover:bg-primary-dark transition-all duration-200 shadow-button hover:shadow-button-hover">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg> Tambah FAQ
            </a>
        </div>
    </div>
    <div class="bg-white rounded-2xl border border-border shadow-soft overflow-hidden">
        <div class="p-6">
            @if($items->isEmpty())
                <div class="text-center py-12">
                    <svg class="mx-auto h-16 w-16 text-border" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z"></path></svg>
                    <p class="mt-4 text-sm font-medium text-text-secondary">Belum ada FAQ</p>
                    <a href="{{ route('admin.faqs.create') }}" wire:navigate class="inline-flex items-center gap-2 mt-4 px-4 py-2 bg-primary text-white text-sm font-medium rounded-xl hover:bg-primary-dark transition-colors">Tambah FAQ</a>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b border-border">
                                <th class="text-left py-3.5 px-3 text-xs font-semibold text-text-secondary uppercase tracking-wider">Pertanyaan</th>
                                <th class="text-left py-3.5 px-3 text-xs font-semibold text-text-secondary uppercase tracking-wider">Urutan</th>
                                <th class="text-left py-3.5 px-3 text-xs font-semibold text-text-secondary uppercase tracking-wider">Status</th>
                                <th class="text-right py-3.5 px-3 text-xs font-semibold text-text-secondary uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                            <tr class="border-b border-border/50 hover:bg-surface/50 transition-colors">
                                <td class="py-4 px-3"><p class="font-medium text-text-primary">{{ $item->question }}</p></td>
                                <td class="py-4 px-3"><span class="text-sm text-text-secondary">{{ $item->order }}</span></td>
                                <td class="py-4 px-3">
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-medium rounded-lg {{ $item->is_active ? 'bg-emerald-100 text-emerald-700' : 'bg-gray-100 text-gray-600' }}">
                                        <span class="w-1.5 h-1.5 rounded-full {{ $item->is_active ? 'bg-emerald-500' : 'bg-gray-400' }}"></span>
                                        {{ $item->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </td>
                                <td class="py-4 px-3 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.faqs.edit', $item) }}" wire:navigate class="p-2 text-text-secondary hover:text-primary hover:bg-primary/5 rounded-lg"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg></a>
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
