<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- to install bootstrap to work without cdn : composer require laravel/ui and php artisan ui bootstrap , and npm install && npm run dev --}}
     @vite("resources/js/app.js", "resources/css/app.css") {{-- this line will import js and css files that contain bootstrap imported there form resources by vite --}}
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> --}}
    <title>@yield('title', "social net")</title>
</head>
<body>
    @include('partials.nav')
    <main >
        <div class="m-3">
            @yield('main')
        </div>
    </main>
    @include('partials.footer')
</body>
</html>