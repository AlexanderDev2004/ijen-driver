@extends('layouts.app')

@section('title', $tour->title)
@section('meta_description', \Str::limit(strip_tags($tour->description ?? ''), 155))

@section('content')
<div class="space-y-8 sm:space-y-10">
    <a href="{{ route('public.tours') }}" class="btn-ghost -ml-1">
        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
        {{ __('public.back_to') }} {{ __('public.tours') }}
    </a>

    <article class="surface-card overflow-hidden">
        @if($tour->image)
            <div class="relative h-64 sm:h-80 lg:h-[26rem]">
                <img src="{{ asset('storage/' . $tour->image) }}" alt="{{ $tour->title }}" class="h-full w-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/70 via-slate-900/20 to-transparent"></div>
                <div class="absolute bottom-5 left-5 rounded-2xl bg-white/92 px-4 py-3 shadow-sm backdrop-blur">
                    <div class="text-xs font-semibold uppercase tracking-wider text-slate-500">{{ __('public.tour') }}</div>
                    <h1 class="text-xl font-semibold text-slate-900 sm:text-2xl">{{ $tour->title }}</h1>
                </div>
            </div>
        @endif

        <div class="grid gap-6 p-5 sm:p-7 lg:grid-cols-3 lg:gap-8">
            <div class="space-y-4 lg:col-span-2">
                @if(!$tour->image)
                    <h1 class="text-2xl font-semibold text-slate-900 sm:text-3xl">{{ $tour->title }}</h1>
                @endif

                @if($tour->location)
                    <div class="inline-flex items-center gap-2 rounded-full bg-teal-50 px-3 py-1.5 text-sm font-medium text-teal-700">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        {{ $tour->location }}
                    </div>
                @endif

                <div class="rounded-2xl border border-slate-200 bg-white p-4 sm:p-5">
                    <h2 class="text-lg font-semibold text-slate-900">{{ __('public.tour_description_title') }}</h2>
                    <p class="mt-3 whitespace-pre-line text-sm leading-relaxed text-slate-700 sm:text-base">{{ $tour->description }}</p>
                </div>

                <div class="flex flex-wrap gap-2">
                    <span class="badge-chip badge-positive">{{ __('public.verified_tour') }}</span>
                    <span class="badge-chip bg-cyan-100 text-cyan-700">{{ __('public.transport_included') }}</span>
                </div>
            </div>

            <aside class="space-y-4">
                <div class="soft-panel p-5">
                    <div class="text-xs font-semibold uppercase tracking-wide text-slate-500">{{ __('public.price_from') }}</div>

                    @if($tour->show_price)
                        <div class="mt-1 text-3xl font-bold text-teal-700">Rp {{ number_format($tour->price, 0, ',', '.') }}</div>
                        <div class="text-xs text-slate-500">{{ __('public.per_person') }}</div>
                    @else
                        <div class="mt-2 text-sm font-semibold text-slate-700">{{ __('public.price_hidden') }}</div>
                        <div class="text-xs text-slate-500">{{ __('public.contact_for_price') }}</div>
                    @endif
                </div>

                <a href="{{ route('tour.booking', $tour) }}" class="btn-primary w-full justify-center py-3">{{ __('public.book_now') }}</a>

                <div class="rounded-2xl border border-slate-200 bg-white p-4">
                    <div class="text-xs font-semibold uppercase tracking-wide text-slate-500">{{ __('public.quick_info_title') }}</div>
                    <ul class="mt-3 space-y-2 text-sm text-slate-600">
                        <li class="flex items-start gap-2">
                            <span class="mt-1 h-1.5 w-1.5 rounded-full bg-teal-600"></span>
                            {{ __('public.quick_info_flexible') }}
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="mt-1 h-1.5 w-1.5 rounded-full bg-teal-600"></span>
                            {{ __('public.quick_info_prepare') }}
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="mt-1 h-1.5 w-1.5 rounded-full bg-teal-600"></span>
                            {{ __('public.quick_info_whatsapp') }}
                        </li>
                    </ul>
                </div>
            </aside>
        </div>
    </article>

    <section class="space-y-4">
        <h2 class="section-title text-xl sm:text-2xl">{{ __('public.travel_journal') }}</h2>

        @if($tour->journals && $tour->journals->count())
            <div class="grid gap-4 sm:grid-cols-2">
                @foreach($tour->journals as $j)
                    <a href="{{ route('journal.show', $j->id) }}" class="group overflow-hidden rounded-2xl border border-slate-200 bg-white p-4 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                        @if($j->photo)
                            <div class="mb-3 overflow-hidden rounded-xl">
                                <img src="{{ $j->photo_url }}" alt="{{ $j->title }}" class="h-40 w-full object-cover transition duration-300 group-hover:scale-[1.03]">
                            </div>
                        @endif

                        <div class="text-xs font-semibold uppercase tracking-wide text-slate-500">{{ optional($j->journal_date)->format('d M Y') }}</div>
                        <h3 class="mt-1 line-clamp-1 text-lg font-semibold text-slate-900 transition group-hover:text-teal-700">{{ $j->title }}</h3>
                        <p class="mt-2 line-clamp-2 text-sm text-slate-600">{{ \Str::limit($j->content, 100) }}</p>
                        <div class="mt-3 inline-flex items-center gap-2 text-sm font-semibold text-teal-700">
                            {{ __('public.read_more') }}
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <p class="text-sm text-slate-500">{{ __('public.no_journals') }}</p>
            </div>
        @endif
    </section>
</div>
@endsection
