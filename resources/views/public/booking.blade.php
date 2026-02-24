@extends('layouts.app')
@section('title', __('public.booking_page_title'))

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl shadow border border-slate-100 overflow-hidden">
                @if($tour->image)
                    <img src="{{ asset('storage/' . $tour->image) }}" alt="{{ $tour->title }}" class="w-full h-48 object-cover">
                @endif
                <div class="p-5 space-y-3">
                    <div class="text-xs font-semibold uppercase tracking-wide text-slate-400">{{ __('public.tour') }}</div>
                    <h2 class="text-xl font-bold text-slate-900">{{ $tour->title }}</h2>
                    @if($tour->location)
                        <div class="text-sm text-slate-600">📍 {{ $tour->location }}</div>
                    @endif
                    @if($tour->show_price)
                        <div class="pt-2 border-t border-slate-100">
                            <div class="text-xs text-slate-500">{{ __('public.price_from') }}</div>
                            <div class="text-2xl font-extrabold text-indigo-600">Rp {{ number_format($tour->price, 0, ',', '.') }}</div>
                            <div class="text-xs text-slate-500">{{ __('public.per_person') }}</div>
                        </div>
                    @else
                        <div class="pt-2 border-t border-slate-100 text-sm font-semibold text-slate-600">{{ __('public.price_hidden') }}</div>
                    @endif
                </div>
            </div>
        </div>

        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow border border-slate-100 p-5 sm:p-7">
                <div class="mb-6">
                    <h1 class="text-2xl font-bold text-slate-900">{{ __('public.booking_title') }}: {{ $tour->title }}</h1>
                    <p class="text-sm text-slate-500 mt-1">{{ __('public.booking_subtitle') }}</p>
                </div>

                <form id="bookingForm" action="{{ route('tour.booking.submit', $tour) }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label for="name" class="block text-sm font-medium text-slate-700">{{ __('public.booking_name') }} <span class="text-red-600">*</span></label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" class="mt-1 w-full border border-slate-300 rounded-xl px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500 @error('name') border-red-500 @enderror" required>
                        @error('name')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="phone" class="block text-sm font-medium text-slate-700">{{ __('public.booking_phone') }}</label>
                            <input id="phone" type="tel" name="phone" value="{{ old('phone') }}" class="mt-1 w-full border border-slate-300 rounded-xl px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500 @error('phone') border-red-500 @enderror" placeholder="08xxxxxxxxxx">
                            @error('phone')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                        </div>
                        <div>
                            <label for="date" class="block text-sm font-medium text-slate-700">{{ __('public.booking_date') }} <span class="text-red-600">*</span></label>
                            <input id="date" type="date" name="date" value="{{ old('date') }}" class="mt-1 w-full border border-slate-300 rounded-xl px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500 @error('date') border-red-500 @enderror" required>
                            @error('date')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="people" class="block text-sm font-medium text-slate-700">{{ __('public.booking_people') }} <span class="text-red-600">*</span></label>
                            <input id="people" type="number" min="1" max="100" name="people" value="{{ old('people', 1) }}" class="mt-1 w-full border border-slate-300 rounded-xl px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500 @error('people') border-red-500 @enderror" required>
                            @error('people')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                        </div>
                        <div class="flex items-end">
                            <label class="inline-flex items-center gap-2 text-sm text-slate-700">
                                <input type="checkbox" id="hasChildrenToggle" name="has_children" class="rounded border-slate-300 text-indigo-600 focus:ring-indigo-500" {{ old('has_children') ? 'checked' : '' }}>
                                {{ __('public.booking_has_children') }}
                            </label>
                        </div>
                    </div>

                    <div id="childrenCountLabel" style="display: {{ old('has_children') ? 'block' : 'none' }}">
                        <label for="children_count" class="block text-sm font-medium text-slate-700">{{ __('public.booking_children_count') }}</label>
                        <input id="children_count" type="number" min="1" max="100" name="children_count" value="{{ old('children_count', 1) }}" class="mt-1 w-full border border-slate-300 rounded-xl px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500 @error('children_count') border-red-500 @enderror">
                        @error('children_count')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                    </div>

                    <div>
                        <label for="notes" class="block text-sm font-medium text-slate-700">{{ __('public.booking_notes') }}</label>
                        <textarea id="notes" name="notes" maxlength="1000" rows="4" class="mt-1 w-full border border-slate-300 rounded-xl px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500 @error('notes') border-red-500 @enderror">{{ old('notes') }}</textarea>
                        <small class="text-slate-500">{{ __('public.booking_notes_hint') }}</small>
                        @error('notes')<span class="text-red-600 text-sm block">{{ $message }}</span>@enderror
                    </div>

                    <div class="pt-2 flex items-center gap-3">
                        <button type="submit" class="bg-indigo-600 text-white px-5 py-2.5 rounded-xl font-semibold hover:bg-indigo-700 transition">
                            {{ __('public.booking_submit') }}
                        </button>
                        <a href="{{ route('tour.show', $tour) }}" class="text-sm text-slate-600 hover:text-indigo-600">{{ __('public.back_to') }} {{ __('public.tour') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const childrenToggle = document.getElementById('hasChildrenToggle');
        const childrenLabel = document.getElementById('childrenCountLabel');

        childrenToggle?.addEventListener('change', (event) => {
            childrenLabel.style.display = event.target.checked ? 'block' : 'none';
        });
    </script>
</div>
@endsection
