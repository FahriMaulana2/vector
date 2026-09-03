<?php
use App\Models\Setting;
$navItems = [
    ['label' => 'Home', 'id' => 'home'],
    ['label' => 'Tentang', 'id' => 'about'],
    ['label' => 'Layanan', 'id' => 'services'],
    ['label' => 'Produk', 'id' => 'products'],
    ['label' => 'Portofolio', 'id' => 'portfolio'],
    ['label' => 'Kontak', 'id' => 'contact'],
];
$companyName = Setting::getCompanyName();
$companyTagline = Setting::getDescription() ?: 'Digital Printing & Branding';
$logoUrl = Setting::getLogoUrl();
$whatsappLink = Setting::getWhatsAppLink();
$logoLetter = $companyName ? mb_substr($companyName, 0, 1) : 'O';
$homeUrl = request()->routeIs('home') ? '' : route('home');
$isTrackingPage = request()->routeIs('orders.track');
?>

<nav x-data="{
    mobileOpen: false,
    scrolled: false,
    activeSection: '{{ request()->routeIs('home') ? 'home' : '' }}',
    init() {
        const onScroll = () => {
            this.scrolled = window.scrollY > 20;
        };
        onScroll();
        window.addEventListener('scroll', onScroll, { passive: true });

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    this.activeSection = entry.target.id;
                }
            });
        }, { rootMargin: '-50% 0px -50% 0px' });
        ['home','about','services','products','portfolio','contact'].forEach(id => {
            const el = document.getElementById(id);
            if (el) observer.observe(el);
        });
    }
}"
class="fixed top-0 left-0 right-0 z-50 h-[80px] transition-all duration-300"
:class="scrolled ? 'bg-cream/90 backdrop-blur-xl border-b border-navy/10 shadow-soft' : 'bg-transparent border-b border-transparent'">
    <div class="flex items-center justify-between h-full max-w-7xl mx-auto px-5 md:px-6 lg:px-8">
        
        {{-- Logo & Company Name --}}
        <a href="{{ $homeUrl }}#home" class="inline-flex items-center gap-3 group flex-shrink-0">
            @if($logoUrl)
                {{-- PERUBAHAN 1: Ukuran logo diperbesar dari h-10 w-10 menjadi h-11 w-11 (md:h-12 md:w-12) --}}
                <div class="flex h-11 w-11 md:h-12 md:w-12 items-center justify-center rounded-xl overflow-hidden bg-navy text-gold border border-gold/30 shadow-button transition-all duration-300 group-hover:shadow-button-hover group-hover:-translate-y-0.5">
                    <img src="{{ $logoUrl }}" alt="{{ $companyName }}" class="h-full w-full object-contain">
                </div>
            @else
                {{-- PERUBAHAN 2: Ukuran huruf awal logo diperbesar menjadi text-lg --}}
                <div class="flex h-11 w-11 md:h-12 md:w-12 items-center justify-center rounded-xl bg-navy text-gold border border-gold/30 shadow-button transition-all duration-300 group-hover:shadow-button-hover group-hover:-translate-y-0.5">
                    <span class="font-heading font-bold text-lg tracking-tight">{{ $logoLetter }}</span>
                </div>
            @endif
            
            <div class="leading-tight">
                {{-- PERUBAHAN 3: Nama perusahaan diperbesar dari text-xs menjadi text-sm md:text-base --}}
                <p class="font-heading text-sm md:text-base font-bold uppercase tracking-wider md:tracking-[0.15em] text-navy transition-colors duration-300 group-hover:text-gold-dark">
                    {{ $companyName }}
                </p>
                {{-- PERUBAHAN 4: Tagline disesuaikan agar proporsional (dari text-[10px] jadi text-xs) --}}
                <p class="text-xs font-inter text-ink-soft font-medium mt-0.5">{{ $companyTagline }}</p>
            </div>
        </a>

        {{-- Desktop Menu --}}
        <div class="hidden lg:flex items-center justify-center flex-1">
            <div class="flex items-center gap-0.5 bg-cream/80 rounded-full px-2 py-1.5 border border-navy/10 shadow-soft">
                @foreach($navItems as $item)
                <a href="{{ $homeUrl }}#{{ $item['id'] }}" @click="mobileOpen = false" class="group relative px-4 py-2 text-sm font-inter font-medium transition-all duration-300 rounded-full" :class="activeSection === '{{ $item['id'] }}' ? 'text-cream bg-navy shadow-button' : 'bg-transparent text-ink-soft hover:text-navy hover:bg-white'">
                    <span>{{ $item['label'] }}</span>
                </a>
                @endforeach
                <a href="{{ route('orders.track') }}" class="px-4 py-2 text-sm font-inter font-medium transition-all duration-300 rounded-full {{ $isTrackingPage ? 'text-cream bg-navy shadow-button' : 'text-ink-soft hover:text-navy hover:bg-white' }}">Lacak Pesanan</a>
            </div>
        </div>

        {{-- Desktop CTA --}}
        <div class="hidden lg:flex items-center flex-shrink-0">
            <a href="#contact" class="inline-flex items-center gap-2.5 rounded-full bg-navy px-5 py-2.5 text-sm font-heading font-semibold text-cream border border-gold/40 transition-all duration-300 hover:bg-navy-deep hover:border-gold hover:shadow-button-hover hover:-translate-y-0.5 active:translate-y-0">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
                <span>Pesan Sekarang</span>
            </a>
        </div>

        {{-- Mobile Menu Toggle --}}
        <button @click="mobileOpen = !mobileOpen" type="button" aria-label="Toggle navigation menu"
                class="inline-flex items-center justify-center rounded-xl border border-navy/15 bg-cream p-2.5 text-navy transition-all duration-200 hover:border-gold/50 hover:text-gold-dark focus:outline-none focus-visible:ring-2 focus-visible:ring-gold/40 lg:hidden flex-shrink-0">
            <svg x-show="!mobileOpen" x-cloak xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <svg x-show="mobileOpen" x-cloak xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    {{-- Mobile Menu --}}
    <div x-show="mobileOpen"
         x-cloak
         x-transition:enter="transition-all duration-300 ease-out"
         x-transition:enter-start="opacity-0 -translate-y-3"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition-all duration-200 ease-in"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-3"
         class="lg:hidden border-t border-navy/10 bg-cream shadow-xl"
         @click.outside="mobileOpen = false">
        <div class="max-w-7xl mx-auto px-5 py-5 space-y-1">
            @foreach($navItems as $item)
            <a href="{{ $homeUrl }}#{{ $item['id'] }}"
               @click="mobileOpen = false"
               class="block rounded-xl px-4 py-3 text-sm font-inter font-medium transition-all duration-200"
               :class="activeSection === '{{ $item['id'] }}' ? 'bg-navy text-cream border-l-2 border-gold' : 'text-ink-soft hover:bg-white hover:text-navy'">
                {{ $item['label'] }}
            </a>
            @endforeach
            <a href="{{ route('orders.track') }}"
               @click="mobileOpen = false"
               class="block rounded-xl px-4 py-3 text-sm font-inter font-medium transition-all duration-200 {{ $isTrackingPage ? 'bg-navy text-cream border-l-2 border-gold' : 'text-ink-soft hover:bg-white hover:text-navy' }}">
                Lacak Pesanan
            </a>
            <div class="pt-3">
                <a href="#contact" @click="mobileOpen = false" class="flex items-center justify-center gap-2 rounded-full bg-navy px-4 py-3 text-sm font-heading font-semibold text-cream border border-gold/40 transition-all duration-200 hover:bg-navy-deep hover:shadow-lg">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    <span>Pesan Sekarang</span>
                </a>
            </div>
        </div>
    </div>
</nav>