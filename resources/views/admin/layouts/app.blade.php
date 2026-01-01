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
          <div>
            <div class="text-xs uppercase tracking-wide text-slate-400">Admin</div>
            <h1 class="text-xl font-semibold text-slate-900">@yield('title', 'Dashboard')</h1>
          </div>
          <div class="hidden sm:flex items-center gap-3 text-sm text-slate-500">
            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-100 text-slate-700">
              <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
              Online
            </span>
            <span>Halo, Admin 👋</span>
          </div>
        </div>
      </header>

      <section class="flex-1 px-4 sm:px-6 lg:px-8 py-6">
        @yield('content')
      </section>
    </main>
  </div>
</body>
</html>
