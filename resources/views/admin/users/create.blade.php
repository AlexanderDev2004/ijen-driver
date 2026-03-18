@extends('admin.layouts.app')

@section('title', 'Tambah User Admin')

@section('content')
<div class="space-y-5">
    <div>
        <p class="text-xs font-semibold uppercase tracking-[0.16em] text-slate-400">Tambah User</p>
        <h2 class="text-2xl font-semibold text-slate-900">Tambah User Admin Baru</h2>
        <p class="mt-1 text-sm text-slate-500">Isi data user dengan lengkap untuk memberi akses dashboard.</p>
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
        <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-6">
            @csrf
            @include('admin.users._form', ['submitLabel' => 'Simpan User'])
        </form>
    </section>
</div>
@endsection
