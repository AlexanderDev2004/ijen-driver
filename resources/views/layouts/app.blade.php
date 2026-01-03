<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  {{-- Primary meta --}}
  <title>@yield('title', config('app.name', 'Ijen Driver'))</title>
  <meta name="description" content="@yield('meta_description', 'Ijen Driver - Tour, travel, dan sewa driver Banyuwangi, Kawah Ijen, dan sekitarnya.')">
  @hasSection('meta_keywords')
    <meta name="keywords" content="@yield('meta_keywords')">
  @endif
  <meta name="robots" content="@yield('meta_robots', 'index,follow')">
  <link rel="canonical" href="{{ url()->current() }}">

  {{-- Hreflang (best effort using fallback locales) --}}
  @php($availableLocales = config('app.available_locales', [config('app.fallback_locale'), 'en']))
  @foreach(array_unique($availableLocales) as $locale)
    <link rel="alternate" hreflang="{{ $locale }}" href="{{ url()->current() }}">
  @endforeach
  <link rel="alternate" hreflang="x-default" href="{{ url()->current() }}">

  {{-- Open Graph / Twitter --}}
  <meta property="og:title" content="@yield('title', config('app.name', 'Ijen Driver'))">
  <meta property="og:description" content="@yield('meta_description', 'Ijen Driver - Tour, travel, dan sewa driver Banyuwangi, Kawah Ijen, dan sekitarnya.')">
  <meta property="og:url" content="{{ url()->current() }}">
  <meta property="og:type" content="@yield('meta_og_type', 'website')">
  <meta property="og:locale" content="{{ str_replace('_','-', app()->getLocale()) }}">
  @php($metaImage = trim($__env->yieldContent('meta_image')))
  @if($metaImage !== '')
    <meta property="og:image" content="{{ $metaImage }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:image" content="{{ $metaImage }}">
  @else
    <meta property="og:image" content="{{ url('/images/og-default.jpg') }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:image" content="{{ url('/images/og-default.jpg') }}">
  @endif
  <meta name="twitter:title" content="@yield('title', config('app.name', 'Ijen Driver'))">
  <meta name="twitter:description" content="@yield('meta_description', 'Ijen Driver - Tour, travel, dan sewa driver Banyuwangi, Kawah Ijen, dan sekitarnya.')">

  {{-- Vite compiled CSS/JS (Laravel 10 default) --}}
  @if(file_exists(public_path('build')))
    {{-- If you use a different build flow, adjust --}}
    <link rel="stylesheet" href="{{ asset('build/assets/app.css') }}">
  @else
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  @endif

  @stack('styles')
  @stack('head')
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

      <div class="flex items-center gap-3 md:hidden">
        {{-- Mobile language switcher --}}
        <div class="relative group">
          <button class="flex items-center gap-1 text-sm px-3 py-1.5 rounded border-2 {{ app()->getLocale() == 'id' ? 'border-indigo-600 text-indigo-600' : 'border-slate-200' }} hover:border-indigo-600 transition font-medium">
            <span class="text-xs">🌐</span>
            <span class="uppercase font-bold">{{ app()->getLocale() }}</span>
          </button>
          <div class="absolute right-0 mt-1 bg-white rounded-lg shadow-xl border border-slate-200 py-1 hidden group-hover:block z-50 min-w-[140px]">
            <a href="{{ route('lang.switch', 'id') }}" class="block px-4 py-2 text-sm hover:bg-indigo-50 transition {{ app()->getLocale() == 'id' ? 'bg-indigo-50 text-indigo-700 font-bold' : 'text-slate-700' }}">🇮🇩 Indonesia</a>
            <a href="{{ route('lang.switch', 'en') }}" class="block px-4 py-2 text-sm hover:bg-indigo-50 transition {{ app()->getLocale() == 'en' ? 'bg-indigo-50 text-indigo-700 font-bold' : 'text-slate-700' }}">🇬🇧 English</a>
          </div>
        </div>
        <button id="mobile-menu-toggle" class="md:hidden inline-flex items-center justify-center w-10 h-10 rounded-lg border border-slate-200 hover:border-indigo-500 hover:text-indigo-600 transition" aria-label="Toggle navigation">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
        </button>
      </div>

      <nav class="hidden md:flex items-center gap-4">
        <a href="{{ route('home') }}" class="text-sm hover:text-indigo-600">{{ __('public.home') }}</a>
        <a href="{{ url('/#tours') }}" class="text-sm hover:text-indigo-600">{{ __('public.tours') }}</a>
        <a href="{{ url('/#journals') }}" class="text-sm hover:text-indigo-600">Journals</a>

        {{-- Language Switcher desktop --}}
        <div class="relative group">
          <button class="flex items-center gap-1 text-sm hover:text-indigo-600 px-3 py-1.5 rounded border-2 {{ app()->getLocale() == 'id' ? 'border-indigo-600 text-indigo-600' : 'border-slate-200' }} hover:border-indigo-600 transition font-medium">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"></path>
            </svg>
            <span class="uppercase font-bold">{{ app()->getLocale() }}</span>
            <span class="text-xs">{{ app()->getLocale() == 'id' ? '🇮🇩' : '🇬🇧' }}</span>
          </button>
          <div class="absolute right-0 mt-1 bg-white rounded-lg shadow-xl border border-slate-200 py-1 hidden group-hover:block z-50 min-w-[140px]">
            <a href="{{ route('lang.switch', 'id') }}" class="block px-4 py-2 text-sm hover:bg-indigo-50 transition {{ app()->getLocale() == 'id' ? 'bg-indigo-50 text-indigo-700 font-bold' : 'text-slate-700' }}">🇮🇩 Indonesia</a>
            <a href="{{ route('lang.switch', 'en') }}" class="block px-4 py-2 text-sm hover:bg-indigo-50 transition {{ app()->getLocale() == 'en' ? 'bg-indigo-50 text-indigo-700 font-bold' : 'text-slate-700' }}">🇬🇧 English</a>
          </div>
        </div>

        @if(session()->has('admin_id'))
          <a href="{{ route('admin.dashboard') }}" class="ml-2 text-sm px-3 py-1 rounded bg-indigo-600 text-white">Admin</a>

          <form action="{{ route('admin.logout') }}" method="POST" class="inline-block ml-2">
            @csrf
            <button type="submit" class="text-sm px-3 py-1 rounded border hover:bg-gray-100">Logout</button>
          </form>
        @else
          <a href="{{ route('admin.login') }}" class="ml-2 text-sm px-3 py-1 rounded border hover:bg-gray-100">Admin Login</a>
        @endif
      </nav>
    </div>

    {{-- Mobile menu --}}
    <div id="mobile-menu" class="md:hidden hidden px-4 pb-3 space-y-2">
      <a href="{{ route('home') }}" class="block text-sm py-2 border-b border-slate-100 hover:text-indigo-600">{{ __('public.home') }}</a>
      <a href="{{ url('/#tours') }}" class="block text-sm py-2 border-b border-slate-100 hover:text-indigo-600">{{ __('public.tours') }}</a>
      <a href="{{ url('/#journals') }}" class="block text-sm py-2 border-b border-slate-100 hover:text-indigo-600">Journals</a>
      <div class="flex items-center gap-2 pt-2">
        <a href="{{ route('lang.switch', 'id') }}" class="flex-1 text-sm px-3 py-2 rounded border {{ app()->getLocale() == 'id' ? 'border-indigo-500 text-indigo-600 font-semibold' : 'border-slate-200' }} text-center">🇮🇩 ID</a>
        <a href="{{ route('lang.switch', 'en') }}" class="flex-1 text-sm px-3 py-2 rounded border {{ app()->getLocale() == 'en' ? 'border-indigo-500 text-indigo-600 font-semibold' : 'border-slate-200' }} text-center">🇬🇧 EN</a>
      </div>
      @if(session()->has('admin_id'))
        <a href="{{ route('admin.dashboard') }}" class="block text-sm px-3 py-2 rounded bg-indigo-600 text-white text-center">Admin</a>
        <form action="{{ route('admin.logout') }}" method="POST" class="mt-2">
          @csrf
          <button type="submit" class="w-full text-sm px-3 py-2 rounded border hover:bg-gray-100 text-center">Logout</button>
        </form>
      @else
        <a href="{{ route('admin.login') }}" class="block text-sm px-3 py-2 rounded border hover:bg-gray-100 text-center">Admin Login</a>
      @endif
    </div>
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

  {{-- Mobile menu toggle --}}
  <script>
    const mobileToggle = document.getElementById('mobile-menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');
    if (mobileToggle && mobileMenu) {
      mobileToggle.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
      });
    }
  </script>
      @stack('head')
      @stack('structured_data')

  @stack('scripts')
</body>
</html>
