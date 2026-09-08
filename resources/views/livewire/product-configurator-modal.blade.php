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

    {{-- Modal Overlay --}}
    @if($isOpen && $product)
    <div class="fixed inset-0 z-50 overflow-y-auto bg-navy-deep/80 backdrop-blur-sm p-4 sm:p-6 lg:p-8 flex items-center justify-center"
         wire:keydown.escape="closeModal"
         tabindex="0"
         role="dialog"
         aria-modal="true"
         aria-labelledby="modal-headline">

        {{-- Modal Box --}}
        <div class="relative w-full max-w-2xl rounded-3xl bg-white shadow-2xl border border-gold/25 overflow-hidden transition-all duration-300">
            
            {{-- Header --}}
            <div class="relative bg-gradient-to-r from-navy via-navy to-navy-dark px-6 py-5 text-white sm:px-8">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        @if($product->category)
                            <span class="inline-block text-[10px] font-semibold uppercase tracking-widest text-gold mb-1">
                                {{ $product->category->name }}
                            </span>
                        @endif
                        <h2 id="modal-headline" class="font-heading text-xl font-bold sm:text-2xl text-white">
                            {{ $product->name }}
                        </h2>
                        <p class="mt-1 text-xs text-white/70">
                            Konfigurasikan spesifikasi dan jumlah pesanan Anda
                        </p>
                    </div>
                    <button type="button"
                            wire:click="closeModal"
                            class="rounded-full bg-white/10 p-2 text-white/80 hover:bg-white/20 hover:text-white transition-colors focus:outline-none focus:ring-2 focus:ring-gold"
                            aria-label="Tutup modal">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            </div>

            {{-- Body --}}
            <div class="max-h-[70vh] overflow-y-auto p-6 sm:p-8 space-y-6">

                {{-- Sisi Cetak (Jika produk mendukung 2 sisi) --}}
                @if($product->supports_2_sisi)
                <div>
                    <label class="block text-xs font-heading font-semibold uppercase tracking-wider text-navy mb-2.5">
                        Pilihan Sisi Cetak
                    </label>
                    <div class="grid grid-cols-2 gap-3">
                        <label class="group flex items-center justify-between rounded-xl border p-3.5 cursor-pointer transition-all {{ $sideMode === '1_muka' ? 'border-gold bg-cream shadow-sm ring-1 ring-gold' : 'border-slate-200 hover:border-gold/50 bg-white' }}">
                            <div class="flex items-center gap-3">
                                <input type="radio" wire:model.live="sideMode" value="1_muka" class="h-4 w-4 accent-gold">
                                <span class="text-xs sm:text-sm font-medium {{ $sideMode === '1_muka' ? 'text-navy font-semibold' : 'text-slate-700' }}">1 Muka / Sisi</span>
                            </div>
                        </label>
                        <label class="group flex items-center justify-between rounded-xl border p-3.5 cursor-pointer transition-all {{ $sideMode === '2_muka' ? 'border-gold bg-cream shadow-sm ring-1 ring-gold' : 'border-slate-200 hover:border-gold/50 bg-white' }}">
                            <div class="flex items-center gap-3">
                                <input type="radio" wire:model.live="sideMode" value="2_muka" class="h-4 w-4 accent-gold">
                                <span class="text-xs sm:text-sm font-medium {{ $sideMode === '2_muka' ? 'text-navy font-semibold' : 'text-slate-700' }}">2 Muka (Bolak-Balik)</span>
                            </div>
                        </label>
                    </div>
                </div>
                @endif

                {{-- Dimensi Luas (Jika produk butuh perhitungan luas) --}}
                @if($product->requires_area_calculation)
                <div>
                    <label class="block text-xs font-heading font-semibold uppercase tracking-wider text-navy mb-1.5">
                        Ukuran Cetak (Meter)
                    </label>
                    @if($product->available_widths_note)
                        <p class="text-[11px] text-slate-500 mb-2.5">{{ $product->available_widths_note }}</p>
                    @endif
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <span class="block text-[11px] text-slate-600 mb-1">Panjang (m)</span>
                            <div class="relative">
                                <input type="number" step="0.1" min="0.1" wire:model.live.debounce.300ms="lengthM" placeholder="Contoh: 2"
                                       class="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-xs sm:text-sm text-navy focus:border-gold focus:outline-none focus:ring-1 focus:ring-gold">
                                <span class="absolute right-3.5 top-2.5 text-xs text-slate-400">meter</span>
                            </div>
                        </div>
                        <div>
                            <span class="block text-[11px] text-slate-600 mb-1">Lebar (m)</span>
                            <div class="relative">
                                <input type="number" step="0.1" min="0.1" wire:model.live.debounce.300ms="widthM" placeholder="Contoh: 1"
                                       class="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-xs sm:text-sm text-navy focus:border-gold focus:outline-none focus:ring-1 focus:ring-gold">
                                <span class="absolute right-3.5 top-2.5 text-xs text-slate-400">meter</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                {{-- Option Groups Dinamis --}}
                @foreach($product->optionGroups as $group)
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label class="text-xs font-heading font-semibold uppercase tracking-wider text-navy">
                            {{ $group->name }}
                        </label>
                        @if($group->is_required)
                            <span class="text-[10px] font-semibold text-red-500 uppercase tracking-wider">Wajib Dipilih</span>
                        @endif
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5">
                        @foreach($group->options as $option)
                            @php
                                $isSelected = isset($selectedOptions[$group->id]) && (int)$selectedOptions[$group->id] === (int)$option->id;
                            @endphp
                            <label class="flex items-start justify-between rounded-xl border p-3 cursor-pointer transition-all {{ $isSelected ? 'border-gold bg-cream shadow-sm ring-1 ring-gold' : 'border-slate-200 hover:border-gold/50 bg-white' }}">
                                <div class="flex items-start gap-2.5">
                                    <input type="radio"
                                           wire:model.live="selectedOptions.{{ $group->id }}"
                                           value="{{ $option->id }}"
                                           class="h-4 w-4 mt-0.5 accent-gold">
                                    <div>
                                        <span class="block text-xs sm:text-sm font-medium {{ $isSelected ? 'text-navy font-semibold' : 'text-slate-800' }}">
                                            {{ $option->name }}
                                        </span>
                                        @if($option->requires_manual_quote)
                                            <span class="inline-flex items-center gap-1 rounded bg-amber-50 px-1.5 py-0.5 text-[10px] font-medium text-amber-700 mt-1 border border-amber-200">
                                                Estimasi / Konfirmasi Admin
                                            </span>
                                        @elseif($option->price_mode === 'absolute')
                                            <span class="inline-block text-[11px] font-semibold text-gold-dark mt-0.5">
                                                Rp {{ number_format((float)$option->price_delta, 0, ',', '.') }}
                                            </span>
                                        @elseif($option->price_delta > 0)
                                            <span class="inline-block text-[11px] text-slate-500 mt-0.5">
                                                +Rp {{ number_format((float)$option->price_delta, 0, ',', '.') }}{{ $option->price_unit === 'per_length_m' ? '/m' : '' }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>
                @endforeach

                {{-- Jumlah / Kuantitas --}}
                <div class="border-t border-slate-100 pt-5">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div>
                            <label class="block text-xs font-heading font-semibold uppercase tracking-wider text-navy">
                                Jumlah ({{ $product->base_price_unit ?: 'pcs' }})
                            </label>
                            <p class="text-[11px] text-slate-500 mt-0.5">
                                Min: {{ $product->min_qty ?? 1 }} {{ $product->base_price_unit ?: 'pcs' }}
                                @if(!empty($product->qty_increment) && $product->qty_increment > 1)
                                    (kelipatan {{ $product->qty_increment }})
                                @endif
                            </p>
                        </div>
                        <div class="flex items-center gap-2">
                            <button type="button"
                                    wire:click="decrementQty"
                                    class="flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 bg-white text-navy font-bold hover:border-gold hover:bg-cream transition active:scale-95">
                                -
                            </button>
                            <input type="number"
                                   min="{{ $product->min_qty ?? 1 }}"
                                   step="{{ $product->qty_increment ?: 1 }}"
                                   wire:model.live.debounce.300ms="qty"
                                   class="w-20 text-center rounded-xl border border-slate-200 py-2 text-sm font-semibold text-navy focus:border-gold focus:outline-none focus:ring-1 focus:ring-gold">
                            <button type="button"
                                    wire:click="incrementQty"
                                    class="flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 bg-white text-navy font-bold hover:border-gold hover:bg-cream transition active:scale-95">
                                +
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Live Price Summary or Error Alert --}}
                @if($errorMessage)
                    <div class="rounded-2xl border border-red-200 bg-red-50 p-4 text-xs sm:text-sm text-red-700 flex items-start gap-3">
                        <svg class="h-5 w-5 shrink-0 text-red-500 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        <div>
                            <span class="font-semibold block mb-0.5">Konfigurasi Belum Sesuai:</span>
                            {{ $errorMessage }}
                        </div>
                    </div>
                @elseif($calculationPreview)
                    <div class="rounded-2xl border border-gold/30 bg-cream/70 p-4 sm:p-5 space-y-2.5">
                        <div class="flex items-center justify-between text-xs text-slate-600">
                            <span>Harga Satuan:</span>
                            <span class="font-medium text-navy">Rp {{ number_format((float)$calculationPreview['unit_price'], 0, ',', '.') }}</span>
                        </div>
                        <div class="flex items-center justify-between text-xs text-slate-600">
                            <span>Jumlah:</span>
                            <span class="font-medium text-navy">{{ $calculationPreview['qty'] }} {{ $product->base_price_unit ?: 'pcs' }}</span>
                        </div>
                        @if(!empty($calculationPreview['manual_quote_flag']))
                            <div class="rounded-lg bg-amber-100/70 border border-amber-300 p-2.5 text-[11px] text-amber-800">
                                <span class="font-semibold block">Item Perlu Konfirmasi:</span>
                                {{ $calculationPreview['manual_quote_note'] ?: 'Harga final akan dikonfirmasi oleh tim admin via WhatsApp.' }}
                            </div>
                        @endif
                        <div class="border-t border-gold/20 pt-2.5 flex items-center justify-between">
                            <span class="font-heading text-xs sm:text-sm font-bold text-navy uppercase tracking-wider">Subtotal:</span>
                            <span class="font-heading text-lg sm:text-xl font-bold text-navy">
                                Rp {{ number_format((float)$calculationPreview['line_subtotal'], 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                @endif
            </div>

            {{-- Footer Aksi --}}
            <div class="bg-slate-50 px-6 py-4 sm:px-8 border-t border-slate-100 flex flex-col sm:flex-row gap-3 justify-end items-stretch sm:items-center">
                <button type="button"
                        wire:click="addToCart(false)"
                        wire:loading.attr="disabled"
                        @disabled($errorMessage !== null || $calculationPreview === null)
                        class="inline-flex items-center justify-center gap-2 rounded-xl border border-navy/20 bg-white px-5 py-3 text-xs sm:text-sm font-heading font-semibold text-navy transition hover:bg-slate-100 hover:border-navy disabled:cursor-not-allowed disabled:opacity-50">
                    <svg class="h-4 w-4 text-navy" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                    <span>Tambah & Pilih Produk Lain</span>
                </button>

                <button type="button"
                        wire:click="addToCart(true)"
                        wire:loading.attr="disabled"
                        @disabled($errorMessage !== null || $calculationPreview === null)
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-navy px-6 py-3 text-xs sm:text-sm font-heading font-semibold text-cream shadow-button transition hover:bg-navy-deep hover:shadow-button-hover active:translate-y-0 disabled:cursor-not-allowed disabled:opacity-50">
                    <span>Tambah & Lanjut ke Form</span>
                    <svg class="h-4 w-4 text-gold" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </button>
            </div>
        </div>
    </div>
    @endif
</div>
