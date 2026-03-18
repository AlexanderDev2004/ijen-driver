<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Admin Ijen Driver</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-100 text-slate-800">
    <div class="flex min-h-screen">
        <aside class="hidden w-72 shrink-0 flex-col border-r border-slate-200 bg-slate-900 text-slate-200 lg:flex">
            <div class="border-b border-slate-800 px-6 py-6">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-3">
                    <span class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-teal-500 text-sm font-extrabold tracking-wide text-slate-900">ID</span>
                    <span>
                        <span class="block text-base font-bold text-white">Ijen Driver</span>
                        <span class="block text-xs text-slate-400">Admin Workspace</span>
                    </span>
                </a>
            </div>

            <nav class="flex-1 space-y-1 px-4 py-5">
                <a href="{{ route('admin.tours.index') }}" class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition {{ request()->routeIs('admin.tours.*') ? 'bg-teal-500/15 text-teal-200' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                    </svg>
                    <span>Manajemen Tour</span>
                </a>

                <a href="{{ route('admin.journals.index') }}" class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition {{ request()->routeIs('admin.journals.*') ? 'bg-teal-500/15 text-teal-200' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.483 9.246 5 7.5 5S4.168 5.483 3 6.253v13C4.168 18.483 5.754 18 7.5 18s3.332.483 4.5 1.253m0-13C13.168 5.483 14.754 5 16.5 5c1.746 0 3.332.483 4.5 1.253v13C19.832 18.483 18.246 18 16.5 18c-1.746 0-3.332.483-4.5 1.253" />
                    </svg>
                    <span>Journal Perjalanan</span>
                </a>

                <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition {{ request()->routeIs('admin.users.*') ? 'bg-teal-500/15 text-teal-200' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5V9H2v11h5m10 0v-2a4 4 0 00-8 0v2m8 0H7m4-11a4 4 0 100 8 4 4 0 000-8z" />
                    </svg>
                    <span>Pengguna Admin</span>
                </a>
            </nav>

            <div class="border-t border-slate-800 px-4 py-4">
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-primary w-full">Logout Admin</button>
                </form>
            </div>
        </aside>

        <main class="flex min-w-0 flex-1 flex-col">
            <header class="sticky top-0 z-40 border-b border-slate-200/80 bg-white/95 backdrop-blur">
                <div class="flex items-center justify-between px-4 py-3 sm:px-6 lg:px-8">
                    <div class="flex items-center gap-3">
                        <button id="adminMobileMenuButton" class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 text-slate-700 lg:hidden" aria-label="Open menu">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                        <div>
                            <div class="text-xs font-semibold uppercase tracking-[0.16em] text-slate-400">Admin Panel</div>
                            <h1 class="text-lg font-semibold text-slate-900 sm:text-xl">@yield('title', 'Dashboard')</h1>
                        </div>
                    </div>

                    <div class="hidden items-center gap-2 rounded-full border border-slate-200 bg-slate-50 px-3 py-1.5 text-xs font-semibold text-slate-600 sm:inline-flex">
                        <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                        Sistem Aktif
                    </div>
                </div>
            </header>

            <section class="flex-1 px-4 py-5 sm:px-6 lg:px-8 lg:py-7">
                @if(session('success'))
                    <div class="mb-5 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-5 rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-800">
                        {{ session('error') }}
                    </div>
                @endif

                @if($errors->has('error'))
                    <div class="mb-5 rounded-2xl border border-amber-200 bg-amber-50 px-4 py-3 text-sm text-amber-900">
                        {{ $errors->first('error') }}
                    </div>
                @endif

                @yield('content')
            </section>
        </main>
    </div>

    <div id="adminMobileMenu" class="fixed inset-0 z-50 hidden lg:hidden">
        <div class="absolute inset-0 bg-slate-950/55" data-overlay="true"></div>

        <aside class="absolute left-0 top-0 h-full w-72 bg-slate-900 px-4 py-5 text-slate-200 shadow-2xl">
            <div class="mb-5 flex items-center justify-between border-b border-slate-800 pb-4">
                <div>
                    <div class="text-base font-semibold text-white">Ijen Driver</div>
                    <div class="text-xs text-slate-400">Admin Workspace</div>
                </div>
                <button id="adminMobileMenuClose" class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-slate-700 text-slate-200" aria-label="Close menu">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <nav class="space-y-1">
                <a href="{{ route('admin.tours.index') }}" class="block rounded-xl px-4 py-3 text-sm font-medium {{ request()->routeIs('admin.tours.*') ? 'bg-teal-500/15 text-teal-200' : 'text-slate-300' }}">Manajemen Tour</a>
                <a href="{{ route('admin.journals.index') }}" class="block rounded-xl px-4 py-3 text-sm font-medium {{ request()->routeIs('admin.journals.*') ? 'bg-teal-500/15 text-teal-200' : 'text-slate-300' }}">Journal Perjalanan</a>
                <a href="{{ route('admin.users.index') }}" class="block rounded-xl px-4 py-3 text-sm font-medium {{ request()->routeIs('admin.users.*') ? 'bg-teal-500/15 text-teal-200' : 'text-slate-300' }}">Pengguna Admin</a>
            </nav>

            <div class="mt-6 border-t border-slate-800 pt-4">
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-primary w-full">Logout Admin</button>
                </form>
            </div>
        </aside>
    </div>

    <script>
        const adminMobileMenu = document.getElementById('adminMobileMenu');
        const adminMobileMenuButton = document.getElementById('adminMobileMenuButton');
        const adminMobileMenuClose = document.getElementById('adminMobileMenuClose');

        const setAdminMenuVisibility = (visible) => {
            if (!adminMobileMenu) {
                return;
            }

            adminMobileMenu.classList.toggle('hidden', !visible);
            document.body.classList.toggle('overflow-hidden', visible);
        };

        adminMobileMenuButton?.addEventListener('click', () => setAdminMenuVisibility(true));
        adminMobileMenuClose?.addEventListener('click', () => setAdminMenuVisibility(false));
        adminMobileMenu?.addEventListener('click', (event) => {
            if (event.target?.dataset?.overlay === 'true') {
                setAdminMenuVisibility(false);
            }
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') {
                setAdminMenuVisibility(false);
            }
        });
    </script>
</body>
</html>
