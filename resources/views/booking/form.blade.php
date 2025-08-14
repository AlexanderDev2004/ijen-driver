@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-semibold mb-6">Tour Booking Form</h1>

    <form method="POST" action="{{ route('booking.preview') }}" class="space-y-5 bg-white p-6 rounded shadow">
        @csrf

        @php $d = $draft ?? []; @endphp

        <div>
            <label class="block mb-1">Tour Name</label>
            <input name="tour_name" class="w-full border rounded p-2 bg-gray-100 text-gray-500 cursor-not-allowed"
                value="{{ $tour_name ?? '' }}" readonly>
        </div>

        <div>
            <label class="block mb-1">Full Name</label>
            <input name="nama" class="w-full border rounded p-2" value="{{ old('nama', $d['nama'] ?? '') }}" required>
            @error('nama')
                <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block mb-1">Email</label>
                <input type="email" name="email" class="w-full border rounded p-2"
                    value="{{ old('email', $d['email'] ?? '') }}" required>
                @error('email')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block mb-1">Phone/WhatsApp</label>
                <input name="telpon" class="w-full border rounded p-2" value="{{ old('telpon', $d['telpon'] ?? '') }}"
                    required>
                @error('telpon')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block mb-1">Number of People</label>
                <input type="number" min="1" max="30" name="jumlah" class="w-full border rounded p-2"
                    value="{{ old('jumlah', $d['jumlah'] ?? 1) }}" required>
                @error('jumlah')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block mb-1">Date</label>
                <input type="date" name="tanggal" class="w-full border rounded p-2"
                    value="{{ old('tanggal', $d['tanggal'] ?? '') }}" required>
                @error('tanggal')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex items-center mt-6">
                <input id="bawa_anak" type="checkbox" name="bawa_anak" value="1" class="mr-2"
                    {{ old('bawa_anak', $d['bawa_anak'] ?? false) ? 'checked' : '' }}>
                <label for="bawa_anak">Bringing Children</label>
            </div>
        </div>

        {{-- <div>
            <label class="block mb-1">Notes (optional)</label>
            <textarea name="catatan" class="w-full border rounded p-2" rows="3">{{ old('catatan', $d['catatan'] ?? '') }}</textarea>
        </div> --}}

        <div class="flex items-center justify-between">
            <p class="text-sm text-gray-600">After “Review”, you can still edit before sending to WhatsApp.</p>
            <button class="px-5 py-2 rounded bg-gray-900 text-white hover:bg-black">Review</button>
        </div>
    </form>
@endsection
