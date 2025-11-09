@extends('layouts.app')

@section('title', 'Logout | Ijen Driver')

@section('content')
<div class="max-w-lg mx-auto bg-white rounded-xl shadow p-8 text-center">
  <h1 class="text-2xl font-semibold mb-3 text-gray-800">Logout Admin</h1>
  <p class="text-gray-600 mb-6">
    Apakah kamu yakin ingin keluar dari sesi admin sekarang?
  </p>

  <div class="flex justify-center gap-4">
    <form action="{{ route('admin.logout') }}" method="POST">
      @csrf
      <button type="submit"
        class="bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-2 rounded-lg transition">
        Ya, Logout
      </button>
    </form>

    <a href="{{ route('admin.dashboard') }}"
      class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold px-6 py-2 rounded-lg transition">
      Batal
    </a>
  </div>
</div>
@endsection
