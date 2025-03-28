<!DOCTYPE html>
<html>
    <head>
        <title>Utilisateurs avec Contacts et Commandes</title>
    </head>
    <body>
        <h1>Utilisateurs avec Contacts et Commandes</h1>
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Prix de Commande</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->price }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </body>
</html>