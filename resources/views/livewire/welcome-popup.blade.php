<div>
    @if($campaign && $campaign->cta_final_url)
        <div x-data="{
                showModal: false,
                showImage: false,
                campaignId: {{ $campaign->id }},
                ctaUrl: '{{ $campaign->cta_final_url }}',
                initPopup() {
                    const key = 'omh_popup_seen_' + this.campaignId;
                    const lastSeen = localStorage.getItem(key);
                    if (lastSeen) {
                        const elapsed = Date.now() - parseInt(lastSeen, 10);
                        if (elapsed < 120 * 60 * 1000) {
                            return;
                        }
                    }
                    setTimeout(() => {
                        this.showModal = true;
                        $wire.recordView();
                        setTimeout(() => { this.showImage = true; }, 100);
                    }, 1500);
                },
                closeModal() {
                    this.showModal = false;
                    localStorage.setItem('omh_popup_seen_' + this.campaignId, Date.now().toString());
                },
                handleCtaClick() {
                    $wire.recordClick();
                    this.closeModal();
                    if (this.ctaUrl && this.ctaUrl !== '#') {
                        window.open(this.ctaUrl, '_blank', 'noopener,noreferrer');
                    }
                }
             }"
             x-init="initPopup()"
             @keydown.escape.window="closeModal()"
             x-show="showModal"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6 overflow-y-auto"
             style="display: none;"
             role="dialog"
             aria-modal="true"
             aria-labelledby="popup-title">

            {{-- Modal Backdrop --}}
            <div class="fixed inset-0 bg-slate-950/70 backdrop-blur-sm transition-opacity" @click="closeModal()"></div>

            {{-- Modal Box Container --}}
            <div class="relative w-full max-w-lg bg-white rounded-3xl shadow-2xl overflow-hidden border border-slate-100 z-10 transform transition-all"
                 x-show="showModal"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95 translateY-4"
                 x-transition:enter-end="opacity-100 scale-100 translateY-0">

                {{-- Close Button (Accessible 44x44px target) --}}
                <button type="button" 
                        @click="closeModal()" 
                        aria-label="Tutup Popup"
                        class="absolute top-3 right-3 z-20 w-11 h-11 flex items-center justify-center rounded-full bg-slate-900/50 hover:bg-slate-900/80 text-white transition-colors cursor-pointer shadow-md focus:outline-none focus:ring-2 focus:ring-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>

                {{-- Campaign Image (Conditional rendering on imageLoaded) --}}
                @if($campaign->image_path)
                    <div class="relative w-full h-48 sm:h-56 bg-slate-100 overflow-hidden">
                        <template x-if="showImage">
                            <img src="{{ asset('storage/'.$campaign->image_path) }}" 
                                 alt="{{ $campaign->title }}" 
                                 loading="lazy" 
                                 decoding="async" 
                                 class="w-full h-full object-cover">
                        </template>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>

                        {{-- Template Type Badge Over Overlay --}}
                        <div class="absolute bottom-3 left-4">
                            @if($campaign->template_type === 'code_flash_sale')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-amber-500 text-slate-900 shadow-md">
                                    <span>⚡ FLASH SALE</span>
                                </span>
                            @elseif($campaign->template_type === 'code_welcome')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-[#D6A83D] text-[#173B6C] shadow-md">
                                    <span>🎁 PROMO EKSKLUSIF</span>
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-[#173B6C] text-white shadow-md">
                                    <span>✨ OMAH VECTOR</span>
                                </span>
                            @endif
                        </div>
                    </div>
                @endif

                {{-- Campaign Content Body --}}
                <div class="p-6 sm:p-8">
                    @if(!$campaign->image_path)
                        <div class="mb-4">
                            @if($campaign->template_type === 'code_flash_sale')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-800 border border-amber-200">
                                    <span>⚡ FLASH SALE</span>
                                </span>
                            @elseif($campaign->template_type === 'code_welcome')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-amber-50 text-[#173B6C] border border-amber-200">
                                    <span>🎁 PROMO EKSKLUSIF</span>
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-[#173B6C]/10 text-[#173B6C] border border-[#173B6C]/20">
                                    <span>✨ OMAH VECTOR</span>
                                </span>
                            @endif
                        </div>
                    @endif

                    <h3 id="popup-title" class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight leading-snug mb-3">
                        {{ $campaign->title }}
                    </h3>

                    <p class="text-sm text-slate-600 leading-relaxed mb-6">
                        {{ $campaign->description }}
                    </p>

                    {{-- Smart Sync Fallback Toast Notification --}}
                    @if($campaign->is_cta_fallback_active)
                        <div class="p-3.5 bg-amber-50 border border-amber-200/90 rounded-2xl mb-6 text-xs text-amber-800 flex items-start gap-2.5 shadow-sm">
                            <svg class="w-4 h-4 text-amber-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div class="leading-relaxed">
                                <strong class="font-semibold block">Toko Marketplace Sedang Maintenance</strong>
                                <span>Toko tujuan sedang perbaikan. Anda akan diarahkan langsung ke WhatsApp Official Admin untuk konsultasi & order.</span>
                            </div>
                        </div>
                    @endif

                    {{-- Action CTA Button --}}
                    <div class="space-y-3">
                        <button type="button" 
                                @click="handleCtaClick()" 
                                class="w-full inline-flex items-center justify-center gap-2.5 px-6 py-3.5 bg-[#173B6C] hover:bg-[#1E4F91] text-white font-bold text-sm sm:text-base rounded-2xl transition-all shadow-lg shadow-[#173B6C]/25 hover:shadow-xl hover:-translate-y-0.5 cursor-pointer">
                            <span>{{ $campaign->cta_text }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </button>

                        <button type="button" 
                                @click="closeModal()" 
                                class="w-full text-center text-xs font-medium text-slate-400 hover:text-slate-600 py-1 transition-colors">
                            Nanti Saja
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
