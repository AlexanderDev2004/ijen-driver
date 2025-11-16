@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-6">Paket Tour</h1>

    @if($tours->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($tours as $tour)
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                {{-- Gambar --}}
                @if($tour->image)
                    <img src="{{ asset('storage/'.$tour->image) }}"
                         alt="{{ $tour->title }}"
                         class="h-48 w-full object-cover">
                @else
                    <div class="h-48 w-full bg-gray-200 flex items-center justify-center">
                        <span class="text-gray-500">No Image</span>
                    </div>
                @endif

                {{-- Konten --}}
                <div class="p-4">
                    <h2 class="font-semibold text-lg mb-2">{{ $tour->title }}</h2>

                    {{-- Lokasi --}}
                    @if($tour->location)
                        <p class="text-gray-600 text-sm mb-2 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            {{ $tour->location }}
                        </p>
                    @endif

                    <p class="text-gray-600 text-sm mb-4">{{ \Str::limit($tour->description, 100) }}</p>

                    <div class="flex justify-between items-center">
                        <span class="text-lg font-bold text-indigo-600">Rp {{ number_format($tour->price, 0, ',', '.') }}</span>
                        <a href="{{ route('tour.show', $tour) }}"
                           class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                            Detail
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-6">
            {{ $tours->links() }}
        </div>
    @else
        <div class="text-center py-8">
            <p class="text-gray-500">Belum ada tour yang tersedia.</p>
        </div>
    @endif
</div>
@endsection
