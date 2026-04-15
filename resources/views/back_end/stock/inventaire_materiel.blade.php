<x-app-layout>
    <div class="p-6">

        <h2 class="text-xl font-bold mb-4">Inventaire des matériels</h2>

        <table class="table-auto w-full border border-gray-300">
            <thead class="bg-gray-100">
            <tr>
                <th class="border px-4 py-2">Nom</th>
                <th class="border px-4 py-2">Description</th>
                <th class="border px-4 py-2">Stock</th>
                <th class="border px-4 py-2">Seuil Alerte</th>
                <th class="border px-4 py-2">Statut</th>
                <th class="border px-4 py-2">Actions</th>
            </tr>
            </thead>

            <tbody>
            @forelse($materiels as $materiel)
                <tr class="text-center">
                    <td class="border px-4 py-2">{{ $materiel->nom }}</td>
                    <td class="border px-4 py-2">{{ $materiel->description }}</td>
                    <td class="border px-4 py-2">{{ $materiel->stock }}</td>
                    <td class="border px-4 py-2">{{ $materiel->seuil_alerte }}</td>

                    <td class="border px-4 py-2">
                        @if($materiel->stock <= $materiel->seuil_alerte)
                            <span class="text-red-600 font-bold">⚠️ Stock faible</span>
                        @else
                            <span class="text-green-600">OK</span>
                        @endif
                    </td>

                    <td class="border px-4 py-2">

                        <a href="{{ route('stock.show', $materiel->id_materiel) }}"
                           class="text-blue-600">
                            Voir
                        </a>

                        |

                        <form action="{{ route('stock.delete', $materiel->id_materiel) }}"
                              method="POST"
                              class="inline">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="text-red-600">
                                Supprimer
                            </button>
                        </form>

                    </td>
                </tr>

            @empty
                <tr>
                    <td colspan="6" class="text-center py-4">
                        Aucun matériel disponible
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>

    </div>
</x-app-layout>
