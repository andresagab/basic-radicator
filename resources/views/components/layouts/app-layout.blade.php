<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- styles --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @livewireStyles

    {{-- scripts --}}
    <script src="{{ mix('js/app.js') }}" defer></script>

</head>
<body>

<div class="min-h-screen bg-gray-100">

    {{-- nav --}}
    @include('nav.navbar')

    {{-- main --}}
    <main>
        {{ $slot }}
    </main>

</div>

@stack('modals')

@livewireScripts

</body>
</html>
