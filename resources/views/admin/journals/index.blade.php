@extends('admin.layouts.app')

@section('title', 'Journal Perjalanan')

@section('content')
<div class="w-full">
    {{-- Header dengan Tombol Tambah --}}
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h2 class="text-3xl font-bold text-slate-900">Journal Perjalanan</h2>
            <p class="text-slate-600 mt-1">Kelola catatan perjalanan untuk setiap tour</p>
        </div>
        <a href="{{ route('admin.journals.create') }}"
           class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg font-medium transition">
            + Tambah Journal
        </a>
    </div>

    {{-- Alert Messages --}}
    @if ($message = Session::get('success'))
    <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-lg text-green-700">
        {{ $message }}
    </div>
    @endif

    @if ($message = Session::get('error'))
    <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg text-red-700">
        {{ $message }}
    </div>
    @endif

    {{-- Tabel Journal --}}
    <div class="bg-white rounded-lg shadow overflow-hidden">
        @if ($journals->count() > 0)
        <table class="w-full">
            <thead>
                <tr class="border-b bg-slate-50">
                    <th class="px-6 py-3 text-left text-sm font-semibold text-slate-700">Tour</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-slate-700">Judul Journal</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-slate-700">Tanggal</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-slate-700">Media</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-slate-700">Preview Konten</th>
                    <th class="px-6 py-3 text-center text-sm font-semibold text-slate-700">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($journals as $journal)
                <tr class="border-b hover:bg-slate-50 transition">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-2">
                            <div class="w-2 h-2 rounded-full bg-indigo-600"></div>
                            <span class="font-medium text-slate-900">{{ $journal->tour->title }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="text-slate-900 font-medium">{{ $journal->title }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="text-slate-600 text-sm">
                            {{ \Carbon\Carbon::parse($journal->journal_date)->locale('id')->format('d M Y') }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex gap-2">
                            @if($journal->photo)
                            <span class="inline-flex items-center gap-1 px-2 py-1 bg-blue-50 text-blue-700 rounded text-xs font-medium">
                                📷 Foto
                            </span>
                            @endif
                            @if($journal->video)
                            <span class="inline-flex items-center gap-1 px-2 py-1 bg-purple-50 text-purple-700 rounded text-xs font-medium">
                                🎥 Video
                            </span>
                            @endif
                            @if(!$journal->photo && !$journal->video)
                            <span class="text-slate-400 text-sm">-</span>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="text-slate-600 text-sm line-clamp-2">
                            {{ \Illuminate\Support\Str::limit($journal->content, 50, '...') }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <div class="flex justify-center gap-2">
                            <a href="{{ route('admin.journals.edit', $journal) }}"
                               class="text-indigo-600 hover:text-indigo-700 font-medium transition">
                                Edit
                            </a>
                            <form action="{{ route('admin.journals.destroy', $journal) }}" method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus journal ini?');"
                                  class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-700 font-medium transition">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="px-6 py-4 bg-slate-50 border-t">
            {{ $journals->links('pagination::tailwind') }}
        </div>
        @else
        <div class="p-12 text-center">
            <svg class="w-16 h-16 mx-auto text-slate-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            <p class="text-slate-500 text-lg">Belum ada journal</p>
            <a href="{{ route('admin.journals.create') }}" class="text-indigo-600 hover:text-indigo-700 mt-2 inline-block">
                Buat journal pertama →
            </a>
        </div>
        @endif
    </div>
</div>
@endsection
