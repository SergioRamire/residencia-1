<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body class="h-full">
<div class="bg-white min-h-full px-4 py-16 sm:px-6 sm:py-24 md:grid md:place-items-center lg:px-8">
    <div class="max-w-max mx-auto">
        <main class="sm:flex">
            <p class="text-4xl font-extrabold text-indigo-600 sm:text-5xl">@yield('code')</p>
            <div class="sm:ml-6">
                <div class="sm:border-l sm:border-gray-200 sm:pl-6">
                    <h1 class="text-4xl font-semibold text-gray-900 tracking-tight sm:text-5xl">@yield('message')</h1>
                    @hasSection('description')
                        <p class="mt-1 text-base text-gray-500">@yield('description')</p>
                    @endif
                </div>
                <div class="mt-10 flex space-x-3 sm:border-l sm:border-transparent sm:pl-6">
                    <a href="/dashboard" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Regresar
                    </a>
                    {{-- <a href="#" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"> --}}
                    {{--     Contact support --}}
                    {{-- </a> --}}
                </div>
            </div>
        </main>
    </div>
</div>

</body>
</html>
