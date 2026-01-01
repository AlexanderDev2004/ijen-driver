@extends('admin.layouts.app')

@section('title', 'Daftar Tour')

@section('content')
  <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
      <div>
          <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Konten</p>
          <h1 class="text-2xl font-bold text-slate-900">Daftar Tour</h1>
      </div>
      <a href="{{ route('admin.tours.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700 transition">
          <span class="text-lg">＋</span> Tambah Tour
      </a>
  </div>

  @if(session('success'))
      <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
          {{ session('success') }}
      </div>
  @endif

  @if($errors->any())
      <div class="bg-red-100 text-red-800 px-4 py-2 rounded mb-4">
          {{ implode(', ', $errors->all()) }}
      </div>
  @endif

  <div class="overflow-x-auto bg-white shadow-lg rounded-2xl border border-slate-100">
      <table class="min-w-full">
          <thead>
              <tr class="bg-slate-50 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                  <th class="px-5 py-3">Judul</th>
                  <th class="px-5 py-3">Lokasi</th>
                  <th class="px-5 py-3">Harga</th>
                  <th class="px-5 py-3">Status</th>
                  <th class="px-5 py-3 text-center">Aksi</th>
              </tr>
          </thead>
          <tbody class="divide-y divide-slate-100">
              @forelse($tours as $tour)
                  <tr class="hover:bg-slate-50/70">
                      <td class="px-5 py-3">
                          <div class="font-semibold text-slate-900">{{ $tour->title }}</div>
                          <div class="text-xs text-slate-500">Slug: {{ $tour->slug }}</div>
                      </td>
                      <td class="px-5 py-3 text-slate-700">{{ $tour->location ?? '—' }}</td>
                      <td class="px-5 py-3 font-semibold text-indigo-700">Rp {{ number_format($tour->price, 0, ',', '.') }}</td>
                      <td class="px-5 py-3">
                          @if($tour->is_active)
                              <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-100 text-emerald-700 text-sm font-semibold">
                                  <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Aktif
                              </span>
                          @else
                              <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-rose-100 text-rose-700 text-sm font-semibold">
                                  <span class="w-2 h-2 rounded-full bg-rose-500"></span> Nonaktif
                              </span>
                          @endif
                      </td>
                      <td class="px-5 py-3 text-center">
                          <div class="inline-flex items-center gap-2">
                              <a href="{{ route('admin.tours.edit', $tour->id) }}" class="px-3 py-1.5 rounded-lg bg-indigo-50 text-indigo-700 hover:bg-indigo-100 text-sm font-semibold">Edit</a>
                              <form action="{{ route('admin.tours.destroy', $tour->id) }}" method="POST" class="inline">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" onclick="return confirm('Yakin hapus?')" class="px-3 py-1.5 rounded-lg bg-rose-50 text-rose-700 hover:bg-rose-100 text-sm font-semibold">Hapus</button>
                              </form>
                          </div>
                      </td>
                  </tr>
              @empty
                  <tr>
                      <td colspan="5" class="text-center py-10 text-slate-500">Belum ada tour.</td>
                  </tr>
              @endforelse
          </tbody>
      </table>
  </div>
@endsection
