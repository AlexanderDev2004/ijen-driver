@extends('layouts.app')

@section('title', 'Admin Login')

@section('content')
<div class="mx-auto max-w-md py-6 sm:py-10">
    <section class="surface-card overflow-hidden">
        <div class="page-hero rounded-none rounded-t-3xl border-0 px-6 py-8 sm:px-7">
            <div class="relative z-10">
                <span class="hero-kicker">Admin Area</span>
                <h1 class="text-3xl font-semibold text-white">Admin Login</h1>
                <p class="mt-2 text-sm text-white/90">Masuk untuk mengelola konten tour, journal, dan pengguna.</p>
            </div>
        </div>

        <div class="p-6 sm:p-7">
            <form method="POST" action="{{ route('admin.login.post') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="form-label">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-input @error('email') input-error @enderror" required autocomplete="email">
                    @error('email')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="password" class="form-label">Password</label>
                    <div class="relative">
                        <input id="password" type="password" name="password" class="form-input pr-12 @error('password') input-error @enderror" required autocomplete="current-password">
                        <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 inline-flex items-center px-3 text-slate-500" aria-label="Toggle password visibility">
                            <svg id="eyeIcon" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn-primary w-full justify-center py-3">Masuk</button>
            </form>

            <a href="{{ route('home') }}" class="btn-ghost mt-4 -ml-1">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali ke halaman utama
            </a>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
    const togglePasswordButton = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');

    togglePasswordButton?.addEventListener('click', () => {
        const showingText = passwordInput.type === 'text';
        passwordInput.type = showingText ? 'password' : 'text';

        eyeIcon.innerHTML = showingText
            ? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />'
            : '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.99 9.99 0 012.386-3.712M9.88 9.88a3 3 0 014.24 4.24m4.97 4.97A9.953 9.953 0 0012 19c-4.477 0-8.268-2.943-9.542-7a9.99 9.99 0 012.386-3.712M3 3l18 18" />';
    });
</script>
@endpush
