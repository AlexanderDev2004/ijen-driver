@extends('layouts.app')
@section('content')
<div class="container p-4 max-w-lg mx-auto">
  <h2 class="text-xl font-bold">Konfirmasi Booking</h2>
  <div class="mt-4 border rounded p-4">
    <p><strong>Tour:</strong> {{ $booking->tour->title }}</p>
    <p><strong>Nama:</strong> {{ $booking->name }}</p>
    <p><strong>Tanggal:</strong> {{ $booking->date->format('Y-m-d') }}</p>
    <p><strong>Orang:</strong> {{ $booking->people }}</p>
    <p><strong>Ada Anak:</strong> {{ $booking->has_children ? $booking->children_count : 'Tidak' }}</p>
    <p><strong>Catatan:</strong> {{ $booking->notes ?? '-' }}</p>
  </div>

  <div class="mt-4 flex gap-2">
    <a href="{{ route('booking.sendwa', $booking->id) }}" class="bg-green-600 text-white px-4 py-2 rounded">Kirim ke WhatsApp (Final)</a>
    <a href="{{ route('tour.booking', $booking->tour) }}" class="bg-gray-300 px-4 py-2 rounded">Ubah</a>
  </div>
</div>
@endsection
