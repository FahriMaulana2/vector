<div class="space-y-6">
    {{-- Platform --}}
    <div>
        <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1">Platform <span class="text-red-500">*</span></label>
        <select wire:model.live="platform" class="w-full text-sm bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#173B6C]/20 focus:border-[#173B6C] @error('platform') border-red-300 focus:ring-red-200 focus:border-red-400 @enderror">
            <option value="">— Pilih Platform —</option>
            @foreach($availablePlatforms as $key => $label)
                <option value="{{ $key }}">{{ $label }}</option>
            @endforeach
        </select>
        @error('platform') <p class="text-xs text-red-500 mt-1 font-medium">{{ $message }}</p> @enderror
    </div>

    {{-- Nama Toko --}}
    <div>
        <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1">Nama Toko <span class="text-red-500">*</span></label>
        <input type="text" wire:model.live="store_name" placeholder="Contoh: OMAH Vector Official" class="w-full text-sm bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#173B6C]/20 focus:border-[#173B6C] @error('store_name') border-red-300 focus:ring-red-200 focus:border-red-400 @enderror">
        @error('store_name') <p class="text-xs text-red-500 mt-1 font-medium">{{ $message }}</p> @enderror
    </div>

    {{-- URL Toko --}}
    <div>
        <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1">URL Toko</label>
        <input type="url" wire:model.live="store_url" placeholder="https://shopee.co.id/omahvector" class="w-full text-sm bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#173B6C]/20 focus:border-[#173B6C] @error('store_url') border-red-300 focus:ring-red-200 focus:border-red-400 @enderror">
        @error('store_url') <p class="text-xs text-red-500 mt-1 font-medium">{{ $message }}</p> @enderror
    </div>

    {{-- Logo Toko --}}
    <div>
        <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1">Logo Toko (Optional)</label>
        <div class="flex items-center gap-4">
            @if ($logo)
                <img src="{{ $logo->temporaryUrl() }}" class="w-12 h-12 rounded-xl object-cover border border-slate-200" alt="Preview logo baru">
            @elseif (isset($existing_logo_url) && $existing_logo_url)
                <img src="{{ asset('storage/' . $existing_logo_url) }}" class="w-12 h-12 rounded-xl object-cover border border-slate-200" alt="Logo saat ini">
            @endif
            <input type="file" wire:model.live="logo" accept="image/jpg,image/jpeg,image/png,image/webp" class="text-xs text-slate-500 file:mr-3 file:py-2 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-[#173B6C]/10 file:text-[#173B6C] hover:file:bg-[#173B6C]/20">
        </div>
        <div wire:loading wire:target="logo" class="mt-2 flex items-center gap-2 text-xs text-[#173B6C]">
            <svg class="animate-spin h-3.5 w-3.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Mengunggah logo...
        </div>
        @error('logo') <p class="text-xs text-red-500 mt-1 font-medium">{{ $message }}</p> @enderror
    </div>

    {{-- Toggle Active / Maintenance Status --}}
    <div x-data="{ isActive: @entangle('is_active') }" class="p-4 bg-slate-50 rounded-xl border border-slate-200/80 space-y-3">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-semibold text-slate-800">Status Toko</p>
                <p class="text-xs text-slate-500">Nonaktifkan jika toko sedang maintenance.</p>
            </div>
            <button
                type="button"
                @click="isActive = !isActive"
                :class="isActive ? 'bg-emerald-500' : 'bg-slate-300'"
                class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none"
            >
                <span
                    :class="isActive ? 'translate-x-5' : 'translate-x-0'"
                    class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"
                ></span>
            </button>
        </div>

        {{-- Conditional Maintenance Message --}}
        <div x-show="!isActive" x-transition class="pt-2">
            <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1">Pesan Maintenance (Tampil di Popup CTA)</label>
            <textarea wire:model.live="maintenance_message" rows="2" placeholder="Toko Shopee sedang libur/maintenance. Klik tombol untuk chat Admin via WhatsApp." class="w-full text-sm bg-white border border-slate-200 rounded-xl p-2.5 text-slate-800 focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 @error('maintenance_message') border-red-300 focus:ring-red-200 focus:border-red-400 @enderror"></textarea>
            @error('maintenance_message') <p class="text-xs text-red-500 mt-1 font-medium">{{ $message }}</p> @enderror
        </div>
    </div>

    {{-- Display Order --}}
    <div>
        <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1">Urutan Tampilan (Display Order)</label>
        <input type="number" wire:model.live="display_order" min="0" class="w-full text-sm bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#173B6C]/20 focus:border-[#173B6C] @error('display_order') border-red-300 focus:ring-red-200 focus:border-red-400 @enderror">
        @error('display_order') <p class="text-xs text-red-500 mt-1 font-medium">{{ $message }}</p> @enderror
    </div>
</div>
