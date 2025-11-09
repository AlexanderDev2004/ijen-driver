@extends('layouts.app')

@section('title', 'Ijen Driver - Pilih Tour Favoritmu')

@section('content')
<div class="bg-gray-50 min-h-screen">
    <div class="text-center py-16 bg-gradient-to-r from-blue-600 to-green-500 text-white">
        <h1 class="text-5xl font-extrabold mb-4">Selamat Datang di Ijen Driver</h1>
        <p class="text-lg mb-6">Temukan pengalaman tour terbaik bersama kami 🌋</p>
        <a href="#tours" class="bg-white text-blue-700 px-5 py-3 rounded-lg font-semibold shadow hover:bg-blue-100 transition">
            Lihat Paket Tour
        </a>
    </div>

    <div id="tours" class="container mx-auto px-4 py-10">
        <h2 class="text-3xl font-bold mb-6 text-center text-gray-800">Paket Tour Populer</h2>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded-lg mb-5 text-center">
                {{ session('success') }}
            </div>
        @endif

        @if($tours->count() > 0)
            <div class="grid md:grid-cols-3 gap-6">
                @foreach($tours as $tour)
                    <div class="bg-white rounded-xl shadow hover:shadow-lg transition p-4">
                        @if($tour->image)
                            <img src="{{ asset('storage/'.$tour->image) }}" alt="{{ $tour->title }}" class="h-48 w-full object-cover rounded-md mb-3">
                        @endif
                        <h3 class="text-xl font-semibold mb-2 text-gray-800">{{ $tour->title }}</h3>
                        <p class="text-gray-600 text-sm mb-3">{{ \Str::limit($tour->description, 120) }}</p>
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-bold text-blue-700">Rp {{ number_format($tour->price, 0, ',', '.') }}</span>
                            <a href="{{ route('tour.show', $tour) }}" class="bg-blue-600 text-white px-3 py-2 rounded-md hover:bg-blue-700 transition">
                                Detail
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-10">
                {{ $tours->links() }}
            </div>
        @else
            <p class="text-center text-gray-600">Belum ada paket tour tersedia.</p>
        @endif
    </div>
</div>
@endsection
