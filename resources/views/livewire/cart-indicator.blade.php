<div>
    @if(!request()->routeIs('pemesanan') && $count > 0)
    <div x-data="{ open: false }"
         class="fixed bottom-6 right-6 z-40"
         @keydown.escape.window="open = false">

        {{-- Dropdown Preview Card --}}
        <div x-show="open"
             x-cloak
             @click.outside="open = false"
             x-transition:enter="transition ease-out duration-200 transform"
             x-transition:enter-start="opacity-0 translate-y-3 scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
             x-transition:leave="transition ease-in duration-150 transform"
             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
             x-transition:leave-end="opacity-0 translate-y-3 scale-95"
             class="absolute bottom-full right-0 mb-3 w-[320px] sm:w-[360px] rounded-2xl bg-white border border-navy/10 shadow-2xl overflow-hidden flex flex-col">

            {{-- Dropdown Header --}}
            <div class="px-4 py-3 bg-navy text-cream flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-gold" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                    <span class="font-heading text-xs font-bold uppercase tracking-wider">Keranjang Pesanan</span>
                    <span class="rounded-full bg-gold/20 text-gold text-[10px] font-bold px-2 py-0.5">{{ $count }} item</span>
                </div>
                <button type="button" @click="open = false" class="text-cream/70 hover:text-cream transition cursor-pointer">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            {{-- Items List --}}
            <div class="max-h-56 overflow-y-auto divide-y divide-navy/5 p-3 space-y-2">
                @foreach($items as $uuid => $item)
                    <div wire:key="cart-dropdown-item-{{ $uuid }}" class="pt-2 first:pt-0 flex items-start justify-between gap-3 text-xs">
                        <div class="min-w-0 flex-1">
                            <p class="font-bold text-navy truncate">{{ $item['product_name'] ?? 'Produk' }}</p>
                            <p class="text-[11px] text-ink-soft">
                                {{ $item['qty'] }} pcs
                                @if(!empty($item['side_mode']))
                                    • {{ $item['side_mode'] === '2_muka' ? '2 Muka' : '1 Muka' }}
                                @endif
                            </p>
                            <div class="mt-1">
                                <button type="button"
                                        @click="$dispatch('open-configurator', { productId: {{ $item['product_id'] }}, cartItemUuid: '{{ $uuid }}' })"
                                        class="text-[11px] font-medium text-navy hover:text-gold-dark transition-colors underline cursor-pointer">
                                    Ubah
                                </button>
                            </div>
                        </div>
                        <span class="font-bold text-navy shrink-0">
                            Rp {{ number_format((float)($item['line_subtotal'] ?? 0), 0, ',', '.') }}
                        </span>
                    </div>
                @endforeach
            </div>

            {{-- Dropdown Footer --}}
            <div class="p-3.5 bg-slate-50 border-t border-navy/10 space-y-3">
                <div class="flex items-center justify-between text-xs">
                    <span class="text-ink-soft font-medium">Subtotal Estimasi:</span>
                    <span class="font-heading font-bold text-sm text-navy">Rp {{ number_format((float)$subtotal, 0, ',', '.') }}</span>
                </div>
                <a href="{{ route('pemesanan') }}"
                   class="flex items-center justify-center gap-2 w-full rounded-xl bg-navy py-2.5 px-4 text-xs font-heading font-bold text-cream hover:bg-navy-deep transition shadow-button active:scale-95">
                    <span>Lanjut ke Pemesanan</span>
                    <svg class="w-3.5 h-3.5 text-gold" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>
        </div>

        {{-- Floating Trigger Button --}}
        <button type="button"
                @click="open = !open"
                aria-label="Buka Keranjang Pesanan"
                class="group relative flex items-center gap-2.5 rounded-full bg-navy p-3 sm:px-4 sm:py-3 text-cream border border-gold/40 shadow-xl transition-all duration-300 hover:bg-navy-deep hover:shadow-2xl hover:-translate-y-1 active:translate-y-0 cursor-pointer">
            {{-- Icon with Badge --}}
            <div class="relative flex items-center justify-center">
                <svg class="w-5 h-5 text-cream transition-transform duration-300 group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
                <span class="absolute -top-2.5 -right-2.5 flex h-5 w-5 items-center justify-center rounded-full bg-gold text-[10px] font-bold text-navy shadow-sm ring-2 ring-navy">
                    {{ $count }}
                </span>
            </div>

            {{-- Desktop Subtotal Display --}}
            <div class="hidden sm:flex flex-col text-left leading-tight pr-1">
                <span class="text-[9px] font-medium text-cream/70 uppercase tracking-wider">Keranjang</span>
                <span class="font-heading text-xs font-bold text-gold">Rp {{ number_format((float)$subtotal, 0, ',', '.') }}</span>
            </div>
        </button>
    </div>
    @endif
</div>
