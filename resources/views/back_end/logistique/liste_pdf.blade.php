<x-app-layout>

    <div class="max-w-7xl mx-auto py-10 px-6 space-y-6">

        {{-- TITLE --}}
        <div>
            <h2 class="text-2xl font-bold text-gray-800">
                Liste des bons de transport
            </h2>
            <p class="text-sm text-gray-500">
                Gestion et téléchargement des documents logistiques
            </p>
        </div>

        {{-- SEARCH --}}
        <div class="bg-white shadow-sm rounded-2xl border border-gray-100 p-5">

            <form method="GET" action="{{ route('logistique.liste_pdf') }}"
                  class="flex flex-col md:flex-row gap-3">

                <div class="relative flex-1">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                        🔎
                    </span>

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Rechercher un bon de transport..."
                        class="w-full pl-10 pr-4 py-2 border rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    >
                </div>

                <button type="submit"
                        class="bg-blue-600 text-white px-5 py-2 rounded-xl hover:bg-blue-700 transition">
                    Rechercher
                </button>

                @if(request('search'))
                    <a href="{{ route('logistique.liste_pdf') }}"
                       class="bg-gray-100 text-gray-700 px-5 py-2 rounded-xl hover:bg-gray-200 transition text-center">
                        Réinitialiser
                    </a>
                @endif

            </form>

        </div>

        {{-- TABLE --}}
        <div class="bg-white shadow-lg rounded-2xl border border-gray-100 overflow-hidden">

            <table class="w-full text-sm text-left">

                <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                <tr>
                    <th class="p-4">Nom du fichier</th>
                    <th class="p-4 text-right">Actions</th>
                </tr>
                </thead>

                <tbody class="divide-y">

                @forelse($files as $file)
                    <tr class="hover:bg-gray-50 transition">

                        <td class="p-4 font-medium text-gray-800">
                            {{ basename($file) }}
                        </td>

                        <td class="p-4 text-right space-x-3">

                            <a href="{{ asset('storage/' . $file) }}"
                               target="_blank"
                               class="text-blue-600 hover:text-blue-800 font-medium">
                                Voir
                            </a>

                            <a href="{{ asset('storage/' . $file) }}"
                               download
                               class="text-green-600 hover:text-green-800 font-medium">
                                Télécharger
                            </a>

                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="text-center py-10 text-gray-500">
                            Aucun fichier disponible
                        </td>
                    </tr>
                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</x-app-layout>
