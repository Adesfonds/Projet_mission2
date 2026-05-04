<x-app-layout>
    <div class="p-6">

        <h2 class="text-xl font-bold mb-4">Inventaire des matériels</h2>

        {{-- Messages --}}
        @if(session('success'))
            <div class="bg-green-200 p-2 mb-2">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="bg-red-200 p-2 mb-2">{{ session('error') }}</div>
        @endif

        @if(session('warning'))
            <div class="bg-yellow-200 p-2 mb-2">{{ session('warning') }}</div>
        @endif

        {{-- Recherche --}}
        <form method="GET" action="{{ route('stock.index') }}" class="mb-4">
            <input
                type="text"
                name="search"
                placeholder="Rechercher un matériel..."
                value="{{ request('search') }}"
                class="border p-2 w-full"
            >

            <button type="submit" class="mt-2 bg-blue-600 text-white px-4 py-2">
                Rechercher
            </button>
        </form>

        {{-- Créer --}}
        <a href="{{ route('stock.create') }}" class="text-blue-600 mb-4 inline-block">
            Créer
        </a>

        {{-- TABLEAU --}}
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

                        <!-- Voir -->
                        <a href="{{ route('stock.show', $materiel->id_materiel) }}"
                           class="text-blue-600">
                            Voir
                        </a>

                        |

                        <!-- Supprimer -->
                        <form action="{{ route('stock.delete', $materiel->id_materiel) }}"
                              method="POST"
                              class="inline">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="text-red-600">
                                Supprimer
                            </button>
                        </form>

                        <br><br>

                        <!-- Entrée -->
                        <form method="POST"
                              action="{{ route('stock.entree', $materiel->id_materiel) }}"
                              class="inline">
                            @csrf
                            <input type="number"
                                   name="quantite"
                                   min="1"
                                   step="1"
                                   class="w-16 border"
                                   placeholder="+"
                                   required>
                            <button class="text-green-600">+</button>
                        </form>

                        <!-- Sortie -->
                        <form method="POST"
                              action="{{ route('stock.sortie', $materiel->id_materiel) }}"
                              class="inline">
                            @csrf
                            <input type="number"
                                   name="quantite"
                                   class="w-16 border"
                                   min="1"
                                   step="1"
                                   placeholder="-"
                                   required>
                            <button class="text-red-600">-</button>
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
