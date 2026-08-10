<div class="space-y-6">
    <!-- Header -->
    <div>
        <nav class="flex text-sm text-slate-500 mb-2" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2">
                <li class="inline-flex items-center">
                    <a href="{{ route('admin.dashboard') }}" class="hover:text-[#0F2747] transition-colors">Admin</a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-3 h-3 text-slate-400 mx-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        <a href="{{ route('admin.orders.index') }}" class="hover:text-[#0F2747] transition-colors">Pesanan</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-3 h-3 text-slate-400 mx-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        <span class="font-medium text-[#0F2747]">Detail Pesanan</span>
                    </div>
                </li>
            </ol>
        </nav>
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-[#182B3A]">Detail Pesanan</h1>
                <p class="text-sm text-slate-500 mt-1">Nomor Pesanan: <span class="font-mono font-medium text-[#182B3A]">{{ $order->order_number }}</span></p>
            </div>
            <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center gap-2 px-4 py-2 border border-slate-200 rounded-xl text-sm font-medium text-slate-600 hover:bg-slate-50 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Kolom Kiri: Detail Pesanan -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6">
                <h3 class="text-base font-semibold text-[#182B3A] mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-[#0F2747]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    Informasi Pelanggan
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                    <div>
                        <p class="text-slate-500 mb-1">Nama Lengkap</p>
                        <p class="font-medium text-[#182B3A]">{{ $order->customer_name }}</p>
                    </div>
                    <div>
                        <p class="text-slate-500 mb-1">Nomor Telepon</p>
                        <p class="font-medium text-[#182B3A]">{{ $order->customer_phone }}</p>
                    </div>
                    <div>
                        <p class="text-slate-500 mb-1">Alamat Email</p>
                        <p class="font-medium text-[#182B3A]">{{ $order->customer_email }}</p>
                    </div>
                    <div>
                        <p class="text-slate-500 mb-1">Tanggal Pesanan</p>
                        <p class="font-medium text-[#182B3A]">{{ $order->created_at->format('d F Y, H:i') }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6">
                <h3 class="text-base font-semibold text-[#182B3A] mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-[#0F2747]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    Detail Produk
                </h3>
                <div class="space-y-4">
                    <div class="flex justify-between items-start pb-4 border-b border-slate-100">
                        <div>
                            <p class="font-medium text-[#182B3A]">{{ $order->product ? $order->product->name : 'Permintaan Umum / Custom' }}</p>
                            <p class="text-sm text-slate-500 mt-1">{{ $order->product ? 'Kategori: ' . $order->product->category->name : 'Tidak spesifik' }}</p>
                        </div>
                        <div class="text-right">
                            <p class="font-medium text-[#182B3A]">Qty: {{ $order->quantity }}</p>
                        </div>
                    </div>
                    @if($order->notes)
                        <div>
                            <p class="text-sm font-medium text-slate-700 mb-1">Catatan Pelanggan:</p>
                            <p class="text-sm text-slate-600 bg-slate-50 p-3 rounded-lg border border-slate-100">{{ $order->notes }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Riwayat Status -->
            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6">
                <h3 class="text-base font-semibold text-[#182B3A] mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-[#0F2747]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Riwayat Perubahan Status
                </h3>
                <div class="space-y-4">
                    @forelse($histories as $history)
                        <div class="flex gap-4">
                            <div class="flex flex-col items-center">
                                <div class="w-3 h-3 rounded-full bg-[#0F2747] mt-1.5"></div>
                                @if(!$loop->last)
                                    <div class="w-0.5 flex-1 bg-slate-200 my-1"></div>
                                @endif
                            </div>
                            <div class="flex-1 pb-4">
                                <div class="flex flex-col sm:flex-row sm:items-center gap-2 mb-1">
                                    <span class="text-sm font-semibold text-[#182B3A]">
                                        {{ ucfirst(str_replace('_', ' ', $history->previous_status ?? 'Dibuat')) }} 
                                        <svg class="w-3 h-3 inline text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg> 
                                        {{ ucfirst(str_replace('_', ' ', $history->new_status)) }}
                                    </span>
                                    <span class="text-xs text-slate-400">{{ $history->created_at->format('d M Y, H:i') }}</span>
                                </div>
                                <p class="text-sm text-slate-600">
                                    Oleh: <span class="font-medium">{{ $history->changedByUser ? $history->changedByUser->name : 'Sistem' }}</span>
                                </p>
                                @if($history->notes)
                                    <p class="text-sm text-slate-500 mt-1 bg-slate-50 p-2 rounded border border-slate-100">{{ $history->notes }}</p>
                                @endif
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-slate-500 italic">Belum ada riwayat perubahan status.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Update Status -->
        <div class="lg:col-span-1">
            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6 sticky top-6">
                <h3 class="text-base font-semibold text-[#182B3A] mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-[#0F2747]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                    Update Status
                </h3>

                @if(session('success'))
                    <div class="mb-4 p-3 bg-green-50 border border-green-200 rounded-lg text-sm text-green-700">
                        {{ session('success') }}
                    </div>
                @endif

                <form wire:submit="updateStatus" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Status Saat Ini</label>
                        <select wire:model.live="new_status" class="block w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm text-[#182B3A] focus:outline-none focus:ring-2 focus:ring-[#0F2747]/20 focus:border-[#0F2747] bg-slate-50/50">
                            <option value="pending">Pending</option>
                            <option value="confirmed">Confirmed</option>
                            <option value="design_process">Design Process</option>
                            <option value="printing">Printing</option>
                            <option value="ready_for_pickup">Ready for Pickup</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Catatan Perubahan (Opsional)</label>
                        <textarea wire:model.live="status_notes" rows="3" class="block w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm text-[#182B3A] focus:outline-none focus:ring-2 focus:ring-[#0F2747]/20 focus:border-[#0F2747] bg-slate-50/50 resize-none" placeholder="Contoh: Desain sudah disetujui, lanjut cetak..."></textarea>
                    </div>

                    <button type="submit" wire:loading.attr="disabled" class="w-full flex justify-center items-center gap-2 py-2.5 px-4 border border-transparent rounded-xl text-sm font-semibold text-white bg-[#0F2747] hover:bg-[#081A31] transition-all disabled:opacity-70 disabled:cursor-not-allowed">
                        <svg wire:loading.remove wire:target="updateStatus" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <svg wire:loading wire:target="updateStatus" class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span wire:loading.remove wire:target="updateStatus">Simpan Perubahan</span>
                        <span wire:loading wire:target="updateStatus">Menyimpan...</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>