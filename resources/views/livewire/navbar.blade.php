<?php
$navItems = [
    ['label' => 'Home', 'id' => 'home'],
    ['label' => 'Tentang', 'id' => 'about'],
    ['label' => 'Layanan', 'id' => 'services'],
    ['label' => 'Produk', 'id' => 'products'],
    ['label' => 'Portofolio', 'id' => 'portfolio'],
    ['label' => 'Kontak', 'id' => 'contact'],
];
?>

<nav x-data="{
    mobileOpen: false,
    activeSection: 'home',
    init() {
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
class="fixed top-0 left-0 right-0 z-50 h-[80px] bg-white border-b border-slate-200 shadow-soft">
    <div class="flex items-center justify-between h-full max-w-7xl mx-auto px-5 md:px-6 lg:px-8">
        {{-- Logo --}}
        <a href="#home" class="inline-flex items-center gap-2.5 text-slate-900 group flex-shrink-0">
            <div class="flex h-10 w-10 items-center justify-center rounded-xl gradient-primary text-white shadow-button transition-all duration-300 group-hover:shadow-button-hover">
                <span class="font-bold text-base tracking-tight">O</span>
            </div>
            <div class="leading-tight">
                <p class="text-xs font-bold uppercase tracking-[0.2em]">OMH Vector</p>
                <p class="text-[10px] text-slate-400 font-medium">Digital Printing &amp; Branding</p>
            </div>
        </a>

        {{-- Desktop Navigation --}}
        <div class="hidden lg:flex items-center justify-center flex-1">
            <div class="flex items-center gap-0.5 bg-slate-50/80 rounded-2xl px-2 py-1.5">
                @foreach($navItems as $item)
                <a href="#{{ $item['id'] }}"
                   @click="mobileOpen = false"
                   class="relative px-4 py-2 text-sm font-medium transition-all duration-300 rounded-xl"
                   :class="activeSection === '{{ $item['id'] }}' ? 'text-white bg-[#0B5ED7] shadow-sm' : 'text-slate-600 hover:text-slate-900 hover:bg-white/60'">
                    <span>{{ $item['label'] }}</span>
                </a>
                @endforeach
            </div>
        </div>

        {{-- Desktop CTA --}}
        <div class="hidden lg:flex items-center flex-shrink-0">
            <a href="https://wa.me/6281234567890" target="_blank"
               class="inline-flex items-center gap-2.5 rounded-full bg-[#0B5ED7] px-5 py-2.5 text-sm font-semibold text-white shadow-button transition-all duration-300 hover:shadow-button-hover hover:-translate-y-0.5 active:translate-y-0">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                <span>Order via WhatsApp</span>
            </a>
        </div>

        {{-- Mobile Menu Toggle --}}
        <button @click="mobileOpen = !mobileOpen" type="button"
                class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white p-2.5 text-slate-500 transition-all duration-200 hover:border-[#0B5ED7]/30 hover:text-[#0B5ED7] lg:hidden flex-shrink-0">
            <svg x-show="!mobileOpen" x-cloak xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <svg x-show="mobileOpen" x-cloak xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
         class="lg:hidden border-t border-slate-100 bg-white shadow-xl"
         @click.outside="mobileOpen = false">
        <div class="max-w-7xl mx-auto px-5 py-5 space-y-1">
            @foreach($navItems as $item)
            <a href="#{{ $item['id'] }}"
               @click="mobileOpen = false"
               class="block rounded-xl px-4 py-3 text-sm font-medium transition-all duration-200"
               :class="activeSection === '{{ $item['id'] }}' ? 'bg-[#0B5ED7]/5 text-[#0B5ED7]' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900'">
                {{ $item['label'] }}
            </a>
            @endforeach
            <div class="pt-3">
                <a href="https://wa.me/6281234567890" target="_blank"
                   class="flex items-center justify-center gap-2 rounded-full bg-[#0B5ED7] px-4 py-3 text-sm font-semibold text-white transition-all duration-200 hover:bg-[#0B5ED7]/90 hover:shadow-lg">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    <span>Order via WhatsApp</span>
                </a>
            </div>
        </div>
    </div>
</nav>

