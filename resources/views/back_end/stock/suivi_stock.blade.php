<x-app-layout>
    <div class="max-w-7xl mx-auto p-6">

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">
                📊 Suivi des mouvements de stock
            </h1>

            <a href="{{ route('stock.index') }}"
               class="bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-700">
                ← Retour inventaire
            </a>
        </div>

        <div class="bg-white shadow rounded-xl overflow-hidden">

            <table class="w-full text-sm text-left">
                <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                <tr>
                    <th class="px-6 py-3">Type</th>
                    <th class="px-6 py-3">Matériel</th>
                    <th class="px-6 py-3">Quantité</th>
                    <th class="px-6 py-3">Utilisateur</th>
                    <th class="px-6 py-3">Date</th>
                </tr>
                </thead>

                <tbody class="divide-y">

                @forelse($mouvements as $mouvement)
                    <tr class="hover:bg-gray-50 transition">

                        <!-- Type -->
                        <td class="px-6 py-4">
                            @if($mouvement->type_mouvement == 'entree')
                                <span class="flex items-center gap-1 text-green-700 bg-green-100 px-2 py-1 rounded-full text-xs font-semibold w-fit">
                                    ⬆ Entrée
                                </span>
                            @else
                                <span class="flex items-center gap-1 text-red-700 bg-red-100 px-2 py-1 rounded-full text-xs font-semibold w-fit">
                                    ⬇ Sortie
                                </span>
                            @endif
                        </td>

                        <!-- Matériel -->
                        <td class="px-6 py-4 font-medium text-gray-800">
                            {{ $mouvement->materiel->nom ?? 'N/A' }}
                        </td>

                        <!-- Quantité -->
                        <td class="px-6 py-4 font-bold">
                            {{ $mouvement->quantite }}
                        </td>

                        <!-- Utilisateur -->
                        <td class="px-6 py-4 text-gray-600">
                            👤 {{ $mouvement->utilisateur->name ?? 'N/A' }}
                        </td>

                        <!-- Date -->
                        <td class="px-6 py-4 text-gray-500">
                            {{ \Carbon\Carbon::parse($mouvement->date_mouvement)->format('d/m/Y H:i') }}
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-6 text-gray-500">
                            Aucun mouvement trouvé
                        </td>
                    </tr>
                @endforelse

                </tbody>
            </table>

        </div>
    </div>
</x-app-layout>
