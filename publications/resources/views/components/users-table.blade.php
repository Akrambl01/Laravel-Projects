@props(['users'])

<div>
    <p>ji</p>
<table class="table">
    <tr>
        <th>Id</th>
        <th>Nom</th>
        <th>Metier</th>
    </tr>

    @foreach ($users as $user)
    <tr>
        <td>{{$user['id']}}</td>
        <td>{{$user['nom']}}</td>
        <td>{{$user['metier']}}</td>
    @endforeach
</table>
</div>