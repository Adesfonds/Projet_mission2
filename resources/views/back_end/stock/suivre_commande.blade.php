<x-app-layout>
    <div class="p-6">

        <h1 class="text-xl font-bold mb-4">Suivi des commandes fournisseurs</h1>
        <div class="mb-4">
            <form method="GET" action="{{ route('commandes.index') }}" class="flex gap-2">

                <div class="relative flex-1">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                    </div>

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Rechercher commande, fournisseur ou statut..."
                        class="w-full border rounded pl-10 pr-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                </div>

                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Rechercher
                </button>

            </form>
        </div>

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
    <span class="px-2 py-1 rounded text-white text-sm
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
