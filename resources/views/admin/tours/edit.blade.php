@extends('admin.layouts.app')

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="mb-6">
        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Edit</p>
        <h2 class="text-2xl font-bold text-slate-900">Edit Tour: {{ $tour->title }}</h2>
        <p class="text-sm text-slate-500">Perbarui informasi tour.</p>
    </div>

    @if($errors->any())
        <div class="mb-4 p-4 rounded-xl border border-rose-200 bg-rose-50 text-rose-700">
            <div class="font-semibold mb-1">Terjadi kesalahan:</div>
            <ul class="list-disc list-inside space-y-1 text-sm">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white shadow-xl rounded-2xl border border-slate-100 p-6">
        <form action="{{ route('admin.tours.update', $tour->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            @include('admin.tours._form', ['buttonText' => 'Perbarui', 'tour' => $tour])
        </form>
    </div>
</div>
@endsection
