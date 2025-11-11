@extends('layouts.app')

@section('title', $tour->name)

@section('content')
    <div class="max-w-5xl mx-auto bg-white rounded-xl shadow p-6">
        @if ($tour->image)
            <img src="{{ asset('storage/' . $tour->image) }}" alt="{{ $tour->name }}"
                class="rounded-lg w-full h-80 object-cover mb-6">
        @endif

        <h1 class="text-3xl font-bold text-gray-800">{{ $tour->name }}</h1>
        <p class="text-gray-600 mt-3 leading-relaxed">{{ $tour->description }}</p>

        <div class="flex items-center justify-between mt-6">
            <span class="text-2xl font-bold text-indigo-600">Rp {{ number_format($tour->price, 0, ',', '.') }}</span>
            <a href="{{ route('tour.booking', $tour) }}"
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg font-medium">
                Booking Sekarang
            </a>
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
