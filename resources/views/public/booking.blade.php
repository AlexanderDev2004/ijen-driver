@extends('layouts.app')

@section('title', __('public.booking_page_title'))

@section('content')
<div class="space-y-6 sm:space-y-8">
    <a href="{{ route('tour.show', $tour) }}" class="btn-ghost -ml-1">
        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
        {{ __('public.back_to') }} {{ __('public.tour') }}
    </a>

    <div class="grid gap-5 lg:grid-cols-3">
        <aside class="order-2 lg:order-1 lg:col-span-1">
            <div class="surface-card sticky top-24 overflow-hidden">
                @if($tour->image)
                    <img src="{{ asset('storage/' . $tour->image) }}" alt="{{ $tour->title }}" class="h-48 w-full object-cover">
                @endif

                <div class="space-y-3 p-5">
                    <div class="text-xs font-semibold uppercase tracking-wide text-slate-400">{{ __('public.tour') }}</div>
                    <h2 class="text-xl font-semibold text-slate-900">{{ $tour->title }}</h2>

                    @if($tour->location)
                        <div class="inline-flex items-center gap-1.5 text-sm text-slate-600">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            </svg>
                            <span>{{ $tour->location }}</span>
                        </div>
                    @endif

                    @if($tour->show_price)
                        <div class="rounded-xl bg-teal-50 p-3">
                            <div class="text-xs font-semibold uppercase tracking-wide text-teal-700">{{ __('public.price_from') }}</div>
                            <div class="text-2xl font-bold text-teal-700">Rp {{ number_format($tour->price, 0, ',', '.') }}</div>
                            <div class="text-xs text-teal-700/80">{{ __('public.per_person') }}</div>
                        </div>
                    @else
                        <div class="rounded-xl bg-slate-50 p-3 text-sm font-semibold text-slate-600">{{ __('public.price_hidden') }}</div>
                    @endif
                </div>
            </div>
        </aside>

        <section class="order-1 lg:order-2 lg:col-span-2">
            <div class="surface-card p-5 sm:p-7">
                <div class="mb-6">
                    <h1 class="text-2xl font-semibold text-slate-900">{{ __('public.booking_title') }}</h1>
                    <p class="mt-1 text-sm text-slate-500">{{ __('public.booking_subtitle') }}</p>
                </div>

                <form id="bookingForm" action="{{ route('tour.booking.submit', $tour) }}" method="POST" class="space-y-5">
                    @csrf

                    <div>
                        <label for="name" class="form-label">{{ __('public.booking_name') }} <span class="text-red-600">*</span></label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" class="form-input @error('name') input-error @enderror" required>
                        @error('name')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <label for="phone" class="form-label">{{ __('public.booking_phone') }}</label>
                            <input id="phone" type="tel" name="phone" value="{{ old('phone') }}" class="form-input @error('phone') input-error @enderror" placeholder="08xxxxxxxxxx">
                            @error('phone')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="date" class="form-label">{{ __('public.booking_date') }} <span class="text-red-600">*</span></label>
                            <input id="date" type="date" name="date" value="{{ old('date') }}" class="form-input @error('date') input-error @enderror" required>
                            @error('date')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <label for="people" class="form-label">{{ __('public.booking_people') }} <span class="text-red-600">*</span></label>
                            <input id="people" type="number" min="1" max="100" name="people" value="{{ old('people', 1) }}" class="form-input @error('people') input-error @enderror" required>
                            @error('people')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="rounded-xl border border-slate-200 bg-slate-50 px-4 py-3">
                            <label class="inline-flex cursor-pointer items-center gap-3 text-sm font-semibold text-slate-700">
                                <input type="checkbox" id="hasChildrenToggle" name="has_children" class="h-5 w-5 rounded border-slate-300 text-teal-600 focus:ring-teal-500" {{ old('has_children') ? 'checked' : '' }}>
                                {{ __('public.booking_has_children') }}
                            </label>
                            <p class="mt-1 text-xs text-slate-500">{{ __('public.booking_children_hint') }}</p>
                        </div>
                    </div>

                    <div id="childrenCountSection" class="hidden">
                        <label for="children_count" class="form-label">{{ __('public.booking_children_count') }}</label>
                        <input id="children_count" type="number" min="1" max="100" name="children_count" value="{{ old('children_count', 1) }}" class="form-input @error('children_count') input-error @enderror">
                        @error('children_count')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="notes" class="form-label">{{ __('public.booking_notes') }}</label>
                        <textarea id="notes" name="notes" maxlength="1000" rows="4" class="form-input @error('notes') input-error @enderror">{{ old('notes') }}</textarea>
                        <small class="form-hint">{{ __('public.booking_notes_hint') }}</small>
                        @error('notes')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex flex-col gap-3 border-t border-slate-200 pt-4 sm:flex-row sm:items-center">
                        <button type="submit" class="btn-primary w-full justify-center sm:w-auto">{{ __('public.booking_submit') }}</button>
                        <a href="{{ route('tour.show', $tour) }}" class="btn-secondary w-full justify-center sm:w-auto">{{ __('public.back_to') }} {{ __('public.tour') }}</a>
                    </div>
                </form>
            </div>
        </section>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const childrenToggle = document.getElementById('hasChildrenToggle');
    const childrenCountSection = document.getElementById('childrenCountSection');

    const syncChildrenVisibility = () => {
        if (!childrenToggle || !childrenCountSection) {
            return;
        }

        childrenCountSection.classList.toggle('hidden', !childrenToggle.checked);
    };

    syncChildrenVisibility();
    childrenToggle?.addEventListener('change', syncChildrenVisibility);
</script>
@endpush
