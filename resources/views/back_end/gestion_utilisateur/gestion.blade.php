<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

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
                <td>
                <button class="favorite styled" type="button">Ajouter aux favoris</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>



</x-app-layout>
