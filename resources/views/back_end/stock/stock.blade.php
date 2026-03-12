<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestion des Stocks - VEM') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if($materiels->where('stock', '<=', 'seuil_alerte')->count() > 0)
                    <div class="mb-4 p-4 bg-red-100 border-l-4 border-red-500 text-red-700">
                        <strong>Attention :</strong> Certaines pièces de la foreuse sont sous le seuil critique !
                    </div>
                @endif

                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock Actuel</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Seuil Alerte</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($materiels as $materiel)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $materiel->nom }}</td>
                            <td class="px-6 py-4 whitespace-nowrap font-bold">{{ $materiel->stock }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-500">{{ $materiel->seuil_alerte }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($materiel->stock <= $materiel->seuil_alerte)
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        Critique
                                    </span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Ok
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('materiel.show', $materiel->id_materiel) }}" class="text-indigo-600 hover:text-indigo-900">Détails</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>
