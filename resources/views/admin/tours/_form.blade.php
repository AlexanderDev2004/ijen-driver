<div class="bg-white shadow-lg rounded-2xl p-6 space-y-6 max-w-3xl mx-auto">

    {{-- Judul --}}
    <div>
        <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">
            Judul Tour <span class="text-red-600">*</span>
        </label>
        <input type="text" name="title" id="title"
               value="{{ old('title', $tour->title ?? '') }}"
               class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @error('title') border-red-500 @enderror"
               placeholder="Contoh: Wisata Kawah Ijen"
               required>
        @error('title')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
    </div>

    {{-- Deskripsi --}}
    <div>
        <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
            Deskripsi
        </label>
        <textarea name="description" id="description" rows="4" minlength="10"
              class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @error('description') border-red-500 @enderror"
              placeholder="Tuliskan deskripsi tour...">{{ old('description', $tour->description ?? '') }}</textarea>
        @error('description')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
    </div>

    {{-- Harga & Lokasi --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label for="price" class="block text-sm font-semibold text-gray-700 mb-2">
                Harga (Rp) <span class="text-red-600">*</span>
            </label>
            <input type="number" name="price" id="price"
                   value="{{ old('price', $tour->price ?? 0) }}"
                   class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @error('price') border-red-500 @enderror"
                   placeholder="Masukkan harga" required>
            @error('price')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
        </div>

        <div>
            <label for="location" class="block text-sm font-semibold text-gray-700 mb-2">
                Lokasi
            </label>
            <input type="text" name="location" id="location"
                   value="{{ old('location', $tour->location ?? '') }}"
                     class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @error('location') border-red-500 @enderror"
                   placeholder="Contoh: Banyuwangi, Jawa Timur">
                 @error('location')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
        </div>
    </div>

    {{-- Gambar --}}
    <div>
        <label for="image" class="block text-sm font-semibold text-gray-700 mb-2">
            Gambar
        </label>

        @if(!empty($tour->image))
            <div class="mb-3">
                <img src="{{ asset('storage/' . $tour->image) }}"
                     alt="Preview"
                     class="w-40 h-28 object-cover rounded-lg border border-gray-200 shadow-sm">
            </div>
        @endif

         <input type="file" name="image" id="image" accept="image/jpeg,image/png,image/jpg"
             class="block w-full text-sm text-gray-700 border border-gray-300 rounded-xl cursor-pointer focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('image') border-red-500 @enderror">
         <small class="text-gray-500">Format: JPG, JPEG, PNG. Max 2MB</small>
         @error('image')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
    </div>

    {{-- Status Aktif --}}
    <div class="flex items-center space-x-2">
        <input type="hidden" name="is_active" value="0">
        <input type="checkbox" name="is_active" id="is_active"
               class="w-5 h-5 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500"
               {{ old('is_active', $tour->is_active ?? true) ? 'checked' : '' }}>
        <label for="is_active" class="text-sm text-gray-700 font-medium">
            Aktifkan Tour
        </label>
    </div>

    {{-- Tombol --}}
    <div class="flex justify-end space-x-3 pt-4 border-t border-gray-100">
        <a href="{{ route('admin.tours.index') }}"
           class="px-4 py-2 bg-gray-200 text-gray-800 rounded-xl hover:bg-gray-300 transition">
            Kembali
        </a>
        <button type="submit"
                class="px-5 py-2 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 transition">
            {{ $buttonText }}
        </button>
    </div>

</div>
