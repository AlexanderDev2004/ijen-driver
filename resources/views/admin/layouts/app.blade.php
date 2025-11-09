<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin - @yield('title', 'Dashboard')</title>

    {{-- TailwindCSS --}}
    @vite('resources/css/app.css')

    {{-- Tambahan styling opsional --}}
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f9fafb;
        }
        .sidebar-link.active {
            @apply bg-blue-600 text-white;
        }
    </style>
</head>
<body class="flex min-h-screen">

    {{-- Sidebar --}}
    <aside class="w-64 bg-gray-800 text-gray-100 flex flex-col">
        <div class="p-4 text-2xl font-bold text-center border-b border-gray-700">
            Admin Panel
        </div>

        <nav class="flex-1 p-4 space-y-2">
            <a href="{{ route('admin.tours.index') }}"
               class="block px-3 py-2 rounded-md hover:bg-gray-700 {{ request()->routeIs('admin.tours.*') ? 'bg-gray-700' : '' }}">
               🗺️ Tours
            </a>

            {{-- Tambahkan menu lain di sini jika perlu --}}
            <a href="{{ route('admin.logout') }}"
               class="block px-3 py-2 rounded-md hover:bg-red-600 mt-6 text-red-400 hover:text-white">
               🚪 Logout
            </a>
        </nav>
    </aside>

    {{-- Konten utama --}}
    <main class="flex-1 p-6">
        {{-- Header --}}
        <header class="flex justify-between items-center mb-6 border-b pb-3">
            <h1 class="text-2xl font-semibold text-gray-800">@yield('title', 'Dashboard')</h1>
            <span class="text-gray-500 text-sm">Halo, Admin 👋</span>
        </header>

        {{-- Konten halaman --}}
        <section>
            @yield('content')
        </section>
    </main>

</body>
</html>
