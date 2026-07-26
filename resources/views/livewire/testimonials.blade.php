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

<section id="testimonials" class="relative overflow-hidden bg-white py-28 lg:py-32">
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-1/4 right-1/4 w-[400px] h-[400px] bg-gradient-to-l from-[#0B5ED7]/4 to-transparent rounded-full blur-3xl"></div>
        <div class="absolute bottom-1/3 left-1/3 w-[350px] h-[350px] bg-gradient-to-r from-[#FFC107]/4 to-transparent rounded-full blur-3xl"></div>
    </div>

    <div class="max-w-7xl mx-auto px-6 lg:px-8 relative">
        {{-- Section Header --}}
        <div class="text-center max-w-3xl mx-auto" data-aos="fade-up">
            <div class="inline-flex items-center gap-3 rounded-full bg-[#0B5ED7]/5 px-5 py-2 border border-[#0B5ED7]/10 mb-6">
                <span class="w-1.5 h-1.5 rounded-full bg-[#0B5ED7]"></span>
                <span class="text-sm font-semibold uppercase tracking-[0.2em] text-[#0B5ED7]">Client Testimonials</span>
            </div>
            <h2 class="text-4xl font-bold tracking-tight text-slate-950 sm:text-5xl leading-[1.15]">Trusted by Businesses Across <span class="gradient-text">Indonesia</span></h2>
            <p class="mt-5 text-lg leading-relaxed text-slate-500">Kami bangga telah dipercaya oleh ratusan bisnis dari berbagai industri.</p>
        </div>

        {{-- Google Review Summary --}}
        <div class="mt-12 text-center" data-aos="fade-up" data-aos-delay="100">
            <div class="inline-flex items-center rounded-[1.5rem] border border-slate-100 bg-white px-10 py-6 shadow-premium-lg">
                <div class="flex flex-col items-center gap-2">
                    <div class="flex items-center gap-1.5 text-[#FFC107]">
                        <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    </div>
                    <div class="text-center">
                        <p class="text-lg font-bold text-slate-950">4.9 Average Rating</p>
                        <p class="text-sm text-slate-400">Based on 980+ Happy Customers</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Testimonials Grid --}}
        <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($testimonials as $t)
            <div class="group relative rounded-[1.5rem] border border-slate-100 bg-white p-8 shadow-premium transition-all duration-500 hover:-translate-y-2 hover:shadow-premium-xl hover:border-[#0B5ED7]/20 flex flex-col"
                 data-aos="fade-up"
                 data-aos-delay="{{ $t['delay'] }}">
                {{-- Quote Icon Decorative --}}
                <div class="absolute top-6 right-6 text-[#0B5ED7]/5 select-none pointer-events-none">
                    <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.637-3.995 5.849h4v10H14.017zM0 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151C7.546 6.068 5.983 8.788 5.983 11H10v10H0z"/></svg>
                </div>

                {{-- Stars --}}
                <div class="flex items-center gap-1 text-[#FFC107]">
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                </div>

                {{-- Quote --}}
                <p class="mt-5 text-sm leading-relaxed text-slate-500 flex-1">&ldquo;{{ $t['quote'] }}&rdquo;</p>

                {{-- Project Badge --}}
                <div class="mt-5">
                    <span class="inline-flex items-center gap-1.5 rounded-full bg-[#0B5ED7]/5 px-3 py-1 text-[10px] font-semibold text-[#0B5ED7] border border-[#0B5ED7]/10">
                        <span class="w-1 h-1 rounded-full bg-[#0B5ED7]"></span>
                        {{ $t['project'] }}
                    </span>
                </div>

                {{-- Profile --}}
                <div class="mt-5 pt-5 border-t border-slate-100 flex items-center gap-4">
                    <div class="relative shrink-0">
                        <div class="absolute inset-0 rounded-full bg-gradient-to-br from-[#0B5ED7] to-blue-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300 blur-sm"></div>
                        <img src="{{ $t['img'] }}"
                             alt="{{ $t['name'] }}"
                             class="relative h-12 w-12 rounded-full object-cover ring-2 ring-slate-100 transition-all duration-300 group-hover:ring-[#0B5ED7]/30" />
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
        <div class="mt-16 pt-12 border-t border-slate-100" data-aos="fade-up">
            <div class="grid grid-cols-2 gap-8 sm:grid-cols-4">
                <div class="text-center">
                    <p class="text-3xl sm:text-4xl font-bold gradient-text">980+</p>
                    <p class="mt-2 text-xs text-slate-400 uppercase tracking-wider font-semibold">Satisfied Clients</p>
                </div>
                <div class="text-center">
                    <p class="text-3xl sm:text-4xl font-bold gradient-text">1.250+</p>
                    <p class="mt-2 text-xs text-slate-400 uppercase tracking-wider font-semibold">Completed Projects</p>
                </div>
                <div class="text-center">
                    <p class="text-3xl sm:text-4xl font-bold gradient-text">99%</p>
                    <p class="mt-2 text-xs text-slate-400 uppercase tracking-wider font-semibold">On-Time Delivery</p>
                </div>
                <div class="text-center">
                    <p class="text-3xl sm:text-4xl font-bold gradient-text">6+</p>
                    <p class="mt-2 text-xs text-slate-400 uppercase tracking-wider font-semibold">Years Experience</p>
                </div>
            </div>
        </div>

        {{-- Bottom CTA --}}
        <div class="mt-12 text-center" data-aos="fade-up">
            <p class="text-lg font-semibold text-slate-900">Ready to Start Your Project?</p>
            <a href="https://wa.me/6281234567890" target="_blank"
               class="mt-4 inline-flex items-center gap-2 rounded-full bg-[#0B5ED7] px-8 py-3.5 text-sm font-semibold text-white shadow-lg shadow-[#0B5ED7]/15 transition-all duration-300 hover:bg-[#0B5ED7]/90 hover:shadow-xl hover:shadow-[#0B5ED7]/25 hover:-translate-y-0.5 active:translate-y-0 group">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                Consult via WhatsApp
                <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
    </div>
</section>
