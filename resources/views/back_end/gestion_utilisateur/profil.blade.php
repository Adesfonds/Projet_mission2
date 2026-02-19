<h1>Profil de {{ $utilisateur->uti_nom }}</h1>

<p>Email : {{ $utilisateur->email }}</p>
<p>Rôle : {{ $utilisateur->role->libelle ?? '—' }}</p>

<a href="{{ route('gestion_utilisateur') }}">Retour à la liste</a>

@php
    $sessionUser = session('utilisateur');
    $sessionUserModel = null;

    if($sessionUser && isset($sessionUser->id_uti)) {
        $sessionUserModel = \App\Models\Utilisateur::with('role')->find($sessionUser->id_uti);
    }
@endphp

@if($sessionUserModel && $sessionUserModel->role && $sessionUserModel->role->libelle === 'Admin')
    <form action="{{ route('utilisateur.update', $utilisateur->id_uti) }}" method="POST" style="margin-top:20px;">
        @csrf
        @method('PUT')

        <label for="role_id">Changer le rôle :</label>
        <select name="role_id" id="role_id">
            @foreach($roles as $role)
                <option value="{{ $role->id_role }}" {{ $utilisateur->id_roles == $role->id_role ? 'selected' : '' }}>
                    {{ $role->libelle }}
                </option>
            @endforeach
        </select>

        <button type="submit">Mettre à jour</button>
    </form>
@endif
