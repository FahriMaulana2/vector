<div>
    {{-- Header --}}
    <div class="mb-6">
        <div class="flex items-center gap-3">
            <a
                href="{{ route('admin.products.index') }}"
                wire:navigate
                class="p-2 rounded-xl text-text-secondary hover:text-primary hover:bg-primary/5 transition-colors"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M15 19l-7-7 7-7"
                    />
                </svg>
            </a>

            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-text-primary admin-heading">
                    {{ $isEditing ? 'Edit Produk' : 'Tambah Produk' }}
                </h1>

                <p class="text-text-secondary mt-1.5 text-sm">
                    {{ $isEditing
                        ? 'Perbarui informasi produk OMH Vector.'
                        : 'Tambahkan produk baru ke katalog OMH Vector.'
                    }}
                </p>
            </div>
        </div>
    </div>

    {{-- Form --}}
    <form wire:submit="save" class="space-y-6">

        {{-- Informasi Produk --}}
        <div class="bg-white rounded-2xl border border-border shadow-soft overflow-hidden">
            <div class="p-6 border-b border-border">
                <h2 class="text-lg font-semibold text-text-primary">Informasi Produk</h2>
                <p class="text-sm text-text-secondary mt-1">Informasi yang akan ditampilkan pada katalog produk.</p>
            </div>

            <div class="p-6 space-y-6">

                {{-- Nama Produk --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-text-primary mb-2">
                        Nama Produk <span class="text-red-500">*</span>
                    </label>
                    <input
                        id="name"
                        type="text"
                        wire:model="name"
                        placeholder="Contoh: Banner Custom"
                        class="w-full px-4 py-3 rounded-xl border border-border bg-white text-text-primary placeholder:text-text-secondary/60 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition"
                    >
                    @error('name')
                        <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Deskripsi --}}
                <div>
                    <label for="description" class="block text-sm font-medium text-text-primary mb-2">Deskripsi</label>
                    <textarea
                        id="description"
                        wire:model="description"
                        rows="5"
                        placeholder="Jelaskan secara singkat mengenai produk..."
                        class="w-full px-4 py-3 rounded-xl border border-border bg-white text-text-primary placeholder:text-text-secondary/60 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition resize-none"
                    ></textarea>
                    @error('description')
                        <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Kategori Produk --}}
                <div>
                    <label for="product_category_id" class="block text-sm font-medium text-text-primary mb-2">
                        Kategori Produk <span class="text-red-500">*</span>
                    </label>
                    <select
                        id="product_category_id"
                        wire:model="product_category_id"
                        class="w-full px-4 py-3 rounded-xl border border-border bg-white text-text-primary focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition"
                    >
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('product_category_id')
                        <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Badge + Status --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- Badge --}}
                    <div>
                        <label for="badge" class="block text-sm font-medium text-text-primary mb-2">Badge</label>
                        <input
                            id="badge"
                            type="text"
                            wire:model="badge"
                            placeholder="Contoh: Populer"
                            class="w-full px-4 py-3 rounded-xl border border-border bg-white text-text-primary placeholder:text-text-secondary/60 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition"
                        >
                        <p class="mt-1.5 text-xs text-text-secondary">Opsional. Contoh: Baru, Populer, Best Seller.</p>
                        @error('badge')
                            <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Status --}}
                    <div>
                        <label for="is_active" class="block text-sm font-medium text-text-primary mb-2">
                            Status <span class="text-red-500">*</span>
                        </label>
                        <select
                            id="is_active"
                            wire:model="is_active"
                            class="w-full px-4 py-3 rounded-xl border border-border bg-white text-text-primary focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition"
                        >
                            <option value="1">Aktif</option>
                            <option value="0">Nonaktif</option>
                        </select>
                        @error('is_active')
                            <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
            </div>
        </div>

        {{-- ═══════════════════════════════════════════════════════ --}}
        {{-- PRICING --}}
        {{-- ═══════════════════════════════════════════════════════ --}}
        <div class="bg-white rounded-2xl border border-border shadow-soft overflow-hidden">
            <div class="p-6 border-b border-border">
                <h2 class="text-lg font-semibold text-text-primary">Konfigurasi Harga</h2>
                <p class="text-sm text-text-secondary mt-1">
                    Pilih mode harga dan atur parameter produk.
                </p>
            </div>

            <div class="p-6 space-y-6">

                {{-- Pricing Mode Toggle --}}
                <div>
                    <label class="block text-sm font-medium text-text-primary mb-3">
                        Mode Harga <span class="text-red-500">*</span>
                    </label>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">

                        <label class="relative flex cursor-pointer">
                            <input
                                type="radio"
                                wire:model.live="pricing_mode"
                                value="standard"
                                class="peer sr-only"
                            >
                            <div class="w-full p-4 rounded-xl border-2 border-border peer-checked:border-primary peer-checked:bg-primary/5 transition">
                                <div class="flex items-start gap-3">
                                    <div class="w-5 h-5 rounded-full border-2 border-border peer-checked:border-primary flex items-center justify-center mt-0.5 flex-shrink-0">
                                        <div class="w-2.5 h-2.5 rounded-full bg-primary opacity-0 peer-checked:opacity-100"></div>
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-text-primary">Standard</p>
                                        <p class="text-xs text-text-secondary mt-0.5">Harga satuan tetap (Rp/pcs, Rp/lembar, Rp/m²)</p>
                                    </div>
                                </div>
                            </div>
                        </label>

                        <label class="relative flex cursor-pointer">
                            <input
                                type="radio"
                                wire:model.live="pricing_mode"
                                value="qty_tiered"
                                class="peer sr-only"
                            >
                            <div class="w-full p-4 rounded-xl border-2 border-border peer-checked:border-primary peer-checked:bg-primary/5 transition">
                                <div class="flex items-start gap-3">
                                    <div class="w-5 h-5 rounded-full border-2 border-border peer-checked:border-primary flex items-center justify-center mt-0.5 flex-shrink-0">
                                        <div class="w-2.5 h-2.5 rounded-full bg-primary opacity-0 peer-checked:opacity-100"></div>
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-text-primary">Qty Tiered</p>
                                        <p class="text-xs text-text-secondary mt-0.5">Harga berdasarkan jumlah & sisi cetak</p>
                                    </div>
                                </div>
                            </div>
                        </label>

                    </div>
                    @error('pricing_mode')
                        <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Standard: Price field --}}
                @if($pricing_mode === 'standard')
                    <div>
                        <label for="price" class="block text-sm font-medium text-text-primary mb-2">
                            Harga Satuan (Rp) <span class="text-red-500">*</span>
                        </label>
                        <input
                            id="price"
                            type="number"
                            wire:model="price"
                            min="0"
                            step="100"
                            placeholder="0"
                            class="w-full px-4 py-3 rounded-xl border border-border bg-white text-text-primary placeholder:text-text-secondary/60 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition"
                        >
                        @error('price')
                            <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                @endif

                {{-- Baris konfigurasi bersama --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">

                    {{-- Base Price Unit --}}
                    <div>
                        <label for="base_price_unit" class="block text-sm font-medium text-text-primary mb-2">
                            Satuan Harga <span class="text-red-500">*</span>
                        </label>
                        <select
                            id="base_price_unit"
                            wire:model="base_price_unit"
                            class="w-full px-4 py-3 rounded-xl border border-border bg-white text-text-primary focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition"
                        >
                            <option value="pcs">pcs</option>
                            <option value="lembar">lembar</option>
                            <option value="m2">m²</option>
                        </select>
                        @error('base_price_unit')
                            <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Min Qty --}}
                    <div>
                        <label for="min_qty" class="block text-sm font-medium text-text-primary mb-2">
                            Min. Qty <span class="text-red-500">*</span>
                        </label>
                        <input
                            id="min_qty"
                            type="number"
                            wire:model="min_qty"
                            min="1"
                            placeholder="1"
                            class="w-full px-4 py-3 rounded-xl border border-border bg-white text-text-primary placeholder:text-text-secondary/60 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition"
                        >
                        @error('min_qty')
                            <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Qty Increment --}}
                    <div>
                        <label for="qty_increment" class="block text-sm font-medium text-text-primary mb-2">
                            Kelipatan Qty
                        </label>
                        <input
                            id="qty_increment"
                            type="number"
                            wire:model="qty_increment"
                            min="1"
                            placeholder="Kosong = bebas"
                            class="w-full px-4 py-3 rounded-xl border border-border bg-white text-text-primary placeholder:text-text-secondary/60 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition"
                        >
                        @error('qty_increment')
                            <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                {{-- Checkboxes konfigurasi --}}
                <div class="space-y-3">

                    <label class="flex items-center gap-3 cursor-pointer group">
                        <input
                            type="checkbox"
                            wire:model="requires_area_calculation"
                            class="w-4 h-4 rounded border-border text-primary focus:ring-primary/30"
                        >
                        <div>
                            <span class="text-sm font-medium text-text-primary">Memerlukan kalkulasi luas</span>
                            <span class="text-xs text-text-secondary ml-2">(input panjang × lebar)</span>
                        </div>
                    </label>

                    <label class="flex items-center gap-3 cursor-pointer">
                        <input
                            type="checkbox"
                            wire:model="supports_2_sisi"
                            class="w-4 h-4 rounded border-border text-primary focus:ring-primary/30"
                        >
                        <div>
                            <span class="text-sm font-medium text-text-primary">Mendukung cetak 2 sisi</span>
                            <span class="text-xs text-text-secondary ml-2">(user bisa pilih 1 muka / 2 muka)</span>
                        </div>
                    </label>

                </div>

                {{-- Available widths note --}}
                <div>
                    <label for="available_widths_note" class="block text-sm font-medium text-text-primary mb-2">
                        Catatan Lebar Tersedia
                    </label>
                    <input
                        id="available_widths_note"
                        type="text"
                        wire:model="available_widths_note"
                        placeholder="Contoh: 60cm / 90cm / 120cm"
                        class="w-full px-4 py-3 rounded-xl border border-border bg-white text-text-primary placeholder:text-text-secondary/60 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition"
                    >
                    <p class="mt-1.5 text-xs text-text-secondary">Opsional. Tampil sebagai info di form order.</p>
                    @error('available_widths_note')
                        <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

            </div>
        </div>

        {{-- ═══════════════════════════════════════════════════════ --}}
        {{-- QTY PRICE TIERS (hanya muncul jika mode qty_tiered) --}}
        {{-- ═══════════════════════════════════════════════════════ --}}
        @if($pricing_mode === 'qty_tiered')
            <div class="bg-white rounded-2xl border border-border shadow-soft overflow-hidden">
                <div class="p-6 border-b border-border flex items-center justify-between">
                    <div>
                        <h2 class="text-lg font-semibold text-text-primary">Tabel Harga per Qty</h2>
                        <p class="text-sm text-text-secondary mt-1">
                            Harga berdasarkan jumlah dan sisi cetak. Sistem pakai harga tier dengan <code class="text-xs bg-surface px-1 rounded">min_qty</code> terbesar yang ≤ qty pesanan.
                        </p>
                    </div>
                    <button
                        type="button"
                        wire:click="addTier"
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-primary text-white text-sm font-semibold hover:bg-primary-dark transition shadow-button flex-shrink-0"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Tambah Tier
                    </button>
                </div>

                <div class="p-6">
                    @if(count($tiers) === 0)
                        <div class="text-center py-8 text-text-secondary text-sm">
                            Belum ada tier harga. Klik "Tambah Tier" untuk menambahkan.
                        </div>
                    @else
                        <div class="space-y-3">
                            {{-- Header --}}
                            <div class="grid grid-cols-12 gap-3 px-1 mb-1">
                                <div class="col-span-3 text-xs font-semibold text-text-secondary uppercase tracking-wide">Sisi Cetak</div>
                                <div class="col-span-3 text-xs font-semibold text-text-secondary uppercase tracking-wide">Min. Qty</div>
                                <div class="col-span-4 text-xs font-semibold text-text-secondary uppercase tracking-wide">Harga/Satuan (Rp)</div>
                                <div class="col-span-1 text-xs font-semibold text-text-secondary uppercase tracking-wide text-center">Aktif</div>
                                <div class="col-span-1"></div>
                            </div>

                            @foreach($tiers as $tIdx => $tier)
                                <div class="grid grid-cols-12 gap-3 items-center p-3 bg-surface rounded-xl border border-border">

                                    {{-- Side mode --}}
                                    <div class="col-span-3">
                                        <select
                                            wire:model="tiers.{{ $tIdx }}.side_mode"
                                            class="w-full px-3 py-2 rounded-lg border border-border bg-white text-text-primary text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition"
                                        >
                                            <option value="1_muka">1 Muka</option>
                                            <option value="2_muka">2 Muka</option>
                                        </select>
                                        @error("tiers.{$tIdx}.side_mode")
                                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    {{-- Min qty --}}
                                    <div class="col-span-3">
                                        <input
                                            type="number"
                                            wire:model="tiers.{{ $tIdx }}.min_qty"
                                            min="1"
                                            placeholder="1"
                                            class="w-full px-3 py-2 rounded-lg border border-border bg-white text-text-primary text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition"
                                        >
                                        @error("tiers.{$tIdx}.min_qty")
                                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    {{-- Price per unit --}}
                                    <div class="col-span-4">
                                        <input
                                            type="number"
                                            wire:model="tiers.{{ $tIdx }}.price_per_unit"
                                            min="0"
                                            step="100"
                                            placeholder="0"
                                            class="w-full px-3 py-2 rounded-lg border border-border bg-white text-text-primary text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition"
                                        >
                                        @error("tiers.{$tIdx}.price_per_unit")
                                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    {{-- Is active --}}
                                    <div class="col-span-1 flex justify-center">
                                        <input
                                            type="checkbox"
                                            wire:model="tiers.{{ $tIdx }}.is_active"
                                            class="w-4 h-4 rounded border-border text-primary focus:ring-primary/30"
                                        >
                                    </div>

                                    {{-- Remove --}}
                                    <div class="col-span-1 flex justify-center">
                                        <button
                                            type="button"
                                            wire:click="removeTier({{ $tIdx }})"
                                            class="p-1.5 rounded-lg text-red-400 hover:text-red-600 hover:bg-red-50 transition"
                                        >
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </div>

                                </div>
                            @endforeach

                        </div>
                    @endif

                    @error('tiers')
                        <p class="mt-3 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        @endif

        {{-- ═══════════════════════════════════════════════════════ --}}
        {{-- OPTION GROUPS --}}
        {{-- ═══════════════════════════════════════════════════════ --}}
        <div class="bg-white rounded-2xl border border-border shadow-soft overflow-hidden">
            <div class="p-6 border-b border-border flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-semibold text-text-primary">Opsi Produk</h2>
                    <p class="text-sm text-text-secondary mt-1">
                        Grup opsi yang bisa dipilih pelanggan (finishing, bahan, ukuran, dll).
                    </p>
                </div>
                <button
                    type="button"
                    wire:click="addGroup"
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-primary text-white text-sm font-semibold hover:bg-primary-dark transition shadow-button flex-shrink-0"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Grup
                </button>
            </div>

            <div class="p-6 space-y-5">
                @if(count($optionGroups) === 0)
                    <div class="text-center py-8 text-text-secondary text-sm">
                        Belum ada grup opsi. Klik "Tambah Grup" untuk menambahkan.
                    </div>
                @endif

                @foreach($optionGroups as $gIdx => $group)
                    <div class="border border-border rounded-2xl overflow-hidden">

                        {{-- Group header --}}
                        <div class="flex items-center gap-4 p-4 bg-surface">

                            <div class="flex-1 min-w-0">
                                <input
                                    type="text"
                                    wire:model="optionGroups.{{ $gIdx }}.name"
                                    placeholder="Nama grup, mis: Finishing"
                                    class="w-full px-3 py-2 rounded-lg border border-border bg-white text-text-primary text-sm font-medium placeholder:text-text-secondary/60 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition"
                                >
                                @error("optionGroups.{$gIdx}.name")
                                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Type --}}
                            <div class="w-36 flex-shrink-0">
                                <select
                                    wire:model="optionGroups.{{ $gIdx }}.type"
                                    class="w-full px-3 py-2 rounded-lg border border-border bg-white text-text-primary text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition"
                                >
                                    <option value="radio">Radio (1 pilih)</option>
                                    <option value="select">Select (1 pilih)</option>
                                    <option value="checkbox">Checkbox (multi)</option>
                                </select>
                            </div>

                            {{-- Required toggle --}}
                            <label class="flex items-center gap-2 flex-shrink-0 cursor-pointer">
                                <input
                                    type="checkbox"
                                    wire:model="optionGroups.{{ $gIdx }}.is_required"
                                    class="w-4 h-4 rounded border-border text-primary focus:ring-primary/30"
                                >
                                <span class="text-xs text-text-secondary whitespace-nowrap">Wajib</span>
                            </label>

                            {{-- Remove group --}}
                            <button
                                type="button"
                                wire:click="removeGroup({{ $gIdx }})"
                                class="p-1.5 rounded-lg text-red-400 hover:text-red-600 hover:bg-red-50 transition flex-shrink-0"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>

                        </div>

                        {{-- Options list --}}
                        <div class="p-4 space-y-3">

                            {{-- Option header --}}
                            @if(count($group['options']) > 0)
                                <div class="grid grid-cols-12 gap-2 px-1 mb-2">
                                    <div class="col-span-3 text-xs font-semibold text-text-secondary uppercase tracking-wide">Nama Opsi</div>
                                    <div class="col-span-2 text-xs font-semibold text-text-secondary uppercase tracking-wide">Mode Harga</div>
                                    <div class="col-span-2 text-xs font-semibold text-text-secondary uppercase tracking-wide">Satuan</div>
                                    <div class="col-span-2 text-xs font-semibold text-text-secondary uppercase tracking-wide">Delta (Rp)</div>
                                    <div class="col-span-1 text-xs font-semibold text-text-secondary uppercase tracking-wide text-center">Quoting</div>
                                    <div class="col-span-1 text-xs font-semibold text-text-secondary uppercase tracking-wide text-center">Default</div>
                                    <div class="col-span-1"></div>
                                </div>
                            @endif

                            @foreach($group['options'] as $oIdx => $option)
                                <div class="grid grid-cols-12 gap-2 items-start p-3 bg-white rounded-xl border border-border/60">

                                    {{-- Name --}}
                                    <div class="col-span-3">
                                        <input
                                            type="text"
                                            wire:model="optionGroups.{{ $gIdx }}.options.{{ $oIdx }}.name"
                                            placeholder="Nama opsi"
                                            class="w-full px-3 py-2 rounded-lg border border-border bg-white text-sm text-text-primary placeholder:text-text-secondary/60 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition"
                                        >
                                        @error("optionGroups.{$gIdx}.options.{$oIdx}.name")
                                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    {{-- Price mode --}}
                                    <div class="col-span-2">
                                        <select
                                            wire:model="optionGroups.{{ $gIdx }}.options.{{ $oIdx }}.price_mode"
                                            class="w-full px-2 py-2 rounded-lg border border-border bg-white text-sm text-text-primary focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition"
                                        >
                                            <option value="delta">Delta (+/-)</option>
                                            <option value="absolute">Absolute (override)</option>
                                        </select>
                                    </div>

                                    {{-- Price unit --}}
                                    <div class="col-span-2">
                                        <select
                                            wire:model="optionGroups.{{ $gIdx }}.options.{{ $oIdx }}.price_unit"
                                            class="w-full px-2 py-2 rounded-lg border border-border bg-white text-sm text-text-primary focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition"
                                        >
                                            <option value="flat">Flat</option>
                                            <option value="per_length_m">Per meter (panjang)</option>
                                        </select>
                                    </div>

                                    {{-- Price delta --}}
                                    <div class="col-span-2">
                                        <input
                                            type="number"
                                            wire:model="optionGroups.{{ $gIdx }}.options.{{ $oIdx }}.price_delta"
                                            step="100"
                                            placeholder="0"
                                            class="w-full px-3 py-2 rounded-lg border border-border bg-white text-sm text-text-primary placeholder:text-text-secondary/60 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition"
                                        >
                                        @error("optionGroups.{$gIdx}.options.{$oIdx}.price_delta")
                                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    {{-- requires_manual_quote --}}
                                    <div class="col-span-1 flex justify-center pt-2">
                                        <input
                                            type="checkbox"
                                            wire:model="optionGroups.{{ $gIdx }}.options.{{ $oIdx }}.requires_manual_quote"
                                            title="Perlu konfirmasi admin (manual quote)"
                                            class="w-4 h-4 rounded border-border text-amber-500 focus:ring-amber-500/30"
                                        >
                                    </div>

                                    {{-- is_default --}}
                                    <div class="col-span-1 flex justify-center pt-2">
                                        <input
                                            type="checkbox"
                                            wire:model="optionGroups.{{ $gIdx }}.options.{{ $oIdx }}.is_default"
                                            title="Default terpilih"
                                            class="w-4 h-4 rounded border-border text-primary focus:ring-primary/30"
                                        >
                                    </div>

                                    {{-- Remove option --}}
                                    <div class="col-span-1 flex justify-center pt-1">
                                        <button
                                            type="button"
                                            wire:click="removeOption({{ $gIdx }}, {{ $oIdx }})"
                                            class="p-1.5 rounded-lg text-red-400 hover:text-red-600 hover:bg-red-50 transition"
                                        >
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                        </button>
                                    </div>

                                </div>
                            @endforeach

                            {{-- Add option button --}}
                            <button
                                type="button"
                                wire:click="addOption({{ $gIdx }})"
                                class="inline-flex items-center gap-1.5 px-3 py-2 rounded-lg border border-dashed border-primary/40 text-primary text-xs font-semibold hover:bg-primary/5 transition"
                            >
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                                Tambah Opsi
                            </button>

                        </div>
                    </div>
                @endforeach

            </div>
        </div>

        {{-- ═══════════════════════════════════════════════════════ --}}
        {{-- GAMBAR --}}
        {{-- ═══════════════════════════════════════════════════════ --}}
        <div class="bg-white rounded-2xl border border-border shadow-soft overflow-hidden">
            <div class="p-6 border-b border-border">
                <h2 class="text-lg font-semibold text-text-primary">Gambar Produk</h2>
                <p class="text-sm text-text-secondary mt-1">Upload gambar utama yang akan digunakan pada card produk.</p>
            </div>

            <div class="p-6">

                {{-- Existing image --}}
                @if($existing_image && !$image)
                    <div class="mb-4">
                        <p class="text-xs font-medium text-text-secondary mb-2">Gambar saat ini</p>
                        <img
                            src="{{ asset('storage/' . $existing_image) }}"
                            alt="{{ $name }}"
                            class="w-full max-w-md h-64 object-cover rounded-2xl border border-border"
                        >
                    </div>
                @endif

                {{-- Preview image --}}
                @if($image)
                    <div class="mb-4">
                        <p class="text-xs font-medium text-text-secondary mb-2">Preview gambar baru</p>
                        <img
                            src="{{ $image->temporaryUrl() }}"
                            alt="Preview"
                            class="w-full max-w-md h-64 object-cover rounded-2xl border border-border"
                        >
                    </div>
                @endif

                <label
                    for="image"
                    class="flex flex-col items-center justify-center w-full max-w-md h-48 border-2 border-dashed border-border rounded-2xl cursor-pointer hover:border-primary hover:bg-primary/5 transition"
                >
                    <svg class="w-10 h-10 text-text-secondary mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-10h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span class="text-sm font-medium text-text-primary">Pilih gambar</span>
                    <span class="text-xs text-text-secondary mt-1">JPG, JPEG, PNG maksimal 2MB</span>
                    <input id="image" type="file" wire:model="image" accept="image/*" class="hidden">
                </label>

                @error('image')
                    <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                @enderror

                <div wire:loading wire:target="image" class="mt-3 text-sm text-primary">
                    Mengunggah gambar...
                </div>

            </div>
        </div>

        {{-- Gallery --}}
        <div class="bg-white rounded-2xl border border-border shadow-soft overflow-hidden">
            <div class="p-6 border-b border-border">
                <h2 class="text-lg font-semibold text-text-primary">Gallery Produk</h2>
                <p class="text-sm text-text-secondary mt-1">Opsional. Tambahkan beberapa gambar pendukung produk.</p>
            </div>

            <div class="p-6">

                {{-- Existing gallery --}}
                @if(count($existing_gallery) > 0)
                    <div class="mb-6">
                        <p class="text-xs font-medium text-text-secondary mb-3">Gallery saat ini</p>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            @foreach($existing_gallery as $galleryImage)
                                <div class="aspect-square rounded-xl overflow-hidden border border-border">
                                    <img
                                        src="{{ asset('storage/' . $galleryImage) }}"
                                        alt="{{ $name }}"
                                        class="w-full h-full object-cover"
                                    >
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Upload gallery --}}
                <label
                    for="gallery"
                    class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed border-border rounded-2xl cursor-pointer hover:border-primary hover:bg-primary/5 transition"
                >
                    <svg class="w-8 h-8 text-text-secondary mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span class="text-sm font-medium text-text-primary">Tambahkan gambar gallery</span>
                    <span class="text-xs text-text-secondary mt-1">Bisa memilih beberapa gambar</span>
                    <input id="gallery" type="file" wire:model="gallery" accept="image/*" multiple class="hidden">
                </label>

                @error('gallery.*')
                    <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                @enderror

            </div>
        </div>

        {{-- Action --}}
        <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3">

            <a
                href="{{ route('admin.products.index') }}"
                wire:navigate
                class="inline-flex items-center justify-center px-5 py-3 rounded-xl border border-border text-sm font-semibold text-text-primary hover:bg-surface transition"
            >
                Batal
            </a>

            <button
                type="submit"
                wire:loading.attr="disabled"
                class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-primary text-white text-sm font-semibold hover:bg-primary-dark transition shadow-button disabled:opacity-60 disabled:cursor-not-allowed"
            >
                <svg wire:loading.remove wire:target="save" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>

                <svg wire:loading wire:target="save" class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                </svg>

                <span wire:loading.remove wire:target="save">
                    {{ $isEditing ? 'Simpan Perubahan' : 'Tambah Produk' }}
                </span>

                <span wire:loading wire:target="save">
                    Menyimpan...
                </span>
            </button>

        </div>

    </form>
</div>