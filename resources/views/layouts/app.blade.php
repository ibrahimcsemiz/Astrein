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
        @livewireStyles

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <style>
            *{
                font-family: Arial;
            }
            tr:nth-child(even) {
                background-color: #f6f6f6;
            }
        </style>
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            <header class="bg-white shadow -mb-8">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header  }}
                </div>
            </header>

            <!-- Page Content -->
            <main>
                {{ $slot }}

                @livewireScripts
            </main>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('.select2picker').select2();
            });
        </script>

        <script type="text/javascript">
            $(document).ready(function() {
                $('.select2picker').select2();
            });
        </script>
    </body>
</html>
