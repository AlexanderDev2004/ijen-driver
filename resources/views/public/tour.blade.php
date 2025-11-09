@extends('layouts.app')
@section('content')
<div class="container p-4">
  <h1 class="text-2xl font-bold">{{ $tour->title }}</h1>
  <p class="mt-2">{{ $tour->description }}</p>
  <p class="mt-2">Lokasi: {{ $tour->location }}</p>
  <p class="mt-2">Harga: Rp {{ number_format($tour->price,0,',','.') }}</p>
  <a href="{{ route('tour.booking', $tour) }}" class="mt-4 inline-block bg-green-600 text-white px-4 py-2 rounded">Booking Sekarang</a>

  <h3 class="mt-6">Journal</h3>
  <ul>
    @foreach($tour->journals as $j)
      <li class="border p-2 my-2">
        <div class="text-sm text-gray-600">{{ $j->journal_date? $j->journal_date->format('Y-m-d') : '' }}</div>
        <div class="font-semibold">{{ $j->title }}</div>
        <div class="text-sm">{{ \Str::limit($j->content, 200) }}</div>
      </li>
    @endforeach
  </ul>
</div>
@endsection
