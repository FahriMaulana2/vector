<div class="relative overflow-hidden bg-cream py-10 md:py-16 lg:py-20 pt-24 md:pt-28 min-h-screen">
    {{-- Subtle decorative background --}}
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-[-80px] left-[-80px] w-[280px] h-[280px] md:w-[420px] md:h-[420px] bg-gradient-to-br from-gold/10 to-transparent rounded-full blur-3xl"></div>
        <div class="absolute bottom-[-100px] right-[-80px] w-[280px] h-[280px] md:w-[380px] md:h-[380px] bg-gradient-to-tl from-navy/5 to-transparent rounded-full blur-3xl"></div>
    </div>

    {{-- Very faint navy dot pattern --}}
    <div class="absolute inset-0 opacity-[0.03] pointer-events-none"
         style="background-image: radial-gradient(circle at 1px 1px, #0B1F2A 1px, transparent 0); background-size: 36px 36px;"></div>

    {{-- Thin gold accent line top --}}
    <div class="absolute top-0 left-0 z-0 h-px w-full bg-gradient-to-r from-transparent via-gold/30 to-transparent pointer-events-none"></div>

    <div class="mx-auto px-4 md:px-6 lg:px-8 relative z-10 max-w-6xl">
        {{-- Section Header --}}
        <div class="text-center max-w-2xl mx-auto mb-8 md:mb-12" data-aos="fade-up" wire:ignore.self>
            <span class="inline-flex items-center gap-2 rounded-full bg-white px-3.5 py-1.5 border border-gold/30 shadow-soft">
                <span class="w-1.5 h-1.5 rounded-full bg-gold"></span>
                <span class="font-heading text-[10px] md:text-xs font-semibold uppercase tracking-[0.18em] text-navy">Checkout Pesanan</span>
            </span>
            <h1 class="font-heading mt-3 md:mt-4 text-2xl md:text-3xl lg:text-4xl font-bold tracking-tight text-navy leading-tight">
                Selesaikan <span class="gradient-text">Pesanan Anda</span>
            </h1>
            <p class="mt-2.5 text-xs md:text-sm font-inter leading-relaxed text-ink-soft">
                Periksa rincian pesanan Anda dan lengkapi formulir di bawah ini untuk terhubung langsung ke WhatsApp Admin OMAH Vector.
            </p>

            {{-- Step Indicator --}}
            <div class="flex items-center justify-center gap-3 md:gap-6 mt-6">
                <div class="flex items-center gap-2">
                    <span class="w-6 h-6 rounded-full bg-navy text-gold text-xs font-heading font-bold flex items-center justify-center shadow-sm">1</span>
                    <span class="text-xs font-heading font-medium text-navy">Pilih Produk</span>
                </div>
                <div class="w-6 h-px bg-gold/40"></div>
                <div class="flex items-center gap-2">
                    <span class="w-6 h-6 rounded-full bg-gold text-navy text-xs font-heading font-bold flex items-center justify-center shadow-sm">2</span>
                    <span class="text-xs font-heading font-bold text-navy">Data Diri</span>
                </div>
                <div class="w-6 h-px bg-gold/40"></div>
                <div class="flex items-center gap-2 opacity-60">
                    <span class="w-6 h-6 rounded-full bg-navy/10 text-navy text-xs font-heading font-bold flex items-center justify-center">3</span>
                    <span class="text-xs font-heading font-medium text-ink-soft">WhatsApp</span>
                </div>
            </div>
        </div>

        {{-- 2-Column Split: Left Card = Order Summary | Right Card = Customer Form --}}
        <div class="grid lg:grid-cols-12 gap-6 lg:gap-8 items-start" data-aos="fade-up" wire:ignore.self>
            {{-- Column 1: Order Summary (5 cols on desktop, sticky) --}}
            <div class="lg:col-span-5 lg:sticky lg:top-24 space-y-4">
                <div class="rounded-2xl md:rounded-3xl border border-navy/10 bg-white p-5 md:p-6 shadow-card">
                    <div class="flex items-center justify-between pb-3.5 mb-4 border-b border-navy/10">
                        <div class="flex items-center gap-2.5">
                            <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-gold/15 text-gold-dark">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                </svg>
                            </div>
                            <div>
                                <h2 class="font-heading text-sm md:text-base font-bold text-navy">Ringkasan Pesanan</h2>
                                <p class="text-[11px] font-inter text-ink-soft">Daftar item di keranjang</p>
                            </div>
                        </div>
                        <span class="rounded-full bg-navy/5 border border-navy/10 px-2.5 py-0.5 text-xs font-heading font-semibold text-navy">
                            {{ $cartCount }} Item
                        </span>
                    </div>

                    @if(empty($cartItems))
                        <div class="py-8 text-center space-y-3">
                            <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-slate-100 text-slate-400">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-navy">Keranjang pesanan masih kosong</p>
                                <p class="text-[11px] text-ink-soft mt-0.5">Pilih produk dari katalog untuk mulai memesan</p>
                            </div>
                            <a href="{{ route('products.index') }}"
                               class="inline-flex items-center gap-1.5 rounded-full bg-navy px-4 py-2 text-xs font-heading font-semibold text-cream hover:bg-navy-deep transition-colors shadow-sm">
                                <span>Pilih Produk dari Katalog</span>
                                <svg class="w-3.5 h-3.5 text-gold" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </a>
                        </div>
                    @else
                        <div class="divide-y divide-navy/5 space-y-3 max-h-[420px] overflow-y-auto pr-1">
                            @foreach($cartItems as $uuid => $item)
                                <div class="pt-3 first:pt-0 space-y-2">
                                    <div class="flex items-start justify-between gap-2">
                                        <div>
                                            <h3 class="font-heading text-xs sm:text-sm font-bold text-navy leading-snug">{{ $item['product_name'] ?? 'Produk' }}</h3>
                                            <span class="inline-block rounded bg-navy/5 px-1.5 py-0.5 text-[10px] font-semibold text-navy mt-0.5">Jumlah: {{ $item['qty'] }} pcs</span>
                                        </div>
                                        <span class="font-heading text-xs sm:text-sm font-bold text-navy shrink-0">
                                            Rp {{ number_format((float)($item['line_subtotal'] ?? 0), 0, ',', '.') }}
                                        </span>
                                    </div>

                                    {{-- Spesifikasi Ringkas --}}
                                    <div class="flex flex-wrap gap-1 text-[10px] text-ink-soft">
                                        @if(!empty($item['side_mode']))
                                            <span class="rounded bg-navy/5 px-1.5 py-0.5">
                                                {{ $item['side_mode'] === '2_muka' ? '2 Sisi' : '1 Sisi' }}
                                            </span>
                                        @endif
                                        @if(!empty($item['length_m']) && !empty($item['width_m']))
                                            <span class="rounded bg-navy/5 px-1.5 py-0.5">
                                                {{ $item['length_m'] }}m × {{ $item['width_m'] }}m
                                            </span>
                                        @endif
                                        @if(!empty($item['selected_options']) && is_array($item['selected_options']))
                                            @foreach($item['selected_options'] as $opt)
                                                <span class="rounded bg-navy/5 px-1.5 py-0.5">
                                                    {{ $opt['option_name'] ?? '' }}
                                                </span>
                                            @endforeach
                                        @endif
                                    </div>

                                    @if(!empty($item['manual_quote_flag']))
                                        <p class="text-[10px] text-amber-700 font-medium flex items-center gap-1">
                                            <span>* {{ $item['manual_quote_note'] ?: 'Perlu konfirmasi harga admin' }}</span>
                                        </p>
                                    @endif

                                    {{-- Actions --}}
                                    <div class="flex items-center gap-2 pt-1">
                                        <button type="button"
                                                wire:click.prevent="$dispatch('open-configurator', { productId: {{ $item['product_id'] }}, cartItemUuid: '{{ $uuid }}' })"
                                                class="text-[11px] font-medium text-navy hover:text-gold-dark transition-colors underline cursor-pointer">
                                            Ubah Spesifikasi
                                        </button>
                                        <span class="text-slate-300">|</span>
                                        <button type="button"
                                                wire:click.prevent="removeItem('{{ $uuid }}')"
                                                class="text-[11px] font-medium text-red-500 hover:text-red-700 transition-colors underline cursor-pointer">
                                            Hapus
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{-- Total Calculation --}}
                        <div class="mt-5 pt-4 border-t border-navy/10 space-y-2">
                            <div class="flex items-center justify-between text-xs font-inter text-ink-soft">
                                <span>Estimasi Biaya Cetak:</span>
                                <span class="font-medium text-navy">Rp {{ number_format((float)$cartSubtotal, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex items-center justify-between pt-2 border-t border-dashed border-navy/10">
                                <span class="font-heading text-sm font-bold text-navy uppercase tracking-wider">Total Pembayaran:</span>
                                <span class="font-heading text-base md:text-lg font-bold text-navy">
                                    Rp {{ number_format((float)$cartSubtotal, 0, ',', '.') }}
                                </span>
                            </div>

                            @if($hasManualQuote)
                                <div class="rounded-xl bg-amber-50 border border-amber-200 p-2.5 text-[11px] text-amber-800 leading-relaxed">
                                    Item bertanda khusus memerlukan konfirmasi ongkos/bahan dari admin via WhatsApp.
                                </div>
                            @endif
                        </div>
                    @endif
                </div>

                {{-- Guarantee / Help Card --}}
                <div class="rounded-2xl border border-navy/10 bg-white/70 p-4 shadow-sm flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <div class="text-xs font-inter">
                        <p class="font-semibold text-navy">Transaksi Aman & Bergaransi</p>
                        <p class="text-ink-soft text-[11px]">Hasil cetak dicek ulang (QC) sebelum dikirim.</p>
                    </div>
                </div>
            </div>

            {{-- Column 2: Customer Data Form (7 cols on desktop) --}}
            <div class="lg:col-span-7">
                <div class="rounded-2xl md:rounded-3xl border border-navy/10 bg-white p-5 md:p-8 shadow-card">
                    <div class="flex items-center gap-3 mb-6 pb-4 border-b border-navy/10">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-navy/10 text-navy shrink-0">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="font-heading text-base md:text-lg font-bold text-navy">Form Data Pemesan</h2>
                            <p class="text-xs font-inter text-ink-soft">Isi data pengiriman & detail pesanan Anda</p>
                        </div>
                    </div>

                    <form wire:submit="submit" class="space-y-4 md:space-y-5">
                        @error('general')
                            <div class="rounded-xl border border-red-400/30 bg-red-50 p-3 text-xs font-inter text-red-600">
                                {{ $message }}
                            </div>
                        @enderror

                        @error('cart')
                            <div class="rounded-xl border border-red-400/30 bg-red-50 p-3 text-xs font-inter text-red-600">
                                {{ $message }}
                            </div>
                        @enderror

                        @if (session()->has('success'))
                            <div class="rounded-xl border border-gold/40 bg-gold/10 p-3.5 text-xs font-inter text-navy font-semibold">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="@if(empty($cartItems)) opacity-50 pointer-events-none @endif space-y-4 md:space-y-5">
                            {{-- Name + Phone Row --}}
                            <div class="grid gap-4 sm:grid-cols-2">
                                <div>
                                    <label for="contact-name" class="block text-xs md:text-sm font-heading font-semibold text-navy mb-1.5">Nama Lengkap</label>
                                    <input id="contact-name" type="text" wire:model="name" placeholder="Masukkan nama Anda"
                                           @disabled(empty($cartItems))
                                           class="w-full rounded-xl border @error('name') border-red-400 bg-red-50/30 @else border-navy/15 bg-white @enderror px-3.5 py-3 text-xs md:text-sm font-inter text-navy outline-none transition duration-200 placeholder:text-ink-soft/50 focus:border-gold focus:ring-2 focus:ring-gold/20" />
                                    @error('name')
                                        <span class="text-[11px] text-red-500 mt-1 block font-inter">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div>
                                    <label for="contact-phone" class="block text-xs md:text-sm font-heading font-semibold text-navy mb-1.5">No. WhatsApp</label>
                                    <input id="contact-phone" type="tel" wire:model="phone" placeholder="0812-xxxx-xxxx"
                                           @disabled(empty($cartItems))
                                           class="w-full rounded-xl border @error('phone') border-red-400 bg-red-50/30 @else border-navy/15 bg-white @enderror px-3.5 py-3 text-xs md:text-sm font-inter text-navy outline-none transition duration-200 placeholder:text-ink-soft/50 focus:border-gold focus:ring-2 focus:ring-gold/20" />
                                    @error('phone')
                                        <span class="text-[11px] text-red-500 mt-1 block font-inter">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Email --}}
                            <div>
                                <label for="contact-email" class="block text-xs md:text-sm font-heading font-semibold text-navy mb-1.5">Alamat Email</label>
                                <input id="contact-email" type="email" wire:model="email" placeholder="nama@email.com"
                                       @disabled(empty($cartItems))
                                       class="w-full rounded-xl border @error('email') border-red-400 bg-red-50/30 @else border-navy/15 bg-white @enderror px-3.5 py-3 text-xs md:text-sm font-inter text-navy outline-none transition duration-200 placeholder:text-ink-soft/50 focus:border-gold focus:ring-2 focus:ring-gold/20" />
                                @error('email')
                                    <span class="text-[11px] text-red-500 mt-1 block font-inter">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Alamat Pengiriman --}}
                            <div>
                                <label for="contact-shipping" class="block text-xs md:text-sm font-heading font-semibold text-navy mb-1.5">Alamat Lengkap Pengiriman</label>
                                <textarea id="contact-shipping" rows="2" wire:model="shipping_address" placeholder="Nama Jalan, No. Rumah, RT/RW, Kecamatan, Kota/Kabupaten, Kode Pos..."
                                          @disabled(empty($cartItems))
                                          class="w-full rounded-xl border @error('shipping_address') border-red-400 bg-red-50/30 @else border-navy/15 bg-white @enderror px-3.5 py-3 text-xs md:text-sm font-inter text-navy outline-none transition duration-200 placeholder:text-ink-soft/50 focus:border-gold focus:ring-2 focus:ring-gold/20 resize-none"></textarea>
                                @error('shipping_address')
                                    <span class="text-[11px] text-red-500 mt-1 block font-inter">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Status File Desain --}}
                            <div>
                                <label class="block text-xs md:text-sm font-heading font-semibold text-navy mb-2">Kesiapan File Desain</label>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                    <label class="flex items-center gap-3 rounded-xl border @if($design_file_status === 'ready') border-gold bg-gold/5 ring-1 ring-gold @else border-navy/15 bg-white @endif p-3.5 cursor-pointer transition hover:border-gold/60">
                                        <input type="radio" wire:model.live="design_file_status" value="ready" class="h-4 w-4 accent-gold" @disabled(empty($cartItems))>
                                        <div>
                                            <span class="block text-xs font-heading font-bold text-navy">File Sudah Siap</span>
                                            <span class="block text-[11px] text-ink-soft">File PDF / CDR / TIFF siap cetak</span>
                                        </div>
                                    </label>
                                    <label class="flex items-center gap-3 rounded-xl border @if($design_file_status === 'need_design_help') border-gold bg-gold/5 ring-1 ring-gold @else border-navy/15 bg-white @endif p-3.5 cursor-pointer transition hover:border-gold/60">
                                        <input type="radio" wire:model.live="design_file_status" value="need_design_help" class="h-4 w-4 accent-gold" @disabled(empty($cartItems))>
                                        <div>
                                            <span class="block text-xs font-heading font-bold text-navy">Perlu Bantuan Desain</span>
                                            <span class="block text-[11px] text-ink-soft">Dibantu tim desainer OMAH Vector</span>
                                        </div>
                                    </label>
                                </div>
                                @error('design_file_status')
                                    <span class="text-[11px] text-red-500 mt-1 block font-inter">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Catatan Tambahan --}}
                            <div>
                                <label for="contact-notes" class="block text-xs md:text-sm font-heading font-semibold text-navy mb-1.5">Catatan Khusus (Opsional)</label>
                                <textarea id="contact-notes" rows="2" wire:model="notes" placeholder="Catatan finishing, instruksi packaging, atau tenggat waktu pemakaian..."
                                          @disabled(empty($cartItems))
                                          class="w-full rounded-xl border border-navy/15 bg-white px-3.5 py-3 text-xs md:text-sm font-inter text-navy outline-none transition duration-200 placeholder:text-ink-soft/50 focus:border-gold focus:ring-2 focus:ring-gold/20 resize-none"></textarea>
                                @error('notes')
                                    <span class="text-[11px] text-red-500 mt-1 block font-inter">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- Submit Button --}}
                        <div class="pt-2">
                            <button type="submit"
                                    wire:loading.attr="disabled"
                                    @disabled(empty($cartItems) || $isSubmitting)
                                    class="group relative w-full rounded-full bg-gradient-to-r from-navy via-navy-deep to-navy px-6 py-4 text-xs md:text-sm font-heading font-semibold text-cream shadow-button transition-all duration-300 hover:shadow-button-hover hover:-translate-y-0.5 active:translate-y-0 disabled:opacity-50 disabled:cursor-not-allowed overflow-hidden">
                                <span class="relative z-10 flex items-center justify-center gap-2">
                                    <span wire:loading.remove>Kirim Pesanan & Hubungi WhatsApp</span>
                                    <span wire:loading class="flex items-center gap-2">
                                        <svg class="animate-spin h-4 w-4 text-gold" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                        Memproses Pesanan...
                                    </span>
                                    <svg wire:loading.remove class="w-4 h-4 text-gold transition-transform duration-300 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                    </svg>
                                </span>
                                <div class="absolute inset-0 bg-gradient-to-r from-transparent via-gold/15 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                            </button>
                            <p class="text-center text-[11px] font-inter text-ink-soft mt-3">Data pesanan Anda aman dan diteruskan secara otomatis ke tim customer service kami.</p>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Bottom CTA Navigation: Katalog Produk + Beranda --}}
        <div class="mt-10 md:mt-14 flex items-center justify-center gap-4 flex-wrap text-center relative z-20">
            <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 rounded-full bg-white border border-navy/15 px-5 py-2.5 text-xs font-heading font-semibold text-navy transition hover:bg-navy/5 hover:border-navy/30 shadow-sm">
                <svg class="w-3.5 h-3.5 text-navy" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                <span>Lihat Katalog Produk</span>
            </a>
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 rounded-full bg-navy/10 border border-navy/20 px-5 py-2.5 text-xs font-heading font-semibold text-navy transition hover:bg-navy hover:text-cream shadow-sm">
                <svg class="w-3.5 h-3.5 text-gold" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span>Kembali ke Beranda</span>
            </a>
        </div>
    </div>
</div>
