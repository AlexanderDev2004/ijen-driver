@extends('layouts.app')

@section('title', __('public.journals_page_title'))
@section('meta_description', __('public.journals_page_subtitle'))

@section('content')
<div class="space-y-8 sm:space-y-10">
    <section class="page-hero content-reveal">
        <div class="relative z-10 max-w-3xl">
            <span class="hero-kicker">{{ __('public.journals_kicker') }}</span>
            <h1 class="text-3xl font-bold text-white sm:text-4xl md:text-5xl">{{ __('public.journals_page_title') }}</h1>
            <p class="mt-3 text-sm text-white/90 sm:text-base">{{ __('public.journals_page_subtitle') }}</p>
        </div>
    </section>

    @if($journals->count() > 0)
        <section class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($journals as $journal)
                <a href="{{ route('journal.show', $journal->id) }}" class="group overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-xl">
                    @if($journal->photo)
                        <img src="{{ asset('storage/' . $journal->photo) }}" alt="{{ $journal->title }}" class="h-48 w-full object-cover transition duration-300 group-hover:scale-[1.03]">
                    @else
                        <div class="flex h-48 items-center justify-center bg-slate-100 text-sm font-medium text-slate-500">{{ __('public.no_journal_image') }}</div>
                    @endif

                    <div class="p-5">
                        <div class="text-xs font-semibold uppercase tracking-wide text-slate-400">{{ $journal->tour?->title }}</div>
                        <h3 class="mt-1 line-clamp-1 text-lg font-semibold text-slate-900 transition group-hover:text-teal-700">{{ $journal->title }}</h3>
                        <p class="mt-2 line-clamp-2 text-sm text-slate-600">{{ \Str::limit(strip_tags($journal->content ?? ''), 100) }}</p>
                    </div>
                </a>
            @endforeach
        </section>

        <div>
            {{ $journals->links('pagination::tailwind') }}
        </div>
    @else
        <section class="empty-state">
            <p class="text-sm text-slate-500">{{ __('public.no_journals_home') }}</p>
        </section>
    @endif
</div>
@endsection
