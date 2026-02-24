<h2>Gestion des utilisateurs</h2>

<table border="1" cellpadding="10">
    <thead>
    <tr>
        <th>Nom</th>
        <th>Email</th>
        <th>Rôle</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->role->libelle_ }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
