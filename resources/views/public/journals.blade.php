@extends('layouts.app')

@section('title', __('public.journals_page_title'))
@section('meta_description', __('public.journals_page_subtitle'))

@section('content')
<section class="bg-gradient-to-r from-indigo-600 to-teal-500 text-white">
    <div class="container mx-auto px-4 py-10 sm:py-14 text-center">
        <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold mb-3 sm:mb-4">{{ __('public.journals_page_title') }}</h1>
        <p class="text-base sm:text-lg text-white/90">{{ __('public.journals_page_subtitle') }}</p>
    </div>
</section>

<section class="container mx-auto px-4 py-8 sm:py-10">
    @if($journals->count() > 0)
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

        <div class="mt-8">
            {{ $journals->links('pagination::tailwind') }}
        </div>
    @else
        <div class="text-center py-10 sm:py-12">
            <div class="text-4xl mb-3">📝</div>
            <p class="text-slate-500">{{ __('public.no_journals_home') }}</p>
        </div>
    @endif
</section>
@endsection
