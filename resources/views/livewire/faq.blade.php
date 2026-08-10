<section id="faq" class="relative overflow-hidden bg-cream py-20 lg:py-28">
    {{-- ============================================================
         Premium Layered Background
         Soft radial gradients + blurred golden glow + dotted pattern
         + subtle curved line + floating abstract shapes
    ============================================================ --}}
    <div class="absolute inset-0 pointer-events-none">
        {{-- Soft radial gradient wash (top) --}}
        <div class="absolute top-[-120px] left-1/2 -translate-x-1/2 w-[720px] h-[420px] bg-[radial-gradient(ellipse_at_center,rgba(212,166,58,0.14),transparent_65%)] rounded-full blur-3xl"></div>

        {{-- Warm cream radial glow (center) --}}
        <div class="absolute top-1/3 left-[-140px] w-[480px] h-[480px] bg-[radial-gradient(circle,rgba(212,166,58,0.10),transparent_60%)] rounded-full blur-3xl"></div>
        <div class="absolute bottom-[-120px] right-[-120px] w-[520px] h-[520px] bg-[radial-gradient(circle,rgba(11,30,61,0.08),transparent_62%)] rounded-full blur-3xl"></div>

        {{-- Blurred golden glow orb (floating) --}}
        <div class="absolute top-[15%] right-[8%] w-40 h-40 rounded-full bg-gold/20 blur-[70px] animate-float-subtle"></div>
        <div class="absolute bottom-[18%] left-[6%] w-32 h-32 rounded-full bg-gold/15 blur-[60px] animate-float-subtle" style="animation-delay: 1.5s;"></div>

        {{-- Faint navy dot pattern --}}
        <div class="absolute inset-0 opacity-[0.03] pointer-events-none"
             style="background-image: radial-gradient(circle at 1px 1px, #0B1F2A 1px, transparent 0); background-size: 36px 36px;"></div>

        {{-- Subtle curved line decoration (top right) --}}
        <svg class="absolute top-10 right-0 w-48 h-48 text-gold/10 lg:w-64 lg:h-64" viewBox="0 0 200 200" fill="none" aria-hidden="true">
            <path d="M190 10 C 120 40, 60 120, 150 190" stroke="currentColor" stroke-width="1.5" fill="none" stroke-dasharray="4 6"/>
            <path d="M170 10 C 110 50, 70 130, 140 185" stroke="currentColor" stroke-width="1" fill="none" stroke-dasharray="2 6"/>
        </svg>

        {{-- Subtle curved line decoration (bottom left) --}}
        <svg class="absolute bottom-10 left-0 w-44 h-44 text-navy/10 lg:w-60 lg:h-60 rotate-180" viewBox="0 0 200 200" fill="none" aria-hidden="true">
            <path d="M190 10 C 120 40, 60 120, 150 190" stroke="currentColor" stroke-width="1.5" fill="none" stroke-dasharray="4 6"/>
        </svg>

        {{-- Floating abstract ring shapes --}}
        <div class="absolute top-[28%] left-[4%] lg:left-[8%] w-16 h-16 rounded-full border border-gold/20 animate-float-subtle hidden md:block"></div>
        <div class="absolute top-[62%] right-[5%] lg:right-[10%] w-10 h-10 rounded-lg border border-gold/20 rotate-12 animate-float-subtle hidden md:block" style="animation-delay: 2.2s;"></div>
        <div class="absolute bottom-[30%] right-[16%] w-6 h-6 rounded-full bg-gold/20 animate-float-subtle hidden md:block" style="animation-delay: 0.8s;"></div>
    </div>

    {{-- Thin gold accent line top --}}
    <div class="absolute top-0 left-0 z-0 h-px w-full bg-gradient-to-r from-transparent via-gold/40 to-transparent pointer-events-none"></div>

    <div class="relative z-10 mx-auto w-full max-w-4xl px-5 md:px-6 lg:px-8">
        {{-- ============================ Section Header ============================ --}}
        <div class="text-center max-w-3xl mx-auto" data-aos="fade-up">
            <span class="inline-flex items-center gap-2 rounded-full bg-white px-4 py-1.5 border border-gold/30 shadow-soft">
                <span class="w-1.5 h-1.5 rounded-full bg-gold"></span>
                <span class="font-heading text-xs font-semibold uppercase tracking-[0.22em] text-navy">FAQ</span>
            </span>
            <h2 class="font-heading mt-6 text-3xl md:text-4xl lg:text-5xl font-bold tracking-tight text-navy leading-[1.12]">Pertanyaan yang <span class="gradient-text">Sering Diajukan</span></h2>
            <p class="mt-4 max-w-2xl mx-auto text-base lg:text-lg font-inter leading-relaxed text-ink-soft">Temukan jawaban atas pertanyaan seputar produk, proses pengerjaan, dan layanan OMH Vector.</p>
        </div>

        {{-- ============================ FAQ Accordion Container ============================ --}}
        <div class="mt-14 rounded-3xl border border-gold/20 bg-white/70 backdrop-blur-sm p-5 sm:p-8 shadow-card-hover"
             data-aos="fade-up" data-aos-delay="100">
            <div class="space-y-4">
                @forelse($faqs as $index => $faq)
                <div x-data="{ open: {{ $index === 0 ? 'true' : 'false' }} }"
                     :class="open ? 'border-gold/40 shadow-card-hover' : 'border-transparent hover:border-gold/30 shadow-soft'"
                     class="group overflow-hidden rounded-2xl border bg-white p-6 transition-all duration-300 hover:-translate-y-0.5 hover:shadow-card-hover">

                    {{-- Question --}}
                    <button type="button"
                            @click="open = !open"
                            :aria-expanded="open"
                            class="flex w-full items-center justify-between gap-4 text-left focus:outline-none focus-visible:ring-2 focus-visible:ring-gold/40">
                        <span class="flex items-center gap-4">
                            <span :class="open ? 'bg-gold text-navy' : 'bg-cream text-gold-dark border border-gold/20'"
                                  class="flex h-11 w-11 flex-shrink-0 items-center justify-center rounded-full transition-all duration-300">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </span>
                            <span :class="open ? 'text-navy' : 'text-navy/90'"
                                  class="font-heading text-base font-semibold lg:text-lg transition-colors duration-300">{{ $faq->question }}</span>
                        </span>
                        <span :class="open ? 'rotate-180 bg-gold text-navy' : 'bg-cream text-gold-dark border border-gold/20'"
                              class="flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-full transition-all duration-300">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </span>
                    </button>

                    {{-- Answer (animated) --}}
                    <div x-show="open"
                         x-cloak
                         x-transition:enter="transition-all duration-300 ease-out"
                         x-transition:enter-start="opacity-0 -translate-y-2"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition-all duration-200 ease-in"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 -translate-y-2">
                        <div class="mt-5 pl-[60px] border-t border-gold/10 pt-5">
                            <p class="text-sm font-inter leading-relaxed text-ink-soft lg:text-base">{{ $faq->answer }}</p>
                            <div class="mt-4 h-0.5 w-10 rounded-full bg-gold/40"></div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="rounded-2xl border border-gold/15 bg-white p-10 text-center shadow-soft">
                    <svg class="mx-auto h-14 w-14 text-gold/40" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="mt-4 text-sm font-medium text-ink-soft">Belum ada pertanyaan yang tersedia.</p>
                </div>
                @endforelse
            </div>
        </div>

        {{-- ============================ Bottom CTA Panel ============================ --}}
        <div class="relative mt-14 overflow-hidden rounded-t-3xl bg-[#0B1E3D] text-cream shadow-card-hover" data-aos="fade-up" data-aos-delay="150">
            {{-- Navy panel decorations --}}
            <div class="absolute inset-0 pointer-events-none">
                <div class="absolute top-[-80px] right-[-60px] w-[320px] h-[320px] rounded-full bg-gold/15 blur-3xl"></div>
                <div class="absolute bottom-[-80px] left-[-60px] w-[280px] h-[280px] rounded-full bg-gold/10 blur-3xl"></div>
                <div class="absolute inset-0 opacity-[0.04] pointer-events-none"
                     style="background-image: radial-gradient(circle at 1px 1px, #ffffff 1px, transparent 0); background-size: 32px 32px;"></div>
                <div class="absolute top-0 left-0 h-px w-full bg-gradient-to-r from-transparent via-gold/50 to-transparent"></div>
            </div>

            <div class="relative flex flex-col lg:flex-row items-center justify-between gap-8 p-8 sm:p-10 lg:p-12">
                {{-- Left: Content --}}
                <div class="text-center lg:text-left max-w-xl">
                    <span class="inline-flex items-center gap-2 rounded-full bg-white/[0.06] px-4 py-1.5 border border-gold/25">
                        <span class="w-1.5 h-1.5 rounded-full bg-gold"></span>
                        <span class="font-heading text-xs font-semibold uppercase tracking-[0.22em] text-gold">Hubungi Kami</span>
                    </span>
                    <h3 class="font-heading mt-5 text-2xl lg:text-3xl font-bold leading-tight text-cream">Punya pertanyaan lain?<br /><span class="gradient-text">Kami siap membantu Anda</span></h3>
                    <p class="mt-4 text-sm font-inter leading-relaxed text-cream/60">Jika pertanyaan Anda belum terjawab,<br class="hidden sm:block" /> silakan hubungi tim kami melalui WhatsApp.</p>
                </div>

                {{-- Right: WhatsApp Button --}}
                <div class="flex-shrink-0">
                    <a href="https://wa.me/6281234567890" target="_blank"
                       class="group inline-flex items-center justify-center gap-3 rounded-full bg-gold px-8 py-4 text-sm font-heading font-semibold text-navy shadow-button transition-all duration-300 hover:bg-gold-dark hover:text-white hover:shadow-button-hover hover:-translate-y-0.5 active:translate-y-0">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                        <span>Hubungi via WhatsApp</span>
                        <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
