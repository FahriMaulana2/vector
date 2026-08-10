<?php
use App\Models\Setting;
$companyName = Setting::getCompanyName();
$companyDescription = Setting::getDescription() ?: 'Solusi digital printing dan branding profesional untuk bisnis Anda. Dari banner, sticker, undangan, hingga merchandise custom.';
$logoUrl = Setting::getLogoUrl();
$logoLetter = $companyName ? mb_substr($companyName, 0, 1) : 'O';
$companyEmail = Setting::getEmail();
$companyWhatsapp = Setting::getWhatsAppNumber();
$whatsappLink = Setting::getWhatsAppLink();
$companyAddress = Setting::getAddress();
$social = Setting::getSocialMedia();
?>

<footer class="relative overflow-hidden bg-gradient-to-br from-navy-dark via-navy to-navy-deep text-cream">
    {{-- Layered dark navy background with restrained gold glows (z-0, behind content) --}}
    <div class="absolute inset-0 z-0 pointer-events-none">
        <div class="absolute top-[-80px] right-[-60px] w-[420px] h-[420px] rounded-full bg-gold/10 blur-3xl"></div>
        <div class="absolute bottom-[-100px] left-[-60px] w-[380px] h-[380px] rounded-full bg-navy-deep/40 blur-3xl"></div>
    </div>

    {{-- Extremely faint gold dot pattern (behind content) --}}
    <div class="absolute inset-0 z-0 opacity-[0.04] pointer-events-none"
         style="background-image: radial-gradient(circle at 1px 1px, #D6A83D 1px, transparent 0); background-size: 36px 36px;"></div>

    {{-- Thin gold accent line near top (behind content) --}}
    <div class="absolute top-0 left-0 z-0 h-px w-full bg-gradient-to-r from-transparent via-gold to-transparent opacity-60 pointer-events-none"></div>

    {{-- Back to top (above all decorative layers) --}}
    <div class="absolute top-0 right-8 -translate-y-1/2 z-30">
        <a href="#home"
           aria-label="Kembali ke atas"
           class="group flex items-center justify-center w-11 h-11 rounded-full bg-navy-deep/80 border border-gold/40 shadow-lg backdrop-blur-sm transition-all duration-300 hover:bg-gold hover:border-gold hover:-translate-y-1 focus:outline-none focus-visible:ring-2 focus-visible:ring-gold/60">
            <svg class="w-4 h-4 text-gold transition-all duration-300 group-hover:text-navy group-hover:-translate-y-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
        </a>
    </div>

    <div class="max-w-7xl mx-auto px-5 md:px-6 lg:px-8 pt-20 pb-10 relative z-10" data-aos="fade-up">
        <div class="grid gap-12 md:grid-cols-2 lg:grid-cols-[1.8fr_0.8fr_0.8fr_1.2fr] lg:gap-10">
{{-- Brand Column --}}
            <div class="space-y-6">
                <a href="#home" class="inline-flex items-center gap-3 group focus:outline-none focus-visible:ring-2 focus-visible:ring-gold/60 rounded-lg">
                    @if($logoUrl)
                        <div class="flex h-11 w-11 items-center justify-center rounded-xl overflow-hidden bg-gradient-to-br from-gold-light to-gold-dark text-navy font-heading font-bold text-base shadow-button transition-all duration-300 group-hover:shadow-button-hover group-hover:-translate-y-0.5">
                            <img src="{{ $logoUrl }}" alt="{{ $companyName }}" class="h-full w-full object-contain">
                        </div>
                    @else
                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-gradient-to-br from-gold-light to-gold-dark text-navy font-heading font-bold text-base shadow-button transition-all duration-300 group-hover:shadow-button-hover group-hover:-translate-y-0.5">
                            <span>{{ $logoLetter }}</span>
                        </div>
                    @endif
                    <div class="leading-tight">
                        <p class="font-heading font-semibold text-sm uppercase tracking-[0.25em] text-cream">{{ $companyName }}</p>
                        <p class="text-[11px] font-inter text-cream/50">Digital Printing &amp; Branding</p>
                    </div>
                </a>

                <p class="max-w-sm text-sm font-inter leading-relaxed text-cream/60">{{ $companyDescription }}</p>

                <div class="relative z-20 flex items-center gap-2.5">
                    @if(!empty($social['facebook']))
                    <a href="{{ $social['facebook'] }}" target="_blank" rel="noopener" aria-label="Facebook" class="flex items-center justify-center w-9 h-9 rounded-full bg-navy-deep/60 border border-gold/25 text-gold transition-all duration-200 hover:bg-gold hover:text-navy hover:border-gold hover:-translate-y-0.5 focus:outline-none focus-visible:ring-2 focus-visible:ring-gold/60">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/></svg>
                    </a>
                    @endif
                    @if(!empty($social['instagram']))
                    <a href="{{ $social['instagram'] }}" target="_blank" rel="noopener" aria-label="Instagram" class="flex items-center justify-center w-9 h-9 rounded-full bg-navy-deep/60 border border-gold/25 text-gold transition-all duration-200 hover:bg-gold hover:text-navy hover:border-gold hover:-translate-y-0.5 focus:outline-none focus-visible:ring-2 focus-visible:ring-gold/60">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 016.11 2.525c.636-.247 1.363-.416 2.427-.465C8.88 2.013 9.235 2 11.665 2h.63zm-.63 2.005h-.63c-2.428 0-2.784.012-3.807.058-1.064.049-1.791.218-2.427.465a4.902 4.902 0 00-1.772 1.153 4.902 4.902 0 00-1.153 1.772c-.247.636-.416 1.363-.465 2.427-.047 1.024-.06 1.379-.06 3.808v.63c0 2.428.013 2.784.06 3.807.049 1.064.218 1.791.465 2.427a4.902 4.902 0 001.153 1.772 4.902 4.902 0 001.772 1.153c.636.247 1.363.416 2.427.465 1.024.047 1.379.06 3.808.06h.63c2.428 0 2.784-.013 3.807-.06 1.064-.049 1.791-.218 2.427-.465a4.902 4.902 0 001.772-1.153 4.902 4.902 0 001.153-1.772c.247-.636.416-1.363.465-2.427.047-1.024.06-1.379.06-3.807v-.63c0-2.428-.013-2.784-.06-3.807-.049-1.064-.218-1.791-.465-2.427a4.902 4.902 0 00-1.153-1.772 4.902 4.902 0 00-1.772-1.153c-.636-.247-1.363-.416-2.427-.465-1.024-.047-1.379-.06-3.808-.06zm0 1.64c2.378 0 2.66.012 3.608.058 1.022.05 1.577.217 1.947.36.487.188.835.412 1.2.777.365.365.589.713.777 1.2.143.37.31.925.36 1.947.046.948.058 1.23.058 3.608s-.012 2.66-.058 3.608c-.05 1.022-.217 1.577-.36 1.947a3.238 3.238 0 01-.777 1.2 3.238 3.238 0 01-1.2.777c-.37.143-.925.31-1.947.36-.948.046-1.23.058-3.608.058s-2.66-.012-3.608-.058c-1.022-.05-1.577-.217-1.947-.36a3.238 3.238 0 01-1.2-.777 3.238 3.238 0 01-.777-1.2c-.143-.37-.31-.925-.36-1.947-.046-.948-.058-1.23-.058-3.608s.012-2.66.058-3.608c.05-1.022.217-1.577.36-1.947.188-.487.412-.835.777-1.2a3.238 3.238 0 011.2-.777c.37-.143.925-.31 1.947-.36.948-.046 1.23-.058 3.608-.058zm0 3.3a4.665 4.665 0 100 9.33 4.665 4.665 0 000-9.33zm0 7.69a3.025 3.025 0 110-6.05 3.025 3.025 0 010 6.05zm5.94-7.88a1.09 1.09 0 11-2.18 0 1.09 1.09 0 012.18 0z"/></svg>
                    </a>
                    @endif
                    @if(!empty($social['youtube']))
                    <a href="{{ $social['youtube'] }}" target="_blank" rel="noopener" aria-label="YouTube" class="flex items-center justify-center w-9 h-9 rounded-full bg-navy-deep/60 border border-gold/25 text-gold transition-all duration-200 hover:bg-gold hover:text-navy hover:border-gold hover:-translate-y-0.5 focus:outline-none focus-visible:ring-2 focus-visible:ring-gold/60">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                    </a>
                    @endif
                    @if(!empty($social['tiktok']))
                    <a href="{{ $social['tiktok'] }}" target="_blank" rel="noopener" aria-label="TikTok" class="flex items-center justify-center w-9 h-9 rounded-full bg-navy-deep/60 border border-gold/25 text-gold transition-all duration-200 hover:bg-gold hover:text-navy hover:border-gold hover:-translate-y-0.5 focus:outline-none focus-visible:ring-2 focus-visible:ring-gold/60">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-5.2 1.74 2.89 2.89 0 012.31-4.64 2.93 2.93 0 01.88.13V9.4a6.84 6.84 0 00-1-.05A6.33 6.33 0 005 20.1a6.34 6.34 0 0010.86-4.43v-7a8.16 8.16 0 004.77 1.52v-3.4a4.85 4.85 0 01-1-.1z"/></svg>
                    </a>
                    @endif
                    @if(!empty($social['linkedin']))
                    <a href="{{ $social['linkedin'] }}" target="_blank" rel="noopener" aria-label="LinkedIn" class="flex items-center justify-center w-9 h-9 rounded-full bg-navy-deep/60 border border-gold/25 text-gold transition-all duration-200 hover:bg-gold hover:text-navy hover:border-gold hover:-translate-y-0.5 focus:outline-none focus-visible:ring-2 focus-visible:ring-gold/60">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                    </a>
                    @endif
                </div>
            </div>

            {{-- Quick Links --}}
            <div>
                <p class="font-heading text-xs font-semibold uppercase tracking-[0.2em] text-gold">Quick Links</p>
                <div class="mt-5 space-y-3 text-sm font-inter">
                    <a href="#home" class="group flex items-center gap-2 text-cream/60 transition-all duration-200 hover:text-gold focus:outline-none focus-visible:ring-2 focus-visible:ring-gold/60 rounded">
                        <span class="w-1 h-1 rounded-full bg-gold opacity-0 group-hover:opacity-100 transition-opacity duration-200"></span>
                        <span class="transition-transform duration-200 group-hover:translate-x-1">Home</span>
                    </a>
                    <a href="#about" class="group flex items-center gap-2 text-cream/60 transition-all duration-200 hover:text-gold focus:outline-none focus-visible:ring-2 focus-visible:ring-gold/60 rounded">
                        <span class="w-1 h-1 rounded-full bg-gold opacity-0 group-hover:opacity-100 transition-opacity duration-200"></span>
                        <span class="transition-transform duration-200 group-hover:translate-x-1">Tentang</span>
                    </a>
                    <a href="#services" class="group flex items-center gap-2 text-cream/60 transition-all duration-200 hover:text-gold focus:outline-none focus-visible:ring-2 focus-visible:ring-gold/60 rounded">
                        <span class="w-1 h-1 rounded-full bg-gold opacity-0 group-hover:opacity-100 transition-opacity duration-200"></span>
                        <span class="transition-transform duration-200 group-hover:translate-x-1">Layanan</span>
                    </a>
                    <a href="#products" class="group flex items-center gap-2 text-cream/60 transition-all duration-200 hover:text-gold focus:outline-none focus-visible:ring-2 focus-visible:ring-gold/60 rounded">
                        <span class="w-1 h-1 rounded-full bg-gold opacity-0 group-hover:opacity-100 transition-opacity duration-200"></span>
                        <span class="transition-transform duration-200 group-hover:translate-x-1">Produk</span>
                    </a>
                    <a href="#portfolio" class="group flex items-center gap-2 text-cream/60 transition-all duration-200 hover:text-gold focus:outline-none focus-visible:ring-2 focus-visible:ring-gold/60 rounded">
                        <span class="w-1 h-1 rounded-full bg-gold opacity-0 group-hover:opacity-100 transition-opacity duration-200"></span>
                        <span class="transition-transform duration-200 group-hover:translate-x-1">Portofolio</span>
                    </a>
                    <a href="#contact" class="group flex items-center gap-2 text-cream/60 transition-all duration-200 hover:text-gold focus:outline-none focus-visible:ring-2 focus-visible:ring-gold/60 rounded">
                        <span class="w-1 h-1 rounded-full bg-gold opacity-0 group-hover:opacity-100 transition-opacity duration-200"></span>
                        <span class="transition-transform duration-200 group-hover:translate-x-1">Kontak</span>
                    </a>
                </div>
            </div>

            {{-- Services --}}
            <div>
                <p class="font-heading text-xs font-semibold uppercase tracking-[0.2em] text-gold">Layanan</p>
                <div class="mt-5 space-y-3 text-sm font-inter">
                    <a href="#products" class="group flex items-center gap-2 text-cream/60 transition-all duration-200 hover:text-gold focus:outline-none focus-visible:ring-2 focus-visible:ring-gold/60 rounded">
                        <span class="w-1 h-1 rounded-full bg-gold"></span>
                        <span class="transition-transform duration-200 group-hover:translate-x-1">Banner Printing</span>
                    </a>
                    <a href="#products" class="group flex items-center gap-2 text-cream/60 transition-all duration-200 hover:text-gold focus:outline-none focus-visible:ring-2 focus-visible:ring-gold/60 rounded">
                        <span class="w-1 h-1 rounded-full bg-gold"></span>
                        <span class="transition-transform duration-200 group-hover:translate-x-1">Sticker Printing</span>
                    </a>
                    <a href="#products" class="group flex items-center gap-2 text-cream/60 transition-all duration-200 hover:text-gold focus:outline-none focus-visible:ring-2 focus-visible:ring-gold/60 rounded">
                        <span class="w-1 h-1 rounded-full bg-gold"></span>
                        <span class="transition-transform duration-200 group-hover:translate-x-1">Business Card</span>
                    </a>
                    <a href="#products" class="group flex items-center gap-2 text-cream/60 transition-all duration-200 hover:text-gold focus:outline-none focus-visible:ring-2 focus-visible:ring-gold/60 rounded">
                        <span class="w-1 h-1 rounded-full bg-gold"></span>
                        <span class="transition-transform duration-200 group-hover:translate-x-1">Custom Tumbler</span>
                    </a>
                    <a href="#products" class="group flex items-center gap-2 text-cream/60 transition-all duration-200 hover:text-gold focus:outline-none focus-visible:ring-2 focus-visible:ring-gold/60 rounded">
                        <span class="w-1 h-1 rounded-full bg-gold"></span>
                        <span class="transition-transform duration-200 group-hover:translate-x-1">Merchandise</span>
                    </a>
                </div>
            </div>

            {{-- Contact Column --}}
            <div>
                <p class="font-heading text-xs font-semibold uppercase tracking-[0.2em] text-gold">Kontak</p>
                <div class="mt-5 space-y-4">
<div class="flex items-start gap-3">
                        <div class="mt-0.5 flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-gold/15 text-gold">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/></svg>
                        </div>
                        <div>
                            <p class="font-heading text-[11px] text-cream/40 uppercase tracking-wider">Email</p>
                            <a href="mailto:{{ $companyEmail }}" class="mt-0.5 inline-block text-sm font-inter text-cream/70 transition-colors duration-200 hover:text-gold focus:outline-none focus-visible:ring-2 focus-visible:ring-gold/60 rounded">{{ $companyEmail }}</a>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="mt-0.5 flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-gold text-navy">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
                        </div>
                        <div>
                            <p class="font-heading text-[11px] text-cream/40 uppercase tracking-wider">Alamat</p>
                            <p class="mt-0.5 text-sm font-inter text-cream/70">{{ $companyAddress }}</p>
                        </div>
                    </div>
                </div>

                <div class="relative z-20 mt-6">
                    <a href="{{ $whatsappLink }}" target="_blank"
                       class="inline-flex items-center gap-2 rounded-full bg-gold px-5 py-2.5 text-xs font-heading font-semibold text-navy shadow-button transition-all duration-200 hover:bg-gold-light hover:shadow-button-hover hover:-translate-y-0.5 focus:outline-none focus-visible:ring-2 focus-visible:ring-gold/60">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                        Hubungi via WhatsApp
                    </a>
                </div>
            </div>
        </div>

        {{-- Bottom Bar --}}
        <div class="mt-14 pt-6 border-t border-gold/15 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs font-inter text-cream/40">
<p class="inline-flex items-center gap-2">
                <span class="w-1 h-1 rounded-full bg-gold" aria-hidden="true"></span>
                &copy; {{ date('Y') }} {{ $companyName }}. All rights reserved.
            </p>
            <div class="flex items-center gap-5">
                <a href="#" class="transition-all duration-200 hover:text-gold focus:outline-none focus-visible:ring-2 focus-visible:ring-gold/60 rounded">Privacy Policy</a>
                <a href="#" class="transition-all duration-200 hover:text-gold focus:outline-none focus-visible:ring-2 focus-visible:ring-gold/60 rounded">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>
