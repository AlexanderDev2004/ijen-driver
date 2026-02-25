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
<div class="text-center py-12 sm:py-14 md:py-16 bg-gradient-to-r from-indigo-600 to-teal-500 text-white px-4">
  <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold mb-3 sm:mb-4">Petualangan Dimulai di Sini 🌋</h1>
  <p class="text-base sm:text-lg mb-6 sm:mb-8 text-white/90">Temukan pengalaman mendaki dan berwisata terbaik bersama Ijen Driver</p>
  <div class="flex flex-col sm:flex-row items-center justify-center gap-3 sm:gap-4">
    <a href="#tours" class="w-full sm:w-auto bg-white text-indigo-700 px-6 sm:px-8 py-3 rounded-xl font-semibold hover:bg-gray-100 transition touch-manipulation">Lihat Paket Tour</a>
    <a href="#why-us" class="w-full sm:w-auto px-6 sm:px-8 py-3 rounded-xl font-semibold border-2 border-white/40 hover:bg-white/10 transition touch-manipulation">Kenapa Ijen Driver?</a>
  </div>
</div>

<section class="container mx-auto px-4 sm:px-6 py-8 sm:py-10">
  <div class="grid gap-4 sm:gap-6 lg:grid-cols-3">
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 sm:p-6 hover:shadow-md transition">
      <div class="text-2xl sm:text-3xl mb-3">⭐</div>
      <h3 class="text-base sm:text-lg font-semibold text-slate-900">Sambutan Hangat</h3>
      <p class="text-sm text-slate-600 mt-2">Selamat datang di Ijen Driver! Kami siap menemani perjalananmu dengan pelayanan ramah, aman, dan profesional.</p>
    </div>
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 sm:p-6 hover:shadow-md transition">
      <div class="text-2xl sm:text-3xl mb-3">🧭</div>
      <h3 class="text-base sm:text-lg font-semibold text-slate-900">Rute Terbaik</h3>
      <p class="text-sm text-slate-600 mt-2">Pilih paket yang sesuai kebutuhan, mulai dari sunrise Ijen, city tour Banyuwangi, sampai trip custom.</p>
    </div>
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 sm:p-6 hover:shadow-md transition">
      <div class="text-2xl sm:text-3xl mb-3">💬</div>
      <h3 class="text-base sm:text-lg font-semibold text-slate-900">Respons Cepat</h3>
      <p class="text-sm text-slate-600 mt-2">Tim kami siap menjawab pertanyaan dan membantu booking dengan proses yang jelas dan cepat.</p>
    </div>
  </div>
</section>

<section id="why-us" class="bg-white border-y">
  <div class="container mx-auto px-4 sm:px-6 py-10 sm:py-12">
    <div class="text-center max-w-2xl mx-auto mb-8 sm:mb-10">
      <h2 class="text-2xl sm:text-3xl font-bold text-slate-900">Kenapa pilih Ijen Driver?</h2>
      <p class="text-slate-600 mt-3 text-sm sm:text-base">Kami fokus pada kenyamanan dan pengalaman terbaik agar perjalananmu lebih berkesan.</p>
    </div>
    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
      <div class="rounded-xl bg-slate-50 p-4 sm:p-5">
        <div class="text-base sm:text-lg font-semibold text-slate-900">Driver Lokal</div>
        <div class="text-sm text-slate-600 mt-1">Paham rute dan spot terbaik.</div>
      </div>
      <div class="rounded-xl bg-slate-50 p-4 sm:p-5">
        <div class="text-base sm:text-lg font-semibold text-slate-900">Harga Transparan</div>
        <div class="text-sm text-slate-600 mt-1">Tanpa biaya tersembunyi.</div>
      </div>
      <div class="rounded-xl bg-slate-50 p-4 sm:p-5">
        <div class="text-base sm:text-lg font-semibold text-slate-900">Jadwal Fleksibel</div>
        <div class="text-sm text-slate-600 mt-1">Bisa menyesuaikan itinerary.</div>
      </div>
      <div class="rounded-xl bg-slate-50 p-4 sm:p-5">
        <div class="text-base sm:text-lg font-semibold text-slate-900">Dukungan 24/7</div>
        <div class="text-sm text-slate-600 mt-1">Siap membantu kapan saja.</div>
      </div>
    </div>
  </div>
</section>

<div id="tours" class="container mx-auto px-4 sm:px-6 py-10 sm:py-14">
  <h2 class="text-xl sm:text-2xl md:text-3xl font-bold text-center text-slate-900 mb-6 sm:mb-10">Paket Tour Populer</h2>

  @if($tours->count() > 0)
    <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
      @foreach($tours as $tour)
        <div class="bg-white rounded-xl shadow-sm border border-slate-100 hover:shadow-lg transition overflow-hidden group">
          @if($tour->image)
            <img src="{{ asset('storage/'.$tour->image) }}" alt="{{ $tour->name }}" class="h-44 sm:h-48 w-full object-cover group-hover:scale-105 transition duration-300">
          @endif
          <div class="p-4 sm:p-5 flex flex-col justify-between h-full">
            <div>
              <h3 class="text-base sm:text-lg font-semibold text-slate-900 mb-2 line-clamp-1">{{ $tour->name }}</h3>
              <p class="text-sm text-slate-600 mb-3 line-clamp-2">{{ \Str::limit($tour->description, 80) }}</p>
            </div>
            <div class="flex items-center justify-between mt-auto pt-2">
              <span class="text-indigo-600 font-bold">Rp {{ number_format($tour->price, 0, ',', '.') }}</span>
              <a href="{{ route('tour.show', $tour) }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 text-sm font-medium transition touch-manipulation">Detail</a>
            </div>
          </div>
        </div>
      @endforeach
    </div>

    <div class="mt-8">{{ $tours->links('pagination::tailwind') }}</div>
  @else
    <div class="text-center py-10">
      <div class="text-4xl mb-3">🏝️</div>
      <p class="text-slate-600">Belum ada paket tour tersedia.</p>
    </div>
  @endif
</div>

<section class="container mx-auto px-4 sm:px-6 pb-10 sm:pb-14">
  <div class="bg-gradient-to-r from-indigo-600 to-teal-500 rounded-2xl p-6 sm:p-8 text-white flex flex-col md:flex-row items-start md:items-center justify-between gap-4 sm:gap-6">
    <div>
      <h3 class="text-xl sm:text-2xl font-bold">Siap mulai perjalanan?</h3>
      <p class="text-white/90 mt-2 text-sm sm:text-base">Hubungi kami untuk rekomendasi paket terbaik sesuai kebutuhanmu.</p>
    </div>
    <a href="{{ url('/#tours') }}" class="w-full sm:w-auto text-center bg-white text-indigo-700 px-6 py-3 rounded-xl font-semibold hover:bg-gray-100 transition touch-manipulation">Lihat Paket</a>
  </div>
</section>
@endsection
