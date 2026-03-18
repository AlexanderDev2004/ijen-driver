@extends('admin.layouts.app')

@section('title', 'Daftar Tour')

@section('content')
<div class="space-y-5">
    <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-xs font-semibold uppercase tracking-[0.16em] text-slate-400">Konten Tour</p>
            <h2 class="text-2xl font-semibold text-slate-900">Daftar Tour</h2>
            <p class="mt-1 text-sm text-slate-500">Kelola paket tour yang tampil di halaman publik.</p>
        </div>

        <a href="{{ route('admin.tours.create') }}" class="btn-primary w-full justify-center sm:w-auto">Tambah Tour</a>
    </div>

    <div class="table-shell">
        <table class="min-w-full">
            <thead>
                <tr class="table-head">
                    <th class="px-4 py-3">Judul Tour</th>
                    <th class="px-4 py-3 hidden md:table-cell">Lokasi</th>
                    <th class="px-4 py-3 hidden lg:table-cell">Harga</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Harga</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-slate-200">
                @forelse($tours as $tour)
                    <tr class="table-row">
                        <td class="px-4 py-3">
                            <div class="font-semibold text-slate-900">{{ $tour->title }}</div>
                            <div class="text-xs text-slate-500">Slug: {{ $tour->slug }}</div>
                        </td>

                        <td class="px-4 py-3 text-sm text-slate-700 hidden md:table-cell">{{ $tour->location ?? '-' }}</td>

                        <td class="px-4 py-3 text-sm font-semibold text-teal-700 hidden lg:table-cell">Rp {{ number_format($tour->price, 0, ',', '.') }}</td>

                        <td class="px-4 py-3">
                            @if($tour->is_active)
                                <span class="badge-chip badge-positive">Aktif</span>
                            @else
                                <span class="badge-chip bg-rose-100 text-rose-700">Nonaktif</span>
                            @endif
                        </td>

                        <td class="px-4 py-3">
                            @if($tour->show_price)
                                <span class="badge-chip bg-cyan-100 text-cyan-700">Ditampilkan</span>
                            @else
                                <span class="badge-chip badge-muted">Disembunyikan</span>
                            @endif
                        </td>

                        <td class="px-4 py-3">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.tours.edit', $tour->id) }}" class="btn-secondary px-3 py-1.5 text-xs">Edit</a>
                                <form action="{{ route('admin.tours.destroy', $tour->id) }}" method="POST" onsubmit="return confirm('Yakin hapus tour ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center justify-center rounded-lg bg-rose-100 px-3 py-1.5 text-xs font-semibold text-rose-700 transition hover:bg-rose-200">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-10 text-center text-sm text-slate-500">Belum ada tour. Tambahkan tour pertama untuk mulai menampilkan paket.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
