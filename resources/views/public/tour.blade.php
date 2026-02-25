@extends('layouts.app')

@section('title', $tour->title) {{-- Diubah dari name ke title --}}

@section('content')
    <div class="max-w-6xl mx-auto px-4 sm:px-6 pb-8">
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden border border-slate-100">
            @if ($tour->image)
                <div class="relative h-56 sm:h-64 md:h-80">
                    <img src="{{ asset('storage/' . $tour->image) }}" alt="{{ $tour->title }}" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent"></div>
                    <div class="absolute bottom-3 sm:bottom-4 left-3 sm:left-4 bg-white/95 backdrop-blur-sm px-3 sm:px-4 py-2 rounded-xl shadow-sm">
                        <div class="text-xs uppercase tracking-wide text-slate-500">Tour</div>
                        <h1 class="text-xl sm:text-2xl font-bold text-slate-900">{{ $tour->title }}</h1>
                    </div>
                </div>
            @endif

            <div class="p-5 sm:p-6 md:p-8 space-y-5 sm:space-y-6">
                <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
                    <div class="space-y-2">
                        <h1 class="text-2xl sm:text-3xl font-bold text-slate-900">{{ $tour->title }}</h1>
                        @if($tour->location)
                            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-slate-100 text-slate-700 text-sm">
                                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span>{{ $tour->location }}</span>
                            </div>
                        @endif
                    </div>

                    @if($tour->show_price)
                        <div class="bg-slate-50 border border-slate-200 rounded-xl p-4 text-left md:text-right">
                            <div class="text-sm text-slate-500">{{ __('public.price_from') }}</div>
                            <div class="text-2xl sm:text-3xl font-extrabold text-indigo-600">Rp {{ number_format($tour->price, 0, ',', '.') }}</div>
                            <div class="text-xs text-slate-500">{{ __('public.per_person') }}</div>
                        </div>
                    @else
                        <div class="bg-slate-50 border border-slate-200 rounded-xl p-4 text-left md:text-right">
                            <div class="text-sm text-slate-500">{{ __('public.price_from') }}</div>
                            <div class="text-lg font-bold text-slate-700">{{ __('public.price_hidden') }}</div>
                            <div class="text-xs text-slate-500">{{ __('public.contact_for_price') }}</div>
                        </div>
                    @endif
                </div>

                <div class="prose prose-slate max-w-none text-slate-700 leading-relaxed">
                    <p class="whitespace-pre-line text-sm sm:text-base">{{ $tour->description }}</p>
                </div>

                <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-3 sm:gap-4 pt-4 border-t border-slate-100">
                    <div class="flex flex-wrap items-center gap-2 text-sm">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-emerald-50 text-emerald-700 font-semibold">
                            ✅ {{ __('public.verified_tour') }}
                        </span>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-indigo-50 text-indigo-700 font-semibold">
                            🚐 {{ __('public.transport_included') }}
                        </span>
                    </div>
                    <a href="{{ route('tour.booking', $tour) }}"
                       class="inline-flex items-center justify-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-3 rounded-xl font-semibold shadow transition touch-manipulation">
                        {{ __('public.book_now') }}
                    </a>
                </div>
            </div>
        </div>

        <div class="mt-8 sm:mt-10">
            <h3 class="text-xl sm:text-2xl font-semibold mb-4 sm:mb-5 text-slate-900">{{ __('public.travel_journal') }}</h3>

            @if ($tour->journals && $tour->journals->count())
                <div class="grid gap-4 sm:grid-cols-2">
                    @foreach ($tour->journals as $j)
                        <a href="{{ route('journal.show', $j->id) }}" class="block bg-white p-4 sm:p-5 shadow-sm rounded-xl border border-slate-100 hover:shadow-md hover:border-indigo-200 transition group">
                            @if($j->photo)
                            <div class="mb-3 overflow-hidden rounded-lg">
                                <img src="{{ $j->photo_url }}" alt="{{ $j->title }}" class="w-full h-32 sm:h-40 object-cover group-hover:scale-105 transition duration-300">
                            </div>
                            @endif

                            <div class="flex items-center justify-between mb-2">
                                <div class="text-xs font-semibold text-slate-500 uppercase tracking-wide">
                                    {{ optional($j->journal_date)->format('d M Y') }}
                                </div>
                                <div class="flex gap-1.5">
                                    @if($j->photo)
                                    <span class="text-xs bg-blue-50 text-blue-600 px-2 py-0.5 rounded">📷</span>
                                    @endif
                                    @if($j->video)
                                    <span class="text-xs bg-purple-50 text-purple-600 px-2 py-0.5 rounded">🎥</span>
                                    @endif
                                </div>
                            </div>

                            <div class="font-semibold text-slate-900 mb-2 group-hover:text-indigo-600 transition line-clamp-1">{{ $j->title }}</div>
                            <p class="text-slate-600 text-sm line-clamp-2">{{ \Str::limit($j->content, 100) }}</p>

                            <div class="mt-3 text-indigo-600 text-sm font-medium flex items-center gap-1 transition-all">
                                {{ __('public.read_more') }}
                                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <p class="text-slate-500 text-sm">{{ __('public.no_journals') }}</p>
            @endif
        </div>
    </div>
@endsection
