<section class="relative overflow-hidden bg-cream pt-[104px] pb-12 md:pt-[128px] md:pb-20">
    {{-- Subtle decorative background --}}
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-[-80px] left-[-80px] w-[280px] h-[280px] md:w-[420px] md:h-[420px] bg-gradient-to-br from-gold/10 to-transparent rounded-full blur-3xl"></div>
        <div class="absolute bottom-[-100px] right-[-80px] w-[280px] h-[280px] md:w-[380px] md:h-[380px] bg-gradient-to-tl from-navy/5 to-transparent rounded-full blur-3xl"></div>
    </div>

    <div class="mx-auto px-4 md:px-6 lg:px-8 relative z-10 md:max-w-5xl">
        {{-- Page Header --}}
        <div class="text-center max-w-2xl mx-auto">
            <span class="inline-flex items-center gap-2 rounded-full bg-white px-3 py-1.5 md:px-4 md:py-1.5 border border-gold/30 shadow-soft">
                <span class="w-1 h-1 md:w-1.5 md:h-1.5 rounded-full bg-gold"></span>
                <span class="font-heading text-[10px] md:text-xs font-semibold uppercase tracking-[0.15em] md:tracking-[0.22em] text-navy">Form Pemesanan</span>
            </span>
            <h1 class="font-heading mt-4 md:mt-6 text-xl md:text-3xl lg:text-4xl font-bold tracking-tight text-navy leading-tight md:leading-[1.12]">Konfirmasi <span class="gradient-text">Pesanan Anda</span></h1>
            <p class="mt-3 md:mt-4 text-sm md:text-base font-inter leading-relaxed text-ink-soft">Periksa kembali rincian keranjang, lalu lengkapi data pemesan untuk memproses pesanan Anda.</p>
        </div>

        <div class="mt-8 md:mt-12 rounded-lg md:rounded-[1.75rem] border border-gold/20 bg-white p-4 md:p-8 lg:p-10 shadow-card">
            <form wire:submit="submit" class="space-y-4 md:space-y-5">
                @error('general')
                <div class="rounded-lg md:rounded-xl border border-red-400/30 bg-red-50 p-3 text-[10px] md:text-xs font-inter text-red-600">
                    {{ $message }}
                </div>
                @enderror

                @error('cart')
                <div class="rounded-lg md:rounded-xl border border-red-400/30 bg-red-50 p-3 text-[10px] md:text-xs font-inter text-red-600">
                    {{ $message }}
                </div>
                @enderror

                {{-- 1. Cart Items Summary --}}
                <div class="rounded-xl md:rounded-2xl border border-slate-200 bg-slate-50/70 p-3.5 md:p-5">
                    <div class="flex items-center justify-between mb-3 border-b border-slate-200/80 pb-2.5">
                        <span class="font-heading text-xs md:text-sm font-bold text-navy uppercase tracking-wider flex items-center gap-2">
                            <svg class="w-4 h-4 text-gold" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                            Rincian Keranjang Pesanan
                        </span>
                        <span class="rounded-full bg-navy/10 px-2.5 py-0.5 text-[10px] font-semibold text-navy">
                            {{ $cartCount }} Item
                        </span>
                    </div>

                    @if(empty($cartItems))
                        <div class="py-6 text-center space-y-3">
                            <div class="mx-auto flex h-10 w-10 items-center justify-center rounded-full bg-slate-200/70 text-slate-400">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-slate-700">Keranjang pesanan masih kosong</p>
                                <p class="text-[11px] text-slate-500 mt-0.5">Pilih produk dari katalog untuk mulai memesan</p>
                            </div>
                            <a href="{{ route('products.index') }}" wire:navigate
                               class="inline-flex items-center gap-1.5 rounded-full border border-gold bg-white px-4 py-2 text-[11px] font-heading font-semibold text-navy hover:bg-cream transition-colors shadow-sm">
                                <span>Pilih Produk dari Katalog</span>
                                <svg class="w-3 h-3 text-gold" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </a>
                        </div>
                    @else
                        <div class="divide-y divide-slate-200/80 space-y-3">
                            @foreach($cartItems as $uuid => $item)
                            <div class="pt-3 first:pt-0 flex flex-col sm:flex-row sm:items-center justify-between gap-2.5">
                                <div class="space-y-1 flex-1">
                                    <div class="flex items-center gap-2">
                                        <h4 class="font-heading text-xs sm:text-sm font-bold text-navy">{{ $item['product_name'] ?? 'Produk' }}</h4>
                                        <span class="rounded bg-slate-200/80 px-1.5 py-0.5 text-[10px] font-semibold text-slate-700">x{{ $item['qty'] }}</span>
                                    </div>

                                    {{-- Spesifikasi & Opsi Ringkas --}}
                                    <div class="flex flex-wrap gap-1.5 text-[10px] text-slate-600">
                                        @if(!empty($item['side_mode']))
                                            <span class="rounded bg-white border border-slate-200 px-1.5 py-0.5">
                                                {{ $item['side_mode'] === '2_muka' ? '2 Sisi (Bolak-balik)' : '1 Sisi' }}
                                            </span>
                                        @endif
                                        @if(!empty($item['length_m']) && !empty($item['width_m']))
                                            <span class="rounded bg-white border border-slate-200 px-1.5 py-0.5">
                                                {{ $item['length_m'] }}m x {{ $item['width_m'] }}m
                                            </span>
                                        @endif
                                        @if(!empty($item['selected_options']) && is_array($item['selected_options']))
                                            @foreach($item['selected_options'] as $opt)
                                                <span class="rounded bg-white border border-slate-200 px-1.5 py-0.5">
                                                    {{ $opt['group_name'] ?? '' }}: {{ $opt['option_name'] ?? '' }}
                                                </span>
                                            @endforeach
                                        @endif
                                    </div>

                                    @if(!empty($item['manual_quote_flag']))
                                        <p class="text-[10px] text-amber-700 font-medium flex items-center gap-1">
                                            <span>* {{ $item['manual_quote_note'] ?: 'Perlu konfirmasi harga admin' }}</span>
                                        </p>
                                    @endif
                                </div>

                                {{-- Subtotal & Tombol Aksi --}}
                                <div class="flex sm:flex-col items-center sm:items-end justify-between sm:justify-center gap-2 shrink-0">
                                    <span class="font-heading text-xs sm:text-sm font-bold text-navy">
                                        Rp {{ number_format((float)($item['line_subtotal'] ?? 0), 0, ',', '.') }}
                                    </span>
                                    <div class="flex items-center gap-2">
                                        <button type="button"
                                                wire:click.prevent="$dispatch('open-configurator', { productId: {{ $item['product_id'] }}, cartItemUuid: '{{ $uuid }}' })"
                                                class="text-[11px] font-medium text-navy hover:text-gold transition-colors underline cursor-pointer">
                                            Ubah
                                        </button>
                                        <span class="text-slate-300">|</span>
                                        <button type="button"
                                                wire:click.prevent="removeItem('{{ $uuid }}')"
                                                class="text-[11px] font-medium text-red-500 hover:text-red-700 transition-colors underline cursor-pointer">
                                            Hapus
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        {{-- Subtotal Card --}}
                        <div class="mt-4 pt-3 border-t border-slate-200/80 space-y-2">
                            <div class="flex items-center justify-between">
                                <span class="font-heading text-xs sm:text-sm font-bold text-navy uppercase tracking-wider">Subtotal:</span>
                                <span class="font-heading text-sm sm:text-base font-bold text-navy">
                                    Rp {{ number_format((float)$cartSubtotal, 0, ',', '.') }}
                                </span>
                            </div>
                            @if($hasManualQuote)
                                <div class="rounded-lg bg-amber-50 border border-amber-200 p-2 text-[11px] text-amber-800">
                                    Beberapa item perlu konfirmasi harga tambahan dari admin, akan diinfokan via WhatsApp.
                                </div>
                            @endif
                        </div>

                        <div class="mt-3 text-right">
                            <a href="{{ route('products.index') }}" wire:navigate class="text-[11px] font-heading font-semibold text-navy underline hover:text-gold transition-colors">
                                + Tambah produk lain
                            </a>
                        </div>
                    @endif
                </div>

                {{-- 2. Data Pemesan (Disabled jika cart kosong) --}}
                <div class="@if(empty($cartItems)) opacity-50 pointer-events-none @endif space-y-4 md:space-y-5">
                    {{-- Name + Phone Row --}}
                    <div class="grid gap-3 md:gap-5 sm:grid-cols-2">
                        <div>
                            <label for="order-name" class="block text-xs md:text-sm font-heading font-semibold text-navy mb-1 md:mb-1.5">Nama Lengkap</label>
                            <input id="order-name" type="text" wire:model="name" placeholder="Masukkan nama Anda"
                                   @disabled(empty($cartItems))
                                   class="w-full rounded-lg md:rounded-xl border @error('name') border-red-400 bg-red-50/30 @else border-gold/25 bg-cream @enderror px-3 md:px-4 py-2.5 md:py-3.5 text-xs md:text-sm font-inter text-navy outline-none transition-all duration-300 placeholder:text-ink-soft/60 focus:bg-white focus:border-gold focus:ring-2 focus:ring-gold/20 hover:border-gold/40" />
                            @error('name')
                            <span class="text-[10px] md:text-xs text-red-500 mt-1 block font-inter">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="order-phone" class="block text-xs md:text-sm font-heading font-semibold text-navy mb-1 md:mb-1.5">No. WhatsApp</label>
                            <input id="order-phone" type="tel" wire:model="phone" placeholder="+62 812-xxxx-xxxx"
                                   @disabled(empty($cartItems))
                                   class="w-full rounded-lg md:rounded-xl border @error('phone') border-red-400 bg-red-50/30 @else border-gold/25 bg-cream @enderror px-3 md:px-4 py-2.5 md:py-3.5 text-xs md:text-sm font-inter text-navy outline-none transition-all duration-300 placeholder:text-ink-soft/60 focus:bg-white focus:border-gold focus:ring-2 focus:ring-gold/20 hover:border-gold/40" />
                            @error('phone')
                            <span class="text-[10px] md:text-xs text-red-500 mt-1 block font-inter">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Email --}}
                    <div>
                        <label for="order-email" class="block text-xs md:text-sm font-heading font-semibold text-navy mb-1 md:mb-1.5">Email</label>
                        <input id="order-email" type="email" wire:model="email" placeholder="contoh@email.com"
                               @disabled(empty($cartItems))
                               class="w-full rounded-lg md:rounded-xl border @error('email') border-red-400 bg-red-50/30 @else border-gold/25 bg-cream @enderror px-3 md:px-4 py-2.5 md:py-3.5 text-xs md:text-sm font-inter text-navy outline-none transition-all duration-300 placeholder:text-ink-soft/60 focus:bg-white focus:border-gold focus:ring-2 focus:ring-gold/20 hover:border-gold/40" />
                        @error('email')
                        <span class="text-[10px] md:text-xs text-red-500 mt-1 block font-inter">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Alamat Pengiriman --}}
                    <div>
                        <label for="order-shipping" class="block text-xs md:text-sm font-heading font-semibold text-navy mb-1 md:mb-1.5">Alamat Lengkap Pengiriman</label>
                        <textarea id="order-shipping" rows="2" wire:model="shipping_address" placeholder="Jalan, No. Rumah, RT/RW, Kelurahan, Kecamatan, Kota/Kabupaten, Kode Pos..."
                                  @disabled(empty($cartItems))
                                  class="w-full rounded-lg md:rounded-xl border @error('shipping_address') border-red-400 bg-red-50/30 @else border-gold/25 bg-cream @enderror px-3 md:px-4 py-2.5 md:py-3 text-xs md:text-sm font-inter text-navy outline-none transition-all duration-300 placeholder:text-ink-soft/60 focus:bg-white focus:border-gold focus:ring-2 focus:ring-gold/20 hover:border-gold/40 resize-none"></textarea>
                        @error('shipping_address')
                        <span class="text-[10px] md:text-xs text-red-500 mt-1 block font-inter">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Status File Desain --}}
                    <div>
                        <label class="block text-xs md:text-sm font-heading font-semibold text-navy mb-2">Status File Desain</label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5">
                            <label class="flex items-center gap-2.5 rounded-lg md:rounded-xl border @if($design_file_status === 'ready') border-gold bg-white shadow-sm ring-1 ring-gold @else border-gold/25 bg-cream @endif p-2.5 sm:p-3 cursor-pointer transition-all hover:bg-white">
                                <input type="radio" wire:model.live="design_file_status" value="ready" class="h-3.5 w-3.5 accent-gold" @disabled(empty($cartItems))>
                                <div>
                                    <span class="block text-xs font-semibold text-navy">File Sudah Siap</span>
                                    <span class="block text-[10px] text-ink-soft">File siap cetak (PDF/TIFF/CDR)</span>
                                </div>
                            </label>
                            <label class="flex items-center gap-2.5 rounded-lg md:rounded-xl border @if($design_file_status === 'need_design_help') border-gold bg-white shadow-sm ring-1 ring-gold @else border-gold/25 bg-cream @endif p-2.5 sm:p-3 cursor-pointer transition-all hover:bg-white">
                                <input type="radio" wire:model.live="design_file_status" value="need_design_help" class="h-3.5 w-3.5 accent-gold" @disabled(empty($cartItems))>
                                <div>
                                    <span class="block text-xs font-semibold text-navy">Belum Ada File</span>
                                    <span class="block text-[10px] text-ink-soft">Minta bantuan desain tim OMAH Vector</span>
                                </div>
                            </label>
                        </div>
                        @error('design_file_status')
                        <span class="text-[10px] md:text-xs text-red-500 mt-1 block font-inter">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Catatan Tambahan --}}
                    <div>
                        <label for="order-notes" class="block text-xs md:text-sm font-heading font-semibold text-navy mb-1 md:mb-1.5">Catatan Tambahan (Opsional)</label>
                        <textarea id="order-notes" rows="2" wire:model="notes" placeholder="Catatan khusus mengenai pesanan, finishing, atau instruksi pengiriman..."
                                  @disabled(empty($cartItems))
                                  class="w-full rounded-lg md:rounded-xl border border-gold/25 bg-cream px-3 md:px-4 py-2.5 md:py-3 text-xs md:text-sm font-inter text-navy outline-none transition-all duration-300 placeholder:text-ink-soft/60 focus:bg-white focus:border-gold focus:ring-2 focus:ring-gold/20 hover:border-gold/40 resize-none"></textarea>
                        @error('notes')
                        <span class="text-[10px] md:text-xs text-red-500 mt-1 block font-inter">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Submit Button --}}
                <button type="submit"
                        wire:loading.attr="disabled"
                        @disabled(empty($cartItems) || $isSubmitting)
                        class="group relative w-full rounded-full bg-navy px-4 md:px-6 py-3 md:py-4 text-xs md:text-sm font-heading font-semibold text-cream shadow-button transition-all duration-300 hover:bg-navy-deep hover:shadow-button-hover hover:-translate-y-0.5 active:translate-y-0 disabled:opacity-50 disabled:cursor-not-allowed overflow-hidden">
                    <span class="relative z-10 flex items-center justify-center gap-1.5 md:gap-2">
                        <span wire:loading.remove>Buat Pesanan</span>
                        <span wire:loading>Memproses Pesanan...</span>
                        <svg class="w-3 h-3 md:w-4 md:h-4 text-gold transition-transform duration-300 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5"/></svg>
                    </span>
                    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-gold/15 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                </button>

                <p class="text-center text-[10px] md:text-xs font-inter text-ink-soft">Data pesanan Anda aman dan langsung terhubung dengan layanan admin resmi OMAH Vector.</p>
            </form>
        </div>
    </div>
</section>
