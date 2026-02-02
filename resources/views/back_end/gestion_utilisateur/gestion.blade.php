<h1>Gestion des utilisateurs</h1>

<a href="{{ route('utilisateur_ajout') }}" class="btn btn-secondary">
    Ajouter un utilisateur
</a>



<table border="1">
    <thead>
    <tr>
        <th>Nom</th>
        <th>Email</th>
        <th>Rôle</th>
    </tr>
    </thead>
    <tbody>
    @foreach($utilisateurs as $utilisateur)
        <tr>
            <td>
                <a href="{{ route('gestion_utilisateur.profil', $utilisateur) }}">
                    {{ $utilisateur->uti_nom }}
                </a>
            </td>

            <td>{{ $utilisateur->email }}</td>
            <td>{{ $utilisateur->role->libelle ?? '—' }}</td>

            <td><form action="{{ route('utilisateur.delete', $utilisateur) }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Voulez-vous vraiment supprimer cet utilisateur ?')">
                    Supprimer
                </button>
            </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<a href="{{ route('tableau_bord') }}" class="btn btn-secondary">
    Retour
</a>
