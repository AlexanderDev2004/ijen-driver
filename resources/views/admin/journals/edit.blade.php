@extends('admin.layouts.app')

@section('title', 'Edit Journal')

@section('content')
<div class="w-full">
    {{-- Breadcrumb --}}
    <div class="mb-6">
        <a href="{{ route('admin.journals.index') }}" class="text-indigo-600 hover:text-indigo-700 font-medium">
            ← Kembali ke Journal
        </a>
    </div>

    {{-- Form Card --}}
    <div class="bg-white rounded-lg shadow p-8">
        <h2 class="text-2xl font-bold text-slate-900 mb-6">Edit Journal</h2>

        <form action="{{ route('admin.journals.update', $journal) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Tour Selection --}}
            <div>
                <label for="tour_id" class="block text-sm font-semibold text-slate-700 mb-2">
                    Tour <span class="text-red-500">*</span>
                </label>
                <select id="tour_id" name="tour_id" required
                        class="w-full px-4 py-2 border @error('tour_id') border-red-500 @else border-slate-300 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    @foreach ($tours as $tour)
                    <option value="{{ $tour->id }}" @selected(old('tour_id', $journal->tour_id) == $tour->id)>
                        {{ $tour->title }}
                    </option>
                    @endforeach
                </select>
                @error('tour_id')
                <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            {{-- Title --}}
            <div>
                <label for="title" class="block text-sm font-semibold text-slate-700 mb-2">
                    Judul Journal <span class="text-red-500">*</span>
                </label>
                <input type="text" id="title" name="title" required
                       value="{{ old('title', $journal->title) }}"
                       class="w-full px-4 py-2 border @error('title') border-red-500 @else border-slate-300 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                       placeholder="Contoh: Hari pertama mendaki Gunung Ijen">
                @error('title')
                <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            {{-- Journal Date --}}
            <div>
                <label for="journal_date" class="block text-sm font-semibold text-slate-700 mb-2">
                    Tanggal Journal <span class="text-red-500">*</span>
                </label>
                <input type="date" id="journal_date" name="journal_date" required
                       value="{{ old('journal_date', $journal->journal_date) }}"
                       class="w-full px-4 py-2 border @error('journal_date') border-red-500 @else border-slate-300 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                @error('journal_date')
                <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            {{-- Content --}}
            <div>
                <label for="content" class="block text-sm font-semibold text-slate-700 mb-2">
                    Konten Journal <span class="text-red-500">*</span>
                </label>
                <textarea id="content" name="content" required rows="8"
                          class="w-full px-4 py-2 border @error('content') border-red-500 @else border-slate-300 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                          placeholder="Tulis pengalaman dan cerita perjalanan Anda di sini...">{{ old('content', $journal->content) }}</textarea>
                <p class="text-slate-500 text-sm mt-1">Minimal 10 karakter</p>
                @error('content')
                <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            {{-- Photo Upload --}}
            <div>
                <label for="photo" class="block text-sm font-semibold text-slate-700 mb-2">
                    Foto Journal <span class="text-slate-500">(Opsional)</span>
                </label>

                @if($journal->photo)
                <div class="mb-3 relative inline-block">
                    <img src="{{ $journal->photo_url }}" alt="Current Photo" class="w-48 h-32 object-cover rounded-lg border">
                    <span class="absolute top-2 left-2 bg-slate-900/70 text-white text-xs px-2 py-1 rounded">Foto Saat Ini</span>
                </div>
                @endif

                <input type="file" id="photo" name="photo" accept="image/*"
                       class="w-full px-4 py-2 border @error('photo') border-red-500 @else border-slate-300 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <p class="text-slate-500 text-sm mt-1">Format: JPEG, JPG, PNG, WEBP. Maksimal 5MB. Kosongkan jika tidak ingin mengubah.</p>
                @error('photo')
                <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            {{-- Video Upload --}}
            <div>
                <label for="video" class="block text-sm font-semibold text-slate-700 mb-2">
                    Video Journal <span class="text-slate-500">(Opsional)</span>
                </label>

                @if($journal->video)
                <div class="mb-3">
                    <video controls class="w-full max-w-md h-48 rounded-lg border">
                        <source src="{{ $journal->video_url }}" type="video/mp4">
                        Browser Anda tidak mendukung video tag.
                    </video>
                    <span class="text-slate-600 text-sm">Video Saat Ini</span>
                </div>
                @endif

                <input type="file" id="video" name="video" accept="video/*"
                       class="w-full px-4 py-2 border @error('video') border-red-500 @else border-slate-300 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <p class="text-slate-500 text-sm mt-1">Format: MP4, AVI, MOV, WMV, FLV. Maksimal 50MB. Kosongkan jika tidak ingin mengubah.</p>
                @error('video')
                <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            {{-- Buttons --}}
            <div class="flex gap-3 pt-4">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg font-medium transition">
                    Perbarui Journal
                </button>
                <a href="{{ route('admin.journals.index') }}" class="bg-slate-200 hover:bg-slate-300 text-slate-900 px-6 py-2 rounded-lg font-medium transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
