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

<section id="testimonials" class="relative overflow-hidden bg-white">
    {{-- Single subtle background --}}
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-1/4 right-1/4 w-[400px] h-[400px] bg-gradient-to-l from-[#0B5ED7]/3 to-transparent rounded-full blur-3xl"></div>
    </div>

    <div class="max-w-7xl mx-auto px-5 md:px-6 lg:px-8 relative">
        {{-- Section Header --}}
        <div class="text-center max-w-3xl mx-auto" data-aos="fade-up">
            <span class="inline-flex items-center gap-2 rounded-full bg-[#0B5ED7]/5 px-4 py-1.5 border border-[#0B5ED7]/10 mb-6">
                <span class="w-1.5 h-1.5 rounded-full bg-[#0B5ED7]"></span>
                <span class="text-xs font-semibold uppercase tracking-[0.2em] text-[#0B5ED7]">Client Testimonials</span>
            </span>
            <h2 class="text-4xl md:text-5xl lg:text-[56px] font-bold tracking-tight text-slate-950 leading-[1.1]">Trusted by Businesses Across <span class="text-[#0B5ED7]">Indonesia</span></h2>
            <p class="mt-4 max-w-2xl mx-auto text-base lg:text-lg leading-relaxed text-slate-500">Kami bangga telah dipercaya oleh ratusan bisnis dari berbagai industri.</p>
        </div>

        {{-- Google Review Summary --}}
        <div class="mt-10 text-center" data-aos="fade-up" data-aos-delay="100">
            <div class="inline-flex items-center rounded-2xl border border-slate-100 bg-white px-10 py-6 shadow-card">
                <div class="flex flex-col items-center gap-2">
                    <div class="flex items-center gap-1 text-amber-400">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    </div>
                    <div class="text-center">
                        <p class="text-lg font-bold text-slate-950">4.9 Average Rating</p>
                        <p class="text-sm text-slate-400">Based on 980+ Happy Customers</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Testimonials Grid --}}
        <div class="mt-10 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($testimonials as $t)
            <div class="group relative rounded-2xl border border-slate-100 bg-white p-8 shadow-card transition-all duration-500 hover:-translate-y-1.5 hover:shadow-card-hover hover:border-[#0B5ED7]/20 flex flex-col"
                 data-aos="fade-up"
                 data-aos-delay="{{ $t['delay'] }}">
                {{-- Stars --}}
                <div class="flex items-center gap-1 text-amber-400">
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                </div>

                {{-- Quote --}}
                <p class="mt-4 text-sm leading-relaxed text-slate-500 flex-1">&ldquo;{{ $t['quote'] }}&rdquo;</p>

                {{-- Project Badge --}}
                <div class="mt-4">
                    <span class="inline-flex items-center gap-1.5 rounded-full bg-[#0B5ED7]/5 px-3 py-1 text-[10px] font-semibold text-[#0B5ED7] border border-[#0B5ED7]/10">
                        <span class="w-1 h-1 rounded-full bg-[#0B5ED7]"></span>
                        {{ $t['project'] }}
                    </span>
                </div>

                {{-- Profile --}}
                <div class="mt-4 pt-4 border-t border-slate-100 flex items-center gap-4">
                    <div class="relative shrink-0">
                        <img src="{{ $t['img'] }}"
                             alt="{{ $t['name'] }}"
                             class="relative h-11 w-11 rounded-full object-cover ring-2 ring-slate-100 transition-all duration-300 group-hover:ring-[#0B5ED7]/30" />
                    </div>
                    <div>
                        <p class="font-semibold text-slate-950 text-sm">{{ $t['name'] }}</p>
                        <p class="text-xs text-slate-400">{{ $t['role'] }}{{ $t['company'] !== '—' ? ', ' . $t['company'] : '' }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Bottom Trust Stats --}}
        <div class="mt-16 pt-10 border-t border-slate-100" data-aos="fade-up">
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

