<!DOCTYPE html>
<html>
    <head>
        <title>Utilisateurs Filtrés</title>
    </head>
    <body>
        <h1>Utilisateurs Filtrés</h1>
        <ul>
            @foreach($users as $user)
                <li>{{ $user->name }} - {{ $user->email }}</li>
            @endforeach
        </ul>
    </body>
</html>