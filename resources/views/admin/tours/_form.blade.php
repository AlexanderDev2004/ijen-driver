@php($isActiveValue = old('is_active', isset($tour) ? (int) $tour->is_active : 1))
@php($showPriceValue = old('show_price', isset($tour) ? (int) $tour->show_price : 1))

<div class="space-y-8">
    <div class="grid grid-cols-1 xl:grid-cols-12 gap-8">
        <div class="xl:col-span-8 space-y-6">
            <div>
                <label for="title" class="block text-sm font-semibold text-slate-700 mb-2">
                    Judul Tour <span class="text-red-600">*</span>
                </label>
                <input type="text" name="title" id="title"
                       value="{{ old('title', $tour->title ?? '') }}"
                       class="w-full rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500 @error('title') border-red-500 @enderror"
                       placeholder="Contoh: Sunrise Kawah Ijen"
                       required>
                @error('title')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-semibold text-slate-700 mb-2">
                    Deskripsi
                </label>
                <textarea name="description" id="description" rows="6" minlength="10"
                          class="w-full rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500 @error('description') border-red-500 @enderror"
                          placeholder="Tuliskan deskripsi singkat, itinerary, atau informasi penting tour...">{{ old('description', $tour->description ?? '') }}</textarea>
                @error('description')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>
        </div>

        <div class="xl:col-span-4 space-y-6">
            <div class="rounded-xl border border-slate-200 bg-slate-50/60 p-4">
                <div class="text-sm font-semibold text-slate-700 mb-3">Status Tour</div>
                <input type="hidden" name="is_active" value="0">
                <label for="is_active" class="flex items-center justify-between gap-3 cursor-pointer">
                    <span class="text-sm text-slate-700">Aktifkan Tour</span>
                    <input type="checkbox" name="is_active" id="is_active"
                           class="w-5 h-5 text-indigo-600 border-slate-300 rounded focus:ring-indigo-500"
                           value="1"
                           {{ (int) $isActiveValue === 1 ? 'checked' : '' }}>
                </label>
                <p class="mt-2 text-xs text-slate-500">Jika nonaktif, tour tidak tampil di halaman publik.</p>
            </div>

            <div class="rounded-xl border border-slate-200 bg-slate-50/60 p-4">
                <div class="text-sm font-semibold text-slate-700 mb-3">Visibilitas Harga</div>
                <input type="hidden" name="show_price" value="0">
                <label for="show_price" class="flex items-center justify-between gap-3 cursor-pointer">
                    <span class="text-sm text-slate-700">Tampilkan Harga di Publik</span>
                    <input type="checkbox" name="show_price" id="show_price"
                           class="w-5 h-5 text-indigo-600 border-slate-300 rounded focus:ring-indigo-500"
                           value="1"
                           {{ (int) $showPriceValue === 1 ? 'checked' : '' }}>
                </label>
                <p class="mt-2 text-xs text-slate-500">Jika dimatikan, harga disembunyikan dari halaman publik.</p>
            </div>

            <div>
                <label for="price" class="block text-sm font-semibold text-slate-700 mb-2">
                    Harga (Rp) <span class="text-red-600">*</span>
                </label>
                <input type="number" name="price" id="price"
                       value="{{ old('price', $tour->price ?? 0) }}"
                       class="w-full rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500 @error('price') border-red-500 @enderror"
                       placeholder="Contoh: 500000"
                       required>
                @error('price')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>

            <div>
                <label for="location" class="block text-sm font-semibold text-slate-700 mb-2">
                    Lokasi
                </label>
                <input type="text" name="location" id="location"
                       value="{{ old('location', $tour->location ?? '') }}"
                       class="w-full rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500 @error('location') border-red-500 @enderror"
                       placeholder="Contoh: Banyuwangi, Jawa Timur">
                @error('location')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>
        </div>
    </div>

    <div class="rounded-xl border border-slate-200 p-4">
        <label for="image" class="block text-sm font-semibold text-slate-700 mb-3">Gambar</label>

        @if(!empty($tour->image))
            <div class="mb-4 flex items-center gap-4">
                <img src="{{ asset('storage/' . $tour->image) }}"
                     alt="Preview"
                     class="w-40 h-28 object-cover rounded-lg border border-slate-200 shadow-sm">
                <span class="text-xs text-slate-500">Gambar saat ini</span>
            </div>
        @endif

        <input type="file" name="image" id="image" accept="image/jpeg,image/png,image/jpg"
               class="block w-full text-sm text-slate-700 border border-slate-300 rounded-xl cursor-pointer focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('image') border-red-500 @enderror">
        <small class="text-slate-500">Format: JPG, JPEG, PNG. Maksimal 2MB.</small>
        @error('image')<span class="text-red-600 text-sm block">{{ $message }}</span>@enderror
    </div>

    <div class="flex justify-end space-x-3 pt-2 border-t border-slate-100">
        <a href="{{ route('admin.tours.index') }}"
           class="px-4 py-2 bg-slate-200 text-slate-800 rounded-xl hover:bg-slate-300 transition">
            Kembali
        </a>
        <button type="submit"
                class="px-5 py-2 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 transition">
            {{ $buttonText }}
        </button>
    </div>
</div>
