@extends('admin.layouts.app')

@section('title', 'Daftar User Admin')

@section('content')
<div class="space-y-5">
    <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-xs font-semibold uppercase tracking-[0.16em] text-slate-400">Manajemen Pengguna</p>
            <h2 class="text-2xl font-semibold text-slate-900">Daftar User Admin</h2>
            <p class="mt-1 text-sm text-slate-500">Kelola akun yang bisa mengakses dashboard admin.</p>
        </div>

        <a href="{{ route('admin.users.create') }}" class="btn-primary w-full justify-center sm:w-auto">Tambah User</a>
    </div>

    <div class="table-shell">
        <table class="min-w-full">
            <thead>
                <tr class="table-head">
                    <th class="px-4 py-3">Nama</th>
                    <th class="px-4 py-3 hidden md:table-cell">Username</th>
                    <th class="px-4 py-3 hidden lg:table-cell">Email</th>
                    <th class="px-4 py-3">Role</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-slate-200">
                @forelse($users as $user)
                    <tr class="table-row">
                        <td class="px-4 py-3">
                            <div class="font-semibold text-slate-900">{{ $user->name }}</div>
                            <div class="text-xs text-slate-500 md:hidden">{{ $user->username }}</div>
                            <div class="text-xs text-slate-500 lg:hidden">{{ $user->email }}</div>
                        </td>

                        <td class="px-4 py-3 hidden text-sm text-slate-700 md:table-cell">{{ $user->username }}</td>
                        <td class="px-4 py-3 hidden text-sm text-slate-700 lg:table-cell">{{ $user->email }}</td>

                        <td class="px-4 py-3">
                            @if($user->is_admin)
                                <span class="badge-chip bg-cyan-100 text-cyan-700">Admin</span>
                            @else
                                <span class="badge-chip badge-muted">User</span>
                            @endif
                        </td>

                        <td class="px-4 py-3">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn-secondary px-3 py-1.5 text-xs">Edit</a>

                                @if($user->id !== session('admin_id'))
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin hapus user ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center justify-center rounded-lg bg-rose-100 px-3 py-1.5 text-xs font-semibold text-rose-700 transition hover:bg-rose-200">Hapus</button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-10 text-center text-sm text-slate-500">Belum ada user admin.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($users->hasPages())
        <div>
            {{ $users->links('pagination::tailwind') }}
        </div>
    @endif
</div>
@endsection
