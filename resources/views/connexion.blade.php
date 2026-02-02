<form method="POST" action="{{ route('login') }}">
    @csrf

    <div>
        <label for="email">Adresse mail :</label>
        <input
            type="email"
            id="email"
            name="email"
            value="{{ old('email') }}"
            required
        />
    </div>

    <div>
        <label for="password">Mot de passe :</label>
        <input
            type="password"
            id="password"
            name="password"
            minlength="5"
            required
        />
    </div>

    <button type="submit">Se connecter</button>
</form>

{{-- Affichage des erreurs --}}
@if ($errors->any())
    <div style="color:red; margin-top:10px;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- Message flash pour erreurs de connexion --}}
@if (session('error'))
    <div style="color:red; margin-top:10px;">
        {{ session('error') }}
    </div>
@endif
