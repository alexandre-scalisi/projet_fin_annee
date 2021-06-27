<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="stylesheet" href="{{ mix('sass/app.css') }}">

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/form.js') }}"></script>
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        
        <div class="min-h-screen bg-gray-100">
            <x-admin-navigation-menu/>
            
            <!-- Page Heading -->
            <div class="flex mt-10">
                <x-admin-sidebar/>

                <!-- Page Content -->
                <main class="max-w-7xl w-full mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $slot }}
                </main>
            </div>
        </div>

        @stack('modals')

        @livewireScripts
        @stack('scripts')
        <script src="https://cdn.jsdelivr.net/gh/livewire/turbolinks@v0.1.x/dist/livewire-turbolinks.js" data-turbolinks-eval="false"></script>
    </body>
</html>
