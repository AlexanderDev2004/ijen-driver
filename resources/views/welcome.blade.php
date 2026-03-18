@extends('layouts.app')

@section('title', 'Ijen Driver - Jelajahi Alam Bersama Kami')
@section('meta_description', 'Paket tour Kawah Ijen, Banyuwangi, dan sekitarnya dengan driver lokal berpengalaman. Booking mudah, aman, dan terpercaya.')
@section('meta_keywords', 'tour ijen, kawah ijen, tour banyuwangi, driver banyuwangi, open trip ijen')

@push('structured_data')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "TouristTrip",
  "name": "Ijen Driver Tours",
  "description": "Paket tour Kawah Ijen, Banyuwangi, dan sekitarnya dengan driver lokal berpengalaman.",
  "image": "{{ isset($tours) && $tours->first() ? asset('storage/' . $tours->first()->image) : url('/images/og-default.jpg') }}",
  "provider": {
    "@type": "Organization",
    "name": "Ijen Driver",
    "url": "{{ url('/') }}"
  },
  "areaServed": "Banyuwangi, Indonesia",
  "offers": {
    "@type": "AggregateOffer",
    "priceCurrency": "IDR",
    "lowPrice": "{{ isset($tours) && $tours->min('price') ? number_format($tours->min('price'), 0, '', '') : '0' }}",
    "offerCount": "{{ isset($tours) ? $tours->count() : 0 }}"
  }
}
</script>
@endpush

@section('content')
<div class="space-y-8 sm:space-y-10">
    <section class="page-hero content-reveal">
        <div class="relative z-10 max-w-3xl">
            <span class="hero-kicker">{{ __('public.hero_kicker') }}</span>
            <h1 class="text-3xl font-bold leading-tight text-white sm:text-4xl md:text-5xl">{{ __('public.hero_title') }}</h1>
            <p class="mt-3 text-sm text-white/90 sm:text-base">{{ __('public.hero_subtitle') }}</p>
            <div class="mt-6 flex flex-col gap-3 sm:flex-row">
                <a href="#tours" class="btn-secondary w-full border-white/70 bg-white text-teal-800 hover:bg-white sm:w-auto">{{ __('public.cta_view_tours') }}</a>
                <a href="#why-us" class="inline-flex w-full items-center justify-center rounded-xl border border-white/45 bg-white/10 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-white/20 sm:w-auto">{{ __('public.cta_why_us') }}</a>
            </div>
        </div>
    </section>

    <section id="why-us" class="surface-card p-6 sm:p-8">
        <h2 class="section-title">{{ __('public.why_us_title') }}</h2>
        <p class="section-subtitle">{{ __('public.why_us_subtitle') }}</p>

        <div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <div class="soft-panel p-4">
                <h3 class="text-base font-semibold text-slate-900">{{ __('public.why_local_title') }}</h3>
                <p class="mt-1 text-sm text-slate-600">{{ __('public.why_local_desc') }}</p>
            </div>
            <div class="soft-panel p-4">
                <h3 class="text-base font-semibold text-slate-900">{{ __('public.why_price_title') }}</h3>
                <p class="mt-1 text-sm text-slate-600">{{ __('public.why_price_desc') }}</p>
            </div>
            <div class="soft-panel p-4">
                <h3 class="text-base font-semibold text-slate-900">{{ __('public.why_schedule_title') }}</h3>
                <p class="mt-1 text-sm text-slate-600">{{ __('public.why_schedule_desc') }}</p>
            </div>
            <div class="soft-panel p-4">
                <h3 class="text-base font-semibold text-slate-900">{{ __('public.why_support_title') }}</h3>
                <p class="mt-1 text-sm text-slate-600">{{ __('public.why_support_desc') }}</p>
            </div>
        </div>
    </section>

    <section id="tours" class="space-y-5">
        <h2 class="section-title">{{ __('public.tour_packages_title') }}</h2>

        @if(isset($tours) && $tours->count() > 0)
            <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($tours as $tour)
                    <article class="group flex h-full flex-col overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-xl">
                        @if($tour->image)
                            <img src="{{ asset('storage/' . $tour->image) }}" alt="{{ $tour->title }}" class="h-48 w-full object-cover transition duration-300 group-hover:scale-[1.03]">
                        @endif

                        <div class="flex flex-1 flex-col p-5">
                            <h3 class="line-clamp-1 text-lg font-semibold text-slate-900">{{ $tour->title }}</h3>
                            <p class="mt-2 line-clamp-2 text-sm text-slate-600">{{ \Str::limit($tour->description, 100) }}</p>
                            <div class="mt-4 flex items-center justify-between">
                                <span class="text-lg font-bold text-teal-700">Rp {{ number_format($tour->price, 0, ',', '.') }}</span>
                                <a href="{{ route('tour.show', $tour) }}" class="btn-primary">{{ __('public.read_more') }}</a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <div>
                {{ $tours->links('pagination::tailwind') }}
            </div>
        @else
            <div class="empty-state">
                <p class="text-sm text-slate-500">{{ __('public.no_tours') }}</p>
            </div>
        @endif
    </section>
</div>
@endsection
