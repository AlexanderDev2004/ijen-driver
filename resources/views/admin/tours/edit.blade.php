@extends('admin.layouts.app')

@section('title', 'Edit Tour')

@section('content')
<div class="space-y-5">
    <div>
        <p class="text-xs font-semibold uppercase tracking-[0.16em] text-slate-400">Edit Tour</p>
        <h2 class="text-2xl font-semibold text-slate-900">Edit Tour: {{ $tour->title }}</h2>
        <p class="mt-1 text-sm text-slate-500">Perbarui detail tour agar informasi publik selalu akurat.</p>
    </div>

    @if($errors->any())
        <div class="rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-800">
            <div class="font-semibold">Terjadi kesalahan input:</div>
            <ul class="mt-2 list-disc space-y-1 pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <section class="surface-card p-5 sm:p-7">
        <form action="{{ route('admin.tours.update', $tour->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')
            @include('admin.tours._form', ['buttonText' => 'Perbarui Tour', 'tour' => $tour])
        </form>
    </section>
</div>
@endsection
