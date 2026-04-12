<x-app-layout>
    <div class="p-6">

        <h2 class="text-xl font-bold mb-4">Liste des bons de transport</h2>

        <table class="table-auto w-full border border-gray-300">
            <thead class="bg-gray-100">
            <tr>
                <th class="border px-4 py-2">Nom</th>
            </tr>
            </thead>
            <tbody>
            @forelse($files as $file)
                <tr>
                    <td class="border px-4 py-2">
                        {{ basename($file) }}
                    </td>

                    <td class="border px-4 py-2">
                        <a href="{{ asset('storage/' . $file) }}" target="_blank">
                            Voir
                        </a>
                        |
                        <a href="{{ asset('storage/' . $file) }}" download>
                            Télécharger
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="2">Aucun fichier</td>
                </tr>
            @endforelse
            </tbody>
        </table>

    </div>
</x-app-layout>
