@extends('admin.layouts.app')

@section('title', 'Edit User Admin')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-6">
        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Edit</p>
        <h2 class="text-2xl font-bold text-slate-900">Edit User: {{ $user->name }}</h2>
        <p class="text-sm text-slate-500">Perbarui data user.</p>
    </div>

    @if($errors->any())
        <div class="mb-4 p-4 rounded-xl border border-rose-200 bg-rose-50 text-rose-700">
            <div class="font-semibold mb-1">Terjadi kesalahan:</div>
            <ul class="list-disc list-inside space-y-1 text-sm">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white shadow-xl rounded-2xl border border-slate-100 p-6">
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Nama --}}
            <div>
                <label for="name" class="form-label">
                    Nama Lengkap <span class="text-red-600">*</span>
                </label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                       class="w-full rounded-lg border border-slate-300 px-4 py-2.5 focus:border-indigo-500 focus:ring-indigo-500 @error('name') border-red-500 @enderror"
                       placeholder="Contoh: John Doe"
                       required>
                @error('name')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>

            {{-- Username --}}
            <div>
                <label for="username" class="form-label">
                    Username <span class="text-red-600">*</span>
                </label>
                <input type="text" name="username" id="username" value="{{ old('username', $user->username) }}"
                       class="w-full rounded-lg border border-slate-300 px-4 py-2.5 focus:border-indigo-500 focus:ring-indigo-500 @error('username') border-red-500 @enderror"
                       placeholder="Contoh: johndoe"
                       required>
                @error('username')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>

            {{-- Email --}}
            <div>
                <label for="email" class="form-label">
                    Email <span class="text-red-600">*</span>
                </label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                       class="w-full rounded-lg border border-slate-300 px-4 py-2.5 focus:border-indigo-500 focus:ring-indigo-500 @error('email') border-red-500 @enderror"
                       placeholder="Contoh: john@example.com"
                       required>
                @error('email')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>

            {{-- Password (Optional saat edit) --}}
            <div class="bg-slate-50 border border-slate-200 rounded-lg p-4">
                <p class="text-sm font-medium text-slate-900 mb-3">Ubah Password <span class="text-slate-500 font-normal">(Opsional)</span></p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="password" class="form-label">
                            Password Baru
                        </label>
                        <input type="password" name="password" id="password"
                               class="w-full rounded-lg border border-slate-300 px-4 py-2.5 focus:border-indigo-500 focus:ring-indigo-500 @error('password') border-red-500 @enderror"
                               placeholder="Kosongkan jika tidak ingin mengubah">
                        @error('password')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="form-label">
                            Konfirmasi Password
                        </label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                               class="w-full rounded-lg border border-slate-300 px-4 py-2.5 focus:border-indigo-500 focus:ring-indigo-500 @error('password_confirmation') border-red-500 @enderror"
                               placeholder="Ulangi password baru">
                        @error('password_confirmation')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

            {{-- Role --}}
            <div>
                <label class="flex items-center gap-3">
                    <input type="hidden" name="is_admin" value="0">
                    <input type="checkbox" name="is_admin" id="is_admin" value="1" {{ old('is_admin', $user->is_admin) ? 'checked' : '' }}
                           class="w-5 h-5 text-indigo-600 border-slate-300 rounded focus:ring-indigo-500">
                    <span class="text-sm font-medium text-slate-700">Admin (akses dashboard)</span>
                </label>
            </div>

            {{-- Tombol --}}
            <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                <a href="{{ route('admin.users.index') }}"
                   class="px-4 py-2.5 bg-slate-200 text-slate-800 rounded-lg hover:bg-slate-300 transition font-semibold">
                    Batal
                </a>
                <button type="submit"
                        class="px-6 py-2.5 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition font-semibold">
                    Perbarui User
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
