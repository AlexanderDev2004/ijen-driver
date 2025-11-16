@extends('layouts.app')

@section('title', $tour->title) {{-- Diubah dari name ke title --}}

@section('content')
    <div class="max-w-5xl mx-auto bg-white rounded-xl shadow overflow-hidden">
        {{-- Gambar di atas --}}
        @if ($tour->image)
            <div class="w-full h-96 overflow-hidden">
                <img src="{{ asset('storage/' . $tour->image) }}" alt="{{ $tour->title }}"
                    class="w-full h-full object-cover">
            </div>
        @endif

        {{-- Konten --}}
        <div class="p-6">
            <h1 class="text-3xl font-bold text-gray-800">{{ $tour->title }}</h1> {{-- Diubah dari name ke title --}}

            {{-- Lokasi --}}
            @if($tour->location)
                <div class="flex items-center mt-2 text-gray-600">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span>{{ $tour->location }}</span>
                </div>
            @endif

            {{-- Deskripsi --}}
            <div class="mt-4">
                <p class="text-gray-600 leading-relaxed whitespace-pre-line">{{ $tour->description }}</p>
            </div>

            {{-- Harga dan Booking --}}
            <div class="flex items-center justify-between mt-6 pt-6 border-t border-gray-200">
                <div>
                    <span class="text-2xl font-bold text-indigo-600">Rp {{ number_format($tour->price, 0, ',', '.') }}</span>
                    <p class="text-sm text-gray-500 mt-1">Harga per orang</p>
                </div>
                <a href="{{ route('tour.booking', $tour) }}"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg font-medium transition duration-300">
                    Booking Sekarang
                </a>
            </div>
        </div>
    </div>

    {{-- Journals --}}
    <div class="max-w-5xl mx-auto mt-10">
        <h3 class="text-2xl font-semibold mb-4 text-gray-800">Journal Perjalanan</h3>

        @if ($tour->journals && $tour->journals->count())
            <div class="grid md:grid-cols-2 gap-5">
                @foreach ($tour->journals as $j)
                    <div class="bg-white p-5 shadow rounded-lg border hover:shadow-md transition">
                        <div class="text-sm text-gray-500">{{ optional($j->journal_date)->format('d M Y') }}</div>
                        <div class="font-semibold text-gray-800 mt-1">{{ $j->title }}</div>
                        <p class="text-gray-600 text-sm mt-2">{{ \Str::limit($j->content, 150) }}</p>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500 text-sm">Belum ada journal untuk tour ini.</p>
        @endif
    </div>
@endsection
