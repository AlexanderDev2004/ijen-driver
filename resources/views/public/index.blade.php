@extends('layouts.app')

@section('title', 'Ijen Driver - ' . __('public.hero_title'))
@section('meta_description', __('public.hero_subtitle'))

@section('content')
<div class="space-y-10 sm:space-y-12">
    <section class="page-hero content-reveal">
        <div class="relative z-10 max-w-3xl">
            <span class="hero-kicker">{{ __('public.hero_kicker') }}</span>
            <h1 class="text-3xl font-bold leading-tight text-white sm:text-4xl md:text-5xl">{{ __('public.hero_title') }}</h1>
            <p class="mt-3 text-sm text-white/90 sm:text-base md:text-lg">{{ __('public.hero_subtitle') }}</p>

            <div class="mt-6 flex flex-col items-start gap-3 sm:flex-row">
                <a href="#tours" class="btn-secondary w-full border-white/70 bg-white text-teal-800 hover:bg-white sm:w-auto">{{ __('public.cta_view_tours') }}</a>
                <a href="#why-us" class="inline-flex w-full items-center justify-center rounded-xl border border-white/45 bg-white/10 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-white/20 sm:w-auto">{{ __('public.cta_why_us') }}</a>
            </div>
        </div>
    </section>

    <section class="grid gap-4 md:grid-cols-3 content-reveal-delay">
        <div class="surface-card p-5 sm:p-6">
            <div class="mb-3 inline-flex h-10 w-10 items-center justify-center rounded-xl bg-teal-100 text-teal-700">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-slate-900">{{ __('public.feature_welcome_title') }}</h3>
            <p class="mt-2 text-sm text-slate-600">{{ __('public.feature_welcome_desc') }}</p>
        </div>

        <div class="surface-card p-5 sm:p-6">
            <div class="mb-3 inline-flex h-10 w-10 items-center justify-center rounded-xl bg-amber-100 text-amber-700">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-slate-900">{{ __('public.feature_routes_title') }}</h3>
            <p class="mt-2 text-sm text-slate-600">{{ __('public.feature_routes_desc') }}</p>
        </div>

        <div class="surface-card p-5 sm:p-6">
            <div class="mb-3 inline-flex h-10 w-10 items-center justify-center rounded-xl bg-cyan-100 text-cyan-700">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-4l-4 4v-4z" />
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-slate-900">{{ __('public.feature_response_title') }}</h3>
            <p class="mt-2 text-sm text-slate-600">{{ __('public.feature_response_desc') }}</p>
        </div>
    </section>

    <section id="why-us" class="surface-card p-6 sm:p-8">
        <div class="max-w-2xl">
            <h2 class="section-title">{{ __('public.why_us_title') }}</h2>
            <p class="section-subtitle">{{ __('public.why_us_subtitle') }}</p>
        </div>

        <div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <div class="soft-panel p-4 sm:p-5">
                <div class="text-base font-semibold text-slate-900">{{ __('public.why_local_title') }}</div>
                <div class="mt-1 text-sm text-slate-600">{{ __('public.why_local_desc') }}</div>
            </div>

            <div class="soft-panel p-4 sm:p-5">
                <div class="text-base font-semibold text-slate-900">{{ __('public.why_price_title') }}</div>
                <div class="mt-1 text-sm text-slate-600">{{ __('public.why_price_desc') }}</div>
            </div>

            <div class="soft-panel p-4 sm:p-5">
                <div class="text-base font-semibold text-slate-900">{{ __('public.why_schedule_title') }}</div>
                <div class="mt-1 text-sm text-slate-600">{{ __('public.why_schedule_desc') }}</div>
            </div>

            <div class="soft-panel p-4 sm:p-5">
                <div class="text-base font-semibold text-slate-900">{{ __('public.why_support_title') }}</div>
                <div class="mt-1 text-sm text-slate-600">{{ __('public.why_support_desc') }}</div>
            </div>
        </div>
    </section>

    <section id="tours" class="space-y-5">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <h2 class="section-title">{{ __('public.tour_packages_title') }}</h2>
                <p class="section-subtitle">{{ __('public.tour_packages_hint') }}</p>
            </div>
            <a href="{{ route('public.tours') }}" class="btn-secondary w-full sm:w-auto">{{ __('public.view_all_tours') }}</a>
        </div>

        @if($tours->count() > 0)
            <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($tours as $tour)
                    <article class="group flex h-full flex-col overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-xl">
                        @if($tour->image)
                            <img src="{{ asset('storage/' . $tour->image) }}" alt="{{ $tour->title }}" class="h-48 w-full object-cover transition duration-300 group-hover:scale-[1.03]">
                        @else
                            <div class="flex h-48 items-center justify-center bg-slate-100 text-sm font-medium text-slate-500">{{ __('public.no_image') }}</div>
                        @endif

                        <div class="flex flex-1 flex-col p-5">
                            <h3 class="line-clamp-1 text-lg font-semibold text-slate-900">{{ $tour->title }}</h3>

                            @if($tour->location)
                                <p class="mt-2 inline-flex items-center gap-1.5 text-sm text-slate-600">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <span class="truncate">{{ $tour->location }}</span>
                                </p>
                            @endif

                            <p class="mt-3 line-clamp-2 text-sm text-slate-600">{{ \Str::limit($tour->description, 90) }}</p>

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
            </div>

            <div>
                {{ $tours->links('pagination::tailwind') }}
            </div>
        @else
            <div class="empty-state">
                <p class="text-sm text-slate-500">{{ __('public.no_tours') }}</p>
            </div>
        @endif
    </section>

    <section id="journals" class="space-y-5">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <h2 class="section-title">{{ __('public.journal_section_title') }}</h2>
                <p class="section-subtitle">{{ __('public.journal_section_subtitle') }}</p>
            </div>
            <a href="{{ route('public.journals') }}" class="btn-secondary w-full sm:w-auto">{{ __('public.view_all_journals') }}</a>
        </div>

        @if(isset($journals) && $journals->count() > 0)
            <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($journals as $journal)
                    <a href="{{ route('journal.show', $journal->id) }}" class="group overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-xl">
                        @if($journal->photo)
                            <img src="{{ asset('storage/' . $journal->photo) }}" alt="{{ $journal->title }}" class="h-44 w-full object-cover transition duration-300 group-hover:scale-[1.03]">
                        @else
                            <div class="flex h-44 items-center justify-center bg-slate-100 text-sm font-medium text-slate-500">{{ __('public.no_journal_image') }}</div>
                        @endif

                        <div class="p-5">
                            <div class="text-xs font-semibold uppercase tracking-wide text-slate-400">{{ $journal->tour?->title }}</div>
                            <h3 class="mt-1 line-clamp-1 text-lg font-semibold text-slate-900 transition group-hover:text-teal-700">{{ $journal->title }}</h3>
                            <p class="mt-2 line-clamp-2 text-sm text-slate-600">{{ \Str::limit(strip_tags($journal->content ?? ''), 100) }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <p class="text-sm text-slate-500">{{ __('public.no_journals_home') }}</p>
            </div>
        @endif
    </section>

    <section class="page-hero content-reveal-delay">
        <div class="relative z-10 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div class="max-w-xl">
                <h3 class="text-2xl font-semibold text-white sm:text-3xl">{{ __('public.cta_title') }}</h3>
                <p class="mt-2 text-sm text-white/90 sm:text-base">{{ __('public.cta_subtitle') }}</p>
            </div>

            <a href="#tours" class="btn-secondary border-white/70 bg-white text-teal-800 hover:bg-white">{{ __('public.cta_button') }}</a>
        </div>
    </section>
</div>
@endsection
