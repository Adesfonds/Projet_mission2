<h1>Tableau de bord</h1>

<p>Utilisateur : {{ $user->uti_nom }} (Rôle : {{ $user->role->libelle }})</p>

<div>
    @php
        // Définir les pages accessibles selon le rôle
        $pagesParRole = [
            'Admin' => [
                ['name' => 'Gestion des utilisateurs', 'route' => 'gestion_utilisateur'],
                ['name' => 'Journalisation', 'route' => 'journal'],
                ['name' => 'Relevés de terrain', 'route' => 'releves_terrain']
            ],
            'Technicien' => [
                ['name' => 'Relevés de terrain', 'route' => 'releves_terrain'],
                ['name' => 'Journalisation', 'route' => 'journal']
            ],
            'Logisticien' => [
                ['name' => 'Logistique', 'route' => 'logistique'],
                ['name' => 'Stock', 'route' => 'stock']
            ],
            'Direction' => [
                ['name' => 'Gestion des utilisateurs', 'route' => 'gestion_utilisateur'],
                ['name' => 'Journalisation', 'route' => 'journal'],
                ['name' => 'Logistique', 'route' => 'logistique'],
                ['name' => 'Stock', 'route' => 'stock'],
                ['name' => 'Relevés de terrain', 'route' => 'releves_terrain']
            ]
        ];

        $pages = $pagesParRole[$user->role->libelle] ?? [];
    @endphp

    @foreach($pages as $page)
        <a href="{{ route($page['route']) }}">
            <button>{{ $page['name'] }}</button>
        </a>
    @endforeach
</div>
