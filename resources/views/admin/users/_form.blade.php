@php($isEdit = isset($user))

<div class="space-y-5">
    <div>
        <label for="name" class="form-label">Nama Lengkap <span class="text-red-600">*</span></label>
        <input type="text" id="name" name="name" value="{{ old('name', $user->name ?? '') }}" class="form-input @error('name') input-error @enderror" placeholder="Contoh: John Doe" required>
        @error('name')
            <span class="error-message">{{ $message }}</span>
        @enderror
    </div>

    <div>
        <label for="username" class="form-label">Username <span class="text-red-600">*</span></label>
        <input type="text" id="username" name="username" value="{{ old('username', $user->username ?? '') }}" class="form-input @error('username') input-error @enderror" placeholder="Contoh: johndoe" required>
        @error('username')
            <span class="error-message">{{ $message }}</span>
        @enderror
    </div>

    <div>
        <label for="email" class="form-label">Email <span class="text-red-600">*</span></label>
        <input type="email" id="email" name="email" value="{{ old('email', $user->email ?? '') }}" class="form-input @error('email') input-error @enderror" placeholder="Contoh: john@example.com" required>
        @error('email')
            <span class="error-message">{{ $message }}</span>
        @enderror
    </div>

    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
        <div class="mb-3 text-sm font-semibold text-slate-800">
            {{ $isEdit ? 'Ubah Password (Opsional)' : 'Password Akun' }}
        </div>

        <div class="grid gap-4 md:grid-cols-2">
            <div>
                <label for="password" class="form-label">{{ $isEdit ? 'Password Baru' : 'Password' }}{{ $isEdit ? '' : ' *' }}</label>
                <input type="password" id="password" name="password" class="form-input @error('password') input-error @enderror" placeholder="{{ $isEdit ? 'Kosongkan jika tidak diubah' : 'Minimal 6 karakter' }}" {{ $isEdit ? '' : 'required' }}>
                @error('password')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="form-label">Konfirmasi Password{{ $isEdit ? '' : ' *' }}</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-input @error('password_confirmation') input-error @enderror" placeholder="Ulangi password" {{ $isEdit ? '' : 'required' }}>
                @error('password_confirmation')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>

    <label class="inline-flex items-center gap-3 rounded-xl border border-slate-200 bg-white px-4 py-3">
        <input type="hidden" name="is_admin" value="0">
        <input type="checkbox" id="is_admin" name="is_admin" value="1" class="h-5 w-5 rounded border-slate-300 text-teal-600 focus:ring-teal-500" {{ old('is_admin', $user->is_admin ?? false) ? 'checked' : '' }}>
        <span class="text-sm font-medium text-slate-700">Jadikan Admin (akses dashboard)</span>
    </label>

    <div class="flex flex-col gap-3 border-t border-slate-200 pt-4 sm:flex-row sm:justify-end">
        <a href="{{ route('admin.users.index') }}" class="btn-secondary w-full justify-center sm:w-auto">Batal</a>
        <button type="submit" class="btn-primary w-full justify-center sm:w-auto">{{ $submitLabel }}</button>
    </div>
</div>
