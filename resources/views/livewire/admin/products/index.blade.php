<div>
    {{-- Header --}}
    <div class="mb-6">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-text-primary admin-heading">
                    Produk
                </h1>

                <p class="text-text-secondary mt-1.5 text-sm">
                    Kelola daftar produk OMH Vector.
                </p>
            </div>

            <a
                href="{{ route('admin.products.create') }}"
                wire:navigate
                class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary text-white text-sm font-semibold rounded-xl hover:bg-primary-dark transition-all duration-200 shadow-button hover:shadow-button-hover"
            >
                <svg
                    class="w-4 h-4"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 4v16m8-8H4"
                    />
                </svg>

                Tambah Produk
            </a>
        </div>
    </div>

    {{-- Product Table --}}
    <div class="bg-white rounded-2xl border border-border shadow-soft overflow-hidden">
        <div class="p-6">

            {{-- Empty State --}}
            @if($items->isEmpty())

                <div class="text-center py-12">

                    <svg
                        class="mx-auto h-16 w-16 text-border"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.5"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"
                        />
                    </svg>

                    <p class="mt-4 text-sm font-medium text-text-secondary">
                        Belum ada produk
                    </p>

                    <a
                        href="{{ route('admin.products.create') }}"
                        wire:navigate
                        class="inline-flex items-center gap-2 mt-4 px-4 py-2 bg-primary text-white text-sm font-medium rounded-xl hover:bg-primary-dark transition-colors"
                    >
                        Tambah Produk
                    </a>

                </div>

            @else

                <div class="overflow-x-auto">

                    <table class="w-full text-sm">

                        {{-- Table Header --}}
                        <thead>
                            <tr class="border-b border-border">

                                <th class="text-left py-3.5 px-3 text-xs font-semibold text-text-secondary uppercase tracking-wider">
                                    Produk
                                </th>

                                <th class="text-left py-3.5 px-3 text-xs font-semibold text-text-secondary uppercase tracking-wider">
                                    Status
                                </th>

                                <th class="text-right py-3.5 px-3 text-xs font-semibold text-text-secondary uppercase tracking-wider">
                                    Aksi
                                </th>

                            </tr>
                        </thead>

                        {{-- Table Body --}}
                        <tbody>

                            @foreach($items as $item)

                                <tr class="border-b border-border/50 hover:bg-surface/50 transition-colors">

                                    {{-- Product --}}
                                    <td class="py-4 px-3">

                                        <div class="flex items-center gap-3">

                                            {{-- Product Image --}}
                                            @if($item->image)

                                                <img
                                                    src="{{ asset('storage/' . $item->image) }}"
                                                    alt="{{ $item->name }}"
                                                    class="w-12 h-12 rounded-lg object-cover border border-border"
                                                >

                                            @else

                                                <div class="w-12 h-12 rounded-lg bg-surface flex items-center justify-center">

                                                    <svg
                                                        class="w-5 h-5 text-text-secondary"
                                                        fill="none"
                                                        stroke="currentColor"
                                                        viewBox="0 0 24 24"
                                                    >
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"
                                                        />
                                                    </svg>

                                                </div>

                                            @endif

                                            {{-- Product Information --}}
                                            <div class="min-w-0">

                                                <div class="flex items-center gap-2 flex-wrap">

                                                    <p class="font-medium text-text-primary">
                                                        {{ $item->name }}
                                                    </p>

                                                    {{-- Badge --}}
                                                    @if($item->badge)

                                                        <span class="px-1.5 py-0.5 text-[10px] font-medium rounded bg-yellow-100 text-yellow-700">
                                                            {{ $item->badge }}
                                                        </span>

                                                    @endif

                                                </div>

                                                {{-- Short Description --}}
                                                @if($item->short_description)

                                                    <p class="mt-1 text-xs text-text-secondary truncate max-w-md">
                                                        {{ $item->short_description }}
                                                    </p>

                                                @endif

                                            </div>

                                        </div>

                                    </td>

                                    {{-- Status --}}
                                    <td class="py-4 px-3">

                                        @if($item->is_active)

                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 text-xs font-medium rounded-lg bg-emerald-100 text-emerald-700">

                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>

                                                Aktif

                                            </span>

                                        @else

                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 text-xs font-medium rounded-lg bg-gray-100 text-gray-600">

                                                <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span>

                                                Nonaktif

                                            </span>

                                        @endif

                                    </td>

                                    {{-- Actions --}}
                                    <td class="py-4 px-3 text-right">

                                        <div class="flex items-center justify-end gap-2">

                                            {{-- Edit --}}
                                            <a
                                                href="{{ route('admin.products.edit', $item) }}"
                                                wire:navigate
                                                title="Edit produk"
                                                class="p-2 text-text-secondary hover:text-primary hover:bg-primary/5 rounded-lg transition-colors"
                                            >

                                                <svg
                                                    class="w-4 h-4"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    viewBox="0 0 24 24"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
                                                    />
                                                </svg>

                                            </a>

                                            {{-- Delete --}}
                                            <button
                                                type="button"
                                                wire:click="delete({{ $item->id }})"
                                                wire:confirm="Yakin ingin menghapus produk ini?"
                                                title="Hapus produk"
                                                class="p-2 text-text-secondary hover:text-red-500 hover:bg-red-50 rounded-lg transition-colors"
                                            >

                                                <svg
                                                    class="w-4 h-4"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    viewBox="0 0 24 24"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                                                    />
                                                </svg>

                                            </button>

                                        </div>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

                {{-- Pagination --}}
                <div class="mt-4">
                    {{ $items->links() }}
                </div>

            @endif

        </div>
    </div>
</div>