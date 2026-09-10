<div>
    @if($marketplaces->isNotEmpty())
        <div id="marketplaces" class="h-full flex flex-col justify-between space-y-6">
            {{-- Marketplace Card Header --}}
            <div class="bg-white rounded-2xl border border-navy/10 p-5 md:p-6 shadow-card">
                <div class="flex items-center justify-between gap-3 mb-2">
                    <span class="inline-flex items-center gap-1.5 rounded-full bg-gold/15 px-3 py-1 border border-gold/30 text-[10px] md:text-xs font-heading font-semibold uppercase tracking-wider text-navy">
                        <span class="w-1.5 h-1.5 rounded-full bg-gold"></span>
                        Official Store
                    </span>
                    @if($marketplaces->count() > 1)
                        <span class="text-[11px] font-inter text-ink-soft inline-flex items-center gap-1">
                            <span>Geser</span>
                            <svg class="w-3.5 h-3.5 text-gold-dark" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                            </svg>
                        </span>
                    @endif
                </div>
                <h3 class="font-heading text-lg md:text-xl font-bold text-navy">
                    Pesan Produk Kami via <span class="gradient-text">Official Store</span>
                </h3>
                <p class="text-xs md:text-sm font-inter text-ink-soft mt-1">
                    Pilih platform e-commerce favorit Anda untuk pemesanan cepat, transaksi aman, dan nikmati promo eksklusif toko kami.
                </p>
            </div>

            {{-- Horizontal Native Scroll Container --}}
            <div class="w-full min-w-0">
                <div class="flex flex-nowrap overflow-x-auto pb-2 pt-1 gap-4 snap-x snap-mandatory scroll-smooth"
                     style="scrollbar-width: thin; -webkit-overflow-scrolling: touch;">
                    @foreach($marketplaces as $item)
                        @php
                            $platformLabel = $availablePlatforms[$item->platform] ?? ucfirst($item->platform);
                            $isActive = (bool) $item->is_active;
                            $cardWidthClass = $marketplaces->count() === 1 ? 'w-full' : 'w-[85%] sm:w-[280px]';
                        @endphp

                        <div class="{{ $cardWidthClass }} shrink-0 snap-start">
                            <div class="bg-white rounded-2xl border border-navy/10 p-5 shadow-card hover:shadow-card-hover transition-all duration-300 h-full flex flex-col justify-between">
                                <div>
                                    {{-- Logo & Platform Status --}}
                                    <div class="flex items-start justify-between gap-3 mb-4">
                                        <div class="w-14 h-14 rounded-xl bg-cream border border-gold/20 p-2.5 flex items-center justify-center shrink-0">
                                            @if($item->logo_url)
                                                <img src="{{ asset('storage/'.$item->logo_url) }}" alt="{{ $item->store_name }}" loading="lazy" class="w-full h-full object-contain">
                                            @else
                                                <svg class="w-7 h-7 text-navy/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                                </svg>
                                            @endif
                                        </div>

                                        @if($isActive)
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-emerald-50 border border-emerald-200">
                                                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                                <span class="text-xs font-semibold text-emerald-700">{{ $platformLabel }}</span>
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-amber-50 border border-amber-200">
                                                <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                                                <span class="text-xs font-semibold text-amber-700">Maintenance</span>
                                            </span>
                                        @endif
                                    </div>

                                    {{-- Store Name --}}
                                    <h4 class="font-heading text-base font-bold text-navy mb-1.5 line-clamp-1" title="{{ $item->store_name }}">
                                        {{ $item->store_name }}
                                    </h4>

                                    {{-- Status / Description --}}
                                    @if($isActive)
                                        <p class="text-xs font-inter text-ink-soft mb-5 line-clamp-2">
                                            Official store {{ $platformLabel }} OMAH Vector. Transaksi aman, pengiriman cepat & terpercaya.
                                        </p>
                                    @else
                                        <div class="bg-amber-50/70 border border-amber-200/70 rounded-xl p-3 mb-5">
                                            <p class="text-xs text-amber-800 leading-relaxed line-clamp-2">
                                                {{ $item->maintenance_message ?: 'Toko sedang maintenance. Pemesanan dapat dilakukan melalui website.' }}
                                            </p>
                                        </div>
                                    @endif
                                </div>

                                {{-- CTA Buttons --}}
                                <div class="space-y-2 pt-2 border-t border-navy/5">
                                    @if($isActive && $item->store_url)
                                        <a href="{{ $item->store_url }}"
                                           target="_blank"
                                           rel="noopener noreferrer"
                                           class="flex items-center justify-center gap-2 w-full px-4 py-2.5 bg-navy hover:bg-navy-deep text-white font-heading font-semibold text-xs md:text-sm rounded-xl transition-all duration-200 shadow-button hover:shadow-button-hover">
                                            <span>Kunjungi Toko</span>
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                            </svg>
                                        </a>
                                    @else
                                        <button type="button" disabled class="flex items-center justify-center gap-2 w-full px-4 py-2.5 bg-slate-200 text-slate-400 font-heading font-semibold text-xs rounded-xl cursor-not-allowed opacity-60">
                                            <span>Toko Sedang Maintenance</span>
                                        </button>

                                        <a href="{{ $whatsappUrl ?: '#' }}"
                                           target="_blank"
                                           rel="noopener noreferrer"
                                           class="flex items-center justify-center gap-2 w-full px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white font-heading font-semibold text-xs rounded-xl transition-colors shadow-sm">
                                            <span>Order via WhatsApp</span>
                                        </a>
                                        <a href="{{ route('products.index') }}"
                                           class="flex items-center justify-center gap-2 w-full px-4 py-2 border border-navy/20 text-navy hover:bg-navy hover:text-white font-heading font-semibold text-xs rounded-xl transition-colors">
                                            <span>Lihat Produk</span>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Trust Badges / Benefit strip --}}
            <div class="rounded-2xl border border-navy/10 bg-white/70 p-4 shadow-card grid grid-cols-3 gap-2 text-center">
                <div class="flex flex-col items-center">
                    <svg class="w-5 h-5 text-gold mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                    <p class="text-[11px] font-heading font-semibold text-navy">Transaksi Aman</p>
                    <p class="text-[9px] text-ink-soft">Proteksi E-Commerce</p>
                </div>
                <div class="flex flex-col items-center border-x border-navy/5 px-1">
                    <svg class="w-5 h-5 text-gold mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                    <p class="text-[11px] font-heading font-semibold text-navy">Pengiriman Cepat</p>
                    <p class="text-[9px] text-ink-soft">Kurir Terintegrasi</p>
                </div>
                <div class="flex flex-col items-center">
                    <svg class="w-5 h-5 text-gold mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="text-[11px] font-heading font-semibold text-navy">Promo Eksklusif</p>
                    <p class="text-[9px] text-ink-soft">Diskon & Cashback</p>
                </div>
            </div>
        </div>
    @endif
</div>