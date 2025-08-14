<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    <!-- Tailwind via CDN, enough for MVP -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-900">
    <header class="bg-white border-b">
        <div class="max-w-5xl mx-auto px-4 py-4 flex items-center justify-between">
            <a href="{{ route('welcome') }}" class="font-semibold">{{ config('app.name') }}</a>
            <nav class="space-x-4">
                <a class="hover:underline" href="{{ route('booking.form') }}">Book Tour</a>
                <a class="hover:underline" href="{{ route('trips.index') }}">Trip Results</a>
            </nav>
        </div>
    </header>
    <main class="max-w-5xl mx-auto px-4 py-8">
        @if (session('error'))
            <div class="mb-6 p-3 bg-red-100 text-red-800 rounded">{{ session('error') }}</div>
        @endif
        @yield('content')
    </main>
    <footer class="border-t bg-white">
        <div class="max-w-5xl mx-auto px-4 py-6 text-sm text-gray-500">
            © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        </div>
    </footer>
</body>
</html>
