<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestion des utilisateurs') }}
        </>
    </x-slot>



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
        <input
            type="text"
            name="name"
            required
            maxlength="255"
        />

        <label>Adresse mail</label>
        <input
            type="email"
            name="email"
            required
        />

        <label>Mot de passe</label>
        <input
            type="password"
            name="password"
            required
            minlength="5"
            pattern="(?=.*[a-zA-Z])(?=.*\d)(?=.*[@$!%*?&]).{5,}"
            title="Minimum 5 caractères, au moins une lettre, un chiffre et un caractère spécial"
        />

        <label>Rôle</label>
        <select name="role_id" required>
            <option value="">-- Choisir un rôle --</option>
            @foreach($roles as $role)
                <option value="{{ $role->id_role }}">
                    {{ $role->libelle_ }}
                </option>
            @endforeach
        </select>

        <button type="submit">Ajouter</button>
    </form>
    @foreach($users as $user)
        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label>Nom</label>
            <input type="text" name="name" value="{{ $user->name }}" required>

            <label>Email</label>
            <input type="email" name="email" value="{{ $user->email }}" required>

            <label>Rôle</label>
            <select name="role_id" required>
                @foreach($roles as $role)
                    <option value="{{ $role->id_role }}"
                        {{ $user->id_roles == $role->id_role ? 'selected' : '' }}>
                        {{ $role->libelle_ }}
                    </option>
                @endforeach
            </select>

            <label>Nouveau mot de passe</label>
            <input type="password" name="password">

            <label>Confirmer mot de passe</label>
            <input type="password" name="password_confirmation">

            <button type="submit">Mettre à jour</button>
        </form>
    @endforeach

</x-app-layout>
