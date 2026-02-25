@extends('layouts.app')

@section('title', $journal->title)

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 pb-8">
    <div class="mb-5 sm:mb-6">
        <a href="{{ route('tour.show', $journal->tour) }}" class="text-indigo-600 hover:text-indigo-700 font-medium inline-flex items-center gap-2 text-sm sm:text-base">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            {{ __('public.back_to') }} {{ $journal->tour->title }}
        </a>
    </div>

    <article class="bg-white rounded-2xl shadow-sm overflow-hidden border border-slate-100">
        <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-5 sm:px-6 py-6 sm:py-8 text-white">
            <div class="flex items-center gap-2 text-indigo-100 text-xs sm:text-sm mb-2">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                {{ \Carbon\Carbon::parse($journal->journal_date)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
            </div>
            <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-2">{{ $journal->title }}</h1>
            <div class="text-indigo-100 text-sm">
                <span class="inline-flex items-center gap-2">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                    </svg>
                    <span class="truncate">{{ __('public.tour') }}: {{ $journal->tour->title }}</span>
                </span>
            </div>
        </div>

        @if($journal->photo)
        <div class="relative">
            <img src="{{ $journal->photo_url }}" alt="{{ $journal->title }}" class="w-full h-56 sm:h-64 md:h-80 object-cover">
            <div class="absolute bottom-3 sm:bottom-4 right-3 sm:right-4 bg-white/90 backdrop-blur px-3 py-1.5 rounded-lg text-xs sm:text-sm font-medium text-slate-700 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                </svg>
                {{ __('public.photo_documentation') }}
            </div>
        </div>
        @endif

        <div class="px-4 sm:px-6 py-6 sm:py-8">
            <div class="prose prose-slate max-w-none">
                <p class="whitespace-pre-line text-slate-700 leading-relaxed text-sm sm:text-base">{{ $journal->content }}</p>
            </div>
        </div>

        @if($journal->video)
        <div class="px-4 sm:px-6 pb-6 sm:pb-8">
            <div class="bg-slate-50 rounded-xl p-4 sm:p-6 border border-slate-200">
                <div class="flex items-center gap-2 text-slate-700 font-semibold mb-3 sm:mb-4 text-sm sm:text-base">
                    <svg class="w-5 h-5 text-purple-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                    </svg>
                    {{ __('public.video_documentation') }}
                </div>
                <video controls class="w-full rounded-lg shadow-lg bg-black max-h-[400px]">
                    <source src="{{ $journal->video_url }}" type="video/mp4">
                    {{ __('public.browser_no_support') }}
                </video>
            </div>
        </div>
        @endif

        <div class="bg-slate-50 px-4 sm:px-6 py-4 sm:py-5 border-t border-slate-200">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 sm:gap-4">
                <div class="flex flex-wrap items-center gap-2">
                    @if($journal->photo)
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-blue-100 text-blue-700 rounded-lg text-xs sm:text-sm font-medium">
                        📷 {{ __('public.has_photo') }}
                    </span>
                    @endif
                    @if($journal->video)
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-purple-100 text-purple-700 rounded-lg text-xs sm:text-sm font-medium">
                        🎥 {{ __('public.has_video') }}
                    </span>
                    @endif
                </div>
                <a href="{{ route('tour.show', $journal->tour) }}"
                   class="inline-flex items-center justify-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl font-semibold transition touch-manipulation text-sm">
                    {{ __('public.see_full_tour') }}
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
    </article>

    @if($journal->tour->journals->count() > 1)
    <div class="mt-8 sm:mt-10">
        <h3 class="text-xl sm:text-2xl font-semibold mb-4 sm:mb-5 text-slate-900">{{ __('public.other_journals') }}</h3>
        <div class="grid gap-4 sm:grid-cols-2">
            @foreach($journal->tour->journals->where('id', '!=', $journal->id)->take(4) as $otherJournal)
            <a href="{{ route('journal.show', $otherJournal->id) }}" class="block bg-white p-4 sm:p-5 shadow-sm rounded-xl border border-slate-100 hover:shadow-md hover:border-indigo-200 transition group">
                @if($otherJournal->photo)
                <div class="mb-3 overflow-hidden rounded-lg">
                    <img src="{{ $otherJournal->photo_url }}" alt="{{ $otherJournal->title }}" class="w-full h-28 sm:h-32 object-cover group-hover:scale-105 transition duration-300">
                </div>
                @endif

                <div class="text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1.5">
                    {{ optional($otherJournal->journal_date)->format('d M Y') }}
                </div>
                <div class="font-semibold text-slate-900 group-hover:text-indigo-600 transition line-clamp-1">{{ $otherJournal->title }}</div>
                <p class="text-slate-600 text-sm mt-1.5 line-clamp-2">{{ \Str::limit($otherJournal->content, 80) }}</p>
            </a>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection
