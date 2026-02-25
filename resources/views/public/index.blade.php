@extends('layouts.app')

@section('content')
<section class="bg-gradient-to-r from-indigo-600 to-teal-500 text-white">
    <div class="container mx-auto px-4 py-10 sm:py-14 text-center">
        <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold mb-3 sm:mb-4">{{ __('public.hero_title') }}</h1>
        <p class="text-base sm:text-lg md:text-xl mb-6 sm:mb-8 text-white/90">{{ __('public.hero_subtitle') }}</p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-3 sm:gap-4">
            <a href="#tours" class="w-full sm:w-auto bg-white text-indigo-700 px-6 sm:px-8 py-3 sm:py-3.5 rounded-xl font-semibold hover:bg-gray-100 transition touch-manipulation">{{ __('public.cta_view_tours') }}</a>
            <a href="#why-us" class="w-full sm:w-auto px-6 sm:px-8 py-3 sm:py-3.5 rounded-xl font-semibold border-2 border-white/40 hover:bg-white/10 transition touch-manipulation">{{ __('public.cta_why_us') }}</a>
        </div>
    </div>
</section>

<section class="container mx-auto px-4 py-8 sm:py-10">
    <div class="grid gap-4 sm:gap-6 lg:grid-cols-3">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 sm:p-6 hover:shadow-md transition">
            <div class="text-2xl sm:text-3xl mb-3">⭐</div>
            <h3 class="text-base sm:text-lg font-semibold text-slate-900">{{ __('public.feature_welcome_title') }}</h3>
            <p class="text-sm text-slate-600 mt-2">{{ __('public.feature_welcome_desc') }}</p>
        </div>
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 sm:p-6 hover:shadow-md transition">
            <div class="text-2xl sm:text-3xl mb-3">🧭</div>
            <h3 class="text-base sm:text-lg font-semibold text-slate-900">{{ __('public.feature_routes_title') }}</h3>
            <p class="text-sm text-slate-600 mt-2">{{ __('public.feature_routes_desc') }}</p>
        </div>
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 sm:p-6 hover:shadow-md transition">
            <div class="text-2xl sm:text-3xl mb-3">💬</div>
            <h3 class="text-base sm:text-lg font-semibold text-slate-900">{{ __('public.feature_response_title') }}</h3>
            <p class="text-sm text-slate-600 mt-2">{{ __('public.feature_response_desc') }}</p>
        </div>
    </div>
</section>

<section id="why-us" class="bg-white border-y">
    <div class="container mx-auto px-4 py-10 sm:py-12">
        <div class="text-center max-w-2xl mx-auto mb-8 sm:mb-10">
            <h2 class="text-2xl sm:text-3xl font-bold text-slate-900">{{ __('public.why_us_title') }}</h2>
            <p class="text-slate-600 mt-3 text-sm sm:text-base">{{ __('public.why_us_subtitle') }}</p>
        </div>
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <div class="rounded-xl bg-slate-50 p-4 sm:p-5">
                <div class="text-base sm:text-lg font-semibold text-slate-900">{{ __('public.why_local_title') }}</div>
                <div class="text-sm text-slate-600 mt-1">{{ __('public.why_local_desc') }}</div>
            </div>
            <div class="rounded-xl bg-slate-50 p-4 sm:p-5">
                <div class="text-base sm:text-lg font-semibold text-slate-900">{{ __('public.why_price_title') }}</div>
                <div class="text-sm text-slate-600 mt-1">{{ __('public.why_price_desc') }}</div>
            </div>
            <div class="rounded-xl bg-slate-50 p-4 sm:p-5">
                <div class="text-base sm:text-lg font-semibold text-slate-900">{{ __('public.why_schedule_title') }}</div>
                <div class="text-sm text-slate-600 mt-1">{{ __('public.why_schedule_desc') }}</div>
            </div>
            <div class="rounded-xl bg-slate-50 p-4 sm:p-5">
                <div class="text-base sm:text-lg font-semibold text-slate-900">{{ __('public.why_support_title') }}</div>
                <div class="text-sm text-slate-600 mt-1">{{ __('public.why_support_desc') }}</div>
            </div>
        </div>
    </div>
</section>

<div id="tours" class="container mx-auto px-4 py-8 sm:py-10">
    <h1 class="text-xl sm:text-2xl font-bold mb-5 sm:mb-6">{{ __('public.tour_packages_title') }}</h1>

    @if($tours->count() > 0)
        <div class="grid gap-5 sm:gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($tours as $tour)
            <div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden hover:shadow-lg transition duration-300 group">
                @if($tour->image)
                    <img src="{{ asset('storage/'.$tour->image) }}"
                         alt="{{ $tour->title }}"
                         class="h-44 sm:h-48 w-full object-cover group-hover:scale-105 transition duration-300">
                @else
                    <div class="h-44 sm:h-48 w-full bg-gray-200 flex items-center justify-center">
                        <span class="text-gray-500">No Image</span>
                    </div>
                @endif

                <div class="p-4 sm:p-5">
                    <h2 class="font-semibold text-base sm:text-lg mb-2 line-clamp-1">{{ $tour->title }}</h2>

                    @if($tour->location)
                        <p class="text-slate-600 text-sm mb-2 flex items-center">
                            <svg class="w-4 h-4 mr-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span class="truncate">{{ $tour->location }}</span>
                        </p>
                    @endif

                    <p class="text-slate-600 text-sm mb-4 line-clamp-2">{{ \Str::limit($tour->description, 80) }}</p>

                    <div class="flex justify-between items-center gap-3">
                        @if($tour->show_price)
                            <span class="text-lg font-bold text-indigo-600">Rp {{ number_format($tour->price, 0, ',', '.') }}</span>
                        @else
                            <span class="text-sm font-semibold text-slate-500">{{ __('public.price_hidden') }}</span>
                        @endif
                        <a href="{{ route('tour.show', $tour) }}"
                           class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition text-sm font-medium touch-manipulation">
                            Detail
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $tours->links('pagination::tailwind') }}
        </div>
    @else
        <div class="text-center py-10 sm:py-12">
            <div class="text-4xl mb-3">🏝️</div>
            <p class="text-slate-500">Belum ada tour yang tersedia.</p>
        </div>
    @endif
</div>

<section id="journals" class="container mx-auto px-4 py-8 sm:py-10">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-5 sm:mb-6">
        <div>
            <h2 class="text-xl sm:text-2xl font-bold">{{ __('public.journal_section_title') }}</h2>
            <p class="text-sm text-slate-600 mt-1">{{ __('public.journal_section_subtitle') }}</p>
        </div>
    </div>

    @if(isset($journals) && $journals->count() > 0)
        <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($journals as $journal)
                <a href="{{ route('journal.show', $journal->id) }}" class="group bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden hover:shadow-md transition">
                    @if($journal->photo)
                        <img src="{{ asset('storage/'.$journal->photo) }}" alt="{{ $journal->title }}" class="h-40 sm:h-48 w-full object-cover group-hover:scale-105 transition duration-300">
                    @else
                        <div class="h-40 sm:h-48 w-full bg-slate-100 flex items-center justify-center text-slate-400 text-sm">{{ __('public.no_journal_image') }}</div>
                    @endif
                    <div class="p-4 sm:p-5">
                        <div class="text-xs text-slate-500">{{ $journal->tour?->title }}</div>
                        <h3 class="text-base sm:text-lg font-semibold text-slate-900 mt-1 group-hover:text-indigo-600 transition line-clamp-1">{{ $journal->title }}</h3>
                        <p class="text-sm text-slate-600 mt-2 line-clamp-2">{{ \Str::limit(strip_tags($journal->content ?? ''), 80) }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    @else
        <div class="text-center py-10 sm:py-12">
            <div class="text-4xl mb-3">📝</div>
            <p class="text-slate-500">{{ __('public.no_journals_home') }}</p>
        </div>
    @endif
</section>

<section class="container mx-auto px-4 pb-10 sm:pb-14">
    <div class="bg-gradient-to-r from-indigo-600 to-teal-500 rounded-2xl p-6 sm:p-8 text-white flex flex-col md:flex-row items-start md:items-center justify-between gap-4 sm:gap-6">
        <div>
            <h3 class="text-xl sm:text-2xl font-bold">{{ __('public.cta_title') }}</h3>
            <p class="text-white/90 mt-2 text-sm sm:text-base">{{ __('public.cta_subtitle') }}</p>
        </div>
        <a href="#tours" class="w-full sm:w-auto text-center bg-white text-indigo-700 px-6 py-3 rounded-xl font-semibold hover:bg-gray-100 transition touch-manipulation">{{ __('public.cta_button') }}</a>
    </div>
</section>
@endsection
