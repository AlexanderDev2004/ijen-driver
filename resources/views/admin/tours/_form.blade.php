@php($isActiveValue = old('is_active', isset($tour) ? (int) $tour->is_active : 1))
@php($showPriceValue = old('show_price', isset($tour) ? (int) $tour->show_price : 1))

<div class="space-y-6">
    <div class="grid gap-6 xl:grid-cols-12">
        <div class="space-y-5 xl:col-span-8">
            <div>
                <label for="title" class="form-label">Judul Tour <span class="text-red-600">*</span></label>
                <input type="text" id="title" name="title" value="{{ old('title', $tour->title ?? '') }}" class="form-input @error('title') input-error @enderror" placeholder="Contoh: Sunrise Kawah Ijen" required>
                @error('title')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="description" class="form-label">Deskripsi</label>
                <textarea id="description" name="description" rows="8" minlength="10" class="form-input @error('description') input-error @enderror" placeholder="Tulis deskripsi, itinerary, dan informasi penting tour...">{{ old('description', $tour->description ?? '') }}</textarea>
                <span class="form-hint">Gunakan bahasa yang sederhana agar mudah dipahami calon tamu.</span>
                @error('description')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="space-y-5 xl:col-span-4">
            <div class="soft-panel p-4">
                <div class="text-sm font-semibold text-slate-700">Status Tour</div>
                <p class="mt-1 text-xs text-slate-500">Jika nonaktif, tour tidak tampil di halaman publik.</p>

                <label for="is_active" class="mt-3 flex items-center justify-between gap-3 rounded-xl border border-slate-200 bg-white px-3 py-2.5">
                    <span class="text-sm font-medium text-slate-700">Aktifkan Tour</span>
                    <span class="inline-flex items-center gap-2">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" id="is_active" name="is_active" value="1" class="h-5 w-5 rounded border-slate-300 text-teal-600 focus:ring-teal-500" {{ (int) $isActiveValue === 1 ? 'checked' : '' }}>
                    </span>
                </label>
            </div>

            <div class="soft-panel p-4">
                <div class="text-sm font-semibold text-slate-700">Visibilitas Harga</div>
                <p class="mt-1 text-xs text-slate-500">Matikan jika harga ingin dibicarakan langsung melalui WhatsApp.</p>

                <label for="show_price" class="mt-3 flex items-center justify-between gap-3 rounded-xl border border-slate-200 bg-white px-3 py-2.5">
                    <span class="text-sm font-medium text-slate-700">Tampilkan Harga</span>
                    <span class="inline-flex items-center gap-2">
                        <input type="hidden" name="show_price" value="0">
                        <input type="checkbox" id="show_price" name="show_price" value="1" class="h-5 w-5 rounded border-slate-300 text-teal-600 focus:ring-teal-500" {{ (int) $showPriceValue === 1 ? 'checked' : '' }}>
                    </span>
                </label>
            </div>

            <div>
                <label for="price" class="form-label">Harga (Rp) <span class="text-red-600">*</span></label>
                <input type="number" id="price" name="price" value="{{ old('price', $tour->price ?? 0) }}" class="form-input @error('price') input-error @enderror" placeholder="Contoh: 500000" required>
                @error('price')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="location" class="form-label">Lokasi</label>
                <input type="text" id="location" name="location" value="{{ old('location', $tour->location ?? '') }}" class="form-input @error('location') input-error @enderror" placeholder="Contoh: Banyuwangi, Jawa Timur">
                @error('location')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>

    <div class="rounded-2xl border border-slate-200 bg-white p-4">
        <label for="image" class="form-label">Gambar Tour</label>

        @if(!empty($tour->image))
            <div class="mb-4 inline-flex items-center gap-3 rounded-xl border border-slate-200 bg-slate-50 p-2 pr-4">
                <img src="{{ asset('storage/' . $tour->image) }}" alt="Preview" class="h-24 w-32 rounded-lg object-cover">
                <span class="text-xs font-semibold uppercase tracking-wide text-slate-500">Gambar Saat Ini</span>
            </div>
        @endif

        <input type="file" id="image" name="image" accept="image/jpeg,image/png,image/jpg" class="form-input px-3 py-2 @error('image') input-error @enderror">
        <span class="form-hint">Format JPG/JPEG/PNG, maksimal 2MB.</span>
        @error('image')
            <span class="error-message">{{ $message }}</span>
        @enderror
    </div>

    <div class="flex flex-col gap-3 border-t border-slate-200 pt-4 sm:flex-row sm:justify-end">
        <a href="{{ route('admin.tours.index') }}" class="btn-secondary w-full justify-center sm:w-auto">Kembali</a>
        <button type="submit" class="btn-primary w-full justify-center sm:w-auto">{{ $buttonText }}</button>
    </div>
</div>
