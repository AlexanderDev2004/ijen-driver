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
  "image": "{{ isset($tours) && $tours->first()? asset('storage/'.$tours->first()->image) : url('/images/og-default.jpg') }}",
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
<div class="text-center py-16 bg-gradient-to-r from-indigo-600 to-teal-500 text-white">
  <h1 class="text-5xl font-extrabold mb-3">Petualangan Dimulai di Sini 🌋</h1>
  <p class="text-lg mb-6">Temukan pengalaman mendaki dan berwisata terbaik bersama Ijen Driver</p>
  <a href="#tours" class="bg-white text-indigo-700 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">Lihat Paket Tour</a>
</div>

<div id="tours" class="container mx-auto px-6 py-14">
  <h2 class="text-3xl font-bold text-center text-gray-800 mb-10">Paket Tour Populer</h2>

  @if($tours->count() > 0)
    <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
      @foreach($tours as $tour)
        <div class="bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden">
          @if($tour->image)
            <img src="{{ asset('storage/'.$tour->image) }}" alt="{{ $tour->name }}" class="h-56 w-full object-cover">
          @endif
          <div class="p-5 flex flex-col justify-between h-full">
            <div>
              <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $tour->name }}</h3>
              <p class="text-sm text-gray-600 mb-3">{{ \Str::limit($tour->description, 100) }}</p>
            </div>
            <div class="flex items-center justify-between mt-auto">
              <span class="text-indigo-600 font-bold">Rp {{ number_format($tour->price, 0, ',', '.') }}</span>
              <a href="{{ route('tour.show', $tour) }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 text-sm">Detail</a>
            </div>
          </div>
        </div>
      @endforeach
    </div>

    <div class="mt-10">{{ $tours->links() }}</div>
  @else
    <p class="text-center text-gray-600">Belum ada paket tour tersedia.</p>
  @endif
</div>
@endsection
