<div x-data="{
        toastVisible: false,
        toastMessage: '',
        showToast(msg) {
            this.toastMessage = msg;
            this.toastVisible = true;
            setTimeout(() => { this.toastVisible = false }, 3500);
        }
    }"
    x-on:show-toast.window="showToast($event.detail.message)"
    x-on:scroll-to-order-form.window="
        requestAnimationFrame(() => {
            const el = document.getElementById('contact');
            if (el) {
                el.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    "
    class="relative z-50">

    {{-- Toast Notification --}}
    <div x-show="toastVisible"
         x-transition:enter="transition ease-out duration-300 transform"
         x-transition:enter-start="translate-y-4 opacity-0 scale-95"
         x-transition:enter-end="translate-y-0 opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-200 transform"
         x-transition:leave-start="translate-y-0 opacity-100 scale-100"
         x-transition:leave-end="translate-y-4 opacity-0 scale-95"
         class="fixed bottom-6 right-6 z-[9999] flex items-center gap-3 rounded-2xl bg-navy-deep px-5 py-4 text-cream shadow-2xl border border-gold/40 max-w-md"
         style="display: none;">
        <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-gold/20 text-gold">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
        </div>
        <p class="text-xs md:text-sm font-inter text-cream/90" x-text="toastMessage"></p>
    </div>

    {{-- Modal Overlay / Bottom Sheet --}}
    @if($isOpen && $product)
    <div class="fixed inset-0 z-50 overflow-y-auto bg-navy-deep/75 backdrop-blur-sm flex items-end justify-center sm:items-center p-0 sm:p-4 md:p-6"
         wire:keydown.escape="closeModal"
         tabindex="0"
         role="dialog"
         aria-modal="true"
         aria-labelledby="modal-headline">

        {{-- Modal Box / Bottom Sheet Container --}}
        <div class="relative w-full sm:max-w-2xl max-h-[92vh] sm:max-h-[88vh] rounded-t-[28px] sm:rounded-3xl bg-white shadow-2xl border-t sm:border border-slate-200/80 flex flex-col overflow-hidden transition-all duration-300">
            
            {{-- Mobile Drag Handle --}}
            <div class="flex-none pt-2.5 pb-1 flex justify-center sm:hidden bg-white">
                <span class="w-12 h-1.5 rounded-full bg-slate-300"></span>
            </div>

            {{-- Header (flex-none, 64-72px) --}}
            <div class="flex-none px-4 sm:px-6 py-3 sm:py-4 border-b border-slate-100 bg-white flex items-center justify-between gap-4">
                <div class="min-w-0 flex-1">
                    @if($product->category)
                        <span class="inline-block text-[11px] font-bold uppercase tracking-wider text-gold-dark mb-0.5">
                            {{ $product->category->name }}
                        </span>
                    @endif
                    <h2 id="modal-headline" class="font-heading text-lg sm:text-xl font-bold text-navy leading-tight truncate">
                        {{ $product->name }}
                    </h2>
                    <p class="text-xs text-slate-500 mt-0.5 truncate">
                        Sesuaikan spesifikasi produk & lihat estimasi harga
                    </p>
                </div>

                {{-- Close Button (Touch target >= 44x44px) --}}
                <button type="button"
                        wire:click="closeModal"
                        class="min-h-[44px] min-w-[44px] h-11 w-11 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-500 hover:text-navy transition flex items-center justify-center shrink-0 focus:outline-none focus:ring-2 focus:ring-gold"
                        aria-label="Tutup modal">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            {{-- Scrollable Content Body (flex-1 overflow-y-auto) --}}
            <div class="flex-1 overflow-y-auto px-4 sm:px-6 py-4 sm:py-5 space-y-5">

                {{-- 1. Pilihan Sisi Cetak (Jika produk mendukung 2 sisi) --}}
                @if($product->supports_2_sisi)
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wide text-navy mb-2">
                        Pilihan Sisi Cetak
                    </label>
                    <div class="grid grid-cols-2 gap-2.5">
                        <label class="group flex items-center gap-2.5 min-h-[56px] p-3 rounded-xl border transition-all cursor-pointer {{ $sideMode === '1_muka' ? 'border-gold bg-cream/70 shadow-sm ring-1 ring-gold/40' : 'border-slate-200 hover:border-gold/40 bg-white' }}">
                            <input type="radio" wire:model.live="sideMode" value="1_muka" class="h-4 w-4 accent-gold shrink-0 cursor-pointer">
                            <span class="text-sm font-semibold leading-tight {{ $sideMode === '1_muka' ? 'text-navy font-bold' : 'text-slate-800' }}">1 Muka / Sisi</span>
                        </label>
                        <label class="group flex items-center gap-2.5 min-h-[56px] p-3 rounded-xl border transition-all cursor-pointer {{ $sideMode === '2_muka' ? 'border-gold bg-cream/70 shadow-sm ring-1 ring-gold/40' : 'border-slate-200 hover:border-gold/40 bg-white' }}">
                            <input type="radio" wire:model.live="sideMode" value="2_muka" class="h-4 w-4 accent-gold shrink-0 cursor-pointer">
                            <span class="text-sm font-semibold leading-tight {{ $sideMode === '2_muka' ? 'text-navy font-bold' : 'text-slate-800' }}">2 Muka (Bolak-Balik)</span>
                        </label>
                    </div>
                </div>
                @endif

                {{-- 2. Ukuran Cetak (Jika produk butuh perhitungan luas) --}}
                @if($product->requires_area_calculation)
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label class="block text-xs font-bold uppercase tracking-wide text-navy">
                            Ukuran Cetak
                        </label>
                        @if($product->available_widths_note)
                            <span class="text-[11px] text-slate-500 font-medium">{{ $product->available_widths_note }}</span>
                        @endif
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <span class="block text-xs font-medium text-slate-600 mb-1">Panjang</span>
                            <div class="relative flex items-center">
                                <input type="number" step="0.1" min="0.1" wire:model.live.debounce.300ms="lengthM" placeholder="Contoh: 2"
                                       class="w-full h-11 rounded-xl border border-slate-200 pl-3.5 pr-12 text-sm font-semibold text-navy placeholder:font-normal placeholder:text-slate-400 focus:border-gold focus:outline-none focus:ring-2 focus:ring-gold/20 transition">
                                <span class="absolute right-3 text-xs font-semibold text-slate-400 pointer-events-none">meter</span>
                            </div>
                        </div>
                        <div>
                            <span class="block text-xs font-medium text-slate-600 mb-1">Lebar</span>
                            <div class="relative flex items-center">
                                <input type="number" step="0.1" min="0.1" wire:model.live.debounce.300ms="widthM" placeholder="Contoh: 1"
                                       class="w-full h-11 rounded-xl border border-slate-200 pl-3.5 pr-12 text-sm font-semibold text-navy placeholder:font-normal placeholder:text-slate-400 focus:border-gold focus:outline-none focus:ring-2 focus:ring-gold/20 transition">
                                <span class="absolute right-3 text-xs font-semibold text-slate-400 pointer-events-none">meter</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                {{-- 3. Option Groups Dinamis (Bahan, Model, Finishing, Cutting, Ukuran dll.) --}}
                @foreach($product->optionGroups as $group)
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label class="text-xs font-bold uppercase tracking-wide text-navy">
                            {{ $group->name }}
                        </label>
                        @if($group->is_required)
                            <span class="text-[10px] font-bold text-red-500 uppercase tracking-wider bg-red-50 px-2 py-0.5 rounded-full">Wajib</span>
                        @endif
                    </div>
                    {{-- 2-Column Compact Cards Layout --}}
                    <div class="grid grid-cols-2 gap-2.5">
                        @foreach($group->options as $option)
                            @php
                                $isSelected = isset($selectedOptions[$group->id]) && (int)$selectedOptions[$group->id] === (int)$option->id;
                            @endphp
                            <label class="group relative flex items-start gap-2.5 min-h-[60px] p-3 rounded-xl border transition-all cursor-pointer {{ $isSelected ? 'border-gold bg-cream/70 shadow-sm ring-1 ring-gold/40' : 'border-slate-200 hover:border-gold/40 bg-white' }}">
                                <input type="radio"
                                       wire:model.live="selectedOptions.{{ $group->id }}"
                                       value="{{ $option->id }}"
                                       class="h-4 w-4 mt-0.5 accent-gold shrink-0 cursor-pointer">
                                <div class="min-w-0 flex-1 flex flex-col justify-center">
                                    <span class="text-sm font-semibold leading-tight line-clamp-2 {{ $isSelected ? 'text-navy font-bold' : 'text-slate-800' }}">
                                        {{ $option->name }}
                                    </span>
                                    @if($option->requires_manual_quote)
                                        <span class="inline-flex items-center text-[10px] font-medium text-amber-700 bg-amber-50 rounded px-1.5 py-0.5 mt-1 border border-amber-200 w-fit">
                                            Konfirmasi Admin
                                        </span>
                                    @elseif($option->price_mode === 'absolute')
                                        <span class="text-xs font-bold text-gold-dark mt-1">
                                            Rp {{ number_format((float)$option->price_delta, 0, ',', '.') }}
                                        </span>
                                    @elseif($option->price_delta > 0)
                                        <span class="text-xs font-semibold text-slate-500 mt-1">
                                            +Rp {{ number_format((float)$option->price_delta, 0, ',', '.') }}{{ $option->price_unit === 'per_length_m' ? '/m' : '' }}
                                        </span>
                                    @endif
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>
                @endforeach

                {{-- 4. Quantity Stepper --}}
                <div class="border-t border-slate-100 pt-4">
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wide text-navy">
                                Jumlah ({{ $product->base_price_unit ?: 'pcs' }})
                            </label>
                            <p class="text-xs text-slate-500 mt-0.5">
                                Min: {{ $product->min_qty ?? 1 }} {{ $product->base_price_unit ?: 'pcs' }}
                                @if(!empty($product->qty_increment) && $product->qty_increment > 1)
                                    (kelipatan {{ $product->qty_increment }})
                                @endif
                            </p>
                        </div>
                        {{-- Touch-friendly Stepper Control (44x44px buttons) --}}
                        <div class="flex items-center gap-2">
                            <button type="button"
                                    wire:click="decrementQty"
                                    class="min-h-[44px] min-w-[44px] h-11 w-11 flex items-center justify-center rounded-xl border border-slate-200 bg-white text-navy font-bold text-lg hover:border-gold hover:bg-cream transition active:scale-95 shadow-sm"
                                    aria-label="Kurangi kuantitas">
                                -
                            </button>
                            <input type="number"
                                   min="{{ $product->min_qty ?? 1 }}"
                                   step="{{ $product->qty_increment ?: 1 }}"
                                   wire:model.live.debounce.300ms="qty"
                                   class="w-16 sm:w-20 h-11 text-center rounded-xl border border-slate-200 py-2 text-sm font-bold text-navy focus:border-gold focus:outline-none focus:ring-2 focus:ring-gold/20 shadow-sm">
                            <button type="button"
                                    wire:click="incrementQty"
                                    class="min-h-[44px] min-w-[44px] h-11 w-11 flex items-center justify-center rounded-xl border border-slate-200 bg-white text-navy font-bold text-lg hover:border-gold hover:bg-cream transition active:scale-95 shadow-sm"
                                    aria-label="Tambah kuantitas">
                                +
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Alert / Detailed Notice if any --}}
                @if($errorMessage)
                    <div class="rounded-xl border border-red-200 bg-red-50 p-3.5 text-xs text-red-700 flex items-start gap-2.5">
                        <svg class="h-4 w-4 shrink-0 text-red-500 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        <div class="leading-relaxed">
                            <strong class="font-semibold block mb-0.5">Konfigurasi Belum Sesuai</strong>
                            {{ $errorMessage }}
                        </div>
                    </div>
                @elseif($calculationPreview && !empty($calculationPreview['manual_quote_flag']))
                    <div class="rounded-xl bg-amber-50 border border-amber-200 p-3 text-xs text-amber-800 flex items-start gap-2.5">
                        <svg class="h-4 w-4 shrink-0 text-amber-600 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <div>
                            <strong class="font-semibold block">Item Perlu Konfirmasi Admin</strong>
                            {{ $calculationPreview['manual_quote_note'] ?: 'Harga final akan dikonfirmasi oleh tim admin via WhatsApp.' }}
                        </div>
                    </div>
                @endif

            </div>

            {{-- Sticky Footer Bar (flex-none, 72-84px height) --}}
            <div class="flex-none bg-white border-t border-slate-200/80 px-4 py-3 sm:px-6 sm:py-3.5 pb-[calc(0.75rem+env(safe-area-inset-bottom))] sm:pb-3.5 shadow-[0_-6px_20px_rgba(0,0,0,0.06)] flex items-center justify-between gap-3 min-h-[76px]">
                {{-- Left: Total Estimasi Display --}}
                <div class="min-w-0 flex flex-col justify-center">
                    @if($calculationPreview)
                        <span class="text-[10px] sm:text-[11px] font-bold uppercase tracking-wider text-slate-400 leading-none">
                            Total Estimasi
                        </span>
                        <span class="font-heading text-lg sm:text-xl font-bold text-navy leading-tight mt-1 truncate">
                            Rp {{ number_format((float)$calculationPreview['line_subtotal'], 0, ',', '.') }}
                        </span>
                        <span class="text-[11px] text-slate-500 font-medium leading-none mt-0.5 truncate">
                            {{ $calculationPreview['qty'] }} {{ $product->base_price_unit ?: 'pcs' }}
                            @if($product->requires_area_calculation && $lengthM && $widthM)
                                • {{ $lengthM }}×{{ $widthM }}m
                            @endif
                        </span>
                    @else
                        <span class="text-xs font-semibold text-slate-400">Menghitung...</span>
                    @endif
                </div>

                {{-- Right: Consolidated Action Buttons --}}
                <div class="flex items-center gap-2 shrink-0">
                    {{-- Secondary Button: Tambah Saja (Touch target 44x44px) --}}
                    <button type="button"
                            wire:click="addToCart(false)"
                            wire:loading.attr="disabled"
                            @disabled($errorMessage !== null || $calculationPreview === null)
                            class="min-h-[44px] min-w-[44px] h-11 w-11 sm:w-auto sm:px-3.5 inline-flex items-center justify-center gap-1.5 rounded-xl border border-slate-200 bg-white text-navy font-semibold text-xs transition hover:bg-slate-50 hover:border-slate-300 active:scale-95 disabled:cursor-not-allowed disabled:opacity-50 shadow-sm"
                            title="Tambah ke Keranjang & Pilih Produk Lain"
                            aria-label="Tambah & Pilih Produk Lain">
                        <svg class="h-5 w-5 text-navy shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                        <span class="hidden sm:inline">Tambah Saja</span>
                    </button>

                    {{-- Primary Button: Pesan Sekarang --}}
                    <button type="button"
                            wire:click="addToCart(true)"
                            wire:loading.attr="disabled"
                            @disabled($errorMessage !== null || $calculationPreview === null)
                            class="min-h-[44px] h-11 px-4 sm:px-6 inline-flex items-center justify-center gap-2 rounded-xl bg-navy text-xs sm:text-sm font-bold text-cream shadow-md transition hover:bg-navy-deep active:scale-95 disabled:cursor-not-allowed disabled:opacity-50">
                        <span>Pesan Sekarang</span>
                        <svg class="h-4 w-4 text-gold shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
