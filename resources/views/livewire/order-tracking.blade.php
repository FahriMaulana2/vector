<div>
    {{-- No surplus words or unnecessary actions. - Marcus Aurelius --}}
<div class="min-h-screen bg-light pt-28 pb-20">
    <section class="mx-auto max-w-5xl px-5 md:px-6 lg:px-8">
        <div class="max-w-2xl">
            <p class="font-heading text-xs font-semibold uppercase tracking-[0.25em] text-gold-dark">OMH Vector</p>
            <h1 class="mt-3 font-heading text-3xl font-bold tracking-tight text-navy md:text-5xl">Lacak Pesanan</h1>
            <p class="mt-4 max-w-xl text-base leading-relaxed text-ink-soft md:text-lg">
                Masukkan nomor pesanan dan email yang digunakan saat pemesanan untuk melihat pembaruan status pesanan Anda.
            </p>
        </div>

        <div class="mt-10 grid gap-8 lg:grid-cols-[minmax(0,0.85fr)_minmax(0,1.15fr)] lg:items-start">
            <div class="rounded-2xl border border-navy/10 bg-white p-6 shadow-card md:p-8">
                <h2 class="font-heading text-xl font-semibold text-navy">Cari pesanan</h2>
                <form wire:submit="trackOrder" class="mt-6 space-y-5">
                    <div>
                        <label for="order-number" class="block text-sm font-semibold text-navy">Nomor Pesanan</label>
                        <input id="order-number" type="text" wire:model="orderNumber" placeholder="Contoh: ORD-20260825-ABC123"
                               class="mt-2 block w-full rounded-xl border border-navy/15 bg-light px-4 py-3 text-sm text-ink outline-none transition focus:border-gold focus:ring-2 focus:ring-gold/20">
                        @error('orderNumber') <p class="mt-2 text-sm text-danger">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="tracking-email" class="block text-sm font-semibold text-navy">Email</label>
                        <input id="tracking-email" type="email" wire:model="email" placeholder="customer@example.com"
                               class="mt-2 block w-full rounded-xl border border-navy/15 bg-light px-4 py-3 text-sm text-ink outline-none transition focus:border-gold focus:ring-2 focus:ring-gold/20">
                        @error('email') <p class="mt-2 text-sm text-danger">{{ $message }}</p> @enderror
                    </div>

                    @if($lookupError)
                        <p class="rounded-xl border border-danger/20 bg-red-50 px-4 py-3 text-sm text-danger" role="alert">{{ $lookupError }}</p>
                    @endif

                    @if($rateLimited)
                        <p class="rounded-xl border border-warning/20 bg-amber-50 px-4 py-3 text-sm text-amber-700" role="alert">Terlalu banyak percobaan. Silakan coba lagi dalam beberapa saat.</p>
                    @endif

                    <button type="submit" wire:loading.attr="disabled" wire:target="trackOrder"
                            class="inline-flex w-full items-center justify-center gap-2 rounded-xl border border-gold/40 bg-navy px-5 py-3 text-sm font-semibold text-cream transition hover:bg-navy-deep hover:shadow-button-hover disabled:cursor-not-allowed disabled:opacity-70">
                        <span wire:loading.remove wire:target="trackOrder">Lacak Pesanan</span>
                        <span wire:loading wire:target="trackOrder">Melacak...</span>
                    </button>
                </form>
            </div>

            @if($trackedOrder)
                <div class="rounded-2xl border border-navy/10 bg-white p-6 shadow-card md:p-8" aria-live="polite">
                    <div class="flex flex-col gap-4 border-b border-navy/10 pb-6 sm:flex-row sm:items-start sm:justify-between">
                        <div>
                            <p class="text-sm text-ink-soft">Nomor Pesanan</p>
                            <p class="mt-1 font-mono text-lg font-semibold text-navy">{{ $trackedOrder->order_number }}</p>
                        </div>
                        <span class="inline-flex w-fit rounded-full bg-gold/15 px-3 py-1.5 text-sm font-semibold text-gold-dark">
                            {{ $this->formatStatus($trackedOrder->status) }}
                        </span>
                    </div>

                    <div class="mt-6">
                        <p class="text-sm text-ink-soft">Nama Pelanggan</p>
                        <p class="mt-1 text-lg font-semibold text-navy">{{ $trackedOrder->customer_name }}</p>
                    </div>

                    <div class="mt-8">
                        <h2 class="font-heading text-xl font-semibold text-navy">Perjalanan Pesanan</h2>
                        <div class="mt-6 space-y-5">
                            @forelse($trackedOrder->statusHistories as $history)
                                <div wire:key="tracking-history-{{ $history->id }}" class="flex gap-4">
                                    <div class="flex flex-col items-center">
                                        <span class="mt-1 h-3 w-3 shrink-0 rounded-full bg-gold ring-4 ring-gold/15"></span>
                                        @if(!$loop->last)<span class="mt-2 w-px grow bg-navy/15"></span>@endif
                                    </div>
                                    <div class="min-w-0 flex-1 pb-1">
                                        <div class="flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between">
                                            <p class="font-semibold text-navy">{{ $this->formatStatus($history->new_status) }}</p>
                                            <time class="text-xs text-ink-soft">{{ $history->created_at->format('d M Y, H:i') }}</time>
                                        </div>
                                        @if($history->previous_status)
                                            <p class="mt-1 text-sm text-ink-soft">Dari: {{ $this->formatStatus($history->previous_status) }}</p>
                                        @endif
                                        @if($history->notes)
                                            <p class="mt-2 rounded-lg bg-light px-3 py-2 text-sm text-ink-soft">{{ $history->notes }}</p>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <p class="text-sm italic text-ink-soft">Belum ada riwayat perubahan status.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            @else
                <div class="flex min-h-72 items-center justify-center rounded-2xl border border-dashed border-navy/15 bg-cream/60 p-8 text-center">
                    <div>
                        <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-gold/15 text-2xl text-gold-dark">?</div>
                        <p class="mt-4 font-heading text-lg font-semibold text-navy">Status pesanan tampil di sini</p>
                        <p class="mt-2 text-sm leading-relaxed text-ink-soft">Gunakan data yang sama seperti saat membuat pesanan.</p>
                    </div>
                </div>
            @endif
        </div>
    </section>
