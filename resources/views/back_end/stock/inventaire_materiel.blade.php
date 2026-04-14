<x-app-layout>
    <div class="p-6">

        <h2 class="text-xl font-bold mb-4">Liste des matériels</h2>

        <table class="table-auto w-full border border-gray-300">
            <thead class="bg-gray-100">
            <tr>
                <th class="border px-4 py-2">Nom</th>
                <th class="border px-4 py-2">Description</th>
                <th class="border px-4 py-2">Stock</th>
                <th class="border px-4 py-2">Seuil Alerte</th>
            </tr>
            </thead>

            <tbody>
            @forelse($materiels as $materiel)
                <tr class="text-center">
                    <td class="border px-4 py-2">{{ $materiel->nom }}</td>
                    <td class="border px-4 py-2">{{ $materiel->description }}</td>
                    <td class="border px-4 py-2">{{ $materiel->stock }}</td>
                    <td class="border px-4 py-2">{{ $materiel->seuil_alerte }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center py-4">
                        Aucun matériel disponible
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>

    </div>
</x-app-layout>
