<?php
$businessHours = [
    ['day' => 'Senin – Jumat', 'hours' => '08:00 – 18:00'],
    ['day' => 'Sabtu', 'hours' => '09:00 – 15:00'],
    ['day' => 'Minggu', 'hours' => '<span class="text-red-400">Tutup</span>'],
];
?>

<section id="contact" class="relative overflow-hidden bg-white">
    {{-- Single subtle background --}}
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-1/4 left-1/3 w-[450px] h-[450px] bg-gradient-to-r from-[#0B5ED7]/3 to-transparent rounded-full blur-3xl"></div>
    </div>

    <div class="max-w-7xl mx-auto px-5 md:px-6 lg:px-8 relative">
        {{-- Section Header --}}
        <div class="text-center max-w-3xl mx-auto" data-aos="fade-up">
            <span class="inline-flex items-center gap-2 rounded-full bg-[#0B5ED7]/5 px-4 py-1.5 border border-[#0B5ED7]/10 mb-6">
                <span class="w-1.5 h-1.5 rounded-full bg-[#0B5ED7]"></span>
                <span class="text-xs font-semibold uppercase tracking-[0.2em] text-[#0B5ED7]">Get in Touch</span>
            </span>
            <h2 class="text-4xl md:text-5xl lg:text-[56px] font-bold tracking-tight text-slate-950 leading-[1.1]">Let's Start Your <span class="text-[#0B5ED7]">Project</span></h2>
            <p class="mt-4 max-w-2xl mx-auto text-base lg:text-lg leading-relaxed text-slate-500">Tim kami siap membantu konsultasi, pemilihan bahan, desain, hingga pengiriman.</p>
        </div>

        <div class="mt-12 grid gap-10 lg:grid-cols-[1.2fr_1.5fr] lg:items-start">
            {{-- Left: Contact Info --}}
            <div class="space-y-6" data-aos="fade-right">
                {{-- Contact Details Cards --}}
                <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-1">
                    {{-- Email Card --}}
                    <div class="rounded-2xl border border-slate-100 bg-white p-6 shadow-card transition-all duration-300 hover:shadow-card-hover hover:-translate-y-0.5">
                        <div class="flex items-start gap-4">
                            <div class="mt-0.5 flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-[#0B5ED7]/10 text-[#0B5ED7]">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Email</p>
                                <p class="mt-0.5 font-semibold text-slate-950">hello@omhvector.com</p>
                                <p class="text-xs text-slate-400 mt-0.5">Kami akan merespon dalam 1×24 jam</p>
                            </div>
                        </div>
                    </div>

                    {{-- WhatsApp Card --}}
                    <div class="rounded-2xl border border-slate-100 bg-white p-6 shadow-card transition-all duration-300 hover:shadow-card-hover hover:-translate-y-0.5">
                        <div class="flex items-start gap-4">
                            <div class="mt-0.5 flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-[#0B5ED7]/10 text-[#0B5ED7]">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                            </div>
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">WhatsApp</p>
                                <p class="mt-0.5 font-semibold text-slate-950">+62 812-3456-7890</p>
                                <p class="text-xs text-slate-400 mt-0.5">Respons cepat via chat</p>
                            </div>
                        </div>
                    </div>

                    {{-- Address Card --}}
                    <div class="rounded-2xl border border-slate-100 bg-white p-6 shadow-card transition-all duration-300 hover:shadow-card-hover hover:-translate-y-0.5">
                        <div class="flex items-start gap-4">
                            <div class="mt-0.5 flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-[#0B5ED7]/10 text-[#0B5ED7]">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Alamat</p>
                                <p class="mt-0.5 font-semibold text-slate-950">Jl. Digital Printing No. 15</p>
                                <p class="text-xs text-slate-400 mt-0.5">Jakarta Selatan, Indonesia</p>
                            </div>
                        </div>
                    </div>

                    {{-- Business Hours Card --}}
                    <div class="rounded-2xl border border-slate-100 bg-white p-6 shadow-card transition-all duration-300 hover:shadow-card-hover hover:-translate-y-0.5">
                        <div class="flex items-start gap-4">
                            <div class="mt-0.5 flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-[#0B5ED7]/10 text-[#0B5ED7]">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Jam Operasional</p>
                                <div class="mt-2 space-y-2">
                                    @foreach($businessHours as $hours)
                                    <div class="flex items-center justify-between text-sm">
                                        <span class="text-slate-500">{{ $hours['day'] }}</span>
                                        <span class="font-medium text-slate-900">{!! $hours['hours'] !!}</span>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Maps Placeholder --}}
                <div class="rounded-2xl overflow-hidden border border-slate-100 shadow-card">
                    <div class="bg-slate-100 h-[200px] flex items-center justify-center">
                        <div class="text-center">
                            <svg class="w-10 h-10 mx-auto text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 6.75V15m6-6v8.25m.503 3.498l4.875-2.437c.381-.19.622-.58.622-1.006V4.82c0-.836-.88-1.38-1.628-1.006l-3.869 1.934c-.317.159-.69.159-1.006 0L9.503 3.252a1.125 1.125 0 00-1.006 0L3.622 5.689C3.24 5.88 3 6.27 3 6.695V19.18c0 .836.88 1.38 1.628 1.006l3.869-1.934c.317-.159.69-.159 1.006 0l4.994 2.497c.317.158.69.158 1.006 0z" />
                            </svg>
                            <p class="mt-2 text-sm text-slate-400 font-medium">Google Maps</p>
                            <p class="text-xs text-slate-300">Jl. Digital Printing No. 15, Jakarta Selatan</p>
                        </div>
                    </div>
                </div>

                {{-- Large WhatsApp CTA --}}
                <a href="https://wa.me/6281234567890" target="_blank"
                   class="group flex items-center justify-center gap-3 rounded-2xl bg-gradient-to-br from-[#0B5ED7] to-blue-500 px-8 py-4 text-sm font-semibold text-white shadow-button transition-all duration-300 hover:shadow-button-hover hover:-translate-y-0.5 active:translate-y-0">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    <span>Chat via WhatsApp</span>
                    <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>

            {{-- Right: Contact Form --}}
            <div class="rounded-2xl border border-slate-100 bg-white p-8 lg:p-10 shadow-card transition-all duration-300 hover:shadow-card-hover" data-aos="fade-left">
                <div class="flex items-center gap-3 mb-6">
                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-[#0B5ED7]/10 text-[#0B5ED7]">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-slate-950">Kirim Pesan</h3>
                        <p class="text-sm text-slate-400">Kami akan merespon dalam 1×24 jam</p>
                    </div>
                </div>

                <form class="space-y-5">
                    {{-- Name + Phone Row --}}
                    <div class="grid gap-5 sm:grid-cols-2">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Lengkap</label>
                            <input type="text" placeholder="Masukkan nama Anda"
                                   class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3.5 text-sm text-slate-900 outline-none transition-all duration-300 placeholder:text-slate-400 focus:border-[#0B5ED7] focus:ring-2 focus:ring-[#0B5ED7]/10 hover:border-slate-300" />
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1.5">No. WhatsApp</label>
                            <input type="tel" placeholder="+62 812-xxxx-xxxx"
                                   class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3.5 text-sm text-slate-900 outline-none transition-all duration-300 placeholder:text-slate-400 focus:border-[#0B5ED7] focus:ring-2 focus:ring-[#0B5ED7]/10 hover:border-slate-300" />
                        </div>
                    </div>

                    {{-- Email --}}
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Email</label>
                        <input type="email" placeholder="contoh@email.com"
                               class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3.5 text-sm text-slate-900 outline-none transition-all duration-300 placeholder:text-slate-400 focus:border-[#0B5ED7] focus:ring-2 focus:ring-[#0B5ED7]/10 hover:border-slate-300" />
                    </div>

                    {{-- Service Selection --}}
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Layanan</label>
                        <div class="grid grid-cols-2 gap-2">
                            @php
                            $services = ['Banner Printing', 'Sticker Printing', 'Wedding Invitation', 'Business Card', 'Custom Tumbler', 'Merchandise', 'Graphic Design', 'Lainnya'];
                            @endphp
                            @foreach($services as $service)
                            <label class="group flex items-center gap-2.5 rounded-xl border border-slate-200 px-3.5 py-2.5 cursor-pointer transition-all duration-200 hover:border-[#0B5ED7]/30 hover:bg-[#0B5ED7]/5">
                                <input type="radio" name="service" value="{{ $service }}" class="h-4 w-4 accent-[#0B5ED7]">
                                <span class="text-sm text-slate-600 group-hover:text-slate-900">{{ $service }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- Message --}}
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Pesan</label>
                        <textarea rows="4" placeholder="Jelaskan kebutuhan cetak atau branding Anda..."
                                  class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3.5 text-sm text-slate-900 outline-none transition-all duration-300 placeholder:text-slate-400 focus:border-[#0B5ED7] focus:ring-2 focus:ring-[#0B5ED7]/10 hover:border-slate-300 resize-none"></textarea>
                    </div>

                    {{-- Submit Button --}}
                    <button type="submit"
                            class="group relative w-full rounded-full bg-gradient-to-r from-[#0B5ED7] to-blue-500 px-6 py-4 text-sm font-semibold text-white shadow-button transition-all duration-300 hover:shadow-button-hover hover:-translate-y-0.5 active:translate-y-0 overflow-hidden">
                        <span class="relative z-10 flex items-center justify-center gap-2">
                            Kirim Pesan
                            <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5"/></svg>
                        </span>
                        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                    </button>

                    <p class="text-center text-xs text-slate-400">Your information is kept confidential. We respect your privacy.</p>
                </form>
            </div>
        </div>
    </div>
</section>

