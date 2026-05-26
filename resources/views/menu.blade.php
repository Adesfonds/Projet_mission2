<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500&family=Playfair+Display:wght@600&display=swap" rel="stylesheet">
@vite(['resources/css/app.css'])
<nav class="menu">
    <a href="{{ url('') }}" class="btn">Accueil</a>

    <select name="presentation" id="present-select"
            onchange="if(this.value) window.location.href=this.value;">
        <option value="">Présentation de l'entreprise</option>
        <option value="{{ url('presentation/histoire') }}">Histoire</option>
        <option value="{{ url('presentation/entreprise') }}">L'entreprise</option>
        <option value="{{ url('presentation/equipe') }}">Équipe</option>
    </select>

    <a href="{{ url('actualites') }}" class="btn">Actualités</a>

    <a href="{{ url('partenariats/nos') }}" class="btn">Nos partenaires</a>

    <a href="{{ url('contact') }}" class="btn">Contact</a>

    <select name="rapports" id="environnementaux-select"
            onchange="if(this.value) window.location.href=this.value;">
        <option value="">Rapports environnementaux</option>
        <option value="{{ route('rapports.mensuel') }}">Rapports mensuels</option>
        <option value="{{ route('rapports.trimestriel') }}">Rapports trimestriels</option>
        <option value="{{ route('rapports.archive') }}">Archives</option>
    </select>

    <a href="{{ route('login') }}" class="btn btn--pro">Espace pro</a>

</nav>
