@extends('layouts.app')

@section('title', __('public.confirm_page_title'))

@section('content')
<div class="mx-auto max-w-4xl space-y-6">
    <section class="surface-card p-5 sm:p-7">
        <div class="mb-5">
            <h1 class="text-2xl font-semibold text-slate-900">{{ __('public.confirm_title') }}</h1>
            <p class="mt-1 text-sm text-slate-500">{{ __('public.confirm_subtitle') }}</p>
        </div>

        <div class="overflow-hidden rounded-2xl border border-slate-200">
            <div class="grid grid-cols-1 divide-y divide-slate-200 sm:grid-cols-2 sm:divide-x sm:divide-y-0">
                <div class="bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-600">{{ __('public.tour') }}</div>
                <div class="px-4 py-3 text-sm text-slate-900">{{ $booking->tour->title }}</div>
            </div>

            <div class="grid grid-cols-1 divide-y divide-slate-200 sm:grid-cols-2 sm:divide-x sm:divide-y-0">
                <div class="bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-600">{{ __('public.booking_name') }}</div>
                <div class="px-4 py-3 text-sm text-slate-900">{{ $booking->name }}</div>
            </div>

            <div class="grid grid-cols-1 divide-y divide-slate-200 sm:grid-cols-2 sm:divide-x sm:divide-y-0">
                <div class="bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-600">{{ __('public.booking_date') }}</div>
                <div class="px-4 py-3 text-sm text-slate-900">{{ $booking->date->format('Y-m-d') }}</div>
            </div>

            <div class="grid grid-cols-1 divide-y divide-slate-200 sm:grid-cols-2 sm:divide-x sm:divide-y-0">
                <div class="bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-600">{{ __('public.booking_people') }}</div>
                <div class="px-4 py-3 text-sm text-slate-900">{{ $booking->people }}</div>
            </div>

            <div class="grid grid-cols-1 divide-y divide-slate-200 sm:grid-cols-2 sm:divide-x sm:divide-y-0">
                <div class="bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-600">{{ __('public.booking_has_children') }}</div>
                <div class="px-4 py-3 text-sm text-slate-900">{{ $booking->has_children ? $booking->children_count : __('public.no') }}</div>
            </div>

            <div class="grid grid-cols-1 divide-y divide-slate-200 sm:grid-cols-2 sm:divide-x sm:divide-y-0">
                <div class="bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-600">{{ __('public.booking_notes') }}</div>
                <div class="px-4 py-3 text-sm text-slate-900">{{ $booking->notes ?? '-' }}</div>
            </div>
        </div>

        <div class="mt-6 flex flex-col gap-3 sm:flex-row sm:items-center">
            <a href="{{ route('booking.sendwa', $booking->id) }}" class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-emerald-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-emerald-700 sm:w-auto">
                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884" />
                </svg>
                {{ __('public.confirm_send_whatsapp') }}
            </a>

            <a href="{{ route('tour.booking', $booking->tour) }}" class="btn-secondary w-full justify-center sm:w-auto">{{ __('public.confirm_edit') }}</a>
        </div>
    </section>
</div>
@endsection
