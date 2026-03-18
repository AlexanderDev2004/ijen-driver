@extends('layouts.app')

@section('title', 'Logout | Ijen Driver')

@section('content')
<div class="mx-auto max-w-lg py-8">
    <section class="surface-card p-6 text-center sm:p-8">
        <h1 class="text-2xl font-semibold text-slate-900">Logout Admin</h1>
        <p class="mt-2 text-sm text-slate-600">Apakah kamu yakin ingin keluar dari sesi admin sekarang?</p>

        <div class="mt-6 flex flex-col gap-3 sm:flex-row sm:justify-center">
            <form action="{{ route('admin.logout') }}" method="POST" class="w-full sm:w-auto">
                @csrf
                <button type="submit" class="inline-flex w-full items-center justify-center rounded-xl bg-rose-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-rose-700">Ya, Logout</button>
            </form>

            <a href="{{ route('admin.dashboard') }}" class="btn-secondary w-full justify-center sm:w-auto">Batal</a>
        </div>
    </section>
</div>
@endsection
