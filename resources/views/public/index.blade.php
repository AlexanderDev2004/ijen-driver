@extends('layouts.app')
@section('content')
<div class="container mx-auto p-4">
  <h1 class="text-2xl font-bold mb-4">Paket Tour</h1>
  <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    @foreach($tours as $tour)
    <div class="border rounded p-4">
      @if($tour->image)
        <img src="{{ asset('storage/'.$tour->image) }}" alt="" class="h-40 w-full object-cover mb-2">
      @endif
      <h2 class="font-semibold">{{ $tour->title }}</h2>
      <p class="text-sm">{{ \Str::limit($tour->description, 120) }}</p>
      <div class="mt-2 flex justify-between items-center">
        <span class="text-lg">Rp {{ number_format($tour->price,0,',','.') }}</span>
        <a href="{{ route('tour.show', $tour) }}" class="px-3 py-1 bg-blue-600 text-white rounded">Detail</a>
      </div>
    </div>
    @endforeach
  </div>
  <div class="mt-4">{{ $tours->links() }}</div>
</div>
@endsection
