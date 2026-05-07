<x-app-layout>
    <div class="p-6">

        <h1 class="text-xl font-bold mb-4">Suivi des commandes</h1>

        <table class="w-full mt-4 border">
            <thead>
            <tr>
                <th class="border p-2">ID</th>
                <th class="border p-2">Fournisseur</th>
                <th class="border p-2">Date</th>
                <th class="border p-2">Statut</th>
                <th class="border p-2">Nb matériels</th>

            </tr>
            </thead>

            <tbody>
            @forelse($commandes as $commande)
                <tr class="border">

                    {{-- ID commande --}}
                    <td class="p-2">
                        {{ $commande->id_commande }}
                    </td>

                    {{-- Fournisseur --}}
                    <td class="p-2">
                        {{ $commande->fournisseur->nom ?? 'Aucun fournisseur' }}
                    </td>

                    {{-- Date --}}
                    <td class="p-2">
                        {{ $commande->date_commande }}
                    </td>

                    {{-- Statut --}}
                    <td class="p-2">

                            {{ $commande->statut_commande == 'livree' ? 'bg-green-500' : 'bg-orange-500' }}">
                            {{ $commande->statut_commande }}

                    </td>

                    {{-- Nombre de matériels --}}
                    <td class="p-2">
                        {{ $commande->materiels->count() }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center p-4">
                        Aucune commande trouvée
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>

    </div>
</x-app-layout>
