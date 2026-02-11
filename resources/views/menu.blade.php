
<!-- resources/views/includes/menu.blade.php -->
<a href="{{ url('') }}">
    <button>Accueil</button>
</a>
<a href="{{ url('connexion') }}">
    <button>Espace Pro</button>
</a>

<select name="presentation" id="present-select" onchange="location = this.value;">
    <option value="">Présentation de l'entreprise</option>
    <option value="{{ url('histoire') }}">Histoire</option>
    <option value="{{ url('entreprise') }}">L'entreprise</option>
    <option value="{{ url('equipe') }}">Équipe</option>
</select>

<a href="{{ url('Actualites') }}">
    <button>Actualités</button>
</a>

<select name="partenariats" id="partenariats-select" onchange="location = this.value;">
    <option value="">Partenariats</option>
    <option value="{{ url('Partenaire') }}">Nos partenaires</option>
    <option value="{{ url('Demandes') }}">Demande de partenariat</option>
</select>

<a href="{{ url('contact') }}">
    <button>Contact</button>
</a>

<select name="rapports" id="environnementaux-select" onchange="location = this.value;">
    <option value="">Rapports environnementaux</option>
    <option value="{{ url('Rapport/Mensuels') }}">Rapports mensuels</option>
    <option value="{{ url('Rapport/Trimestriel') }}">Rapports trimestriels</option>
    <option value="{{ url('Rapport/archive') }}">Archives</option>
</select>
