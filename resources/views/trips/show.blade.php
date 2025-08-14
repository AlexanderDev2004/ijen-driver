@extends('layouts.app')

@section('content')
<article class="bg-white p-6 rounded shadow">
    <header class="mb-4">
        <h1 class="text-2xl font-semibold">{{ $trip->title }}</h1>
        <div class="text-sm text-gray-600">
            {{ $trip->date->format('d M Y') }} • Participants: {{ $trip->participants }} • Kids: {{ $trip->has_kids ? 'Yes' : 'No' }}
        </div>
    </header>

    @if($trip->photos && count($trip->photos))
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mb-4">
            @foreach($trip->photos as $p)
                <img src="{{ asset('storage/'.$p) }}" alt="Trip Photo" class="w-full h-56 object-cover rounded">
            @endforeach
        </div>
    @endif

    @if($trip->testimonial)
        <div class="p-4 bg-gray-50 rounded border">
            <div class="font-medium mb-1">Testimonial {{ $trip->customer_name ? '— '.$trip->customer_name : '' }}</div>
            <p>{{ $trip->testimonial }}</p>
        </div>
    @endif
</article>
@endsection
