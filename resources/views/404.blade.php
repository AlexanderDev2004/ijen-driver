<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>404 - Page Not Found</title>

     @vite('resources/css/app.css')

</head>
<body class="min-h-screen bg-gradient-to-b from-gray-50 to-white flex items-center justify-center">
    <main class="max-w-4xl mx-auto px-6 py-16 text-center">
        <div class="inline-flex items-center justify-center w-36 h-36 rounded-full bg-indigo-50 text-indigo-600 mb-8 shadow-md">
            <span class="text-4xl font-extrabold tracking-tight">404</span>
        </div>

        <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-900 mb-4">Page not found</h1>
        <p class="text-gray-600 mb-8">
            The page you are looking for doesn't exist or has been moved. Try returning home or using the link below.
        </p>

        <div class="flex gap-3 justify-center">
            <a href="{{ url('/') }}" class="inline-flex items-center gap-2 px-5 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md shadow-sm">
                <!-- Home icon (simple SVG) -->
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9.75L12 3l9 6.75M9 22V12h6v10"></path>
                </svg>
                Go to homepage
            </a>

            <button onclick="history.back()" class="inline-flex items-center gap-2 px-5 py-3 bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 rounded-md shadow-sm">
                Go back
            </button>
        </div>

        <p class="mt-8 text-sm text-gray-400">
            If you think this is an error, contact support.
        </p>
    </main>
</body>
</html>
