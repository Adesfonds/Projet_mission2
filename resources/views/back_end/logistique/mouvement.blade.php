<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Mouvements de minerai - VEM
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 px-6 space-y-8">

        {{-- ALERTS --}}
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-5 py-3 rounded-xl">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-50 border border-red-200 text-red-700 px-5 py-3 rounded-xl">
                {{ session('error') }}
            </div>
        @endif

        {{-- TABLE --}}
        <div class="bg-white shadow-lg rounded-2xl border border-gray-100 overflow-hidden">

            <div class="px-6 py-4 border-b bg-gray-50">
                <h3 class="text-lg font-semibold text-gray-700">
                    Mouvements de minerai
                </h3>
            </div>

            <table class="w-full text-sm text-left">

                <thead class="bg-gray-100 text-xs uppercase text-gray-600">
                <tr>
                    <th class="p-4">ID</th>
                    <th>Date</th>
                    <th>Site</th>
                    <th>Minerai</th>
                    <th>Volume</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
                </thead>

                <tbody class="divide-y">

                @foreach($cargaisons as $cargaison)
                    <tr class="hover:bg-gray-50 transition">

                        <td class="p-4 font-medium text-gray-800">
                            {{ $cargaison->id_cargaison }}
                        </td>

                        <td class="text-gray-700">
                            {{ $cargaison->date_extraction }}
                        </td>

                        <td class="text-gray-700">
                            {{ $cargaison->site->nom ?? '—' }}
                        </td>

                        <td class="text-gray-700">
                            {{ $cargaison->minerai->nom ?? '—' }}
                        </td>

                        <td class="text-gray-700">
                            {{ $cargaison->volume }} t
                        </td>

                        <td>
                                <span class="px-3 py-1 text-xs rounded-full
                                    @if($cargaison->statut == 'Extrait') bg-blue-100 text-blue-700
                                    @elseif($cargaison->statut == 'En transport') bg-yellow-100 text-yellow-700
                                    @elseif($cargaison->statut == 'Stocké') bg-green-100 text-green-700
                                    @endif">
                                    {{ $cargaison->statut }}
                                </span>
                        </td>

                        <td class="space-x-2">

                            {{-- CREATE TRANSPORT --}}
                            @if($cargaison->statut == 'Extrait')
                                <a href="?selected_cargaison={{ $cargaison->id_cargaison }}"
                                   class="text-blue-600 hover:text-blue-800 font-medium">
                                    Créer transport
                                </a>
                            @endif

                            {{-- STOCKAGE --}}
                            @if($cargaison->statut == 'En transport' && $cargaison->transport)
                                <form action="{{ route('transports.arrive', $cargaison->transport->id_transport) }}"
                                      method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')

                                    <button class="text-green-600 hover:text-green-800 font-medium">
                                        Mettre en stockage
                                    </button>
                                </form>
                            @endif

                        </td>

                    </tr>
                @endforeach

                </tbody>

            </table>
        </div>

        {{-- CREATE TRANSPORT --}}
        @if(request('selected_cargaison'))
            <div class="bg-white shadow-lg rounded-2xl border border-gray-100 p-6">

                <h3 class="text-lg font-semibold text-gray-700 mb-4">
                    Créer un transport
                </h3>

                <form action="{{ route('transports.store') }}" method="POST" class="grid md:grid-cols-3 gap-4">
                    @csrf

                    <input type="hidden" name="cargaison_id" value="{{ request('selected_cargaison') }}">

                    <input type="date" name="date_depart"
                           class="border rounded-xl p-3" required>

                    <input type="date" name="date_arrivee"
                           class="border rounded-xl p-3" required>

                    <input type="text" name="destination"
                           placeholder="Destination..."
                           class="border rounded-xl p-3" required>

                    <button class="md:col-span-3 bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl transition">
                        Créer le transport
                    </button>

                </form>

            </div>
        @endif

        {{-- CREATE EXTRACTION --}}
        <div class="bg-white shadow-lg rounded-2xl border border-gray-100 p-6">

            <h3 class="text-lg font-semibold text-gray-700 mb-4">
                Nouvelle extraction
            </h3>

            <form action="{{ route('cargaisons.store') }}" method="POST" class="grid md:grid-cols-3 gap-4">
                @csrf

                <input type="number" name="volume" min="0"
                       placeholder="Volume (tonnes)"
                       class="border rounded-xl p-3" required>

                <select name="id_site" class="border rounded-xl p-3" required>
                    <option value="">Site</option>
                    @foreach($sites as $site)
                        <option value="{{ $site->id }}">{{ $site->nom }}</option>
                    @endforeach
                </select>

                <select name="id_minerais" class="border rounded-xl p-3" required>
                    <option value="">Minerai</option>
                    @foreach($minerais as $minerai)
                        <option value="{{ $minerai->id }}">{{ $minerai->nom }}</option>
                    @endforeach
                </select>

                <button class="md:col-span-3 bg-green-600 hover:bg-green-700 text-white py-3 rounded-xl transition">
                    Enregistrer l'extraction
                </button>

            </form>

        </div>

        {{-- ERROR --}}
        @error('date_arrivee')
        <div class="text-red-600 text-sm">
            {{ $message }}
        </div>
        @enderror

    </div>

</x-app-layout>
