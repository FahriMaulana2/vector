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

<section id="testimonials" class="relative overflow-hidden bg-[#F8FAFC] py-20 lg:py-24">
    {{-- Subtle decorative background --}}
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-[-80px] right-[-80px] w-[420px] h-[420px] bg-gradient-to-bl from-[#0B5ED7]/6 to-transparent rounded-full blur-3xl"></div>
        <div class="absolute bottom-[-100px] left-[-80px] w-[380px] h-[380px] bg-gradient-to-tr from-[#FBBF24]/5 to-transparent rounded-full blur-3xl"></div>
    </div>

    {{-- Faint dot pattern --}}
    <div class="absolute inset-0 opacity-[0.03] pointer-events-none"
         style="background-image: radial-gradient(circle at 1px 1px, #0B5ED7 1px, transparent 0); background-size: 36px 36px;"></div>

<div class="max-w-7xl mx-auto px-5 md:px-6 lg:px-8 relative z-10">
        {{-- Section Header --}}
        <div class="text-center max-w-3xl mx-auto" data-aos="fade-up">
            <span class="inline-flex items-center gap-2 rounded-full bg-white border border-[#0B5ED7]/10 px-4 py-1.5 mb-6 shadow-soft">
                <span class="w-1.5 h-1.5 rounded-full bg-[#F59E0B]"></span>
                <span class="text-xs font-semibold uppercase tracking-[0.2em] text-[#0B5ED7]">Client Testimonials</span>
            </span>
            <h2 class="text-4xl md:text-5xl lg:text-[52px] font-bold tracking-tight text-[#0B1E3D] leading-[1.1]">Trusted by Businesses Across <span class="text-[#0B5ED7]">Indonesia</span></h2>
            <p class="mt-4 max-w-2xl mx-auto text-base lg:text-lg leading-relaxed text-slate-500">Kami bangga telah dipercaya oleh ratusan bisnis dari berbagai industri.</p>
        </div>

        {{-- Google Review Summary (preserved) --}}
        <div class="mt-10 text-center" data-aos="fade-up" data-aos-delay="100">
            <div class="inline-flex flex-col sm:flex-row items-center gap-4 sm:gap-6 rounded-2xl border border-slate-100 bg-white px-8 sm:px-10 py-6 shadow-card">
                <div class="flex items-center gap-1 text-[#FBBF24]">
                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                </div>
                <div class="text-center sm:text-left">
                    <p class="text-lg font-bold text-[#0B1E3D]">4.9 Average Rating</p>
                    <p class="text-sm text-slate-400">Based on 980+ Happy Customers</p>
                </div>
            </div>
        </div>

        {{-- Testimonials Grid --}}
        <div class="mt-10 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($testimonials as $t)
            <div class="group relative flex flex-col rounded-3xl border border-slate-100 bg-white p-8 shadow-card transition-all duration-300 hover:-translate-y-1.5 hover:shadow-card-hover hover:border-[#0B5ED7]/20"
                 data-aos="fade-up"
                 data-aos-delay="{{ $t['delay'] }}">

                {{-- Quotation mark (decorative, behind) --}}
                <svg class="absolute top-6 right-6 w-16 h-16 opacity-[0.08] text-[#0B5ED7] pointer-events-none" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>

                <div class="flex flex-col flex-1">
                    {{-- Stars --}}
                    <div class="flex items-center gap-1 text-[#FBBF24]">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    </div>

                    {{-- Quote --}}
                    <p class="mt-4 text-sm leading-relaxed text-slate-500 flex-1">&ldquo;{{ $t['quote'] }}&rdquo;</p>

                    {{-- Project Badge --}}
                    <div class="mt-5">
                        <span class="inline-flex items-center gap-1.5 rounded-full bg-[#0B5ED7]/5 px-3 py-1 text-[10px] font-semibold text-[#0B5ED7] border border-[#0B5ED7]/10">
                            <span class="w-1 h-1 rounded-full bg-[#F59E0B]"></span>
                            {{ $t['project'] }}
                        </span>
                    </div>

                    {{-- Profile --}}
                    <div class="mt-5 pt-5 border-t border-slate-100 flex items-center gap-4">
                        <div class="relative shrink-0">
                            <img src="{{ $t['img'] }}"
                                 alt="{{ $t['name'] }}"
                                 class="relative h-12 w-12 rounded-full object-cover ring-2 ring-white shadow-soft transition-transform duration-300 group-hover:scale-105" />
                            {{-- Gold verification accent --}}
                            <span class="absolute bottom-0 right-0 h-3 w-3 rounded-full bg-[#FBBF24] ring-2 ring-white"></span>
                        </div>
                        <div>
                            <p class="font-bold text-[#0B1E3D]">{{ $t['name'] }}</p>
                            <p class="text-xs text-slate-400">{{ $t['role'] }}{{ $t['company'] !== '—' ? ', ' . $t['company'] : '' }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Bottom Trust Stats (preserved) --}}
        <div class="mt-16 pt-10 border-t border-slate-200/70" data-aos="fade-up">
            <div class="grid grid-cols-2 gap-8 sm:grid-cols-4">
                <div class="text-center">
                    <p class="text-3xl sm:text-4xl font-bold text-[#0B5ED7]">980+</p>
                    <p class="mt-2 text-xs text-slate-400 uppercase tracking-wider font-semibold">Satisfied Clients</p>
                </div>
                <div class="text-center">
                    <p class="text-3xl sm:text-4xl font-bold text-[#0B5ED7]">1.250+</p>
                    <p class="mt-2 text-xs text-slate-400 uppercase tracking-wider font-semibold">Completed Projects</p>
                </div>
                <div class="text-center">
                    <p class="text-3xl sm:text-4xl font-bold text-[#0B5ED7]">99%</p>
                    <p class="mt-2 text-xs text-slate-400 uppercase tracking-wider font-semibold">On-Time Delivery</p>
                </div>
                <div class="text-center">
                    <p class="text-3xl sm:text-4xl font-bold text-[#0B5ED7]">6+</p>
                    <p class="mt-2 text-xs text-slate-400 uppercase tracking-wider font-semibold">Years Experience</p>
                </div>
            </div>
        </div>
    </div>
</section>
