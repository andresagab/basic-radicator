<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- styles --}}
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @livewireStyles

    {{-- scripts --}}
    <script src="{{ mix('js/app.js') }}" defer></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

<script>

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });

    Livewire.on('toast', function (title, icon) {
        Toast.fire({
            title: title,
            icon: icon,
        });
    });

</script>

</body>
</html>
