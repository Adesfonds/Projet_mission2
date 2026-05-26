<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Inventaire des matériels - VEM
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-8 px-6 space-y-6">

        {{-- MESSAGES --}}
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl">
                {{ session('error') }}
            </div>
        @endif

        @if(session('warning'))
            <div class="bg-yellow-50 border border-yellow-200 text-yellow-700 px-4 py-3 rounded-xl">
                {{ session('warning') }}
            </div>
        @endif

        {{-- HEADER ACTIONS --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

            <h3 class="text-lg font-semibold text-gray-700">
                Inventaire des matériels
            </h3>

            <div class="flex gap-3">

                <form method="GET" action="{{ route('stock.index') }}" class="flex gap-2">

                    <input type="text"
                           name="search"
                           value="{{ request('search') }}"
                           placeholder="Rechercher..."
                           class="w-64 border border-gray-200 rounded-xl px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">

                    <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-xl text-sm">
                        Rechercher
                    </button>

                </form>

                <a href="{{ route('stock.create') }}"
                   class="bg-gray-900 hover:bg-black text-white px-4 py-2 rounded-xl text-sm">
                    + Créer
                </a>

            </div>

        </div>

        {{-- TABLE --}}
        <div class="bg-white shadow-lg rounded-2xl border border-gray-100 overflow-hidden">

            <table class="w-full text-sm">

                <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                <tr>
                    <th class="p-4 text-left">Nom</th>
                    <th class="p-4 text-left">Description</th>
                    <th class="p-4">Stock</th>
                    <th class="p-4">Seuil</th>
                    <th class="p-4">Statut</th>
                    <th class="p-4">Actions</th>
                </tr>
                </thead>

                <tbody class="divide-y">

                @forelse($materiels as $materiel)

                    <tr class="hover:bg-gray-50 transition">

                        <td class="p-4 font-medium text-gray-800">
                            {{ $materiel->nom }}
                        </td>

                        <td class="p-4 text-gray-600">
                            {{ $materiel->description }}
                        </td>

                        <td class="p-4 text-center font-semibold">
                            {{ $materiel->stock }}
                        </td>

                        <td class="p-4 text-center">
                            {{ $materiel->seuil_alerte }}
                        </td>

                        <td class="p-4 text-center">

                            @if($materiel->stock <= $materiel->seuil_alerte)
                                <span class="px-3 py-1 text-xs rounded-full bg-red-100 text-red-700">
                                    ⚠ Stock faible
                                </span>
                            @else
                                <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700">
                                    OK
                                </span>
                            @endif

                        </td>

                        {{-- ACTIONS --}}
                        <td class="p-4 space-y-2">

                            <div class="flex gap-2 justify-center">

                                <a href="{{ route('stock.show', $materiel->id_materiel) }}"
                                   class="text-blue-600 text-sm hover:underline">
                                    Voir
                                </a>

                                <form action="{{ route('stock.delete', $materiel->id_materiel) }}"
                                      method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button class="text-red-600 text-sm hover:underline"
                                            onclick="return confirm('Supprimer ce matériel ?')">
                                        Supprimer
                                    </button>
                                </form>

                            </div>

                            {{-- ENTREE / SORTIE --}}
                            <div class="flex justify-center gap-2 mt-2">

                                <form method="POST"
                                      action="{{ route('stock.entree', $materiel->id_materiel) }}"
                                      class="flex gap-1">
                                    @csrf
                                    <input type="number"
                                           name="quantite"
                                           min="1"
                                           class="w-16 border border-gray-200 rounded px-1 text-center text-sm"
                                           placeholder="+">
                                    <button class="text-green-600 text-sm">+</button>
                                </form>

                                <form method="POST"
                                      action="{{ route('stock.sortie', $materiel->id_materiel) }}"
                                      class="flex gap-1">
                                    @csrf
                                    <input type="number"
                                           name="quantite"
                                           min="1"
                                           class="w-16 border border-gray-200 rounded px-1 text-center text-sm"
                                           placeholder="-">
                                    <button class="text-red-600 text-sm">-</button>
                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="6" class="p-6 text-center text-gray-500">
                            Aucun matériel disponible
                        </td>
                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</x-app-layout>
