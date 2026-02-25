@extends('admin.layouts.app')

@section('title', 'Daftar Tour')

@section('content')
  <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 sm:gap-4 mb-5 sm:mb-6">
      <div>
          <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Konten</p>
          <h1 class="text-xl sm:text-2xl font-bold text-slate-900">Daftar Tour</h1>
      </div>
      <a href="{{ route('admin.tours.create') }}" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700 transition touch-manipulation">
          <span class="text-lg">＋</span> <span class="hidden sm:inline">Tambah</span> Tour
      </a>
  </div>

  @if(session('success'))
      <div class="bg-green-100 text-green-800 px-4 py-3 rounded-lg mb-4 text-sm">
          {{ session('success') }}
      </div>
  @endif

  @if($errors->any())
      <div class="bg-red-100 text-red-800 px-4 py-3 rounded-lg mb-4 text-sm">
          {{ implode(', ', $errors->all()) }}
      </div>
  @endif

  <div class="bg-white shadow-sm rounded-xl border border-slate-100 overflow-hidden">
      <div class="overflow-x-auto">
          <table class="min-w-full">
              <thead>
                  <tr class="bg-slate-50 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                      <th class="px-4 py-3">Judul</th>
                      <th class="px-4 py-3 hidden sm:table-cell">Lokasi</th>
                      <th class="px-4 py-3 hidden md:table-cell">Harga</th>
                      <th class="px-4 py-3">Status</th>
                      <th class="px-4 py-3 text-center">Aksi</th>
                  </tr>
              </thead>
              <tbody class="divide-y divide-slate-100">
                  @forelse($tours as $tour)
                      <tr class="hover:bg-slate-50/70">
                          <td class="px-4 py-3">
                              <div class="font-semibold text-slate-900 text-sm">{{ $tour->title }}</div>
                              <div class="text-xs text-slate-500 hidden lg:block">Slug: {{ $tour->slug }}</div>
                          </td>
                          <td class="px-4 py-3 text-slate-700 text-sm hidden sm:table-cell">{{ $tour->location ?? '—' }}</td>
                          <td class="px-4 py-3 font-semibold text-indigo-700 text-sm hidden md:table-cell">Rp {{ number_format($tour->price, 0, ',', '.') }}</td>
                          <td class="px-4 py-3">
                              @if($tour->is_active)
                                  <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-emerald-100 text-emerald-700 text-xs font-semibold">
                                      <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Aktif
                                  </span>
                              @else
                                  <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-rose-100 text-rose-700 text-xs font-semibold">
                                      <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span> Nonaktif
                                  </span>
                              @endif
                          </td>
                          <td class="px-4 py-3">
                              <div class="flex items-center justify-center gap-1.5">
                                  <a href="{{ route('admin.tours.edit', $tour->id) }}" class="px-3 py-1.5 rounded-lg bg-indigo-50 text-indigo-700 hover:bg-indigo-100 text-xs font-semibold">Edit</a>
                                  <form action="{{ route('admin.tours.destroy', $tour->id) }}" method="POST" class="inline">
                                      @csrf
                                      @method('DELETE')
                                      <button type="submit" onclick="return confirm('Yakin hapus?')" class="px-3 py-1.5 rounded-lg bg-rose-50 text-rose-700 hover:bg-rose-100 text-xs font-semibold">Hapus</button>
                                  </form>
                              </div>
                          </td>
                      </tr>
                  @empty
                      <tr>
                          <td colspan="5" class="text-center py-8 text-slate-500">Belum ada tour.</td>
                      </tr>
                  @endforelse
              </tbody>
          </table>
      </div>
  </div>
@endsection
