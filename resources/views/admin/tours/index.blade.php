@extends('admin.layouts.app')

@section('title', 'Daftar Tour')

@section('content')
  <div class="flex justify-between items-center mb-6">
      <h1 class="text-2xl font-bold">Daftar Tour</h1>
      <a href="{{ route('admin.tours.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
          + Tambah Tour
      </a>
  </div>

  <div class="overflow-x-auto bg-white shadow rounded-lg">
      <table class="min-w-full border border-gray-200">
          <thead class="bg-gray-100">
              <tr>
                  <th class="px-4 py-2 border-b text-left">Judul</th>
                  <th class="px-4 py-2 border-b text-left">Lokasi</th>
                  <th class="px-4 py-2 border-b text-left">Harga</th>
                  <th class="px-4 py-2 border-b text-left">Status</th>
                  <th class="px-4 py-2 border-b text-center">Aksi</th>
              </tr>
          </thead>
          <tbody>
              @forelse($tours as $tour)
                  <tr class="hover:bg-gray-50">
                      <td class="px-4 py-2 border-b">{{ $tour->title }}</td>
                      <td class="px-4 py-2 border-b">{{ $tour->location ?? '-' }}</td>
                      <td class="px-4 py-2 border-b">Rp {{ number_format($tour->price, 0, ',', '.') }}</td>
                      <td class="px-4 py-2 border-b">
                          @if($tour->is_active)
                              <span class="text-green-600 font-medium">Aktif</span>
                          @else
                              <span class="text-red-600 font-medium">Nonaktif</span>
                          @endif
                      </td>
                      <td class="px-4 py-2 border-b text-center space-x-2">
                          <a href="{{ route('admin.tours.edit', $tour->id) }}" class="text-indigo-600 hover:underline">Edit</a>
                          <form action="{{ route('admin.tours.destroy', $tour->id) }}" method="POST" class="inline">
                              @csrf
                              @method('DELETE')
                              <button type="submit" onclick="return confirm('Yakin hapus?')" class="text-red-600 hover:underline">Hapus</button>
                          </form>
                      </td>
                  </tr>
              @empty
                  <tr>
                      <td colspan="5" class="text-center py-6 text-gray-500">Belum ada tour.</td>
                  </tr>
              @endforelse
          </tbody>
      </table>
  </div>
@endsection
