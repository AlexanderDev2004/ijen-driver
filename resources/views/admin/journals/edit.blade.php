@extends('admin.layouts.app')

@section('title', 'Edit Journal')

@section('content')
<div class="space-y-5">
    <a href="{{ route('admin.journals.index') }}" class="btn-ghost -ml-1">
        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
        Kembali ke Journal
    </a>

    <div>
        <p class="text-xs font-semibold uppercase tracking-[0.16em] text-slate-400">Edit Journal</p>
        <h2 class="text-2xl font-semibold text-slate-900">Edit Journal: {{ $journal->title }}</h2>
        <p class="mt-1 text-sm text-slate-500">Perbarui konten agar dokumentasi perjalanan tetap relevan.</p>
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
        <form action="{{ route('admin.journals.update', $journal) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')
            @include('admin.journals._form', ['submitLabel' => 'Perbarui Journal', 'journal' => $journal])
        </form>
    </section>
</div>
@endsection
