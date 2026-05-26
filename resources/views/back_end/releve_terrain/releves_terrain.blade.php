<x-app-layout>
    <div class="p-6 space-y-6">

        <h1 class="text-2xl font-bold text-gray-800">
            Relevés de terrain
        </h1>

        {{-- FILTRES --}}
        <form method="GET" action="{{ route('releves_terrain') }}"
              class="bg-white p-4 rounded-lg shadow flex flex-wrap gap-4 items-end">

            <div>
                <label class="text-sm text-gray-600">Date</label>
                <input type="date"
                       name="date"
                       value="{{ request('date') }}"
                       class="border p-2 rounded w-full">
            </div>

            <div>
                <label class="text-sm text-gray-600">Type capteur</label>
                <select name="type_capteur" class="border p-2 rounded w-full">
                    <option value="">Tous types</option>
                    @foreach($types as $type)
                        <option value="{{ $type }}" @selected(request('type_capteur') == $type)>
                            {{ $type }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="text-sm text-gray-600">Localisation</label>
                <select name="localisation" class="border p-2 rounded w-full">
                    <option value="">Toutes localisations</option>
                    @foreach($localisations as $loc)
                        <option value="{{ $loc }}" @selected(request('localisation') == $loc)>
                            {{ $loc }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Filtrer
            </button>

            <a href="{{ route('releves_terrain') }}"
               class="bg-gray-200 px-4 py-2 rounded hover:bg-gray-300">
                Reset
            </a>

        </form>

        {{-- CAPTEURS --}}
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="px-4 py-3 border-b font-semibold text-gray-700">
                Capteurs
            </div>

            <table class="w-full text-sm">
                <thead class="bg-gray-100 text-left">
                <tr>
                    <th class="p-3">ID</th>
                    <th>Type</th>
                    <th>Modèle</th>
                    <th>Localisation</th>
                </tr>
                </thead>

                <tbody>
                @forelse($capteurs as $capteur)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="p-3">{{ $capteur->id_capt }}</td>
                        <td>{{ $capteur->type_capteur }}</td>
                        <td>{{ $capteur->modele_ ?? '-' }}</td>
                        <td>{{ $capteur->localisation ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center p-4 text-gray-500">
                            Aucun capteur
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        {{-- COLLECTES --}}
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="px-4 py-3 border-b font-semibold text-gray-700">
                Collectes
            </div>

            <table class="w-full text-sm">
                <thead class="bg-gray-100 text-left">
                <tr>
                    <th class="p-3">Capteur</th>
                    <th>Horodatage</th>
                    <th>Valeur</th>
                    <th>Unité</th>
                </tr>
                </thead>

                <tbody>
                @forelse($collectes as $collecte)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="p-3">{{ $collecte->id_capt }}</td>
                        <td>{{ $collecte->mesure->horodatage ?? '-' }}</td>
                        <td>{{ $collecte->mesure->valeur ?? '-' }}</td>
                        <td>{{ $collecte->mesure->unite ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center p-4 text-gray-500">
                            Aucune collecte
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        <div>
            {{ $collectes->withQueryString()->links() }}
        </div>

    </div>
</x-app-layout>
