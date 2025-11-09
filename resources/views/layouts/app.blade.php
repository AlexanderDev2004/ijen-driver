<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title', config('app.name', 'Ijen Driver'))</title>

  {{-- Vite compiled CSS/JS (Laravel 10 default) --}}
  @if(file_exists(public_path('build')))
    {{-- If you use a different build flow, adjust --}}
    <link rel="stylesheet" href="{{ asset('build/assets/app.css') }}">
  @else
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  @endif

  @stack('styles')
</head>
<body class="bg-gray-50 text-gray-800 antialiased min-h-screen flex flex-col">

  {{-- Topbar --}}
  <header class="bg-white shadow-sm">
    <div class="container mx-auto px-4 py-3 flex items-center justify-between">
      <div class="flex items-center gap-3">
        <a href="{{ route('home') }}" class="flex items-center gap-3">
          <div class="w-10 h-10 rounded-full bg-gradient-to-r from-indigo-600 to-teal-400 flex items-center justify-center text-white font-bold">ID</div>
          <div>
            <div class="font-semibold text-lg">Ijen Driver</div>
            <div class="text-xs text-gray-500">Tour & Booking</div>
          </div>
        </a>
      </div>

      <nav class="flex items-center gap-4">
        <a href="{{ route('home') }}" class="text-sm hover:text-indigo-600">Home</a>
        <a href="{{ url('/#tours') }}" class="text-sm hover:text-indigo-600">Tours</a>
        <a href="{{ url('/#journals') }}" class="text-sm hover:text-indigo-600">Journals</a>

        @if(session()->has('admin_id'))
          <a href="{{ route('admin.dashboard') }}" class="ml-4 text-sm px-3 py-1 rounded bg-indigo-600 text-white">Admin</a>

          <form action="{{ route('admin.logout') }}" method="POST" class="inline-block ml-2">
            @csrf
            <button type="submit" class="text-sm px-3 py-1 rounded border hover:bg-gray-100">Logout</button>
          </form>
        @else
          <a href="{{ route('admin.login') }}" class="ml-4 text-sm px-3 py-1 rounded border hover:bg-gray-100">Admin Login</a>
        @endif
      </nav>
    </div>
  </header>

  {{-- Main area --}}
  <main class="flex-1 container mx-auto px-4 py-8 w-full">
    {{-- Flash messages --}}
    @if(session('success'))
      <div class="mb-4 p-3 rounded border-l-4 border-green-500 bg-green-50 text-green-800">
        {{ session('success') }}
      </div>
    @endif

    @if(session('error'))
      <div class="mb-4 p-3 rounded border-l-4 border-red-500 bg-red-50 text-red-800">
        {{ session('error') }}
      </div>
    @endif

    @if($errors->any())
      <div class="mb-4 p-3 rounded border-l-4 border-yellow-500 bg-yellow-50 text-yellow-800">
        <ul class="list-disc pl-5">
          @foreach($errors->all() as $err)
            <li>{{ $err }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    {{-- Content --}}
    @yield('content')
  </main>

  {{-- Footer --}}
  <footer class="bg-white border-t">
    <div class="container mx-auto px-4 py-6 text-sm text-gray-600 flex flex-col md:flex-row justify-between items-center gap-3">
      <div>© {{ date('Y') }} Ijen Driver — All rights reserved.</div>
      <div>
        <a href="#" class="hover:text-indigo-600 mr-3">Terms</a>
        <a href="#" class="hover:text-indigo-600">Privacy</a>
      </div>
    </div>
  </footer>

  {{-- Optional small admin quickbar for logged-in admin --}}
  @if(session()->has('admin_id'))
    <div class="fixed bottom-6 right-6">
      <a href="{{ route('admin.tours.index') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-full shadow-lg hover:shadow-xl">
        Manage
      </a>
    </div>
  @endif

  {{-- Scripts --}}
  @if(file_exists(public_path('build')))
    <script src="{{ asset('build/assets/app.js') }}"></script>
  @else
    @vite(['resources/js/app.js'])
  @endif

  @stack('scripts')
</body>
</html>
