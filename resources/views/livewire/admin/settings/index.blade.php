<div class="space-y-6">

    {{-- Header --}}
    <div>
        <nav class="flex text-sm text-slate-500 mb-2" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2">
                <li class="inline-flex items-center">
                    <a
                        href="{{ route('admin.dashboard') }}"
                        class="hover:text-[#0F2747] transition-colors"
                    >
                        Admin
                    </a>
                </li>

                <li aria-current="page">
                    <div class="flex items-center">
                        <svg
                            class="w-3 h-3 text-slate-400 mx-1"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 5l7 7-7 7"
                            />
                        </svg>

                        <span class="font-medium text-[#0F2747]">
                            Pengaturan Website
                        </span>
                    </div>
                </li>
            </ol>
        </nav>

        <h1 class="text-2xl font-bold text-[#182B3A]">
            Pengaturan Website
        </h1>

        <p class="text-sm text-slate-500 mt-1">
            Kelola informasi perusahaan, media sosial, branding, dan SEO website OMH Vector.
        </p>
    </div>


    {{-- Flash Success --}}
    @if(session('success'))
        <div class="p-4 bg-green-50 border border-green-200 rounded-xl text-sm text-green-700 flex items-center gap-2">
            <svg
                class="w-5 h-5 flex-shrink-0"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                />
            </svg>

            {{ session('success') }}
        </div>
    @endif


    <form wire:submit="save" class="space-y-6">

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- ========================================================= --}}
            {{-- KOLOM KIRI --}}
            {{-- ========================================================= --}}

            <div class="lg:col-span-2 space-y-6">

                {{-- ===================================================== --}}
                {{-- INFORMASI PERUSAHAAN --}}
                {{-- ===================================================== --}}

                <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6">

                    <h3 class="text-base font-semibold text-[#182B3A] mb-4 flex items-center gap-2">

                        <svg
                            class="w-5 h-5 text-[#0F2747]"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"
                            />
                        </svg>

                        Informasi Perusahaan
                    </h3>


                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        {{-- Nama --}}
                        <div class="md:col-span-2">

                            <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                Nama Perusahaan
                                <span class="text-red-500">*</span>
                            </label>

                            <input
                                wire:model.live="settings.company_name"
                                type="text"
                                class="block w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#0F2747]/20 focus:border-[#0F2747] bg-slate-50/50 focus:bg-white @error('settings.company_name') border-red-300 @enderror"
                            >

                            @error('settings.company_name')
                                <p class="mt-1 text-xs text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- Email --}}
                        <div>

                            <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                Email
                            </label>

                            <input
                                wire:model.live="settings.company_email"
                                type="email"
                                class="block w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#0F2747]/20 focus:border-[#0F2747] bg-slate-50/50 focus:bg-white"
                            >

                        </div>


                        {{-- Telepon --}}
                        <div>

                            <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                Nomor Telepon
                            </label>

                            <input
                                wire:model.live="settings.company_phone"
                                type="text"
                                class="block w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#0F2747]/20 focus:border-[#0F2747] bg-slate-50/50 focus:bg-white"
                            >

                        </div>


                        {{-- WhatsApp --}}
                        <div>

                            <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                Nomor WhatsApp
                                <span class="text-xs text-slate-400">
                                    (628xxx)
                                </span>
                            </label>

                            <input
                                wire:model.live="settings.company_whatsapp"
                                type="text"
                                class="block w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#0F2747]/20 focus:border-[#0F2747] bg-slate-50/50 focus:bg-white"
                            >

                        </div>


                        {{-- Jam Operasional --}}
                        <div>

                            <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                Jam Operasional
                            </label>

                            <input
                                wire:model.live="settings.office_hours"
                                type="text"
                                placeholder="Contoh: Senin - Sabtu: 08.00 - 17.00"
                                class="block w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#0F2747]/20 focus:border-[#0F2747] bg-slate-50/50 focus:bg-white"
                            >

                        </div>


                        {{-- Alamat --}}
                        <div class="md:col-span-2">

                            <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                Alamat Lengkap
                            </label>

                            <textarea
                                wire:model.live="settings.company_address"
                                rows="2"
                                class="block w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#0F2747]/20 focus:border-[#0F2747] bg-slate-50/50 focus:bg-white resize-none"
                            ></textarea>

                        </div>


                        {{-- Deskripsi --}}
                        <div class="md:col-span-2">

                            <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                Deskripsi Singkat Perusahaan
                            </label>

                            <textarea
                                wire:model.live="settings.company_description"
                                rows="3"
                                class="block w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#0F2747]/20 focus:border-[#0F2747] bg-slate-50/50 focus:bg-white resize-none"
                            ></textarea>

                        </div>

                    </div>

                </div>


                {{-- ===================================================== --}}
                {{-- MEDIA SOSIAL --}}
                {{-- ===================================================== --}}

                <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6">

                    <h3 class="text-base font-semibold text-[#182B3A] mb-4 flex items-center gap-2">

                        <svg
                            class="w-5 h-5 text-[#0F2747]"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"
                            />
                        </svg>

                        Tautan Media Sosial

                    </h3>


                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <div>

                            <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                Facebook URL
                            </label>

                            <input
                                wire:model.live="settings.facebook_url"
                                type="url"
                                placeholder="https://facebook.com/..."
                                class="block w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#0F2747]/20 focus:border-[#0F2747] bg-slate-50/50 focus:bg-white"
                            >

                        </div>


                        <div>

                            <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                Instagram URL
                            </label>

                            <input
                                wire:model.live="settings.instagram_url"
                                type="url"
                                placeholder="https://instagram.com/..."
                                class="block w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#0F2747]/20 focus:border-[#0F2747] bg-slate-50/50 focus:bg-white"
                            >

                        </div>


                        <div>

                            <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                TikTok URL
                            </label>

                            <input
                                wire:model.live="settings.tiktok_url"
                                type="url"
                                placeholder="https://tiktok.com/@..."
                                class="block w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#0F2747]/20 focus:border-[#0F2747] bg-slate-50/50 focus:bg-white"
                            >

                        </div>


                        <div>

                            <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                YouTube URL
                            </label>

                            <input
                                wire:model.live="settings.youtube_url"
                                type="url"
                                placeholder="https://youtube.com/..."
                                class="block w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#0F2747]/20 focus:border-[#0F2747] bg-slate-50/50 focus:bg-white"
                            >

                        </div>


                        <div>

                            <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                LinkedIn URL
                            </label>

                            <input
                                wire:model.live="settings.linkedin_url"
                                type="url"
                                placeholder="https://linkedin.com/..."
                                class="block w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#0F2747]/20 focus:border-[#0F2747] bg-slate-50/50 focus:bg-white"
                            >

                        </div>

                    </div>

                </div>


                {{-- ===================================================== --}}
                {{-- SEO --}}
                {{-- ===================================================== --}}

                <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6">

                    <h3 class="text-base font-semibold text-[#182B3A] mb-4 flex items-center gap-2">

                        <svg
                            class="w-5 h-5 text-[#0F2747]"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0"
                            />
                        </svg>

                        SEO & Metadata

                    </h3>


                    <div class="space-y-4">

                        <div>

                            <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                SEO Title
                            </label>

                            <input
                                wire:model.live="settings.seo_title"
                                type="text"
                                placeholder="OMH Vector - Digital Printing & Branding"
                                class="block w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#0F2747]/20 focus:border-[#0F2747] bg-slate-50/50 focus:bg-white"
                            >

                        </div>


                        <div>

                            <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                SEO Description
                            </label>

                            <textarea
                                wire:model.live="settings.seo_description"
                                rows="2"
                                class="block w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#0F2747]/20 focus:border-[#0F2747] bg-slate-50/50 focus:bg-white resize-none"
                            ></textarea>

                        </div>


                        <div>

                            <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                SEO Keywords
                            </label>

                            <input
                                wire:model.live="settings.seo_keywords"
                                type="text"
                                placeholder="printing, branding, merchandise, jakarta"
                                class="block w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#0F2747]/20 focus:border-[#0F2747] bg-slate-50/50 focus:bg-white"
                            >

                        </div>

                    </div>

                </div>


{{-- ===================================================== --}}
                {{-- TAMPILAN / TOGGLE --}}
                {{-- ===================================================== --}}

                <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6">

                    <h3 class="text-base font-semibold text-[#182B3A] mb-4 flex items-center gap-2">

                        <svg
                            class="w-5 h-5 text-[#0F2747]"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"
                            />
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                            />
                        </svg>

                        Tampilan Section

                    </h3>

                    <div class="space-y-4">

                        <div class="flex items-center justify-between gap-4 p-4 rounded-xl border border-slate-200 bg-slate-50/50">

                            <div>
                                <p class="text-sm font-medium text-[#182B3A]">
                                    Tampilkan CTA "Lihat Semua Produk"
                                </p>
                                <p class="text-xs text-slate-500 mt-0.5">
                                    Menampilkan tombol CTA di bagian bawah section Produk pada landing page.
                                </p>
                            </div>

                            <label class="relative inline-flex items-center cursor-pointer flex-shrink-0">
                                <input
                                    type="checkbox"
                                    wire:model.live="settings.show_product_cta"
                                    value="1"
                                    class="sr-only peer"
                                >
                                <div class="w-11 h-6 bg-slate-300 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-[#0F2747]/20 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#0F2747]"></div>
                            </label>

                        </div>

                        <div class="flex items-center justify-between gap-4 p-4 rounded-xl border border-slate-200 bg-slate-50/50">

                            <div>
                                <p class="text-sm font-medium text-[#182B3A]">
                                    Tampilkan CTA "Lihat Semua Portofolio"
                                </p>
                                <p class="text-xs text-slate-500 mt-0.5">
                                    Menampilkan tombol CTA di bagian bawah section Portfolio pada landing page.
                                </p>
                            </div>

                            <label class="relative inline-flex items-center cursor-pointer flex-shrink-0">
                                <input
                                    type="checkbox"
                                    wire:model.live="settings.show_portfolio_cta"
                                    value="1"
                                    class="sr-only peer"
                                >
                                <div class="w-11 h-6 bg-slate-300 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-[#0F2747]/20 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#0F2747]"></div>
                            </label>

                        </div>

                    </div>

                </div>


                {{-- ===================================================== --}}
                {{-- SIMPAN --}}
                {{-- ===================================================== --}}

                <div class="flex justify-end pt-4 border-t border-slate-200">

                    <button
                        type="submit"
                        wire:loading.attr="disabled"
                        class="inline-flex items-center gap-2 py-3 px-8 border border-transparent rounded-xl text-sm font-semibold text-white bg-[#0F2747] hover:bg-[#081A31] shadow-sm hover:shadow-md transition-all disabled:opacity-70 disabled:cursor-not-allowed"
                    >

                        <svg
                            wire:loading.remove
                            wire:target="save"
                            class="w-4 h-4"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M5 13l4 4L19 7"
                            />
                        </svg>

                        <svg
                            wire:loading
                            wire:target="save"
                            class="animate-spin h-4 w-4 text-white"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                        >
                            <circle
                                class="opacity-25"
                                cx="12"
                                cy="12"
                                r="10"
                                stroke="currentColor"
                                stroke-width="4"
                            />

                            <path
                                class="opacity-75"
                                fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"
                            />
                        </svg>

                        <span wire:loading.remove wire:target="save">
                            Simpan Pengaturan
                        </span>

                        <span wire:loading wire:target="save">
                            Menyimpan...
                        </span>

                    </button>

                </div>

            </div>


            {{-- ========================================================= --}}
            {{-- KOLOM KANAN - BRANDING --}}
            {{-- ========================================================= --}}

            <div class="lg:col-span-1">

                <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6 sticky top-6">

                    {{-- Branding Header --}}
                    <div class="flex items-center justify-between mb-5">

                        <h3 class="text-base font-semibold text-[#182B3A] flex items-center gap-2">

                            <svg
                                class="w-5 h-5 text-[#0F2747]"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"
                                />
                            </svg>

                            Branding

                        </h3>

                        <span class="text-xs font-medium text-slate-400">
                            Identitas
                        </span>

                    </div>


                    <div class="space-y-8">


                        {{-- ================================================= --}}
                        {{-- LOGO --}}
                        {{-- ================================================= --}}

                        <div>

                            <div class="flex items-start justify-between mb-2">

                                <div>
                                    <label class="block text-sm font-semibold text-slate-700">
                                        Logo Perusahaan
                                    </label>

                                    <p class="text-xs text-slate-500 mt-1">
                                        PNG, JPG, SVG, WebP · Maks. 2MB
                                    </p>
                                </div>

                            </div>


                            {{-- Preview Logo --}}
                            <div class="relative rounded-xl border border-slate-200 bg-slate-50 aspect-video flex items-center justify-center overflow-hidden">

                                @if($logo)

                                    <img
                                        src="{{ $logo->temporaryUrl() }}"
                                        alt="Preview Logo"
                                        class="max-h-36 max-w-[85%] object-contain"
                                    />

                                @elseif(!empty($settings['logo']))

                                    <img
                                        src="{{ Storage::url($settings['logo']) }}"
                                        alt="Logo Perusahaan"
                                        class="max-h-36 max-w-[85%] object-contain"
                                    />

                                @else

                                    <div class="text-center">

                                        <svg
                                            class="w-10 h-10 mx-auto text-slate-300 mb-2"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.5"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2v12a2 2 0 002 2H6a2 2 0 002-2V6a2 2 0 00-2-2v12a2 2 0 002 2z"
                                            />
                                        </svg>

                                        <span class="text-xs text-slate-400">
                                            Belum ada logo
                                        </span>

                                    </div>

                                @endif

                            </div>


                            {{-- CTA Logo --}}
                            <div class="mt-4">

                                <label
                                    for="logo-upload"
                                    class="group flex items-center justify-center gap-2 w-full px-4 py-3 rounded-xl border-2 border-dashed border-[#0F2747]/30 bg-[#0F2747]/5 text-[#0F2747] font-semibold text-sm cursor-pointer hover:border-[#0F2747] hover:bg-[#0F2747]/10 transition-all"
                                >

                                    <svg
                                        class="w-5 h-5 group-hover:scale-110 transition-transform"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6v12a2 2 0 002 2z"
                                        />
                                    </svg>

                                    <span>
                                        {{ $logo ? 'Ganti Logo' : 'Pilih Logo' }}
                                    </span>

                                    <input
                                        id="logo-upload"
                                        type="file"
                                        wire:model="logo"
                                        accept=".png,.jpg,.jpeg,.svg,.webp"
                                        class="hidden"
                                    />

                                </label>

                            </div>


                            {{-- Loading --}}
                            <div
                                wire:loading
                                wire:target="logo"
                                class="flex items-center gap-2 mt-2 text-xs text-[#0F2747]"
                            >

                                <svg
                                    class="animate-spin w-4 h-4"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                >
                                    <circle
                                        class="opacity-25"
                                        cx="12"
                                        cy="12"
                                        r="10"
                                        stroke="currentColor"
                                        stroke-width="4"
                                    />

                                    <path
                                        class="opacity-75"
                                        fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"
                                    />
                                </svg>

                                Mengupload logo...

                            </div>


                            @error('logo')
                                <p class="text-xs text-red-600 mt-2">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- ================================================= --}}
                        {{-- PEMISAH --}}
                        {{-- ================================================= --}}

                        <div class="border-t border-slate-200"></div>


                        {{-- ================================================= --}}
                        {{-- FAVICON --}}
                        {{-- ================================================= --}}

                        <div>

                            <label class="block text-sm font-semibold text-slate-700">
                                Favicon
                            </label>

                            <p class="text-xs text-slate-500 mt-1 mb-3">
                                PNG, ICO, SVG, JPG · Maks. 1MB
                            </p>


                            <div class="flex items-center gap-4">

                                {{-- Preview --}}
                                <div class="relative flex-shrink-0">

                                    <div class="w-20 h-20 rounded-xl border border-slate-200 bg-slate-50 flex items-center justify-center overflow-hidden">

                                        @if($favicon)

                                            <img
                                                src="{{ $favicon->temporaryUrl() }}"
                                                alt="Preview Favicon"
                                                class="w-full h-full object-contain p-2"
                                            />

                                        @elseif(!empty($settings['favicon']))

                                            <img
                                                src="{{ Storage::url($settings['favicon']) }}"
                                                alt="Favicon"
                                                class="w-full h-full object-contain p-2"
                                            />

                                        @else

                                            <svg
                                                class="w-7 h-7 text-slate-300"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="1.5"
                                                    d="M12 4v16m8-8H4"
                                                />
                                            </svg>

                                        @endif

                                    </div>

                                </div>


                                {{-- CTA Favicon --}}
                                <div class="flex-1">

                                    <label
                                        for="favicon-upload"
                                        class="group inline-flex items-center justify-center gap-2 w-full px-4 py-2.5 rounded-xl border border-[#0F2747] bg-[#0F2747] text-white font-semibold text-sm cursor-pointer hover:bg-[#081A31] hover:border-[#081A31] shadow-sm hover:shadow-md transition-all"
                                    >

                                        <svg
                                            class="w-4 h-4 group-hover:scale-110 transition-transform"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M12 4v16m8-8H4"
                                            />
                                        </svg>

                                        <span>
                                            {{ $favicon ? 'Ganti Favicon' : 'Pilih Favicon' }}
                                        </span>

                                        <input
                                            id="favicon-upload"
                                            type="file"
                                            wire:model="favicon"
                                            accept=".png,.ico,.svg,.jpg,.jpeg"
                                            class="hidden"
                                        />

                                    </label>

                                    <p class="text-[11px] text-slate-400 mt-2 text-center">
                                        Klik tombol untuk memilih file
                                    </p>

                                </div>

                            </div>


                            {{-- Loading --}}
                            <div
                                wire:loading
                                wire:target="favicon"
                                class="flex items-center gap-2 mt-2 text-xs text-[#0F2747]"
                            >

                                <svg
                                    class="animate-spin w-4 h-4"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                >
                                    <circle
                                        class="opacity-25"
                                        cx="12"
                                        cy="12"
                                        r="10"
                                        stroke="currentColor"
                                        stroke-width="4"
                                    />

                                    <path
                                        class="opacity-75"
                                        fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"
                                    />
                                </svg>

                                Mengupload favicon...

                            </div>


                            @error('favicon')
                                <p class="text-xs text-red-600 mt-2">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </form>

</div>