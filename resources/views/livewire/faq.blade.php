<section id="faq" class="relative overflow-hidden bg-cream py-12 md:py-20 lg:py-28 border-t border-gold/30">
    {{-- Subtle decorative background --}}
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-[-80px] left-[-80px] w-[280px] h-[280px] md:w-[420px] md:h-[420px] bg-gradient-to-br from-gold/10 to-transparent rounded-full blur-3xl"></div>
        <div class="absolute bottom-[-100px] right-[-80px] w-[280px] h-[280px] md:w-[380px] md:h-[380px] bg-gradient-to-tl from-navy/5 to-transparent rounded-full blur-3xl"></div>
        <div class="hidden md:block absolute bottom-[-120px] right-[-120px] h-[420px] w-[420px] rounded-full bg-[radial-gradient(circle,rgba(30,58,95,0.04),transparent_65%)] blur-3xl"></div>
    </div>

    {{-- Faint navy dot pattern --}}
    <div class="absolute inset-0 opacity-[0.03] pointer-events-none"
         style="background-image: radial-gradient(circle at 1px 1px, #0B1F2A 1px, transparent 0); background-size: 36px 36px;"></div>

    {{-- Distinct gold accent line top & bottom --}}
    <div class="absolute top-0 left-0 z-0 h-px w-full bg-gradient-to-r from-transparent via-gold/50 to-transparent pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 z-0 h-px w-full bg-gradient-to-r from-transparent via-gold/30 to-transparent pointer-events-none"></div>

    <div class="relative z-10 mx-auto px-4 md:px-6 lg:px-8 md:max-w-7xl">
        <div class="grid items-start gap-6 md:gap-8 lg:grid-cols-[0.9fr_1.5fr] xl:gap-12">
            <div class="rounded-lg md:rounded-[1.75rem] border border-white/70 bg-white p-4 md:p-8 shadow-card transition-all duration-300 hover:border-gold/40 hover:shadow-card-hover lg:sticky lg:top-6">
                <span class="inline-flex items-center gap-2 rounded-full bg-white px-3 py-1.5 md:px-4 md:py-1.5 border border-gold/30 shadow-soft">
                    <span class="w-1 h-1 md:w-1.5 md:h-1.5 rounded-full bg-gold"></span>
                    <span class="font-heading text-[10px] md:text-xs font-semibold uppercase tracking-[0.15em] md:tracking-[0.22em] text-navy">FAQ</span>
                </span>

                <h2 class="mt-4 md:mt-6 font-heading text-lg md:text-3xl lg:text-4xl xl:text-5xl font-bold tracking-tight leading-tight md:leading-[1.12] text-navy">
                    Pertanyaan yang Sering Ditanyakan
                </h2>

                <p class="mt-3 md:mt-4 font-inter text-xs md:text-base lg:text-lg leading-relaxed text-ink-soft">
                    Temukan jawaban cepat sebelum menghubungi OMH Vector untuk kebutuhan cetak, desain, atau branding bisnis Anda.
                </p>

                <div class="mt-6 md:mt-8 rounded-lg md:rounded-[1.75rem] border border-gold/30 bg-white p-4 md:p-6 shadow-card">
                    <div class="flex items-center gap-3">
                        <div class="flex h-9 w-9 md:h-10 md:w-10 items-center justify-center rounded-lg md:rounded-xl bg-gold/10 border border-gold/20 text-navy shrink-0">
                            <svg class="h-4 w-4 md:h-5 md:w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="font-heading text-[10px] md:text-sm font-semibold uppercase tracking-[0.12em] md:tracking-[0.15em] text-navy">BUTUH BANTUAN?</p>
                        </div>
                    </div>

                    <p class="mt-3 md:mt-4 text-xs md:text-sm leading-relaxed text-ink-soft">
                        Tim kami siap membantu Anda dengan jawaban yang lebih personal sesuai kebutuhan proyek Anda.
                    </p>

                    <a href="{{ $whatsappLink ?: '#' }}" target="_blank" rel="noopener noreferrer"
                       class="mt-4 md:mt-5 inline-flex items-center gap-2 rounded-full bg-navy px-4 md:px-5 py-2.5 md:py-3 text-[11px] md:text-sm font-heading md:font-semibold font-bold text-white shadow-button transition-all duration-300 hover:bg-gold hover:text-navy hover:shadow-button-hover hover:-translate-y-0.5 focus:outline-none focus-visible:ring-2 focus-visible:ring-gold/50">
                        Tanya via WhatsApp →
                        <svg class="h-3 w-3 md:h-4 md:w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>
            </div>

            <div x-data="{ openIndex: 0 }" class="space-y-3 md:space-y-4">
                @forelse($faqs as $index => $faq)
                    <div class="overflow-hidden rounded-lg md:rounded-[1.75rem] border border-white/70 bg-white shadow-card transition-all duration-300 hover:-translate-y-1 hover:border-gold/40 hover:shadow-card-hover"
                         :class="openIndex === {{ $index }} ? 'border-gold/50 shadow-card-hover' : ''">
                        <button type="button"
                                @click="openIndex = openIndex === {{ $index }} ? null : {{ $index }}"
                                :aria-expanded="openIndex === {{ $index }}"
                                aria-controls="faq-answer-{{ $faq->id }}"
                                class="flex w-full items-center justify-between gap-3 md:gap-4 px-3 md:px-6 py-3 md:py-5 text-left focus:outline-none focus-visible:ring-2 focus-visible:ring-gold/50">
                            <div class="flex items-center gap-3 md:gap-4 min-w-0">
                                <span class="flex h-8 md:h-11 w-8 md:w-11 shrink-0 items-center justify-center rounded-full border border-gold/30 bg-cream font-heading text-[10px] md:text-xs font-bold tracking-[0.18em] text-gold"
                                      :class="openIndex === {{ $index }} ? 'border-gold bg-gold text-white' : 'border-gold/30 bg-cream text-gold'">
                                    {{ str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) }}
                                </span>
                                <span class="font-heading text-xs md:text-base lg:text-lg font-semibold text-navy">
                                    {{ $faq->question }}
                                </span>
                            </div>

                            <span class="flex h-7 md:h-9 w-7 md:w-9 shrink-0 items-center justify-center rounded-full border border-gold/30 bg-cream text-navy transition-all duration-300"
                                  :class="openIndex === {{ $index }} ? 'rotate-45 border-gold bg-gold text-white' : 'border-gold/30 bg-cream text-navy'">
                                <svg class="h-3 w-3 md:h-4 md:w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16M4 12h16"/>
                                </svg>
                            </span>
                        </button>

                        <div id="faq-answer-{{ $faq->id }}"
                             x-show="openIndex === {{ $index }}"
                             x-cloak
                             x-transition:enter="transition-all ease-out duration-300"
                             x-transition:enter-start="opacity-0 -translate-y-2"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition-all ease-in duration-200"
                             x-transition:leave-start="opacity-100 translate-y-0"
                             x-transition:leave-end="opacity-0 -translate-y-2"
                             class="px-3 md:px-6 pb-3 md:pb-5">
                            <div class="border-t border-gold/30 pt-3 md:pt-4">
                                <p class="text-xs md:text-sm lg:text-base leading-relaxed text-ink-soft">
                                    {{ $faq->answer }}
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="rounded-lg md:rounded-[1.75rem] border border-dashed border-gold/30 bg-white p-6 md:p-10 text-center shadow-card">
                        <p class="text-xs md:text-sm text-ink-soft">Belum ada FAQ yang tersedia.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</section>
