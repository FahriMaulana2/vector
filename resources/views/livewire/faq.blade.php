<section id="faq" class="relative overflow-hidden bg-[#F8FAFC] py-20 lg:py-28">
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute left-1/2 top-[-120px] h-[420px] w-[720px] -translate-x-1/2 rounded-full bg-[radial-gradient(ellipse_at_center,rgba(255,193,7,0.18),transparent_68%)] blur-3xl"></div>
        <div class="absolute left-[-100px] top-1/3 h-[360px] w-[360px] rounded-full bg-[radial-gradient(circle,rgba(255,193,7,0.12),transparent_60%)] blur-3xl"></div>
        <div class="absolute bottom-[-120px] right-[-120px] h-[420px] w-[420px] rounded-full bg-[radial-gradient(circle,rgba(11,30,61,0.08),transparent_65%)] blur-3xl"></div>
        <div class="absolute inset-0 opacity-[0.03]" style="background-image: radial-gradient(circle at 1px 1px, #0B1F2A 1px, transparent 0); background-size: 36px 36px;"></div>
    </div>

    <div class="relative z-10 mx-auto max-w-7xl px-5 md:px-6 lg:px-8">
        <div class="grid items-start gap-8 lg:grid-cols-[0.9fr_1.5fr] xl:gap-12">
            <div class="rounded-[1.75rem] border border-[#0B5ED7]/10 bg-white p-6 shadow-soft sm:p-8 lg:sticky lg:top-6">
                <span class="inline-flex items-center gap-2 rounded-full border border-[#FFC107]/30 bg-[#FFC107]/10 px-3 py-1.5 text-[11px] font-semibold uppercase tracking-[0.2em] text-[#0B5ED7]">
                    <span class="h-1.5 w-1.5 rounded-full bg-[#FFC107]"></span>
                    FAQ
                </span>

                <h2 class="mt-6 font-heading text-3xl font-bold leading-tight text-[#1E293B] md:text-4xl">
                    Pertanyaan yang Sering Ditanyakan
                </h2>

                <p class="mt-4 text-base leading-relaxed text-slate-600">
                    Temukan jawaban cepat sebelum menghubungi OMH Vector untuk kebutuhan cetak, desain, atau branding bisnis Anda.
                </p>

                <div class="mt-8 rounded-2xl border border-[#0B5ED7]/10 bg-[#F8FAFC] p-5">
                    <div class="flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#0B5ED7]/10 text-[#0B5ED7]">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="font-heading text-sm font-semibold uppercase tracking-[0.15em] text-[#0B5ED7]">Butuh bantuan?</p>
                        </div>
                    </div>

                    <p class="mt-4 text-sm leading-relaxed text-slate-600">
                        Tim kami siap membantu Anda dengan jawaban yang lebih personal sesuai kebutuhan proyek Anda.
                    </p>

                    <a href="{{ $whatsappLink ?: '#' }}" target="_blank" rel="noopener noreferrer"
                       class="mt-5 inline-flex items-center gap-2 rounded-full bg-[#0B5ED7] px-5 py-3 text-sm font-semibold text-white transition-all duration-300 hover:-translate-y-0.5 hover:bg-[#0B5ED7]/90 focus:outline-none focus-visible:ring-2 focus-visible:ring-[#0B5ED7]/30">
                        Tanya via WhatsApp
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>
            </div>

            <div x-data="{ openIndex: 0 }" class="space-y-4">
                @forelse($faqs as $index => $faq)
                    <div class="overflow-hidden rounded-[1.5rem] border border-slate-200 bg-white shadow-soft transition-all duration-300 hover:border-[#0B5ED7]/20 hover:shadow-md"
                         :class="openIndex === {{ $index }} ? 'border-[#0B5ED7]/30 shadow-md' : ''">
                        <button type="button"
                                @click="openIndex = openIndex === {{ $index }} ? null : {{ $index }}"
                                :aria-expanded="openIndex === {{ $index }}"
                                aria-controls="faq-answer-{{ $faq->id }}"
                                class="flex w-full items-center justify-between gap-4 px-5 py-5 text-left sm:px-6 focus:outline-none focus-visible:ring-2 focus-visible:ring-[#0B5ED7]/30">
                            <div class="flex items-center gap-4">
                                <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full border border-[#FFC107]/30 bg-[#FFC107]/10 font-heading text-xs font-bold tracking-[0.18em] text-[#0B5ED7]"
                                      :class="openIndex === {{ $index }} ? 'bg-[#FFC107] text-[#1E293B]' : ''">
                                    {{ str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) }}
                                </span>
                                <span class="font-heading text-base font-semibold text-[#1E293B] sm:text-lg">
                                    {{ $faq->question }}
                                </span>
                            </div>

                            <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full border border-slate-200 bg-slate-50 text-[#0B5ED7] transition-all duration-300"
                                  :class="openIndex === {{ $index }} ? 'rotate-45 bg-[#0B5ED7] text-white border-[#0B5ED7]' : ''">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2" aria-hidden="true">
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
                             class="px-5 pb-5 sm:px-6">
                            <div class="border-t border-slate-200 pt-4">
                                <p class="text-sm leading-relaxed text-slate-600 sm:text-base">
                                    {{ $faq->answer }}
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="rounded-[1.5rem] border border-dashed border-slate-300 bg-white p-10 text-center shadow-soft">
                        <p class="text-sm text-slate-600">Belum ada FAQ yang tersedia.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</section>
