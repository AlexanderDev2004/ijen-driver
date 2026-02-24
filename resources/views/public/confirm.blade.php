@extends('layouts.app')
@section('title', __('public.confirm_page_title'))

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 py-8">
  <div class="bg-white rounded-2xl shadow border border-slate-100 p-5 sm:p-7">
    <div class="mb-6">
      <h1 class="text-2xl font-bold text-slate-900">{{ __('public.confirm_title') }}</h1>
      <p class="text-sm text-slate-500 mt-1">{{ __('public.confirm_subtitle') }}</p>
    </div>

    <div class="rounded-xl border border-slate-200 overflow-hidden">
      <div class="grid grid-cols-1 sm:grid-cols-2">
        <div class="px-4 py-3 border-b sm:border-b-0 sm:border-r border-slate-100 bg-slate-50 text-sm font-medium text-slate-600">{{ __('public.tour') }}</div>
        <div class="px-4 py-3 border-b border-slate-100 text-slate-900">{{ $booking->tour->title }}</div>

        <div class="px-4 py-3 border-b sm:border-b-0 sm:border-r border-slate-100 bg-slate-50 text-sm font-medium text-slate-600">{{ __('public.booking_name') }}</div>
        <div class="px-4 py-3 border-b border-slate-100 text-slate-900">{{ $booking->name }}</div>

        <div class="px-4 py-3 border-b sm:border-b-0 sm:border-r border-slate-100 bg-slate-50 text-sm font-medium text-slate-600">{{ __('public.booking_date') }}</div>
        <div class="px-4 py-3 border-b border-slate-100 text-slate-900">{{ $booking->date->format('Y-m-d') }}</div>

        <div class="px-4 py-3 border-b sm:border-b-0 sm:border-r border-slate-100 bg-slate-50 text-sm font-medium text-slate-600">{{ __('public.booking_people') }}</div>
        <div class="px-4 py-3 border-b border-slate-100 text-slate-900">{{ $booking->people }}</div>

        <div class="px-4 py-3 border-b sm:border-b-0 sm:border-r border-slate-100 bg-slate-50 text-sm font-medium text-slate-600">{{ __('public.booking_has_children') }}</div>
        <div class="px-4 py-3 border-b border-slate-100 text-slate-900">{{ $booking->has_children ? $booking->children_count : __('public.no') }}</div>

        <div class="px-4 py-3 sm:border-r border-slate-100 bg-slate-50 text-sm font-medium text-slate-600">{{ __('public.booking_notes') }}</div>
        <div class="px-4 py-3 text-slate-900">{{ $booking->notes ?? '-' }}</div>
      </div>
    </div>

    <div class="mt-6 flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
      <a href="{{ route('booking.sendwa', $booking->id) }}" class="inline-flex items-center justify-center bg-green-600 text-white px-5 py-2.5 rounded-xl font-semibold hover:bg-green-700 transition">
        {{ __('public.confirm_send_whatsapp') }}
      </a>
      <a href="{{ route('tour.booking', $booking->tour) }}" class="inline-flex items-center justify-center bg-slate-200 text-slate-800 px-5 py-2.5 rounded-xl font-semibold hover:bg-slate-300 transition">
        {{ __('public.confirm_edit') }}
      </a>
    </div>
  </div>
</div>
@endsection
