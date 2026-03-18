@extends('admin.layouts.app')

@section('title', 'Journal Perjalanan')

@section('content')
<div class="space-y-5">
    <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-xs font-semibold uppercase tracking-[0.16em] text-slate-400">Konten Journal</p>
            <h2 class="text-2xl font-semibold text-slate-900">Journal Perjalanan</h2>
            <p class="mt-1 text-sm text-slate-500">Kelola cerita perjalanan dari setiap tour.</p>
        </div>

        <a href="{{ route('admin.journals.create') }}" class="btn-primary w-full justify-center sm:w-auto">Tambah Journal</a>
    </div>

    <div class="table-shell">
        <table class="min-w-full">
            <thead>
                <tr class="table-head">
                    <th class="px-4 py-3">Tour</th>
                    <th class="px-4 py-3">Judul Journal</th>
                    <th class="px-4 py-3 hidden md:table-cell">Tanggal</th>
                    <th class="px-4 py-3 hidden lg:table-cell">Media</th>
                    <th class="px-4 py-3 hidden xl:table-cell">Preview</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-slate-200">
                @forelse($journals as $journal)
                    <tr class="table-row">
                        <td class="px-4 py-3 text-sm font-semibold text-slate-900">{{ $journal->tour->title }}</td>
                        <td class="px-4 py-3">
                            <div class="line-clamp-1 text-sm font-semibold text-slate-900">{{ $journal->title }}</div>
                            <div class="mt-1 text-xs text-slate-500 md:hidden">{{ \Carbon\Carbon::parse($journal->journal_date)->locale('id')->format('d M Y') }}</div>
                        </td>
                        <td class="px-4 py-3 hidden text-sm text-slate-700 md:table-cell">{{ \Carbon\Carbon::parse($journal->journal_date)->locale('id')->format('d M Y') }}</td>
                        <td class="px-4 py-3 hidden lg:table-cell">
                            <div class="flex flex-wrap gap-1.5">
                                @if($journal->photo)
                                    <span class="badge-chip bg-sky-100 text-sky-700">Foto</span>
                                @endif
                                @if($journal->video)
                                    <span class="badge-chip bg-cyan-100 text-cyan-700">Video</span>
                                @endif
                                @if(!$journal->photo && !$journal->video)
                                    <span class="badge-chip badge-muted">-</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-4 py-3 hidden xl:table-cell">
                            <p class="line-clamp-2 text-sm text-slate-600">{{ \Illuminate\Support\Str::limit($journal->content, 90, '...') }}</p>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.journals.edit', $journal) }}" class="btn-secondary px-3 py-1.5 text-xs">Edit</a>
                                <form action="{{ route('admin.journals.destroy', $journal) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus journal ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center justify-center rounded-lg bg-rose-100 px-3 py-1.5 text-xs font-semibold text-rose-700 transition hover:bg-rose-200">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-10 text-center text-sm text-slate-500">Belum ada journal. Buat journal pertama untuk menampilkan cerita perjalanan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div>
        {{ $journals->links('pagination::tailwind') }}
    </div>
</div>
@endsection
