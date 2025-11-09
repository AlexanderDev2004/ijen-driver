@extends('layouts.app')
@section('content')
<div class="container p-4 max-w-lg mx-auto">
  <h1 class="text-xl font-bold">Booking: {{ $tour->title }}</h1>
  <form action="{{ route('tour.booking.submit', $tour) }}" method="POST">
    @csrf
    <label class="block mt-3">Nama <input name="name" value="{{ old('name') }}" class="w-full border p-2"></label>
    <label class="block mt-3">Phone <input name="phone" value="{{ old('phone') }}" class="w-full border p-2"></label>
    <label class="block mt-3">Tanggal <input type="date" name="date" value="{{ old('date') }}" class="w-full border p-2"></label>
    <label class="block mt-3">Orang <input type="number" min="1" name="people" value="{{ old('people',1) }}" class="w-full border p-2"></label>
    <label class="block mt-3">
      <input type="checkbox" name="has_children" {{ old('has_children') ? 'checked' : '' }}> Ada Anak?
    </label>
    <label class="block mt-3">Jumlah Anak <input type="number" name="children_count" value="{{ old('children_count',0) }}" class="w-full border p-2"></label>
    <label class="block mt-3">Catatan <textarea name="notes" class="w-full border p-2">{{ old('notes') }}</textarea></label>
    <div class="mt-4">
      <button class="bg-blue-600 text-white px-4 py-2 rounded">Submit</button>
    </div>
  </form>
</div>
@endsection
