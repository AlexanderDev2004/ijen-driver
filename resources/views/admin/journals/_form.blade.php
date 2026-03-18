@php($isEdit = isset($journal))

<div class="space-y-5">
    <div>
        <label for="tour_id" class="form-label">Tour <span class="text-red-600">*</span></label>
        <select id="tour_id" name="tour_id" required class="form-input @error('tour_id') input-error @enderror">
            <option value="">-- Pilih Tour --</option>
            @foreach($tours as $tour)
                <option value="{{ $tour->id }}" @selected(old('tour_id', $journal->tour_id ?? null) == $tour->id)>
                    {{ $tour->title }}
                </option>
            @endforeach
        </select>
        @error('tour_id')
            <span class="error-message">{{ $message }}</span>
        @enderror
    </div>

    <div>
        <label for="title" class="form-label">Judul Journal <span class="text-red-600">*</span></label>
        <input type="text" id="title" name="title" required value="{{ old('title', $journal->title ?? '') }}" class="form-input @error('title') input-error @enderror" placeholder="Contoh: Hari pertama mendaki Gunung Ijen">
        @error('title')
            <span class="error-message">{{ $message }}</span>
        @enderror
    </div>

    <div>
        <label for="journal_date" class="form-label">Tanggal Journal <span class="text-red-600">*</span></label>
        <input type="date" id="journal_date" name="journal_date" required value="{{ old('journal_date', $journal->journal_date ?? '') }}" class="form-input @error('journal_date') input-error @enderror">
        @error('journal_date')
            <span class="error-message">{{ $message }}</span>
        @enderror
    </div>

    <div>
        <label for="content" class="form-label">Konten Journal <span class="text-red-600">*</span></label>
        <textarea id="content" name="content" required rows="8" class="form-input @error('content') input-error @enderror" placeholder="Tulis pengalaman dan cerita perjalanan di sini...">{{ old('content', $journal->content ?? '') }}</textarea>
        <span class="form-hint">Minimal 10 karakter.</span>
        @error('content')
            <span class="error-message">{{ $message }}</span>
        @enderror
    </div>

    <div class="grid gap-4 md:grid-cols-2">
        <div>
            <label for="photo" class="form-label">Foto Journal <span class="text-slate-500">(Opsional)</span></label>

            @if($isEdit && !empty($journal->photo))
                <div class="mb-3 inline-flex items-center gap-3 rounded-xl border border-slate-200 bg-slate-50 p-2 pr-4">
                    <img src="{{ $journal->photo_url }}" alt="Current photo" class="h-20 w-28 rounded-lg object-cover">
                    <span class="text-xs font-semibold uppercase tracking-wide text-slate-500">Foto Saat Ini</span>
                </div>
            @endif

            <input type="file" id="photo" name="photo" accept="image/*" class="form-input px-3 py-2 @error('photo') input-error @enderror">
            <span class="form-hint">Format JPEG/JPG/PNG/WEBP, maksimal 5MB.</span>
            @error('photo')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="video" class="form-label">Video Journal <span class="text-slate-500">(Opsional)</span></label>

            @if($isEdit && !empty($journal->video))
                <div class="mb-3 rounded-xl border border-slate-200 bg-slate-50 p-2">
                    <video controls class="h-20 w-full rounded-lg object-cover">
                        <source src="{{ $journal->video_url }}" type="video/mp4">
                    </video>
                    <span class="mt-2 block text-xs font-semibold uppercase tracking-wide text-slate-500">Video Saat Ini</span>
                </div>
            @endif

            <input type="file" id="video" name="video" accept="video/*" class="form-input px-3 py-2 @error('video') input-error @enderror">
            <span class="form-hint">Format MP4/AVI/MOV/WMV/FLV, maksimal 50MB.</span>
            @error('video')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="flex flex-col gap-3 border-t border-slate-200 pt-4 sm:flex-row sm:justify-end">
        <a href="{{ route('admin.journals.index') }}" class="btn-secondary w-full justify-center sm:w-auto">Batal</a>
        <button type="submit" class="btn-primary w-full justify-center sm:w-auto">{{ $submitLabel }}</button>
    </div>
</div>
