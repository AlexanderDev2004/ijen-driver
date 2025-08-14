@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-semibold mb-6">Trip Results</h1>

@if($trips->count() === 0)
    <p>No trips have been published yet.</p>
@else
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @foreach($trips as $t)
            <a href="{{ route('trips.show', $t) }}" class="block bg-white rounded shadow hover:shadow-md overflow-hidden">
                @if($t->cover)
                    <img src="{{ asset('storage/'.$t->cover) }}" alt="{{ $t->title }}" class="w-full h-48 object-cover">
                @endif
                <div class="p-4">
                    <div class="text-sm text-gray-500">{{ $t->date->format('d M Y') }}</div>
                    <div class="font-semibold">{{ $t->title }}</div>
                    <div class="text-sm text-gray-600">Participants: {{ $t->participants }} • Kids: {{ $t->has_kids ? 'Yes' : 'No' }}</div>
                </div>
            </a>
        @endforeach
    </div>

    <div class="mt-6">
        {{ $trips->links() }}
    </div>
@endif
@endsection
