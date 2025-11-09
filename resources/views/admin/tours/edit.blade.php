@extends('admin.layouts.app')

@section('title', 'Edit Tour')

@section('content')
    <div class="max-w-3xl mx-auto bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-semibold mb-6 text-gray-800">
            Edit Tour: <span class="text-indigo-600">{{ $tour->title }}</span>
        </h2>

        <form action="{{ route('admin.tours.update', $tour->id) }}" method="POST" enctype="multipart/form-data"
            class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700">Judul Tour</label>
                <input type="text" name="title" value="{{ old('title', $tour->title) }}"
                    class="mt-1 w-full rounded-md border-gray-300 focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Lokasi</label>
                <input type="text" name="location" value="{{ old('location', $tour->location) }}"
                    class="mt-1 w-full rounded-md border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Harga</label>
                <input type="number" name="price" value="{{ old('price', $tour->price) }}"
                    class="mt-1 w-full rounded-md border-gray-300 focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea name="description" rows="4"
                    class="mt-1 w-full rounded-md border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">{{ old('description', $tour->description) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Gambar Saat Ini</label>
                @if ($tour->image)
                    <img src="{{ asset('storage/' . $tour->image) }}" class="w-40 h-28 object-cover rounded-md mt-2">
                @else
                    <p class="text-gray-500 text-sm mt-1">Tidak ada gambar</p>
                @endif
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Ganti Gambar (opsional)</label>
                <input type="file" name="image" accept="image/*" class="mt-1 w-full text-sm text-gray-600">
            </div>

            <div class="flex items-center gap-2">
                <input type="checkbox" name="is_active" id="is_active" {{ $tour->is_active ? 'checked' : '' }}
                    class="rounded text-indigo-600">
                <label for="is_active" class="text-sm text-gray-700">Aktif</label>
            </div>

            <div class="flex gap-3">
                <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-md">Update</button>
                <a href="{{ route('admin.tours.index') }}"
                    class="px-5 py-2 border rounded-md text-gray-700 hover:bg-gray-100">Kembali</a>
            </div>
        </form>
    </div>
@endsection
