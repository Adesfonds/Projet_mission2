<x-app-layout>
    <div class="p-6">

        <h1 class="text-xl font-bold mb-4">Suivi des commandes fournisseurs</h1>

        <table class="w-full mt-4 border">
            <thead class="bg-gray-100">
            <tr>
                <th class="border p-2">ID</th>
                <th class="border p-2">Fournisseur</th>
                <th class="border p-2">Date</th>
                <th class="border p-2">Statut</th>
            </tr>
            </thead>

            <tbody>
            @forelse($commandes as $commande)
                <tr class="border text-center">

                    {{-- ID --}}
                    <td class="p-2">
                        {{ $commande->id_commande }}
                    </td>

                    {{-- Fournisseur --}}
                    <td class="p-2">
                        {{ $commande->fournisseur->nom ?? 'Non défini' }}
                    </td>

                    {{-- Date --}}
                    <td class="p-2">
                        {{ $commande->date_commande }}
                    </td>

                    {{-- Statut corrigé --}}
                    <td class="p-2">
                        <span >
                            {{ $commande->statut_commande == 'livree' ? 'bg-green-500' : 'bg-orange-500' }}">
                            {{ $commande->statut_commande }}
                        </span>
                    </td>


                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center p-4">
                        Aucune commande trouvée
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>

    </div>
</x-app-layout>
