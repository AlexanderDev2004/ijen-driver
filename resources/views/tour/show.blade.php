@extends('layouts.app')

@section('title', 'Tour ' . $tour['title'])

@section('content')
<div class="max-w-4xl mx-auto py-8">
    <div class="bg-white rounded-lg shadow overflow-hidden md:flex">
        <div class="md:flex-shrink-0">
            <img class="h-64 w-full object-cover md:w-64" src="{{ asset($tour['image']) }}" alt="{{ $tour['title'] }}">
        </div>
        <div class="p-8">
            <h1 class="text-3xl font-bold mb-4">{{ $tour['title'] }}</h1>
            <p class="text-gray-700 mb-6">{{ $tour['description'] }}</p>

            <h3 class="text-xl font-semibold mb-2">Tour Details</h3>
            <ul class="list-disc list-inside text-gray-700 mb-6">
                @foreach($tour['details'] as $detail)
                    <li>{{ $detail }}</li>
                @endforeach
            </ul>

            <a href="{{ route('booking.form', ['tour' => $name]) }}"
               class="inline-block bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-3 rounded text-lg font-semibold">
                Book Now
            </a>
        </div>
    </div>
</div>
@endsection
