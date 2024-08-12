<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <script async src="https://unpkg.com/@material-tailwind/html@latest/scripts/ripple.js"></script>
        <script src="https://unpkg.com/@material-tailwind/html@latest/scripts/collapse.js"></script>
        <script src="node_modules/@material-tailwind/html/scripts/collapse.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> 
        <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

        <style>
            /* Custom styles for select2 */
            .select2 {
                width:100%!important;
            }

            .select2-container .select2-selection {
                height: 100%; /* Ensure the height matches the original select element */
                width: 100%;
                border: 1px solid #b0bec5; /* Match the border style */
                border-radius: 7px;
                padding: 0.75rem; /* Adjust padding to match the original select */
                font-size: 0.875rem;
                color: #607d8b;
                background-color: transparent;
            }
    
            .select2-container--default .select2-selection--single .select2-selection__rendered {
                line-height: normal; /* Ensure text is vertically centered */
            }
    
            .select2-container--default .select2-selection--single .select2-selection__arrow {
                height: 100%; /* Match the height of the selection */
            }
        </style>
    </head>
    <body class="font-sans antialiased flex">
        @include('sweetalert::alert')
        @include('layouts.sidebar')
        <main class="flex-auto text-gray-700 h-screen overflow-y-scroll">
            {{ $slot }}
        </main>
    </body>
</html>
