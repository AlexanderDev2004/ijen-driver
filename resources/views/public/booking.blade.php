@extends('layouts.app')
@section('content')
<div class="container p-4 max-w-lg mx-auto">
  <h1 class="text-xl font-bold">Booking: {{ $tour->title }}</h1>
  <form id="bookingForm" action="{{ route('tour.booking.submit', $tour) }}" method="POST">
    @csrf
    <label class="block mt-3">
      Nama <span class="text-red-600">*</span>
      <input type="text" name="name" value="{{ old('name') }}" class="w-full border p-2 rounded @error('name') border-red-500 @enderror" required>
      @error('name')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
    </label>
    <label class="block mt-3">
      Phone
      <input type="tel" name="phone" value="{{ old('phone') }}" class="w-full border p-2 rounded @error('phone') border-red-500 @enderror" placeholder="08xxxxxxxxxx">
      @error('phone')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
    </label>
    <label class="block mt-3">
      Tanggal <span class="text-red-600">*</span>
      <input type="date" name="date" value="{{ old('date') }}" class="w-full border p-2 rounded @error('date') border-red-500 @enderror" required>
      @error('date')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
    </label>
    <label class="block mt-3">
      Orang <span class="text-red-600">*</span>
      <input type="number" min="1" max="100" name="people" value="{{ old('people',1) }}" class="w-full border p-2 rounded @error('people') border-red-500 @enderror" required>
      @error('people')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
    </label>
    <label class="block mt-3">
      <input type="checkbox" id="hasChildrenToggle" name="has_children" {{ old('has_children') ? 'checked' : '' }}> Ada Anak?
    </label>
    <label id="childrenCountLabel" class="block mt-3" style="display: {{ old('has_children') ? 'block' : 'none' }}">
      Jumlah Anak
      <input type="number" min="1" max="100" name="children_count" value="{{ old('children_count',0) }}" class="w-full border p-2 rounded @error('children_count') border-red-500 @enderror">
      @error('children_count')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
    </label>
    <label class="block mt-3">
      Catatan
      <textarea name="notes" maxlength="1000" class="w-full border p-2 rounded @error('notes') border-red-500 @enderror" rows="3">{{ old('notes') }}</textarea>
      <small class="text-gray-500">Max 1000 karakter</small>
      @error('notes')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
    </label>
    <div class="mt-4">
      <button class="bg-blue-600 text-white px-4 py-2 rounded">Submit</button>
    </div>
  </form>

  <script type="module">
    import { validateBookingForm, displayErrors, clearErrors } from '/resources/js/validation.js';

    const form = document.getElementById('bookingForm');
    const childrenToggle = document.getElementById('hasChildrenToggle');
    const childrenLabel = document.getElementById('childrenCountLabel');

    // Toggle children count field
    childrenToggle.addEventListener('change', (e) => {
      childrenLabel.style.display = e.target.checked ? 'block' : 'none';
    });

    // Form submission
    form.addEventListener('submit', (e) => {
      const { isValid, errors } = validateBookingForm(form);
      if (!isValid) {
        e.preventDefault();
        displayErrors(errors, '#bookingForm');
      }
    });

    // Clear errors on input
    form.querySelectorAll('input, textarea').forEach((input) => {
      input.addEventListener('input', () => clearErrors('#bookingForm'));
    });
  </script>
</div>
@endsection
