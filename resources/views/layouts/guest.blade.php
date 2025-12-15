<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full font-sans antialiased">

    
    <div class="min-h-full flex flex-col justify-center py-12 sm:px-6 bg-gradient-to-br from-blue-500 via-blue-600 to-indigo-700">

        
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <div class="text-center">
                <h1 class="text-4xl font-bold text-white tracking-tight">
                    LOGIN
                </h1>
                <p class="mt-2 text-blue-100 text-lg">
                    FinanSiswa
                </p>
            </div>
        </div>

        
        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white dark:bg-white-800 py-10 px-8 shadow-2xl sm:rounded-2xl sm:px-12">
                {{ $slot }}
            </div>

            
            <div class="mt-8 text-center">
                <p class="text-sm text-blue-200">
                    © {{ date('Y') }} FinanSiswa. Berinvestasi dalam diri Anda.
                </p>
            </div>
        </div>
    </div>
</body>
</html>