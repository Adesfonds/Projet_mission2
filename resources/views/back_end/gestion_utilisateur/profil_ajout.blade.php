<form action="{{ route('utilisateur.store') }}" method="POST">
    @csrf

    <label>Nom</label>
    <input type="text" name="uti_nom" required/>

    <label>Adresse mail</label>
    <input type="email" name="email" required minlength="5"/>

    <label>Mot de passe</label>
    <input type="password" name="password" required minlength="5"/>

    <label>Rôles</label>
    <select name="role_id" id="role_id">
        @foreach($roles as $role)
            <option value="{{ $role->id_role }}">
                {{ $role->libelle }}
            </option>
        @endforeach
    </select>

    <button type="submit">Ajouter</button>
</form>
