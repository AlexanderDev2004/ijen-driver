@extends('layouts.app')

@section('title', __('public.tours_page_title'))
@section('meta_description', __('public.tours_page_subtitle'))

@section('content')
<section class="bg-gradient-to-r from-indigo-600 to-teal-500 text-white">
    <div class="container mx-auto px-4 py-12 sm:py-16 text-center">
        <h1 class="text-4xl sm:text-5xl font-extrabold mb-3">{{ __('public.tours_page_title') }}</h1>
        <p class="text-base sm:text-lg">{{ __('public.tours_page_subtitle') }}</p>
    </div>
</section>

<section class="container mx-auto px-4 py-10">
    @if($tours->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($tours as $tour)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                    @if($tour->image)
                        <img src="{{ asset('storage/'.$tour->image) }}" alt="{{ $tour->title }}" class="h-48 w-full object-cover">
                    @else
                        <div class="h-48 w-full bg-gray-200 flex items-center justify-center">
                            <span class="text-gray-500">{{ __('public.no_journal_image') }}</span>
                        </div>
                    @endif

                    <div class="p-4">
                        <h2 class="font-semibold text-lg mb-2">{{ $tour->title }}</h2>

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
                            @if($tour->show_price)
                                <span class="text-lg font-bold text-indigo-600">Rp {{ number_format($tour->price, 0, ',', '.') }}</span>
                            @else
                                <span class="text-sm font-semibold text-slate-500">{{ __('public.price_hidden') }}</span>
                            @endif
                            <a href="{{ route('tour.show', $tour) }}"
                               class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                                {{ __('public.read_more') }}
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $tours->links() }}
        </div>
    @else
        <div class="text-center py-8">
            <p class="text-gray-500">{{ __('public.no_tours') }}</p>
        </div>
    @endif
</section>
@endsection
