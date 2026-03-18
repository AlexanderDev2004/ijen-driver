<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen">
    <main class="mx-auto flex min-h-screen w-full max-w-3xl items-center justify-center px-4 py-10">
        <section class="surface-card w-full p-8 text-center sm:p-10">
            <div class="mx-auto inline-flex h-20 w-20 items-center justify-center rounded-2xl bg-teal-100 text-3xl font-bold text-teal-700">404</div>

            <h1 class="mt-6 text-3xl font-semibold text-slate-900 sm:text-4xl">Page not found</h1>
            <p class="mx-auto mt-3 max-w-lg text-sm text-slate-600 sm:text-base">
                The page you are looking for may have been moved, deleted, or the URL might be incorrect.
            </p>

            <div class="mt-7 flex flex-col justify-center gap-3 sm:flex-row">
                <a href="{{ url('/') }}" class="btn-primary w-full justify-center sm:w-auto">Go to homepage</a>
                <button onclick="history.back()" class="btn-secondary w-full justify-center sm:w-auto">Go back</button>
            </div>
        </section>
    </main>
</body>
</html>
