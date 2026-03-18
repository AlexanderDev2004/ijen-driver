<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Ijen Driver'))</title>
    <meta name="description" content="@yield('meta_description', 'Ijen Driver - Tour, travel, dan sewa driver Banyuwangi, Kawah Ijen, dan sekitarnya.')">
    @hasSection('meta_keywords')
        <meta name="keywords" content="@yield('meta_keywords')">
    @endif
    <meta name="robots" content="@yield('meta_robots', 'index,follow')">
    <link rel="canonical" href="{{ url()->current() }}">

    @php($availableLocales = config('app.available_locales', [config('app.fallback_locale'), 'en']))
    @foreach(array_unique($availableLocales) as $locale)
        <link rel="alternate" hreflang="{{ $locale }}" href="{{ url()->current() }}">
    @endforeach
    <link rel="alternate" hreflang="x-default" href="{{ url()->current() }}">

    <meta property="og:title" content="@yield('title', config('app.name', 'Ijen Driver'))">
    <meta property="og:description" content="@yield('meta_description', 'Ijen Driver - Tour, travel, dan sewa driver Banyuwangi, Kawah Ijen, dan sekitarnya.')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="@yield('meta_og_type', 'website')">
    <meta property="og:locale" content="{{ str_replace('_', '-', app()->getLocale()) }}">

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

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
    @stack('head')
    @stack('structured_data')
</head>
<body class="min-h-screen">
    <div class="relative flex min-h-screen flex-col">
        <header class="sticky top-0 z-50 border-b border-slate-200/70 bg-white/90 backdrop-blur-lg">
            <div class="mx-auto flex w-full max-w-7xl items-center justify-between gap-4 px-4 py-3 sm:px-6 lg:px-8">
                <a href="{{ route('home') }}" class="group inline-flex items-center gap-3">
                    <div class="inline-flex h-11 w-11 items-center justify-center rounded-2xl bg-teal-700 text-sm font-extrabold tracking-wide text-white shadow-sm transition group-hover:-translate-y-0.5">
                        ID
                    </div>
                    <div>
                        <div class="text-base font-bold text-slate-900 sm:text-lg">Ijen Driver</div>
                        <div class="text-xs text-slate-500">{{ __('public.brand_subtitle') }}</div>
                    </div>
                </a>

                <nav class="hidden items-center gap-1 md:flex">
                    <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'nav-link-active' : '' }}">{{ __('public.home') }}</a>
                    <a href="{{ route('public.tours') }}" class="nav-link {{ request()->routeIs('public.tours', 'tour.show', 'tour.booking', 'booking.confirm') ? 'nav-link-active' : '' }}">{{ __('public.tours') }}</a>
                    <a href="{{ route('public.journals') }}" class="nav-link {{ request()->routeIs('public.journals', 'journal.show') ? 'nav-link-active' : '' }}">{{ __('public.travel_journal') }}</a>
                </nav>

                <div class="hidden items-center gap-2 lg:flex">
                    <div class="inline-flex items-center rounded-xl border border-slate-200 bg-white p-1">
                        <a href="{{ route('lang.switch', 'id') }}" class="rounded-lg px-3 py-1.5 text-xs font-semibold {{ app()->getLocale() === 'id' ? 'bg-teal-50 text-teal-700' : 'text-slate-500 hover:text-slate-700' }}">ID</a>
                        <a href="{{ route('lang.switch', 'en') }}" class="rounded-lg px-3 py-1.5 text-xs font-semibold {{ app()->getLocale() === 'en' ? 'bg-teal-50 text-teal-700' : 'text-slate-500 hover:text-slate-700' }}">EN</a>
                    </div>

                    @if(session()->has('admin_id'))
                        <a href="{{ route('admin.dashboard') }}" class="btn-primary">Admin</a>
                        <form action="{{ route('admin.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-secondary">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('admin.login') }}" class="btn-secondary">Admin</a>
                    @endif
                </div>

                <button id="mobile-menu-toggle" class="inline-flex h-11 w-11 items-center justify-center rounded-xl border border-slate-200 text-slate-700 transition hover:border-teal-400 hover:text-teal-700 md:hidden" aria-label="Toggle navigation" aria-expanded="false">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>

            <div id="mobile-menu" class="hidden border-t border-slate-200 bg-white px-4 py-4 md:hidden">
                <div class="space-y-1">
                    <a href="{{ route('home') }}" class="block rounded-lg px-3 py-3 text-sm font-medium {{ request()->routeIs('home') ? 'bg-teal-50 text-teal-700' : 'text-slate-700 hover:bg-slate-50' }}">{{ __('public.home') }}</a>
                    <a href="{{ route('public.tours') }}" class="block rounded-lg px-3 py-3 text-sm font-medium {{ request()->routeIs('public.tours', 'tour.show', 'tour.booking', 'booking.confirm') ? 'bg-teal-50 text-teal-700' : 'text-slate-700 hover:bg-slate-50' }}">{{ __('public.tours') }}</a>
                    <a href="{{ route('public.journals') }}" class="block rounded-lg px-3 py-3 text-sm font-medium {{ request()->routeIs('public.journals', 'journal.show') ? 'bg-teal-50 text-teal-700' : 'text-slate-700 hover:bg-slate-50' }}">{{ __('public.travel_journal') }}</a>
                </div>

                <div class="mt-4 flex items-center gap-2">
                    <a href="{{ route('lang.switch', 'id') }}" class="flex-1 rounded-lg border px-3 py-2 text-center text-xs font-semibold {{ app()->getLocale() === 'id' ? 'border-teal-300 bg-teal-50 text-teal-700' : 'border-slate-300 text-slate-600' }}">{{ __('public.language_label_id') }}</a>
                    <a href="{{ route('lang.switch', 'en') }}" class="flex-1 rounded-lg border px-3 py-2 text-center text-xs font-semibold {{ app()->getLocale() === 'en' ? 'border-teal-300 bg-teal-50 text-teal-700' : 'border-slate-300 text-slate-600' }}">{{ __('public.language_label_en') }}</a>
                </div>

                <div class="mt-4 space-y-2 border-t border-slate-200 pt-4">
                    @if(session()->has('admin_id'))
                        <a href="{{ route('admin.dashboard') }}" class="btn-primary w-full">Admin Dashboard</a>
                        <form action="{{ route('admin.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-secondary w-full">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('admin.login') }}" class="btn-secondary w-full">{{ __('public.login_admin') }}</a>
                    @endif
                </div>
            </div>
        </header>

        <main class="flex-1">
            <div class="mx-auto w-full max-w-7xl px-4 py-6 sm:px-6 sm:py-8 lg:px-8">
                @if(session('success'))
                    <div class="mb-5 flex items-start gap-3 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800 content-reveal">
                        <svg class="mt-0.5 h-4 w-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-5 flex items-start gap-3 rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-800 content-reveal">
                        <svg class="mt-0.5 h-4 w-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M5 19h14a2 2 0 001.732-3l-7-12a2 2 0 00-3.464 0l-7 12A2 2 0 005 19z" />
                        </svg>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-5 rounded-2xl border border-amber-200 bg-amber-50 px-4 py-3 text-sm text-amber-900 content-reveal">
                        <div class="mb-2 font-semibold">{{ __('public.review_error_heading') }}</div>
                        <ul class="list-disc space-y-1 pl-5">
                            @foreach($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>

        @php($waNumber = preg_replace('/[^0-9]/', '', (string) env('WA_OWNER_NUMBER', '')))
        <footer class="border-t border-slate-200/80 bg-white/90">
            <div class="mx-auto flex w-full max-w-7xl flex-col gap-4 px-4 py-6 text-sm text-slate-600 sm:px-6 md:flex-row md:items-center md:justify-between lg:px-8">
                <div>
                    <div class="font-semibold text-slate-800">Ijen Driver</div>
                    <div>{{ __('public.footer_tagline') }}</div>
                </div>

                <div class="flex flex-wrap items-center gap-2">
                    <a href="{{ route('home') }}" class="btn-ghost">{{ __('public.home') }}</a>
                    <a href="{{ route('public.tours') }}" class="btn-ghost">{{ __('public.tours') }}</a>
                    <a href="{{ route('public.journals') }}" class="btn-ghost">{{ __('public.travel_journal') }}</a>
                    @if($waNumber !== '')
                        <a href="https://wa.me/{{ $waNumber }}" target="_blank" rel="noopener" class="btn-ghost">WhatsApp</a>
                    @endif
                </div>
            </div>
        </footer>

        @if(session()->has('admin_id'))
            <div class="fixed bottom-5 right-5 z-40 hidden sm:block">
                <a href="{{ route('admin.tours.index') }}" class="btn-primary shadow-lg">{{ __('public.manage_content') }}</a>
            </div>
        @endif
    </div>

    <script>
        const mobileToggle = document.getElementById('mobile-menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');

        if (mobileToggle && mobileMenu) {
            mobileToggle.addEventListener('click', () => {
                const isHidden = mobileMenu.classList.toggle('hidden');
                mobileToggle.setAttribute('aria-expanded', String(!isHidden));
            });

            document.addEventListener('keydown', (event) => {
                if (event.key === 'Escape') {
                    mobileMenu.classList.add('hidden');
                    mobileToggle.setAttribute('aria-expanded', 'false');
                }
            });
        }
    </script>

    @stack('scripts')
</body>
</html>
