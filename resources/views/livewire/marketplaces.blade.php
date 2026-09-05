<div>
    @if($marketplaces->isNotEmpty())
        <section id="marketplaces" class="relative py-16 md:py-24 bg-gradient-to-b from-cream via-white to-cream overflow-hidden" data-aos="fade-up">
            {{-- Background decorative --}}
            <div class="absolute inset-0 z-0 pointer-events-none opacity-30">
                <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-gold/5 rounded-full blur-3xl"></div>
                <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-navy/5 rounded-full blur-3xl"></div>
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                {{-- Section Header --}}
                <div class="text-center max-w-3xl mx-auto mb-12 md:mb-16">
                    <span class="inline-flex items-center gap-2 rounded-full bg-white px-4 py-2 border border-gold/30 shadow-soft mb-4">
                        <span class="w-2 h-2 rounded-full bg-gold"></span>
                        <span class="font-heading text-xs font-semibold uppercase tracking-[0.2em] text-navy">Official Marketplace</span>
                    </span>
                    <h2 class="font-heading text-2xl md:text-4xl lg:text-5xl font-bold text-navy tracking-tight leading-tight mb-4">
                        Pesan Produk Kami via <span class="gradient-text">Official Store</span>
                    </h2>
                    <p class="text-sm md:text-base text-ink-soft max-w-2xl mx-auto">
                        Pilih platform e-commerce favorit Anda untuk pemesanan cepat, aman, dan nikmati berbagai promo eksklusif toko.
                    </p>
                </div>

                {{-- Single Marketplace - Featured --}}
                @if($marketplaces->count() === 1)
                    @php
                        $item = $marketplaces->first();
                        $platformLabel = $availablePlatforms[$item->platform] ?? ucfirst($item->platform);
                        $isActive = (bool) $item->is_active;
                    @endphp

                    <div class="max-w-3xl mx-auto">
                        <div class="group relative bg-white rounded-[2rem] border border-white/70 shadow-card overflow-hidden">
                            {{-- Top accent line --}}
                            <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-gold via-gold-light to-gold"></div>
                            
                            <div class="p-8 md:p-12">
                                {{-- Logo & Badge --}}
                                <div class="flex items-center justify-between mb-8">
                                    <div class="w-20 h-20 md:w-24 md:h-24 rounded-2xl bg-cream border-2 border-gold/20 p-4 flex items-center justify-center">
                                        @if($item->logo_url)
                                            <img src="{{ asset('storage/'.$item->logo_url) }}" alt="{{ $item->store_name }}" class="w-full h-full object-contain">
                                        @else
                                            <svg class="w-10 h-10 text-navy/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                            </svg>
                                        @endif
                                    </div>
                                    
                                    @if($isActive)
                                        <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-emerald-50 border border-emerald-200">
                                            <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                            <span class="text-sm font-semibold text-emerald-700">{{ $platformLabel }}</span>
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-amber-50 border border-amber-200">
                                            <span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span>
                                            <span class="text-sm font-semibold text-amber-700">Maintenance</span>
                                        </span>
                                    @endif
                                </div>

                                {{-- Store Name --}}
                                <h3 class="font-heading text-2xl md:text-3xl font-bold text-navy mb-4">
                                    {{ $item->store_name }}
                                </h3>

                                {{-- Status Message --}}
                                @if($isActive)
                                    <p class="text-ink-soft leading-relaxed mb-8 text-center max-w-xl mx-auto">
                                        Official store resmi {{ $platformLabel }} OMAH Vector. Nikmati transaksi aman dengan metode pembayaran terintegrasi, pengiriman cepat, dan promo eksklusif setiap harinya.
                                    </p>
                                @else
                                    <div class="bg-amber-50/80 border border-amber-200/60 rounded-2xl p-6 mb-8">
                                        <div class="flex items-start gap-3">
                                            <svg class="w-6 h-6 text-amber-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                            </svg>
                                            <div>
                                                <p class="font-heading font-semibold text-amber-900 mb-1">Toko Sedang Maintenance</p>
                                                <p class="text-sm text-amber-800 leading-relaxed">
                                                    {{ $item->maintenance_message ?: 'Toko marketplace ini sedang dalam perbaikan. Pemesanan tetap dapat dilakukan melalui website dengan respon cepat.' }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                {{-- CTA Button --}}
                                <div class="flex flex-col sm:flex-row gap-3 justify-center">
                                    @if($isActive && $item->store_url)
                                        <a href="{{ $item->store_url }}" 
                                           target="_blank" 
                                           rel="noopener noreferrer" 
                                           class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-navy hover:bg-navy-deep text-white font-heading font-semibold rounded-full transition-all duration-300 shadow-button hover:shadow-button-hover hover:-translate-y-0.5">
                                            <span>Kunjungi Toko {{ $platformLabel }}</span>
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                            </svg>
                                        </a>
                                    @else
                                        <button disabled 
                                                class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-slate-200 text-slate-400 font-heading font-semibold rounded-full cursor-not-allowed opacity-60">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                                            </svg>
                                            <span>Toko Sedang Maintenance</span>
                                        </button>
                                        
                                        <a href="{{ route('products.index') }}" 
                                           class="inline-flex items-center justify-center gap-2 px-8 py-4 border-2 border-navy text-navy hover:bg-navy hover:text-white font-heading font-semibold rounded-full transition-all duration-300">
                                            <span>Lihat Produk di Website</span>
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                            </svg>
                                        </a>
                                    @endif
                                </div>

                                {{-- Trust Badges --}}
                                @if($isActive)
                                    <div class="mt-10 pt-8 border-t border-slate-100 grid grid-cols-3 gap-4 text-center">
                                        <div>
                                            <svg class="w-8 h-8 mx-auto text-gold mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                            </svg>
                                            <p class="text-xs font-medium text-navy">Transaksi Aman</p>
                                        </div>
                                        <div>
                                            <svg class="w-8 h-8 mx-auto text-gold mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                            </svg>
                                            <p class="text-xs font-medium text-navy">Pengiriman Cepat</p>
                                        </div>
                                        <div>
                                            <svg class="w-8 h-8 mx-auto text-gold mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            <p class="text-xs font-medium text-navy">Promo Eksklusif</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                {{-- Multiple Marketplaces --}}
                @else
                    {{-- Desktop Grid --}}
                    <div class="hidden md:grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($marketplaces as $item)
                            @php
                                $platformLabel = $availablePlatforms[$item->platform] ?? ucfirst($item->platform);
                                $isActive = (bool) $item->is_active;
                            @endphp

                            <div class="group relative bg-white rounded-2xl border border-white/70 shadow-card hover:shadow-card-hover transition-all duration-300 overflow-hidden">
                                <div class="p-6">
                                    {{-- Logo & Badge --}}
                                    <div class="flex items-start justify-between mb-4">
                                        <div class="w-14 h-14 rounded-xl bg-cream border border-gold/20 p-2.5 flex items-center justify-center group-hover:scale-105 transition-transform">
                                            @if($item->logo_url)
                                                <img src="{{ asset('storage/'.$item->logo_url) }}" alt="{{ $item->store_name }}" loading="lazy" class="w-full h-full object-contain">
                                            @else
                                                <svg class="w-7 h-7 text-navy/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                                </svg>
                                            @endif
                                        </div>
                                        
                                        @if($isActive)
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 border border-emerald-200">
                                                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                                <span class="text-xs font-semibold text-emerald-700">{{ $platformLabel }}</span>
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-50 border border-amber-200">
                                                <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                                                <span class="text-xs font-semibold text-amber-700">Maintenance</span>
                                            </span>
                                        @endif
                                    </div>

                                    {{-- Store Name --}}
                                    <h3 class="font-heading text-lg font-bold text-navy mb-2">
                                        {{ $item->store_name }}
                                    </h3>

                                    {{-- Status Content --}}
                                    @if($isActive)
                                        <p class="text-sm text-ink-soft mb-6 line-clamp-2">
                                            Official store {{ $platformLabel }} OMAH Vector. Transaksi aman & terpercaya.
                                        </p>
                                    @else
                                        <div class="bg-amber-50/60 border border-amber-200/60 rounded-lg p-3 mb-6">
                                            <p class="text-xs text-amber-800 leading-relaxed">
                                                {{ $item->maintenance_message ?: 'Toko sedang maintenance. Pemesanan dapat dilakukan melalui website.' }}
                                            </p>
                                        </div>
                                    @endif

                                    {{-- CTA Buttons --}}
                                    <div class="space-y-2">
                                        @if($isActive && $item->store_url)
                                            <a href="{{ $item->store_url }}" 
                                               target="_blank" 
                                               rel="noopener noreferrer" 
                                               class="flex items-center justify-center gap-2 w-full px-4 py-3 bg-navy hover:bg-navy-deep text-white font-heading font-semibold text-sm rounded-full transition-all duration-300 shadow-button hover:shadow-button-hover">
                                                <span>Kunjungi Toko</span>
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                                </svg>
                                            </a>
                                        @else
                                            <button disabled class="flex items-center justify-center gap-2 w-full px-4 py-3 bg-slate-200 text-slate-400 font-heading font-semibold text-sm rounded-full cursor-not-allowed opacity-60">
                                                <span>Toko Maintenance</span>
                                            </button>
                                            
                                            <a href="{{ route('products.index') }}" 
                                               class="flex items-center justify-center gap-2 w-full px-4 py-2.5 border border-navy text-navy hover:bg-navy hover:text-white font-heading font-semibold text-sm rounded-full transition-all duration-300">
                                                <span>Lihat Produk</span>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Mobile Horizontal Scroll --}}
                    <div class="md:hidden -mx-4 px-4">
                        <div class="flex gap-4 overflow-x-auto snap-x snap-mandatory pb-4 scrollbar-hide" style="scrollbar-width: none; -ms-overflow-style: none;">
                            @foreach($marketplaces as $item)
                                @php
                                    $platformLabel = $availablePlatforms[$item->platform] ?? ucfirst($item->platform);
                                    $isActive = (bool) $item->is_active;
                                @endphp

                                <div class="flex-shrink-0 w-[85vw] max-w-sm snap-center">
                                    <div class="bg-white rounded-2xl border border-white/70 shadow-card p-5 h-full">
                                        {{-- Logo & Badge --}}
                                        <div class="flex items-start justify-between mb-3">
                                            <div class="w-12 h-12 rounded-lg bg-cream border border-gold/20 p-2 flex items-center justify-center">
                                                @if($item->logo_url)
                                                    <img src="{{ asset('storage/'.$item->logo_url) }}" alt="{{ $item->store_name }}" loading="lazy" class="w-full h-full object-contain">
                                                @else
                                                    <svg class="w-6 h-6 text-navy/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                                    </svg>
                                                @endif
                                            </div>
                                            
                                            @if($isActive)
                                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-emerald-50 border border-emerald-200">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                                    <span class="text-[10px] font-semibold text-emerald-700">{{ $platformLabel }}</span>
                                                </span>
                                            @else
                                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-amber-50 border border-amber-200">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                                    <span class="text-[10px] font-semibold text-amber-700">Maintenance</span>
                                                </span>
                                            @endif
                                        </div>

                                        {{-- Store Name --}}
                                        <h3 class="font-heading text-base font-bold text-navy mb-2 line-clamp-1">
                                            {{ $item->store_name }}
                                        </h3>

                                        {{-- Status --}}
                                        @if(!$isActive)
                                            <p class="text-xs text-amber-800 mb-3 line-clamp-2">
                                                {{ $item->maintenance_message ?: 'Toko sedang maintenance.' }}
                                            </p>
                                        @endif

                                        {{-- CTA --}}
                                        <div class="space-y-2 mt-3">
                                            @if($isActive && $item->store_url)
                                                <a href="{{ $item->store_url }}" 
                                                   target="_blank" 
                                                   rel="noopener noreferrer" 
                                                   class="flex items-center justify-center gap-2 w-full px-4 py-2.5 bg-navy text-white font-heading font-semibold text-sm rounded-full">
                                                    <span>Kunjungi</span>
                                                </a>
                                            @else
                                                <button disabled class="flex items-center justify-center gap-2 w-full px-4 py-2.5 bg-slate-200 text-slate-400 font-heading font-semibold text-sm rounded-full cursor-not-allowed">
                                                    <span>Maintenance</span>
                                                </button>
                                                
                                                <a href="{{ route('products.index') }}" 
                                                   class="flex items-center justify-center gap-2 w-full px-4 py-2 border border-navy text-navy font-heading font-semibold text-sm rounded-full">
                                                    <span>Lihat Produk</span>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </section>
    @endif
</div>