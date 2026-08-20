<div>
    {{-- =========================================================
        HEADER
    ========================================================== --}}
    <div class="mb-6">
        <div class="flex items-center justify-between flex-wrap gap-4">

            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-text-primary admin-heading">
                    {{ $isEditing ? 'Edit' : 'Tambah' }} Langkah Alur Kerja
                </h1>

                <p class="text-text-secondary mt-1.5 text-sm">
                    Kelola langkah alur kerja.
                </p>
            </div>

            <a
                href="{{ route('admin.workflow.index') }}"
                wire:navigate
                class="inline-flex items-center gap-2 px-4 py-2.5 bg-white text-text-secondary text-sm font-medium rounded-xl border border-border hover:bg-surface transition-all duration-200"
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
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"
                    />
                </svg>

                Kembali
            </a>

        </div>
    </div>


    {{-- =========================================================
        FORM
    ========================================================== --}}
    <div class="max-w-2xl">

        <div class="bg-white rounded-2xl border border-border shadow-soft p-6">

            <div class="space-y-4">

                {{-- Nomor Langkah --}}
                <div>
                    <label class="block text-sm font-medium text-text-primary mb-1.5">
                        Nomor Langkah
                        <span class="text-red-500">*</span>
                    </label>

                    <input
                        wire:model="step_number"
                        type="number"
                        min="1"
                        class="w-full px-4 py-2.5 border border-border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all"
                        placeholder="1"
                    >

                    @error('step_number')
                        <p class="mt-1 text-xs text-red-500">
                            {{ $message }}
                        </p>
                    @enderror
                </div>


                {{-- Judul --}}
                <div>
                    <label class="block text-sm font-medium text-text-primary mb-1.5">
                        Judul
                        <span class="text-red-500">*</span>
                    </label>

                    <input
                        wire:model="title"
                        type="text"
                        class="w-full px-4 py-2.5 border border-border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all"
                        placeholder="Judul langkah"
                    >

                    @error('title')
                        <p class="mt-1 text-xs text-red-500">
                            {{ $message }}
                        </p>
                    @enderror
                </div>


                {{-- Deskripsi --}}
                <div>
                    <label class="block text-sm font-medium text-text-primary mb-1.5">
                        Deskripsi
                    </label>

                    <textarea
                        wire:model="description"
                        rows="4"
                        class="w-full px-4 py-2.5 border border-border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all resize-none"
                        placeholder="Deskripsi langkah"
                    ></textarea>

                    @error('description')
                        <p class="mt-1 text-xs text-red-500">
                            {{ $message }}
                        </p>
                    @enderror
                </div>


                {{-- Urutan --}}
                <div>
                    <label class="block text-sm font-medium text-text-primary mb-1.5">
                        Urutan
                    </label>

                    <input
                        wire:model="sort_order"
                        type="number"
                        min="0"
                        class="w-full px-4 py-2.5 border border-border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all"
                        placeholder="0"
                    >

                    @error('sort_order')
                        <p class="mt-1 text-xs text-red-500">
                            {{ $message }}
                        </p>
                    @enderror
                </div>


                {{-- =====================================================
                    ICON
                ====================================================== --}}
                <div>

                    <label class="block text-sm font-medium text-text-primary mb-1.5">
                        Icon
                    </label>

                    <p class="text-xs text-text-secondary mb-2">
                        Pilih ikon untuk langkah ini.
                    </p>


                    {{-- Selected Icon Preview --}}
                    <div class="flex items-center justify-between gap-4 mb-3">

                        <div class="flex items-center gap-3">

                            {{-- Preview --}}
                            <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-white border border-border text-navy">

                                @if(isset($icons[$icon]))

                                    <svg
                                        class="w-6 h-6"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="1.5"
                                        aria-hidden="true"
                                    >
                                        {!! $icons[$icon]['svg'] !!}
                                    </svg>

                                @else

                                    <svg
                                        class="w-6 h-6"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="1.5"
                                        aria-hidden="true"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"
                                        />
                                    </svg>

                                @endif

                            </div>


                            {{-- Icon Information --}}
                            <div>

                                <div class="text-sm font-medium text-text-primary">
                                    {{ $icons[$icon]['name'] ?? 'Chat Bubble' }}
                                </div>

                                <div class="text-xs text-text-secondary">
                                    Heroicons
                                </div>

                            </div>

                        </div>


                        {{-- Button --}}
                        <button
                            type="button"
                            wire:click="openIconPicker"
                            class="px-3 py-2 bg-white border border-border rounded-xl text-sm hover:bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all"
                        >
                            Ganti Icon
                        </button>

                    </div>


                    {{-- =================================================
                        ICON PICKER MODAL
                    ================================================== --}}
                    @if($iconPickerOpen)

                        <div
                            class="fixed inset-0 z-[9999] flex items-center justify-center p-4"
                            wire:key="icon-picker-modal"
                        >

                            {{-- Backdrop --}}
                            <div
                                class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm"
                                wire:click="closeIconPicker"
                            ></div>


                            {{-- Modal --}}
                            <div
                                class="relative w-full max-w-4xl max-h-[85vh] mx-3 sm:mx-0 rounded-2xl bg-white shadow-2xl border border-border overflow-hidden flex flex-col"
                                role="dialog"
                                aria-modal="true"
                                aria-label="Pilih Icon"
                            >

                                {{-- =============================
                                    MODAL HEADER
                                ============================== --}}
                                <div class="flex items-start justify-between px-5 py-4 border-b border-border">

                                    <div>
                                        <h2 class="text-sm font-semibold text-text-primary">
                                            Pilih Icon
                                        </h2>

                                        <p class="text-xs text-text-secondary mt-0.5">
                                            Pilih icon Heroicons untuk langkah workflow ini.
                                        </p>
                                    </div>


                                    {{-- Close --}}
                                    <button
                                        type="button"
                                        wire:click="closeIconPicker"
                                        class="p-2 rounded-lg text-text-secondary hover:bg-surface hover:text-text-primary transition-all focus:outline-none focus:ring-2 focus:ring-primary/30"
                                        aria-label="Tutup"
                                    >
                                        <svg
                                            class="w-4 h-4"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12"
                                            />
                                        </svg>
                                    </button>

                                </div>


                                {{-- =============================
                                    ICON GRID
                                ============================== --}}
                                <div class="p-5 min-h-0">

                                    <div class="max-h-[55vh] overflow-y-auto pr-2">

                                        <div class="grid grid-cols-4 sm:grid-cols-6 md:grid-cols-8 lg:grid-cols-9 xl:grid-cols-10 gap-3">

                                            @forelse($icons as $key => $meta)

                                                @if(isset($meta['svg']) && trim($meta['svg']) !== '')

                                                    @php
                                                        $selected = $icon === $key;
                                                    @endphp

                                                    <button
                                                        type="button"
                                                        wire:click="selectIcon('{{ $key }}')"
                                                        title="{{ $meta['name'] }}"
                                                        aria-label="{{ $meta['name'] }}"
                                                        aria-pressed="{{ $selected ? 'true' : 'false' }}"
                                                        class="
                                                            group
                                                            aspect-square
                                                            w-full
                                                            max-w-[64px]
                                                            mx-auto
                                                            rounded-xl
                                                            border
                                                            flex
                                                            items-center
                                                            justify-center
                                                            transition-all
                                                            duration-150
                                                            focus:outline-none
                                                            focus:ring-2
                                                            focus:ring-primary/30

                                                            {{ $selected
                                                                ? 'border-blue-600 bg-blue-50 ring-2 ring-blue-500/20'
                                                                : 'border-slate-200 bg-white hover:border-blue-500 hover:bg-blue-50 hover:shadow-sm'
                                                            }}
                                                        "
                                                    >

                                                        <svg
                                                            class="
                                                                w-6 h-6
                                                                transition-transform
                                                                duration-150
                                                                group-hover:scale-110
                                                                {{ $selected
                                                                    ? 'text-blue-600'
                                                                    : 'text-slate-700'
                                                                }}
                                                            "
                                                            fill="none"
                                                            viewBox="0 0 24 24"
                                                            stroke="currentColor"
                                                            stroke-width="1.5"
                                                        >
                                                            {!! $meta['svg'] !!}
                                                        </svg>

                                                    </button>

                                                @endif

                                            @empty

                                                {{-- Fallback jika config kosong --}}
                                                <div class="col-span-full py-12 text-center">

                                                    <div class="text-sm font-medium text-text-primary">
                                                        Icon belum tersedia
                                                    </div>

                                                    <p class="text-xs text-text-secondary mt-1">
                                                        Periksa file config/heroicons.php
                                                    </p>

                                                </div>

                                            @endforelse

                                        </div>

                                    </div>

                                </div>


                                {{-- =============================
                                    MODAL FOOTER
                                ============================== --}}
                                <div class="px-5 py-4 border-t border-border flex justify-end">

                                    <button
                                        type="button"
                                        wire:click="closeIconPicker"
                                        class="px-4 py-2 bg-white border border-border rounded-xl text-sm hover:bg-surface transition-all"
                                    >
                                        Batal
                                    </button>

                                </div>

                            </div>

                        </div>

                    @endif

                </div>


                {{-- Aktif --}}
                <label class="flex items-center gap-3 cursor-pointer">

                    <input
                        wire:model="is_active"
                        type="checkbox"
                        class="w-4 h-4 text-primary focus:ring-primary/20 border-border rounded"
                    >

                    <span class="text-sm font-medium text-text-primary">
                        Aktifkan
                    </span>

                </label>

            </div>

        </div>


        {{-- =========================================================
            FORM ACTIONS
        ========================================================== --}}
        <div class="flex gap-3 mt-6">

            <a
                href="{{ route('admin.workflow.index') }}"
                wire:navigate
                class="flex-1 px-4 py-2.5 bg-white text-text-secondary text-sm font-medium rounded-xl border border-border hover:bg-surface transition-all duration-200 text-center"
            >
                Batal
            </a>


            <button
                wire:click="save"
                wire:loading.attr="disabled"
                class="flex-1 px-4 py-2.5 bg-primary text-white text-sm font-semibold rounded-xl hover:bg-primary-dark transition-all duration-200 shadow-button disabled:opacity-60"
            >

                <span wire:loading.remove wire:target="save">
                    {{ $isEditing ? 'Perbarui' : 'Simpan' }}
                </span>

                <span
                    wire:loading
                    wire:target="save"
                    class="flex items-center justify-center gap-2"
                >

                    <svg
                        class="animate-spin h-4 w-4"
                        viewBox="0 0 24 24"
                    >
                        <circle
                            class="opacity-25"
                            cx="12"
                            cy="12"
                            r="10"
                            stroke="currentColor"
                            stroke-width="4"
                            fill="none"
                        />

                        <path
                            class="opacity-75"
                            fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"
                        />
                    </svg>

                    Menyimpan...

                </span>

            </button>

        </div>

    </div>
</div>