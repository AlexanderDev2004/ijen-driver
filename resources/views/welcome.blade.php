@extends('layouts.app')

@section('title', 'Welcome to Ijen Driver')

@section('content')
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold mb-4">Welcome to Ijen Driver</h1>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto">
            Enjoy the best tour experience with us!
            Choose your favorite destination and we will arrange everything for an unforgettable journey.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @php
            $tours = [
                ['name' => 'Kawah Ijen', 'image' => asset('images/kawah-ijen.png')],
                ['name' => 'Mount Bromo', 'image' => asset('images/bromo.png')],
                ['name' => 'Tumpak Sewu', 'image' => asset('images/tumpak-sewu.png')],
            ];
        @endphp

        @foreach ($tours as $tour)
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <img src="{{ $tour['image'] }}" alt="{{ $tour['name'] }}" class="w-full h-48 object-cover">
                <div class="p-6 text-center">
                    <h2 class="text-xl font-semibold mb-2">{{ $tour['name'] }}</h2>
                    <p class="text-gray-600 mb-4">Explore the beauty of {{ $tour['name'] }} with our experienced guides.</p>
                    <a href="{{ route('tour.show', ['name' => $tour['name']]) }}"
                        class="inline-block bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded">
                        View Details
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
