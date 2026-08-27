<div class="min-h-screen bg-slate-50">

    {{-- Header --}}
    <div class="border-b border-slate-200 bg-white">
        <div class="mx-auto max-w-7xl px-6 py-6">

            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                <div>
                    <div class="mb-2 flex items-center gap-2 text-sm text-slate-500">
                        <a
                            href="{{ route('admin.portfolios.index') }}"
                            wire:navigate
                            class="transition hover:text-blue-600"
                        >
                            Portofolio
                        </a>

                        <span>/</span>

                        <span class="text-slate-700">
                            {{ $isEditing ? 'Edit' : 'Tambah' }}
                        </span>
                    </div>

                    <h1 class="text-2xl font-bold tracking-tight text-slate-900">
                        {{ $isEditing ? 'Edit Portofolio' : 'Tambah Portofolio' }}
                    </h1>

                    <p class="mt-1 text-sm text-slate-500">
                        {{ $isEditing
                            ? 'Perbarui informasi portofolio yang sudah ada.'
                            : 'Tambahkan proyek baru ke katalog portofolio OMH Vector.'
                        }}
                    </p>
                </div>

                <button
                    type="button"
                    wire:click="cancel"
                    class="inline-flex items-center justify-center rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50"
                >
                    Kembali
                </button>

            </div>

        </div>
    </div>


    {{-- Form --}}
    <div class="mx-auto max-w-7xl px-6 py-8">

        <form wire:submit="save">

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

                {{-- LEFT --}}
                <div class="space-y-6 lg:col-span-2">

                    {{-- Informasi Utama --}}
                    <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

                        <div class="border-b border-slate-200 px-6 py-5">
                            <h2 class="text-lg font-bold text-slate-900">
                                Informasi Portofolio
                            </h2>

                            <p class="mt-1 text-sm text-slate-500">
                                Informasi utama mengenai proyek.
                            </p>
                        </div>


                        <div class="space-y-6 p-6">

                            {{-- Title --}}
                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-700">
                                    Judul Portofolio
                                    <span class="text-red-500">*</span>
                                </label>

                                <input
                                    type="text"
                                    wire:model="title"
                                    placeholder="Contoh: Company Profile PT Maju Bersama"
                                    class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10"
                                >

                                @error('title')
                                    <p class="mt-2 text-sm text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>


                            {{-- Client --}}
                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-700">
                                    Nama Klien
                                </label>

                                <input
                                    type="text"
                                    wire:model="client"
                                    placeholder="Contoh: CV Berkah Abadi"
                                    class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10"
                                >

                                @error('client')
                                    <p class="mt-2 text-sm text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            {{-- Category --}}
                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-700">
                                    Kategori
                                </label>

                                <select
                                    wire:model="portfolio_category_id"
                                    class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10"
                                >
                                    <option value="">Pilih kategori</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>


                            {{-- Project Date --}}
                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-700">
                                    Tanggal / Tahun Proyek
                                </label>

                                <input
                                    type="date"
                                    wire:model="project_date"
                                    class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10"
                                >

                                @error('project_date')
                                    <p class="mt-2 text-sm text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>


                            {{-- Description --}}
                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-700">
                                    Deskripsi
                                </label>

                                <textarea
                                    wire:model="description"
                                    rows="6"
                                    placeholder="Jelaskan secara singkat mengenai proyek ini..."
                                    class="w-full resize-y rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10"
                                ></textarea>

                                @error('description')
                                    <p class="mt-2 text-sm text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                        </div>

                    </div>


                    {{-- Main Image --}}
                    <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

                        <div class="border-b border-slate-200 px-6 py-5">
                            <h2 class="text-lg font-bold text-slate-900">
                                Cover Portofolio
                            </h2>

                            <p class="mt-1 text-sm text-slate-500">
                                Gambar utama yang akan ditampilkan pada daftar portofolio.
                            </p>
                        </div>


                        <div class="p-6">

                            @if ($image)
                                {{-- Preview upload baru --}}
                                <div class="relative overflow-hidden rounded-2xl border border-slate-200 bg-slate-100">

                                    <img
                                        src="{{ $image->temporaryUrl() }}"
                                        class="h-80 w-full object-cover"
                                        alt="Preview"
                                    >

                                    <div class="absolute right-4 top-4">
                                        <button
                                            type="button"
                                            wire:click="$set('image', null)"
                                            class="rounded-lg bg-black/70 px-3 py-2 text-xs font-semibold text-white backdrop-blur transition hover:bg-black"
                                        >
                                            Batalkan
                                        </button>
                                    </div>

                                </div>

                            @elseif ($existing_image)

                                {{-- Existing image --}}
                                <div class="relative overflow-hidden rounded-2xl border border-slate-200 bg-slate-100">

                                    <img
                                        src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($existing_image) }}"
                                        class="h-80 w-full object-cover"
                                        alt="{{ $title }}"
                                    >

                                    <div class="absolute right-4 top-4">
                                        <button
                                            type="button"
                                            wire:click="removeMainImage"
                                            wire:confirm="Hapus gambar utama ini?"
                                            class="rounded-lg bg-red-600 px-3 py-2 text-xs font-semibold text-white shadow transition hover:bg-red-700"
                                        >
                                            Hapus
                                        </button>
                                    </div>

                                </div>

                            @else

                                {{-- Empty state --}}
                                <label class="flex cursor-pointer flex-col items-center justify-center rounded-2xl border-2 border-dashed border-slate-300 bg-slate-50 px-6 py-14 text-center transition hover:border-blue-400 hover:bg-blue-50">

                                    <div class="mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-100 text-blue-600">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="h-7 w-7"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.5"
                                                d="M3 16.5V6.75A2.25 2.25 0 015.25 4.5h13.5A2.25 2.25 0 0121 6.75v9.75M3 16.5A2.25 2.25 0 005.25 18.75h13.5A2.25 2.25 0 0021 16.5M3 16.5l4.5-4.5 3 3 3.75-3.75L21 16.5M15.75 8.25h.008v.008h-.008V8.25z"
                                            />
                                        </svg>
                                    </div>

                                    <span class="text-sm font-semibold text-slate-700">
                                        Upload gambar utama
                                    </span>

                                    <span class="mt-1 text-xs text-slate-500">
                                        JPG, JPEG, PNG atau WEBP — maksimal 5 MB
                                    </span>

                                    <input
                                        type="file"
                                        wire:model="image"
                                        accept="image/*"
                                        class="hidden"
                                    >

                                </label>

                            @endif


                            @error('image')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror


                            {{-- Loading --}}
                            <div
                                wire:loading
                                wire:target="image"
                                class="mt-3 text-sm text-blue-600"
                            >
                                Mengupload gambar...
                            </div>

                        </div>

                    </div>


                    {{-- Gallery --}}
                    <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

                        <div class="border-b border-slate-200 px-6 py-5">
                            <h2 class="text-lg font-bold text-slate-900">
                                Gallery Proyek
                            </h2>

                            <p class="mt-1 text-sm text-slate-500">
                                Tambahkan beberapa gambar untuk menampilkan detail proyek.
                            </p>
                        </div>


                        <div class="p-6">

                            {{-- Existing Gallery --}}
                            @if (count($existing_gallery) > 0)

                                <div class="mb-6">

                                    <p class="mb-3 text-sm font-semibold text-slate-700">
                                        Gallery saat ini
                                    </p>

                                    <div class="grid grid-cols-2 gap-4 sm:grid-cols-3">

                                        @foreach ($existing_gallery as $galleryImage)

                                            <div class="group relative overflow-hidden rounded-xl border border-slate-200 bg-slate-100">

                                                <img
                                                    src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($galleryImage) }}"
                                                    class="h-40 w-full object-cover"
                                                    alt="Gallery"
                                                >

                                                <button
                                                    type="button"
                                                    wire:click="removeGalleryImage('{{ $galleryImage }}')"
                                                    wire:confirm="Hapus gambar gallery ini?"
                                                    class="absolute right-2 top-2 rounded-lg bg-red-600 px-2.5 py-1.5 text-xs font-semibold text-white opacity-0 shadow transition group-hover:opacity-100 hover:bg-red-700"
                                                >
                                                    Hapus
                                                </button>

                                            </div>

                                        @endforeach

                                    </div>

                                </div>

                            @endif


                            {{-- New Gallery --}}
                            <label class="flex cursor-pointer flex-col items-center justify-center rounded-2xl border-2 border-dashed border-slate-300 bg-slate-50 px-6 py-10 text-center transition hover:border-blue-400 hover:bg-blue-50">

                                <div class="mb-3 flex h-12 w-12 items-center justify-center rounded-xl bg-slate-200 text-slate-600">

                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-6 w-6"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="1.5"
                                            d="M12 4v16m8-8H4"
                                        />
                                    </svg>

                                </div>

                                <span class="text-sm font-semibold text-slate-700">
                                    Tambahkan gambar gallery
                                </span>

                                <span class="mt-1 text-xs text-slate-500">
                                    Bisa memilih beberapa gambar sekaligus
                                </span>

                                <input
                                    type="file"
                                    wire:model="gallery"
                                    accept="image/*"
                                    multiple
                                    class="hidden"
                                >

                            </label>


                            @error('gallery.*')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror


                            {{-- New Gallery Preview --}}
                            @if (count($gallery) > 0)

                                <div class="mt-6">

                                    <p class="mb-3 text-sm font-semibold text-slate-700">
                                        Gambar baru
                                    </p>

                                    <div class="grid grid-cols-2 gap-4 sm:grid-cols-3">

                                        @foreach ($gallery as $index => $galleryImage)

                                            <div class="relative overflow-hidden rounded-xl border border-slate-200 bg-slate-100">

                                                <img
                                                    src="{{ $galleryImage->temporaryUrl() }}"
                                                    class="h-40 w-full object-cover"
                                                    alt="Preview gallery"
                                                >

                                                <button
                                                    type="button"
                                                    wire:click="$set('gallery.{{ $index }}', null)"
                                                    class="absolute right-2 top-2 rounded-lg bg-black/70 px-2.5 py-1.5 text-xs font-semibold text-white"
                                                >
                                                    Batal
                                                </button>

                                            </div>

                                        @endforeach

                                    </div>

                                </div>

                            @endif

                        </div>

                    </div>

                </div>


                {{-- RIGHT --}}
                <div class="space-y-6">

                    {{-- Status --}}
                    <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

                        <div class="border-b border-slate-200 px-6 py-5">
                            <h2 class="text-lg font-bold text-slate-900">
                                Pengaturan
                            </h2>
                        </div>


                        <div class="space-y-5 p-6">

                            {{-- Active --}}
                            <label class="flex cursor-pointer items-start gap-3">

                                <input
                                    type="checkbox"
                                    wire:model="is_active"
                                    class="mt-1 h-4 w-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500"
                                >

                                <div>
                                    <p class="text-sm font-semibold text-slate-800">
                                        Portofolio aktif
                                    </p>

                                    <p class="mt-1 text-xs leading-5 text-slate-500">
                                        Portofolio akan ditampilkan pada website.
                                    </p>
                                </div>

                            </label>


                            {{-- Featured --}}
                            <label class="flex cursor-pointer items-start gap-3">

                                <input
                                    type="checkbox"
                                    wire:model="is_featured"
                                    class="mt-1 h-4 w-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500"
                                >

                                <div>
                                    <p class="text-sm font-semibold text-slate-800">
                                        Featured
                                    </p>

                                    <p class="mt-1 text-xs leading-5 text-slate-500">
                                        Tandai sebagai portofolio unggulan.
                                    </p>
                                </div>

                            </label>


                            {{-- Sort Order --}}
                            <div>

                                <label class="mb-2 block text-sm font-semibold text-slate-700">
                                    Urutan
                                </label>

                                <input
                                    type="number"
                                    wire:model="sort_order"
                                    min="0"
                                    class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10"
                                >

                                @error('sort_order')
                                    <p class="mt-2 text-sm text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>

                        </div>

                    </div>


                    {{-- Tips --}}
                    <div class="rounded-2xl border border-blue-100 bg-blue-50 p-6">

                        <div class="flex gap-3">

                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-blue-100 text-blue-600">

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.5"
                                        d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.852l.041-.02M12 8.25h.008v.008H12V8.25zM12 21a9 9 0 100-18 9 9 0 000 18z"
                                    />
                                </svg>

                            </div>

                            <div>

                                <h3 class="text-sm font-bold text-blue-900">
                                    Tips Portofolio
                                </h3>

                                <ul class="mt-2 space-y-1 text-xs leading-5 text-blue-800">
                                    <li>• Gunakan gambar dengan kualitas bagus.</li>
                                    <li>• Gunakan judul yang singkat dan jelas.</li>
                                    <li>• Jelaskan proyek secara ringkas.</li>
                                    <li>• Gunakan gambar yang relevan dengan proyek.</li>
                                </ul>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- Footer Action --}}
            <div class="mt-6 flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

                <button
                    type="button"
                    wire:click="cancel"
                    class="rounded-xl border border-slate-300 bg-white px-6 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50"
                >
                    Batal
                </button>

                <button
                    type="submit"
                    wire:loading.attr="disabled"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 disabled:cursor-not-allowed disabled:opacity-60"
                >

                    <span wire:loading.remove wire:target="save">
                        {{ $isEditing ? 'Simpan Perubahan' : 'Simpan Portofolio' }}
                    </span>

                    <span wire:loading wire:target="save">
                        Menyimpan...
                    </span>

                </button>

            </div>

        </form>

    </div>

</div>