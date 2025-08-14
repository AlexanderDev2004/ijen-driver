@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-semibold mb-6">Review Your Booking</h1>

<div class="bg-white p-6 rounded shadow space-y-4">
    <dl class="grid grid-cols-1 md:grid-cols-2 gap-3">
        <div><dt class="font-medium">Tour Name</dt><dd>{{ $data['tour_name'] }}</dd></div>
        <div><dt class="font-medium">Name</dt><dd>{{ $data['nama'] }}</dd></div>
        <div><dt class="font-medium">Email</dt><dd>{{ $data['email'] }}</dd></div>
        <div><dt class="font-medium">Phone</dt><dd>{{ $data['telpon'] }}</dd></div>
        <div><dt class="font-medium">Number of People</dt><dd>{{ $data['jumlah'] }}</dd></div>
        <div><dt class="font-medium">Date</dt><dd>{{ $data['tanggal'] }}</dd></div>
        <div><dt class="font-medium">Bringing Children</dt><dd>{{ $data['bawa_anak'] ? 'Yes' : 'No' }}</dd></div>
        {{-- @if(!empty($data['catatan']))
            <div class="md:col-span-2"><dt class="font-medium">Notes</dt><dd>{{ $data['catatan'] }}</dd></div>
        @endif --}}
    </dl>

    <div class="flex gap-3">
        <a href="{{ route('booking.form') }}"
             class="px-4 py-2 rounded border">Edit</a>

        <form method="POST" action="{{ route('booking.send') }}">
            @csrf
            <button class="px-5 py-2 rounded bg-emerald-600 text-white hover:bg-emerald-700">
                Send to WhatsApp
            </button>
        </form>
    </div>
</div>
@endsection
