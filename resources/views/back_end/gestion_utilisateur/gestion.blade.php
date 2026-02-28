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
                    <form action="{{ route('users.delete', $user->id) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                onclick="return confirm('Supprimer cet utilisateur ?')">
                            Supprimer
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>


    <form action="{{ route('users.store') }}" method="POST">
        @csrf

        <label>Nom</label>
        <input type="text" name="uti_nom" required/>

        <label>Adresse mail</label>
        <input type="email" name="email" required minlength="5"/>

        <label>Mot de passe</label>
        <input
            type="password"
            name="password"
            required
            minlength="5"
            pattern="(?=.*[a-zA-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{5,}"
            title="Au moins 5 caractères, une lettre, un chiffre et un caractère spécial"
        />

        <label>Rôles</label>
        <select name="role_id" id="role_id">
            @foreach($roles as $role)
                <option value="{{ $role->id_role }}">
                    {{ $role->libelle_ }}
                </option>
            @endforeach
        </select>

        <button type="submit">Ajouter</button>
    </form>

</x-app-layout>
