<?php
$testimonials = [
    [
        'img' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=200&q=80',
        'name' => 'Andi Pratama',
        'role' => 'Owner',
        'company' => 'Kopi Nusantara',
        'project' => 'Cafe Branding',
        'quote' => 'Pelayanannya sangat cepat dan hasil cetaknya benar-benar berkualitas. Tim OMH Vector juga membantu memberikan masukan desain sehingga branding usaha kami terlihat jauh lebih profesional.',
        'delay' => 100,
    ],
    [
        'img' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=200&q=80',
        'name' => 'Sinta Lestari',
        'role' => 'Wedding Organizer',
        'company' => '—',
        'project' => 'Wedding Invitation',
        'quote' => 'Hasil undangan sesuai ekspektasi bahkan lebih baik dari desain awal. Warna tajam, finishing rapi, dan pengerjaan selesai tepat waktu.',
        'delay' => 200,
    ],
    [
        'img' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=crop&w=200&q=80',
        'name' => 'Budi Santoso',
        'role' => 'UMKM Owner',
        'company' => '—',
        'project' => 'Packaging Design',
        'quote' => 'Kemasan produk kami sekarang terlihat jauh lebih premium. Banyak pelanggan memberikan respon positif setelah menggunakan desain baru dari OMH Vector.',
        'delay' => 300,
    ],
];
?>

<section id="testimonials" class="relative overflow-hidden bg-light py-20 lg:py-28">
    {{-- Subtle decorative background --}}
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-[-80px] right-[-80px] w-[420px] h-[420px] bg-gradient-to-bl from-gold/10 to-transparent rounded-full blur-3xl"></div>
        <div class="absolute bottom-[-100px] left-[-80px] w-[380px] h-[380px] bg-gradient-to-tr from-navy/5 to-transparent rounded-full blur-3xl"></div>
    </div>

    {{-- Faint navy dot pattern --}}
    <div class="absolute inset-0 opacity-[0.03] pointer-events-none"
         style="background-image: radial-gradient(circle at 1px 1px, #0B1F2A 1px, transparent 0); background-size: 36px 36px;"></div>

    {{-- Thin gold accent line top --}}
    <div class="absolute top-0 left-0 z-0 h-px w-full bg-gradient-to-r from-transparent via-gold/30 to-transparent pointer-events-none"></div>

<div class="max-w-7xl mx-auto px-5 md:px-6 lg:px-8 relative z-10">
        {{-- Section Header --}}
        <div class="text-center max-w-3xl mx-auto" data-aos="fade-up">
            <span class="inline-flex items-center gap-2 rounded-full bg-white px-4 py-1.5 border border-gold/30 shadow-soft">
                <span class="w-1.5 h-1.5 rounded-full bg-gold"></span>
                <span class="font-heading text-xs font-semibold uppercase tracking-[0.22em] text-navy">Testimoni Pelanggan</span>
            </span>
            <h2 class="font-heading mt-6 text-3xl md:text-4xl lg:text-5xl font-bold tracking-tight text-navy leading-[1.12]">Kepercayaan Pelanggan adalah <span class="gradient-text">Kebanggaan Kami</span></h2>
            <p class="mt-4 max-w-2xl mx-auto text-base lg:text-lg font-inter leading-relaxed text-ink-soft">Berbagai pengalaman positif dari pelanggan yang telah mempercayakan kebutuhan digital printing, branding, dan kreativitas mereka kepada OMH Vector.</p>
        </div>

        {{-- Google Review Summary (preserved) --}}
        <div class="mt-12 text-center" data-aos="fade-up" data-aos-delay="100">
            <div class="inline-flex flex-col sm:flex-row items-center gap-4 sm:gap-6 rounded-full bg-white border border-gold/20 px-8 sm:px-10 py-4 shadow-card">
                <div class="flex items-center gap-1 text-gold" role="img" aria-label="Rating 4.9 dari 5">
                    @for($i = 0; $i < 5; $i++)
                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    @endfor
                </div>
                <div class="text-center sm:text-left">
                    <p class="font-heading text-lg font-bold text-navy">4.9 Average Rating</p>
                    <p class="text-sm font-inter text-ink-soft">Based on 980+ Happy Customers</p>
                </div>
            </div>
        </div>

        {{-- Testimonials Grid --}}
        <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($testimonials as $index => $t)
            <div class="group relative flex flex-col overflow-hidden rounded-[1.75rem] border bg-white p-8 shadow-card transition-all duration-300 hover:-translate-y-1 hover:shadow-card-hover {{ $index === 1 ? 'border-gold/30' : 'border-white/70' }} hover:border-gold/40"
                 data-aos="fade-up"
                 data-aos-delay="{{ $t['delay'] }}">

                {{-- Thin gold accent line at top --}}
                <div class="absolute top-0 left-0 h-1 w-10 rounded-br-full bg-gradient-to-r from-gold to-gold-light transition-all duration-300 group-hover:w-16"></div>

                {{-- Refined quotation mark (decorative, behind) --}}
                <svg class="absolute top-8 right-6 w-10 h-10 text-gold opacity-[0.18] pointer-events-none" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>

                <div class="relative flex flex-col flex-1">
                    {{-- Customer profile area (top) --}}
                    <div class="flex items-center gap-4">
                        <div class="relative shrink-0">
                            @if(!empty($t['img']))
                            <img src="{{ $t['img'] }}"
                                 alt="{{ $t['name'] }}"
                                 onerror="this.style.display='none'; this.parentElement.classList.add('has-avatar-fallback');"
                                 class="relative h-14 w-14 rounded-full object-cover ring-2 ring-gold/40 shadow-soft transition-transform duration-300 group-hover:scale-[1.03]" />
                            <div class="absolute inset-0 hidden items-center justify-center rounded-full bg-navy-deep ring-2 ring-gold/40 avatar-fallback">
                                <span class="font-heading text-sm font-bold text-gold">{{ collect(explode(' ', $t['name']))->map(fn($w) => mb_substr($w, 0, 1))->take(2)->implode('') }}</span>
                            </div>
                            @else
                            <div class="flex h-14 w-14 items-center justify-center rounded-full bg-navy-deep ring-2 ring-gold/40">
                                <span class="font-heading text-sm font-bold text-gold">{{ collect(explode(' ', $t['name']))->map(fn($w) => mb_substr($w, 0, 1))->take(2)->implode('') }}</span>
                            </div>
                            @endif
                        </div>
                        <div class="min-w-0">
                            <p class="font-heading font-bold text-navy truncate">{{ $t['name'] }}</p>
                            <p class="text-xs font-inter text-ink-soft">{{ $t['role'] }}{{ $t['company'] !== '—' ? ', ' . $t['company'] : '' }}</p>
                        </div>
                    </div>

                    {{-- Rating (gold stars) --}}
                    <div class="mt-5 flex items-center gap-1 text-gold" role="img" aria-label="Rating bintang 5 dari 5">
                        @for($i = 0; $i < 5; $i++)
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        @endfor
                    </div>

                    {{-- Review content --}}
                    <p class="mt-4 text-sm font-inter leading-relaxed text-ink-soft flex-1">&ldquo;{{ $t['quote'] }}&rdquo;</p>

                    {{-- Project badge (preserved) --}}
                    <div class="mt-5">
                        <span class="inline-flex items-center gap-1.5 rounded-full bg-gold/10 px-3 py-1 text-[10px] font-heading font-semibold text-gold-dark border border-gold/20">
                            <span class="w-1 h-1 rounded-full bg-gold"></span>
                            {{ $t['project'] }}
                        </span>
                    </div>

                    {{-- Card footer (subtle trust divider) --}}
                    <div class="mt-5 pt-5 border-t border-navy/10 flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-gold"></span>
                        <span class="text-[11px] font-inter font-medium text-ink-soft">Pengalaman pelanggan OMH Vector</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Bottom Trust Stats (preserved) --}}
        <div class="mt-16 pt-10 border-t border-navy/10" data-aos="fade-up">
            <div class="grid grid-cols-2 gap-8 sm:grid-cols-4">
                <div class="text-center">
                    <p class="font-heading text-3xl sm:text-4xl font-bold text-navy">980+</p>
                    <p class="mt-2 text-xs font-inter text-ink-soft uppercase tracking-wider font-semibold">Satisfied Clients</p>
                </div>
                <div class="text-center">
                    <p class="font-heading text-3xl sm:text-4xl font-bold text-navy">1.250+</p>
                    <p class="mt-2 text-xs font-inter text-ink-soft uppercase tracking-wider font-semibold">Completed Projects</p>
                </div>
                <div class="text-center">
                    <p class="font-heading text-3xl sm:text-4xl font-bold text-navy">99%</p>
                    <p class="mt-2 text-xs font-inter text-ink-soft uppercase tracking-wider font-semibold">On-Time Delivery</p>
                </div>
                <div class="text-center">
                    <p class="font-heading text-3xl sm:text-4xl font-bold text-gold">6+</p>
                    <p class="mt-2 text-xs font-inter text-ink-soft uppercase tracking-wider font-semibold">Years Experience</p>
                </div>
            </div>
        </div>
    </div>
</section>
