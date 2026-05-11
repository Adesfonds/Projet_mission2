<x-app-layout>
    <div class="p-6">

        <h1 class="text-xl font-bold mb-4">Relevés de terrain</h1>

        {{-- FILTRES --}}
        <form method="GET" action="{{ route('releves_terrain') }}" class="mb-6 flex gap-4 flex-wrap">

            <input type="date" name="date" value="{{ request('date') }}" class="border p-2 rounded">

            <select name="type_capteur" class="border p-2 rounded">
                <option value="">Tous types</option>
                @foreach($types as $type)
                    <option value="{{ $type }}" @selected(request('type_capteur') == $type)>
                        {{ $type }}
                    </option>
                @endforeach
            </select>

            <select name="localisation" class="border p-2 rounded">
                <option value="">Toutes localisations</option>
                @foreach($localisations as $loc)
                    <option value="{{ $loc }}" @selected(request('localisation') == $loc)>
                        {{ $loc }}
                    </option>
                @endforeach
            </select>

            <button class="bg-blue-600 text-white px-4 py-2 rounded">Filtrer</button>
            <a href="{{ route('releves_terrain') }}" class="px-4 py-2 bg-gray-200 rounded">Reset</a>
        </form>

        {{-- CAPTEURS --}}
        <h2 class="font-semibold mb-2">Capteurs</h2>
        <table class="w-full border mb-6 text-sm">
            <thead>
            <tr class="bg-gray-100">
                <th>ID</th><th>Type</th><th>Modèle</th><th>Localisation</th>
            </tr>
            </thead>
            <tbody>
            @forelse($capteurs as $capteur)
                <tr class="border-t">
                    <td>{{ $capteur->id_capt }}</td>
                    <td>{{ $capteur->type_capteur }}</td>
                    <td>{{ $capteur->modele_ ?? '-' }}</td>
                    <td>{{ $capteur->localisation ?? '-' }}</td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center p-3">Aucun capteur</td></tr>
            @endforelse
            </tbody>
        </table>

        {{-- COLLECTES --}}
        <h2 class="font-semibold mb-2">Collectes</h2>
        <table class="w-full border text-sm">
            <thead>
            <tr class="bg-gray-100">
                <th>Capteur</th>
                <th>Horodatage</th>
                <th>Valeur</th>
                <th>Unité</th>
            </tr>
            </thead>
            <tbody>
            @forelse($collectes as $collecte)
                <tr class="border-t">
                    <td>{{ $collecte->id_capt }}</td>
                    <td>{{ $collecte->mesure->horodatage ?? '-' }}</td>
                    <td>{{ $collecte->mesure->valeur ?? '-' }}</td>
                    <td>{{ $collecte->mesure->unite ?? '-' }}</td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center p-3">Aucune collecte</td></tr>
            @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $collectes->withQueryString()->links() }}
        </div>

    </div>
</x-app-layout>
