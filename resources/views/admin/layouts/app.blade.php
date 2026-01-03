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
    {{-- Sidebar --}}
    <aside class="hidden lg:flex w-68 bg-gradient-to-b from-indigo-700 to-indigo-800 text-white flex-col shadow-xl">
      <div class="px-6 py-5 border-b border-white/10">
        <div class="text-xl font-bold tracking-tight">Ijen Driver</div>
        <div class="text-sm text-indigo-100/80">Admin Dashboard</div>
      </div>
      <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
        <a href="{{ route('admin.tours.index') }}"
           class="flex items-center gap-2 px-3 py-2 rounded-lg transition {{ request()->routeIs('admin.tours.*') ? 'bg-white/10 text-white shadow-sm' : 'text-indigo-50 hover:bg-white/5' }}">
          <span class="text-lg">🗺️</span>
          <span class="font-medium">Tours</span>
        </a>
        <a href="{{ route('admin.journals.index') }}"
           class="flex items-center gap-2 px-3 py-2 rounded-lg transition {{ request()->routeIs('admin.journals.*') ? 'bg-white/10 text-white shadow-sm' : 'text-indigo-50 hover:bg-white/5' }}">
          <span class="text-lg">📖</span>
          <span class="font-medium">Journals</span>
        </a>
        <a href="{{ route('admin.users.index') }}"
           class="flex items-center gap-2 px-3 py-2 rounded-lg transition {{ request()->routeIs('admin.users.*') ? 'bg-white/10 text-white shadow-sm' : 'text-indigo-50 hover:bg-white/5' }}">
          <span class="text-lg">👥</span>
          <span class="font-medium">Users</span>
        </a>
      </nav>
      <div class="px-4 pb-5 pt-2 border-t border-white/10">
        <form action="{{ route('admin.logout') }}" method="POST">
          @csrf
          <button type="submit" class="w-full flex items-center justify-center gap-2 px-3 py-2 rounded-lg bg-white/15 hover:bg-white/25 text-white font-semibold transition">
            🚪 Logout
          </button>
        </form>
      </div>
    </aside>

    {{-- Main --}}
    <main class="flex-1 flex flex-col">
      <header class="bg-white/80 backdrop-blur shadow-sm border-b border-slate-100">
        <div class="px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between">
          <div class="flex items-center gap-3">
            <button id="mobileMenuButton" class="lg:hidden inline-flex items-center justify-center w-10 h-10 rounded-lg border border-slate-200 text-slate-700 hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-500">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 5.75h16.5M3.75 12h16.5M3.75 18.25h16.5" />
              </svg>
            </button>
            <div>
              <div class="text-xs uppercase tracking-wide text-slate-400">Admin</div>
              <h1 class="text-xl font-semibold text-slate-900">@yield('title', 'Dashboard')</h1>
            </div>
          </div>
          <div class="flex items-center gap-3 text-sm text-slate-500">
            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-100 text-slate-700">
              <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
              Online
            </span>
            <span class="hidden sm:inline">Halo, Admin 👋</span>
          </div>
        </div>
      </header>

      <section class="flex-1 px-4 sm:px-6 lg:px-8 py-6">
        @yield('content')
      </section>
    </main>
  </div>

  {{-- Mobile menu --}}
  <div id="mobileMenu" class="lg:hidden fixed inset-0 z-40 hidden">
    <div class="absolute inset-0 bg-slate-900/60" data-overlay="true"></div>
    <div class="absolute top-0 left-0 h-full w-72 max-w-[85%] bg-white shadow-2xl p-4 flex flex-col">
      <div class="flex items-center justify-between pb-3 border-b border-slate-200">
        <div>
          <div class="text-base font-semibold text-slate-900">Ijen Driver</div>
          <div class="text-xs text-slate-500">Admin Dashboard</div>
        </div>
        <button id="mobileMenuClose" class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-slate-600 hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-indigo-500">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
      <nav class="flex-1 pt-4 space-y-2 text-sm">
        <a href="{{ route('admin.tours.index') }}"
           class="flex items-center gap-2 px-3 py-2 rounded-lg transition {{ request()->routeIs('admin.tours.*') ? 'bg-indigo-50 text-indigo-700 border border-indigo-100' : 'text-slate-700 hover:bg-slate-50' }}">
          <span class="text-lg">🗺️</span>
          <span class="font-medium">Tours</span>
        </a>
        <a href="{{ route('admin.journals.index') }}"
           class="flex items-center gap-2 px-3 py-2 rounded-lg transition {{ request()->routeIs('admin.journals.*') ? 'bg-indigo-50 text-indigo-700 border border-indigo-100' : 'text-slate-700 hover:bg-slate-50' }}">
          <span class="text-lg">📖</span>
          <span class="font-medium">Journals</span>
        </a>
        <a href="{{ route('admin.users.index') }}"
           class="flex items-center gap-2 px-3 py-2 rounded-lg transition {{ request()->routeIs('admin.users.*') ? 'bg-indigo-50 text-indigo-700 border border-indigo-100' : 'text-slate-700 hover:bg-slate-50' }}">
          <span class="text-lg">👥</span>
          <span class="font-medium">Users</span>
        </a>
      </nav>
      <div class="pt-3 border-t border-slate-200">
        <form action="{{ route('admin.logout') }}" method="POST">
          @csrf
          <button type="submit" class="w-full flex items-center justify-center gap-2 px-3 py-2 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white font-semibold transition">
            🚪 Logout
          </button>
        </form>
      </div>
    </div>
  </div>

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
