<x-app-layout>
    <div class="p-6">

        <h1 class="text-xl font-bold mb-4">Commandes fournisseurs</h1>

        <a href="{{ route('commandes.create') }}" class="text-blue-600">
            + Nouvelle commande
        </a>

        <table class="w-full mt-4 border">
            <thead>
            <tr>
                <th>Fournisseur</th>
                <th>Date</th>
                <th>Statut</th>
                <th>Action</th>
            </tr>
            </thead>

            <tbody>
            @foreach($commandes as $commande)
                <tr>
                    <td>{{ $commande->fournisseur->nom }}</td>
                    <td>{{ $commande->date_commande }}</td>
                    <td>{{ $commande->statut_commande }}</td>

                    <td>
                        <form method="POST"
                              action="{{ route('commandes.update', $commande->id_commande) }}">
                            @csrf

                            <select name="statut_commande">
                                <option value="en_attente">En attente</option>
                                <option value="livree">Livrée</option>
                            </select>

                            <button class="text-green-600">OK</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
</x-app-layout>
