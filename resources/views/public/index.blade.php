@extends('layouts.app')

@section('content')
<section class="bg-gradient-to-r from-indigo-600 to-teal-500 text-white">
    <div class="container mx-auto px-4 py-12 sm:py-16 text-center">
        <h1 class="text-4xl sm:text-5xl font-extrabold mb-3">{{ __('public.hero_title') }}</h1>
        <p class="text-base sm:text-lg mb-6">{{ __('public.hero_subtitle') }}</p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
            <a href="#tours" class="bg-white text-indigo-700 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">{{ __('public.cta_view_tours') }}</a>
            <a href="#why-us" class="px-6 py-3 rounded-lg font-semibold border border-white/50 hover:bg-white/10 transition">{{ __('public.cta_why_us') }}</a>
        </div>
    </div>
</section>

<section class="container mx-auto px-4 py-10">
    <div class="grid gap-6 lg:grid-cols-3">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
            <div class="text-2xl mb-2">⭐</div>
            <h3 class="text-lg font-semibold text-slate-900">{{ __('public.feature_welcome_title') }}</h3>
            <p class="text-sm text-slate-600 mt-2">{{ __('public.feature_welcome_desc') }}</p>
        </div>
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
            <div class="text-2xl mb-2">🧭</div>
            <h3 class="text-lg font-semibold text-slate-900">{{ __('public.feature_routes_title') }}</h3>
            <p class="text-sm text-slate-600 mt-2">{{ __('public.feature_routes_desc') }}</p>
        </div>
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
            <div class="text-2xl mb-2">💬</div>
            <h3 class="text-lg font-semibold text-slate-900">{{ __('public.feature_response_title') }}</h3>
            <p class="text-sm text-slate-600 mt-2">{{ __('public.feature_response_desc') }}</p>
        </div>
    </div>
</section>

<section id="why-us" class="bg-white border-y">
    <div class="container mx-auto px-4 py-12">
        <div class="text-center max-w-2xl mx-auto">
            <h2 class="text-3xl font-bold text-slate-900">{{ __('public.why_us_title') }}</h2>
            <p class="text-slate-600 mt-3">{{ __('public.why_us_subtitle') }}</p>
        </div>
        <div class="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
            <div class="rounded-xl bg-slate-50 p-5">
                <div class="text-lg font-semibold text-slate-900">{{ __('public.why_local_title') }}</div>
                <div class="text-sm text-slate-600 mt-1">{{ __('public.why_local_desc') }}</div>
            </div>
            <div class="rounded-xl bg-slate-50 p-5">
                <div class="text-lg font-semibold text-slate-900">{{ __('public.why_price_title') }}</div>
                <div class="text-sm text-slate-600 mt-1">{{ __('public.why_price_desc') }}</div>
            </div>
            <div class="rounded-xl bg-slate-50 p-5">
                <div class="text-lg font-semibold text-slate-900">{{ __('public.why_schedule_title') }}</div>
                <div class="text-sm text-slate-600 mt-1">{{ __('public.why_schedule_desc') }}</div>
            </div>
            <div class="rounded-xl bg-slate-50 p-5">
                <div class="text-lg font-semibold text-slate-900">{{ __('public.why_support_title') }}</div>
                <div class="text-sm text-slate-600 mt-1">{{ __('public.why_support_desc') }}</div>
            </div>
        </div>
    </div>
</section>

<div id="tours" class="container mx-auto px-4 py-10">
    <h1 class="text-2xl font-bold mb-6">{{ __('public.tour_packages_title') }}</h1>

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
                        @if($tour->show_price)
                            <span class="text-lg font-bold text-indigo-600">Rp {{ number_format($tour->price, 0, ',', '.') }}</span>
                        @else
                            <span class="text-sm font-semibold text-slate-500">{{ __('public.price_hidden') }}</span>
                        @endif
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

<section id="journals" class="container mx-auto px-4 py-10">
    <div class="flex items-center justify-between flex-wrap gap-3 mb-6">
        <div>
            <h2 class="text-2xl font-bold">{{ __('public.journal_section_title') }}</h2>
            <p class="text-sm text-slate-600 mt-1">{{ __('public.journal_section_subtitle') }}</p>
        </div>
    </div>

    @if(isset($journals) && $journals->count() > 0)
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($journals as $journal)
                <a href="{{ route('journal.show', $journal->id) }}" class="group bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden hover:shadow-md transition">
                    @if($journal->photo)
                        <img src="{{ asset('storage/'.$journal->photo) }}" alt="{{ $journal->title }}" class="h-48 w-full object-cover">
                    @else
                        <div class="h-48 w-full bg-slate-100 flex items-center justify-center text-slate-400 text-sm">{{ __('public.no_journal_image') }}</div>
                    @endif
                    <div class="p-5">
                        <div class="text-xs text-slate-500">{{ $journal->tour?->title }}</div>
                        <h3 class="text-lg font-semibold text-slate-900 mt-1 group-hover:text-indigo-600 transition">{{ $journal->title }}</h3>
                        <p class="text-sm text-slate-600 mt-2">{{ \Str::limit(strip_tags($journal->content ?? ''), 100) }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    @else
        <div class="text-center py-8">
            <p class="text-slate-500">{{ __('public.no_journals_home') }}</p>
        </div>
    @endif
</section>

<section class="container mx-auto px-4 pb-16">
    <div class="bg-gradient-to-r from-indigo-600 to-teal-500 rounded-2xl p-8 text-white flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
        <div>
            <h3 class="text-2xl font-bold">{{ __('public.cta_title') }}</h3>
            <p class="text-white/90 mt-2">{{ __('public.cta_subtitle') }}</p>
        </div>
        <a href="#tours" class="bg-white text-indigo-700 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">{{ __('public.cta_button') }}</a>
    </div>
</section>
@endsection
