<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>404 - Page Not Found</title>

    @vite('resources/css/app.css')

</head>
<body class="min-h-screen bg-gradient-to-b from-slate-50 to-white flex items-center justify-center px-4">
    <main class="max-w-md mx-auto py-12 sm:py-16 text-center">
        <div class="inline-flex items-center justify-center w-24 h-24 sm:w-32 sm:h-32 rounded-full bg-indigo-50 text-indigo-600 mb-6 sm:mb-8 shadow-md">
            <span class="text-3xl sm:text-4xl font-extrabold tracking-tight">404</span>
        </div>

        <h1 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-slate-900 mb-3 sm:mb-4">Page not found</h1>
        <p class="text-slate-600 mb-6 sm:mb-8 text-sm sm:text-base">
            The page you are looking for doesn't exist or has been moved. Try returning home or using the link below.
        </p>

        <div class="flex flex-col sm:flex-row gap-3 justify-center">
            <a href="{{ url('/') }}" class="inline-flex items-center justify-center gap-2 px-5 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl font-semibold transition touch-manipulation">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9.75L12 3l9 6.75M9 22V12h6v10"></path>
                </svg>
                Go to homepage
            </a>

            <button onclick="history.back()" class="inline-flex items-center justify-center gap-2 px-5 py-3 bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 rounded-xl font-semibold transition">
                Go back
            </button>
        </div>

        <p class="mt-8 text-sm text-slate-400">
            If you think this is an error, contact support.
        </p>
    </main>
</body>
</html>
