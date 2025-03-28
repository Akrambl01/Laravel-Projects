<!DOCTYPE html>
<html lang="en">
<head>
    <title>name and email </title>
</head>
<body>
    <h1>name and email</h1>
    <ul>
        @foreach($users as $user)
            <li>name : {{ $user->name }} - email: {{ $user->email }}</li>
        @endforeach
    </ul>
</body>
</html>