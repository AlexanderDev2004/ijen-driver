@extends('layouts.app')

@section('title', __('public.tours_page_title'))
@section('meta_description', __('public.tours_page_subtitle'))

@section('content')
<div class="space-y-8 sm:space-y-10">
    <section class="page-hero content-reveal">
        <div class="relative z-10 max-w-3xl">
            <span class="hero-kicker">{{ __('public.tours_kicker') }}</span>
            <h1 class="text-3xl font-bold text-white sm:text-4xl md:text-5xl">{{ __('public.tours_page_title') }}</h1>
            <p class="mt-3 text-sm text-white/90 sm:text-base">{{ __('public.tours_page_subtitle') }}</p>
        </div>
    </section>

    @if($tours->count() > 0)
        <section class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($tours as $tour)
                <article class="group flex h-full flex-col overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-xl">
                    @if($tour->image)
                        <img src="{{ asset('storage/' . $tour->image) }}" alt="{{ $tour->title }}" class="h-48 w-full object-cover transition duration-300 group-hover:scale-[1.03]">
                    @else
                        <div class="flex h-48 items-center justify-center bg-slate-100 text-sm font-medium text-slate-500">{{ __('public.no_image') }}</div>
                    @endif

                    <div class="flex flex-1 flex-col p-5">
                        <h2 class="line-clamp-1 text-lg font-semibold text-slate-900">{{ $tour->title }}</h2>

                        @if($tour->location)
                            <p class="mt-2 inline-flex items-center gap-1.5 text-sm text-slate-600">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span class="truncate">{{ $tour->location }}</span>
                            </p>
                        @endif

                        <p class="mt-3 line-clamp-2 text-sm text-slate-600">{{ \Str::limit($tour->description, 100) }}</p>

                        <div class="mt-5 flex items-center justify-between gap-3">
                            @if($tour->show_price)
                                <span class="text-lg font-bold text-teal-700">Rp {{ number_format($tour->price, 0, ',', '.') }}</span>
                            @else
                                <span class="text-sm font-semibold text-slate-500">{{ __('public.price_hidden') }}</span>
                            @endif

                            <a href="{{ route('tour.show', $tour) }}" class="btn-primary">{{ __('public.read_more') }}</a>
                        </div>
                    </div>
                </article>
            @endforeach
        </section>

        <div>
            {{ $tours->links('pagination::tailwind') }}
        </div>
    @else
        <section class="empty-state">
            <p class="text-sm text-slate-500">{{ __('public.no_tours') }}</p>
        </section>
    @endif
</div>
@endsection
