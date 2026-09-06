<div class="min-h-screen bg-light pt-28 pb-20">
    <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
        {{-- Card Struk Digital --}}
        <div class="overflow-hidden rounded-3xl border border-navy/10 bg-white shadow-xl">
            {{-- Header Struk --}}
            <div class="relative bg-gradient-to-br from-navy via-navy-deep to-navy p-6 sm:p-8 text-cream">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <div class="inline-flex items-center gap-2 rounded-full bg-gold/20 px-3 py-1 text-xs font-semibold uppercase tracking-wider text-gold">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Struk Digital Pemesanan
                        </div>
                        <h1 class="mt-2 text-2xl sm:text-3xl font-bold font-heading text-cream">OMAH Vector</h1>
                        <p class="text-xs sm:text-sm text-cream/70 mt-1">Creative Digital Printing &amp; Custom Merch</p>
                    </div>
                    <div class="sm:text-right">
                        <span class="text-xs uppercase tracking-wider text-cream/60 block">Nomor Pesanan</span>
                        <div class="mt-1 inline-block rounded-xl bg-white/10 px-4 py-2 font-mono text-lg sm:text-xl font-bold tracking-wider text-gold shadow-inner border border-white/10">
                            {{ $order->order_number }}
                        </div>
                        <span class="text-[11px] text-cream/50 block mt-1">Simpan / screenshot nomor ini</span>
                    </div>
                </div>

                {{-- Status Badge Header --}}
                <div class="mt-6 flex flex-wrap items-center justify-between gap-2 border-t border-white/10 pt-4 text-xs">
                    <div class="flex items-center gap-2">
                        <span class="text-cream/70">Status:</span>
                        <span class="inline-flex items-center gap-1.5 rounded-full px-2.5 py-0.5 font-semibold {{ $order->status === 'terkonfirmasi' ? 'bg-emerald-500/20 text-emerald-300 border border-emerald-400/30' : 'bg-amber-500/20 text-amber-300 border border-amber-400/30' }}">
                            <span class="h-1.5 w-1.5 rounded-full {{ $order->status === 'terkonfirmasi' ? 'bg-emerald-400' : 'bg-amber-400' }}"></span>
                            {{ $order->status_label }}
                        </span>
                    </div>
                    <div class="text-cream/60">
                        {{ $order->created_at ? $order->created_at->format('d M Y, H:i') : now()->format('d M Y, H:i') }} WIB
                    </div>
                </div>
            </div>

            {{-- Body Struk --}}
            <div class="p-6 sm:p-8 space-y-6">
                @if ($expired)
                    {{-- Alert Order Kedaluwarsa --}}
                    <div class="rounded-2xl border border-red-200 bg-red-50/80 p-5 sm:p-6 text-center">
                        <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-red-100 text-red-600 mb-3">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h2 class="text-lg font-bold text-red-900">Waktu Konfirmasi Pesanan Telah Habis</h2>
                        <p class="mt-1.5 text-sm text-red-700 max-w-md mx-auto">
                            Pesanan ini tidak dikonfirmasi dalam waktu yang ditentukan sehingga rincian telah dibersihkan secara otomatis. Silakan buat pesanan baru dari katalog kami.
                        </p>
                        <div class="mt-5">
                            <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 rounded-xl bg-navy px-5 py-2.5 text-sm font-semibold text-cream hover:bg-navy-deep transition shadow-sm">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                Buka Katalog Produk
                            </a>
                        </div>
                    </div>
                @else
                    {{-- Info Pelanggan & Pengiriman --}}
                    <div class="rounded-2xl bg-slate-50 border border-slate-200/80 p-4 sm:p-5">
                        <h2 class="text-xs font-bold uppercase tracking-wider text-slate-500 mb-3 flex items-center gap-1.5">
                            <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            Data Pemesan &amp; Pengiriman
                        </h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-sm">
                            <div>
                                <span class="text-xs text-slate-500 block">Nama Pemesan</span>
                                <span class="font-semibold text-navy">{{ $order->customer_name ?: '-' }}</span>
                            </div>
                            <div>
                                <span class="text-xs text-slate-500 block">Nomor WhatsApp</span>
                                <span class="font-semibold text-navy">{{ $order->customer_phone ?: '-' }}</span>
                            </div>
                            <div>
                                <span class="text-xs text-slate-500 block">Email</span>
                                <span class="font-medium text-slate-700">{{ $order->customer_email ?: '-' }}</span>
                            </div>
                            <div>
                                <span class="text-xs text-slate-500 block">Status File Desain</span>
                                <span class="inline-flex items-center gap-1 font-medium {{ $order->design_file_status === 'ready' ? 'text-emerald-700' : 'text-amber-700' }}">
                                    @if ($order->design_file_status === 'ready')
                                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        File Sudah Siap Cetak
                                    @else
                                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        Perlu Bantuan Desain
                                    @endif
                                </span>
                            </div>
                            @if ($order->shipping_address)
                                <div class="sm:col-span-2 pt-2 border-t border-slate-200/60">
                                    <span class="text-xs text-slate-500 block">Alamat Pengiriman</span>
                                    <span class="text-slate-700 text-xs sm:text-sm whitespace-pre-line">{{ $order->shipping_address }}</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Tabel Rincian Item --}}
                    <div>
                        <h2 class="text-xs font-bold uppercase tracking-wider text-slate-500 mb-3 flex items-center gap-1.5">
                            <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                            Rincian Item Pesanan
                        </h2>
                        <div class="divide-y divide-slate-100 border-y border-slate-200">
                            @forelse ($order->orderItems as $item)
                                <div class="py-3.5 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                                    <div class="space-y-1">
                                        <p class="font-semibold text-navy text-sm sm:text-base">{{ $item->product_name }}</p>
                                        <div class="flex flex-wrap items-center gap-1.5 text-xs text-slate-600">
                                            @if ($item->side_mode)
                                                <span class="rounded bg-slate-100 px-2 py-0.5 font-medium text-slate-700">
                                                    {{ $item->side_mode === '2_muka' ? '2 Sisi (Bolak-balik)' : '1 Sisi' }}
                                                </span>
                                            @endif
                                            @if ($item->length_m && $item->width_m)
                                                <span class="rounded bg-slate-100 px-2 py-0.5 font-medium text-slate-700">
                                                    {{ $item->length_m }}m x {{ $item->width_m }}m
                                                </span>
                                            @endif
                                            @if (! empty($item->selected_options) && is_array($item->selected_options))
                                                @foreach ($item->selected_options as $opt)
                                                    <span class="rounded bg-slate-100 px-2 py-0.5 text-slate-600">
                                                        {{ $opt['group_name'] ?? '' }}: <strong class="text-slate-800">{{ $opt['option_name'] ?? '' }}</strong>
                                                    </span>
                                                @endforeach
                                            @endif
                                        </div>
                                        @if ($item->manual_quote_flag)
                                            <p class="text-xs text-amber-700 font-medium flex items-center gap-1 mt-1">
                                                <svg class="h-3.5 w-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                                Opsi ini memerlukan konfirmasi harga dari admin
                                            </p>
                                        @endif
                                    </div>
                                    <div class="sm:text-right shrink-0">
                                        <p class="font-bold text-navy text-sm sm:text-base">
                                            Rp {{ number_format((float) $item->line_subtotal, 0, ',', '.') }}
                                        </p>
                                        <p class="text-xs text-slate-500">
                                            {{ $item->qty }} x Rp {{ number_format((float) $item->unit_price, 0, ',', '.') }}
                                        </p>
                                    </div>
                                </div>
                            @empty
                                <div class="py-4 text-center text-sm text-slate-500 italic">
                                    Item pesanan tidak tersedia atau telah diredaksi.
                                </div>
                            @endforelse
                        </div>

                        {{-- Subtotal & Catatan Ongkir --}}
                        <div class="mt-4 space-y-2">
                            <div class="flex justify-between items-baseline pt-2">
                                <span class="text-sm font-semibold text-navy">Total Estimasi Subtotal:</span>
                                <span class="text-xl sm:text-2xl font-bold text-navy font-mono">
                                    Rp {{ number_format((float) ($order->subtotal ?? 0), 0, ',', '.') }}
                                </span>
                            </div>
                            <div class="rounded-xl bg-amber-50/70 border border-amber-200/60 p-3 text-xs text-amber-800 flex items-start gap-2">
                                <svg class="h-4 w-4 shrink-0 text-amber-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <span><strong>Catatan:</strong> Ongkos kirim akan dikonfirmasi oleh admin via WhatsApp dan belum termasuk dalam total di atas.</span>
                            </div>
                            @if ($order->has_manual_quote_item)
                                <div class="rounded-xl bg-blue-50 border border-blue-200 p-3 text-xs text-blue-800 flex items-start gap-2">
                                    <svg class="h-4 w-4 shrink-0 text-blue-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                    <span>Ada item pesanan dengan opsi khusus yang memerlukan konfirmasi harga tambahan dari admin via WhatsApp.</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Tombol Lanjutkan ke WhatsApp Admin (Tanpa Timer) --}}
                    <div class="pt-4 border-t border-slate-200">
                        <button
                            type="button"
                            wire:click="confirmAndRedirect"
                            wire:loading.attr="disabled"
                            class="w-full inline-flex items-center justify-center gap-3 rounded-2xl bg-[#25D366] hover:bg-[#20bd5a] text-white px-6 py-4 text-base sm:text-lg font-bold shadow-lg shadow-emerald-500/25 transition-all hover:scale-[1.01] active:scale-[0.99] disabled:opacity-75 disabled:cursor-not-allowed"
                        >
                            <span wire:loading.remove wire:target="confirmAndRedirect" class="flex items-center gap-2.5">
                                <svg class="h-6 w-6 fill-current" viewBox="0 0 24 24">
                                    <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                                </svg>
                                <span>Lanjutkan ke WhatsApp Admin</span>
                            </span>
                            <span wire:loading wire:target="confirmAndRedirect" class="flex items-center gap-2">
                                <svg class="animate-spin h-5 w-5 text-white" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                <span>Membuka WhatsApp...</span>
                            </span>
                        </button>
                        <p class="text-center text-xs text-slate-500 mt-2.5">
                            Klik tombol di atas untuk mengirim rincian pesanan Anda langsung ke WhatsApp Admin OMAH Vector.
                        </p>
                    </div>
                @endif
            </div>

            {{-- Footer Struk --}}
            <div class="bg-slate-50 border-t border-slate-200/80 px-6 py-4 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-slate-500">
                <span>Butuh bantuan lain? Hubungi customer care kami.</span>
                <a href="{{ route('orders.track', ['order' => $order->order_number]) }}" class="font-medium text-navy hover:text-gold transition">
                    Lacak Progres Pesanan &rarr;
                </a>
            </div>
        </div>
    </div>
</div>
