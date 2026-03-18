@extends('layouts.app')

@section('title', $journal->title)
@section('meta_description', \Str::limit(strip_tags($journal->content ?? ''), 155))

@section('content')
<div class="space-y-8 sm:space-y-10">
    <a href="{{ route('tour.show', $journal->tour) }}" class="btn-ghost -ml-1">
        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
        {{ __('public.back_to') }} {{ $journal->tour->title }}
    </a>

    <article class="surface-card overflow-hidden">
        <div class="page-hero rounded-none rounded-t-3xl border-0 border-b border-white/20 px-5 py-7 sm:px-7 sm:py-10">
            <div class="relative z-10 max-w-3xl">
                <span class="hero-kicker">{{ __('public.journal_story_kicker') }}</span>
                <h1 class="text-3xl font-bold text-white sm:text-4xl">{{ $journal->title }}</h1>
                <p class="mt-2 text-sm text-white/85 sm:text-base">
                    {{ \Carbon\Carbon::parse($journal->journal_date)->locale(app()->getLocale())->isoFormat('dddd, D MMMM YYYY') }}
                </p>
                <p class="mt-1 text-sm text-white/85">{{ __('public.tour') }}: {{ $journal->tour->title }}</p>
            </div>
        </div>

        @if($journal->photo)
            <div class="relative">
                <img src="{{ $journal->photo_url }}" alt="{{ $journal->title }}" class="h-64 w-full object-cover sm:h-80">
                <div class="absolute bottom-4 right-4 rounded-xl bg-white/90 px-3 py-1.5 text-xs font-semibold text-slate-700 backdrop-blur">
                    {{ __('public.photo_documentation') }}
                </div>
            </div>
        @endif

        <div class="p-5 sm:p-7">
            <div class="rounded-2xl border border-slate-200 bg-white p-4 sm:p-5">
                <p class="whitespace-pre-line text-sm leading-relaxed text-slate-700 sm:text-base">{{ $journal->content }}</p>
            </div>
        </div>

        @if($journal->video)
            <div class="px-5 pb-6 sm:px-7 sm:pb-7">
                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 sm:p-5">
                    <div class="mb-3 text-sm font-semibold text-slate-800">{{ __('public.video_documentation') }}</div>
                    <video controls class="max-h-[460px] w-full rounded-xl bg-black">
                        <source src="{{ $journal->video_url }}" type="video/mp4">
                        {{ __('public.browser_no_support') }}
                    </video>
                </div>
            </div>
        @endif

        <div class="border-t border-slate-200 bg-slate-50 px-5 py-4 sm:px-7">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <div class="flex flex-wrap gap-2">
                    @if($journal->photo)
                        <span class="badge-chip bg-sky-100 text-sky-700">{{ __('public.has_photo') }}</span>
                    @endif
                    @if($journal->video)
                        <span class="badge-chip bg-cyan-100 text-cyan-700">{{ __('public.has_video') }}</span>
                    @endif
                </div>

                <a href="{{ route('tour.show', $journal->tour) }}" class="btn-primary w-full justify-center sm:w-auto">
                    {{ __('public.see_full_tour') }}
                </a>
            </div>
        </div>
    </article>

    @if($journal->tour->journals->count() > 1)
        <section class="space-y-4">
            <h2 class="section-title text-xl sm:text-2xl">{{ __('public.other_journals') }}</h2>

            <div class="grid gap-4 sm:grid-cols-2">
                @foreach($journal->tour->journals->where('id', '!=', $journal->id)->take(4) as $otherJournal)
                    <a href="{{ route('journal.show', $otherJournal->id) }}" class="group overflow-hidden rounded-2xl border border-slate-200 bg-white p-4 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                        @if($otherJournal->photo)
                            <div class="mb-3 overflow-hidden rounded-xl">
                                <img src="{{ $otherJournal->photo_url }}" alt="{{ $otherJournal->title }}" class="h-32 w-full object-cover transition duration-300 group-hover:scale-[1.03]">
                            </div>
                        @endif

                        <div class="text-xs font-semibold uppercase tracking-wide text-slate-500">{{ optional($otherJournal->journal_date)->format('d M Y') }}</div>
                        <h3 class="mt-1 line-clamp-1 text-base font-semibold text-slate-900 transition group-hover:text-teal-700">{{ $otherJournal->title }}</h3>
                        <p class="mt-2 line-clamp-2 text-sm text-slate-600">{{ \Str::limit($otherJournal->content, 90) }}</p>
                    </a>
                @endforeach
            </div>
        </section>
    @endif
</div>
@endsection
