<!DOCTYPE html>
<html>
    <head>
        <title>Liste des Utilisateurs</title>
    </head>
    <body>
        <h1>Liste des Utilisateurs</h1>
        <ul>
            @foreach($users as $user)
                <li>#{{ $user->id }}- {{ $user->name }} - {{ $user->email }}</li>
            @endforeach
        </ul>
    </body>
</html>