<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(["resources/js/app.js"])
    <title>{{ $name }}</title>
</head>
<body>
    <img src="{{asset('user.png')}}" alt="logo" width="100" height="100">
    <h1>Welcome {{$name}}, {{$email}} </h1>
    <p>
        confirm your email by clicking on the link below
    </p>
    <a href="{{ $href }}" class="btn btn-primary">Confirm your account</a>
</body>
</html>