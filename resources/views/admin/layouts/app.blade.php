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
<body class="flex min-h-screen bg-gray-50 text-gray-800">

  {{-- Sidebar --}}
  <aside class="w-64 bg-indigo-700 text-white flex flex-col shadow-lg">
    <div class="p-5 text-2xl font-bold tracking-wide border-b border-indigo-600">
      Ijen Driver
    </div>
    <nav class="flex-1 p-4 space-y-1">
      <a href="{{ route('admin.tours.index') }}"
         class="block px-3 py-2 rounded-md transition
         {{ request()->routeIs('admin.tours.*') ? 'bg-indigo-500' : 'hover:bg-indigo-600' }}">
         🗺️ Tours
      </a>

      {{-- Add more menus here --}}
      <a href="{{ route('admin.logout') }}"
         class="block px-3 py-2 rounded-md mt-6 bg-red-500 hover:bg-red-600 transition text-white">
         🚪 Logout
      </a>
    </nav>
  </aside>

  {{-- Main --}}
  <main class="flex-1 flex flex-col">
    <header class="flex justify-between items-center bg-white shadow px-6 py-4">
      <h1 class="text-xl font-semibold">@yield('title', 'Dashboard')</h1>
      <span class="text-gray-500 text-sm">Halo, Admin 👋</span>
    </header>

    <section class="flex-1 p-6">
      @yield('content')
    </section>
  </main>
</body>
</html>
