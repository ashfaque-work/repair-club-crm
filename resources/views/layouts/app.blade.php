<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Repair Club Portal') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="https://flowbite.com/docs/images/logo.svg">
        
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')
            @include('layouts.sidebar')

            <!-- Page Content -->
            <main>
                <div class="p-1 sm:ml-64">
                    <!-- Page Heading -->
                    <header>
                        <div class="max-w-7xl mx-auto pt-16 px-4 sm:px-6 lg:px-8">
                        @if (isset($header))
                            {{ $header }}
                        @endif
                        </div>
                    </header>
                    <div class="container mx-auto py-4">
                        {{ $slot }}
                    </div>
                </div>
            </main>
        </div>
    </body>
</html>