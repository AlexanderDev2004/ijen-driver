@extends('admin.layouts.app')

@section('title', 'Daftar User Admin')

@section('content')
  <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
      <div>
          <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Manajemen</p>
          <h1 class="text-2xl font-bold text-slate-900">Daftar User Admin</h1>
      </div>
      <a href="{{ route('admin.users.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700 transition">
          <span class="text-lg">＋</span> Tambah User
      </a>
  </div>

  @if(session('success'))
      <div class="mb-4 p-4 rounded-xl border border-emerald-200 bg-emerald-50 text-emerald-700">
          {{ session('success') }}
      </div>
  @endif

  @if($errors->any())
      <div class="mb-4 p-4 rounded-xl border border-rose-200 bg-rose-50 text-rose-700">
          <strong>Error:</strong>
          <ul class="list-disc list-inside">
              @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif

  <div class="overflow-x-auto bg-white shadow-lg rounded-2xl border border-slate-100">
      <table class="min-w-full">
          <thead>
              <tr class="bg-slate-50 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                  <th class="px-5 py-3">Nama</th>
                  <th class="px-5 py-3">Username</th>
                  <th class="px-5 py-3">Email</th>
                  <th class="px-5 py-3">Role</th>
                  <th class="px-5 py-3 text-center">Aksi</th>
              </tr>
          </thead>
          <tbody class="divide-y divide-slate-100">
              @forelse($users as $user)
                  <tr class="hover:bg-slate-50/70">
                      <td class="px-5 py-3">
                          <div class="font-semibold text-slate-900">{{ $user->name }}</div>
                      </td>
                      <td class="px-5 py-3">
                          <div class="text-slate-700 font-mono text-sm">{{ $user->username }}</div>
                      </td>
                      <td class="px-5 py-3 text-slate-700">{{ $user->email }}</td>
                      <td class="px-5 py-3">
                          @if($user->is_admin)
                              <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-100 text-indigo-700 text-sm font-semibold">
                                  <span class="w-2 h-2 rounded-full bg-indigo-500"></span> Admin
                              </span>
                          @else
                              <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-100 text-slate-700 text-sm font-semibold">
                                  <span class="w-2 h-2 rounded-full bg-slate-400"></span> User
                              </span>
                          @endif
                      </td>
                      <td class="px-5 py-3 text-center">
                          <div class="inline-flex items-center gap-2">
                              <a href="{{ route('admin.users.edit', $user->id) }}" class="px-3 py-1.5 rounded-lg bg-indigo-50 text-indigo-700 hover:bg-indigo-100 text-sm font-semibold">Edit</a>
                              @if($user->id !== session('admin_id'))
                                  <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline">
                                      @csrf
                                      @method('DELETE')
                                      <button type="submit" onclick="return confirm('Yakin hapus user ini?')" class="px-3 py-1.5 rounded-lg bg-rose-50 text-rose-700 hover:bg-rose-100 text-sm font-semibold">Hapus</button>
                                  </form>
                              @endif
                          </div>
                      </td>
                  </tr>
              @empty
                  <tr>
                      <td colspan="5" class="text-center py-10 text-slate-500">Belum ada user.</td>
                  </tr>
              @endforelse
          </tbody>
      </table>
  </div>

  @if($users->hasPages())
      <div class="mt-6">
          {{ $users->links() }}
      </div>
  @endif
@endsection
