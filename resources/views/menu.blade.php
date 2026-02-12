<!-- resources/views/includes/menu.blade.php -->

<!-- Accueil -->
<a href="{{ url('') }}" class="btn">Accueil</a>

<!-- Espace Pro -->
<a href="{{ route('login') }}" class="btn">Espace Pro</a>

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
<select name="partenariats" id="partenariats-select" onchange="if(this.value) window.location.href=this.value;">
    <option value="">Partenariats</option>
    <option value="{{ url('partenariats/nos') }}">Nos partenaires</option>
    <option value="{{ url('partenariats/demandes') }}">Demande de partenariat</option>
</select>

<!-- Contact -->
<a href="{{ url('contact') }}" class="btn">Contact</a>

<!-- Rapports environnementaux -->
<select name="rapports" id="environnementaux-select" onchange="if(this.value) window.location.href=this.value;">
    <option value="">Rapports environnementaux</option>
    <option value="{{ url('rapport/mensuels') }}">Rapports mensuels</option>
    <option value="{{ url('rapport/trimestriel') }}">Rapports trimestriels</option>
    <option value="{{ url('rapport/archive') }}">Archives</option>
</select>
