<!-- resources/views/includes/menu.blade.php -->

<!-- Accueil -->
<div class="menu">
<a href="{{ url('') }}" class="btn">Accueil</a>


<a href="{{ route('login') }}" class="btn">Espace pro </a>

<!-- Présentation -->
<select name="presentation" id="present-select" onchange="if(this.value) window.location.href=this.value;">
    <option value="">Présentation de l'entreprise</option>
    <option value="{{ url('presentation/histoire') }}">Histoire</option>
    <option value="{{ url('presentation/entreprise') }}">L'entreprise</option>
    <option value="{{ url('presentation/equipe') }}">Équipe</option>
</select>

<!-- Actualités -->
<a href="{{ url('actualites') }}" class="btn">Actualités</a>

<!-- Partenariats -->

    <a href="{{ url('partenariats/nos') }}">Nos partenaires</a>

<!-- Contact -->
<a href="{{ url('contact') }}" class="btn">Contact</a>

<!-- Rapports environnementaux -->
    <!-- Rapports environnementaux -->
    <select name="rapports" id="environnementaux-select"
            onchange="if (this.value) window.location.href = this.value;">

        <option value="">-- Rapports environnementaux --</option>

        <option value="{{ route('rapports.mensuel') }}">
            Rapports mensuels
        </option>

        <option value="{{ route('rapports.trimestriel') }}">
            Rapports trimestriels
        </option>

        <option value="{{ route('rapports.archive') }}">
            Archives
        </option>

    </select>
