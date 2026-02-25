<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Dashboard') - Admin Panel</title>
  @vite('resources/css/app.css')

  <style>
    html { scroll-behavior: smooth; }
  </style>
</head>
<body class="min-h-screen bg-slate-50 text-slate-800">
  <div class="min-h-screen flex">
    <aside class="hidden lg:flex w-64 xl:w-68 bg-gradient-to-b from-indigo-700 to-indigo-800 text-white flex-col shadow-xl">
      <div class="px-5 xl:px-6 py-5 border-b border-white/10">
        <div class="text-lg xl:text-xl font-bold tracking-tight">Ijen Driver</div>
        <div class="text-sm text-indigo-100/80">Admin Dashboard</div>
      </div>
      <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
        <a href="{{ route('admin.tours.index') }}"
           class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('admin.tours.*') ? 'bg-white/10 text-white shadow-sm' : 'text-indigo-50 hover:bg-white/5' }}">
          <span class="text-lg">🗺️</span>
          <span class="font-medium">Tours</span>
        </a>
        <a href="{{ route('admin.journals.index') }}"
           class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('admin.journals.*') ? 'bg-white/10 text-white shadow-sm' : 'text-indigo-50 hover:bg-white/5' }}">
          <span class="text-lg">📖</span>
          <span class="font-medium">Journals</span>
        </a>
        <a href="{{ route('admin.users.index') }}"
           class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('admin.users.*') ? 'bg-white/10 text-white shadow-sm' : 'text-indigo-50 hover:bg-white/5' }}">
          <span class="text-lg">👥</span>
          <span class="font-medium">Users</span>
        </a>
      </nav>
      <div class="px-4 pb-5 pt-2 border-t border-white/10">
        <form action="{{ route('admin.logout') }}" method="POST">
          @csrf
          <button type="submit" class="w-full flex items-center justify-center gap-2 px-3 py-2.5 rounded-lg bg-white/15 hover:bg-white/25 text-white font-semibold transition">
            🚪 Logout
          </button>
        </form>
      </div>
    </aside>

    <main class="flex-1 flex flex-col min-w-0">
      <header class="bg-white/80 backdrop-blur shadow-sm border-b border-slate-100">
        <div class="px-4 sm:px-6 lg:px-8 py-3 sm:py-4 flex items-center justify-between">
          <div class="flex items-center gap-2 sm:gap-3">
            <button id="mobileMenuButton" class="lg:hidden inline-flex items-center justify-center w-10 h-10 rounded-lg border border-slate-200 text-slate-700 hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 touch-manipulation">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 5.75h16.5M3.75 12h16.5M3.75 18.25h16.5" />
              </svg>
            </button>
            <div>
              <div class="text-xs uppercase tracking-wide text-slate-400 hidden sm:block">Admin</div>
              <h1 class="text-lg sm:text-xl font-semibold text-slate-900">@yield('title', 'Dashboard')</h1>
            </div>
          </div>
          <div class="flex items-center gap-2 sm:gap-3 text-xs sm:text-sm text-slate-500">
            <span class="inline-flex items-center gap-1.5 sm:gap-2 px-2.5 sm:px-3 py-1.5 rounded-full bg-slate-100 text-slate-700">
              <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
              <span class="hidden sm:inline">Online</span>
            </span>
            <span class="hidden md:inline">Halo, Admin 👋</span>
          </div>
        </div>
      </header>

      <section class="flex-1 px-3 sm:px-4 lg:px-6 py-4 sm:py-6 overflow-x-hidden">
        @yield('content')
      </section>
    </main>
  </div>

  <div id="mobileMenu" class="lg:hidden fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" data-overlay="true"></div>
    <div class="absolute top-0 left-0 h-full w-72 max-w-[85%] bg-white shadow-2xl flex flex-col animate-slide-in">
      <div class="flex items-center justify-between px-4 py-4 border-b border-slate-200">
        <div>
          <div class="text-base font-semibold text-slate-900">Ijen Driver</div>
          <div class="text-xs text-slate-500">Admin Dashboard</div>
        </div>
        <button id="mobileMenuClose" class="inline-flex items-center justify-center w-10 h-10 rounded-lg text-slate-600 hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 touch-manipulation">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
      <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
        <a href="{{ route('admin.tours.index') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-lg transition text-base {{ request()->routeIs('admin.tours.*') ? 'bg-indigo-50 text-indigo-700 border border-indigo-100' : 'text-slate-700 hover:bg-slate-50' }}">
          <span class="text-xl">🗺️</span>
          <span class="font-medium">Tours</span>
        </a>
        <a href="{{ route('admin.journals.index') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-lg transition text-base {{ request()->routeIs('admin.journals.*') ? 'bg-indigo-50 text-indigo-700 border border-indigo-100' : 'text-slate-700 hover:bg-slate-50' }}">
          <span class="text-xl">📖</span>
          <span class="font-medium">Journals</span>
        </a>
        <a href="{{ route('admin.users.index') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-lg transition text-base {{ request()->routeIs('admin.users.*') ? 'bg-indigo-50 text-indigo-700 border border-indigo-100' : 'text-slate-700 hover:bg-slate-50' }}">
          <span class="text-xl">👥</span>
          <span class="font-medium">Users</span>
        </a>
      </nav>
      <div class="px-3 py-4 border-t border-slate-200">
        <form action="{{ route('admin.logout') }}" method="POST">
          @csrf
          <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-3 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white font-semibold transition text-base">
            🚪 Logout
          </button>
        </form>
      </div>
    </div>
  </div>

  <style>
    @keyframes slide-in {
      from { transform: translateX(-100%); }
      to { transform: translateX(0); }
    }
    .animate-slide-in {
      animation: slide-in 0.2s ease-out;
    }
  </style>

  <script>
    const mobileMenu = document.getElementById('mobileMenu');
    const mobileMenuButton = document.getElementById('mobileMenuButton');
    const mobileMenuClose = document.getElementById('mobileMenuClose');

    const setMenuVisibility = (visible) => {
      if (!mobileMenu) return;
      mobileMenu.classList.toggle('hidden', !visible);
      document.body.classList.toggle('overflow-hidden', visible);
    };

    mobileMenuButton?.addEventListener('click', () => setMenuVisibility(true));
    mobileMenuClose?.addEventListener('click', () => setMenuVisibility(false));
    mobileMenu?.addEventListener('click', (event) => {
      if (event.target?.dataset?.overlay === 'true') {
        setMenuVisibility(false);
      }
    });
  </script>
</body>
</html>
