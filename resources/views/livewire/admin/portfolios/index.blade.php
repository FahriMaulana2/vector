<div class="space-y-6">

    {{-- Header --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>
            <h1 class="text-2xl font-bold text-slate-900">
                Portofolio
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Kelola portofolio dan hasil pekerjaan OMH Vector.
            </p>
        </div>

        <a
            href="{{ route('admin.portfolios.create') }}"
            wire:navigate
            class="inline-flex items-center justify-center rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-blue-700"
        >
            + Tambah Portofolio
        </a>

    </div>


    {{-- Flash message --}}
    @if (session()->has('success'))
        <div
            class="rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm font-medium text-green-700"
        >
            {{ session('success') }}
        </div>
    @endif


    {{-- Search --}}
    <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">

        <input
            type="text"
            wire:model.live.debounce.300ms="search"
            placeholder="Cari portofolio..."
            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
        >

    </div>


    {{-- Table --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

        <div class="overflow-x-auto">

            <table class="min-w-full divide-y divide-slate-200">

                <thead class="bg-slate-50">

                    <tr>

                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                            Portofolio
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                            Klien
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                            Tanggal
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                            Status
                        </th>

                        <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-slate-500">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-slate-100">

                    @forelse ($items as $item)

                        <tr class="transition hover:bg-slate-50">

                            {{-- Portfolio --}}
                            <td class="px-6 py-5">

                                <div class="flex items-center gap-4">

                                    <div class="h-16 w-20 flex-shrink-0 overflow-hidden rounded-xl bg-slate-100">

                                        @if ($item->image_url)

                                            <img
                                                src="{{ $item->image_url }}"
                                                alt="{{ $item->title }}"
                                                class="h-full w-full object-cover"
                                            >

                                        @else

                                            <div class="flex h-full w-full items-center justify-center text-xs text-slate-400">
                                                No Image
                                            </div>

                                        @endif

                                    </div>


                                    <div class="min-w-0">

                                        <h3 class="truncate font-semibold text-slate-900">
                                            {{ $item->title }}
                                        </h3>

                                        @if ($item->description)

                                            <p class="mt-1 max-w-md truncate text-sm text-slate-500">
                                                {{ $item->description }}
                                            </p>

                                        @endif

                                    </div>

                                </div>

                            </td>


                            {{-- Client --}}
                            <td class="px-6 py-5 text-sm text-slate-600">

                                {{ $item->client ?: '-' }}

                            </td>


                            {{-- Date --}}
                            <td class="px-6 py-5 text-sm text-slate-600">

                                {{ $item->project_date?->format('d M Y') ?? '-' }}

                            </td>


                            {{-- Status --}}
                            <td class="px-6 py-5">

                                <div class="flex flex-col gap-2">

                                    @if ($item->is_active)

                                        <span class="inline-flex w-fit rounded-full bg-green-50 px-3 py-1 text-xs font-semibold text-green-700">
                                            Aktif
                                        </span>

                                    @else

                                        <span class="inline-flex w-fit rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-600">
                                            Nonaktif
                                        </span>

                                    @endif


                                    @if ($item->is_featured)

                                        <span class="inline-flex w-fit rounded-full bg-yellow-50 px-3 py-1 text-xs font-semibold text-yellow-700">
                                            Featured
                                        </span>

                                    @endif

                                </div>

                            </td>


                            {{-- Actions --}}
                            <td class="px-6 py-5">

                                <div class="flex justify-end gap-2">

                                    <a
                                        href="{{ route('admin.portfolios.edit', $item) }}"
                                        wire:navigate
                                        class="rounded-lg px-3 py-2 text-sm font-semibold text-blue-600 transition hover:bg-blue-50"
                                    >
                                        Edit
                                    </a>


                                    <button
                                        type="button"
                                        wire:click="delete({{ $item->id }})"
                                        wire:confirm="Yakin ingin menghapus portofolio ini?"
                                        class="rounded-lg px-3 py-2 text-sm font-semibold text-red-600 transition hover:bg-red-50"
                                    >
                                        Hapus
                                    </button>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="5"
                                class="px-6 py-16 text-center"
                            >

                                <div class="text-slate-400">

                                    <p class="text-lg font-semibold">
                                        Belum ada portofolio
                                    </p>

                                    <p class="mt-1 text-sm">
                                        Tambahkan portofolio pertama kamu.
                                    </p>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- Pagination --}}
        @if ($items->hasPages())

            <div class="border-t border-slate-200 px-6 py-4">

                {{ $items->links() }}

            </div>

        @endif

    </div>

</div>