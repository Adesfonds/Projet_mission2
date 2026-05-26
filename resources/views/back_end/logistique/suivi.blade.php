<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Suivi des transports de cargaisons - VEM
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 px-6 space-y-6">

        {{-- FLASH MESSAGES --}}
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

        {{-- TITLE + SEARCH --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

            <h3 class="text-lg font-semibold text-gray-700">
                Transports en cours et terminés
            </h3>

            <form method="GET" action="{{ route('transports.index') }}" class="flex gap-2 w-full md:w-auto">

                <div class="relative w-full md:w-80">
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Destination ou statut..."
                        class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    >

                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center">
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>

                <button class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm rounded-xl transition">
                    Rechercher
                </button>

            </form>

        </div>

        {{-- TABLE --}}
        <div class="bg-white shadow-lg rounded-2xl border border-gray-100 overflow-hidden">

            <table class="w-full text-sm text-left">

                <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                <tr>
                    <th class="p-4">Destination</th>
                    <th class="p-4">Départ</th>
                    <th class="p-4">Arrivée</th>
                    <th class="p-4">Statut</th>
                </tr>
                </thead>

                <tbody class="divide-y">

                @forelse($transports as $transport)
                    <tr class="hover:bg-gray-50 transition">

                        <td class="p-4 font-medium text-gray-800">
                            {{ $transport->destination }}
                        </td>

                        <td class="p-4 text-gray-600">
                            {{ $transport->date_depart }}
                        </td>

                        <td class="p-4 text-gray-600">
                            {{ $transport->date_arrivee ?? '—' }}
                        </td>

                        <td class="p-4">

                            @if($transport->statut_transport === 'Terminé')
                                <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700">
                                        Terminé
                                    </span>

                            @elseif($transport->statut_transport === 'En cours')
                                <span class="px-3 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700">
                                        En cours
                                    </span>

                            @else
                                <span class="px-3 py-1 text-xs rounded-full bg-blue-100 text-blue-700">
                                        {{ $transport->statut_transport }}
                                    </span>
                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="4" class="p-6 text-center text-gray-500">
                            Aucun transport enregistré
                        </td>
                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</x-app-layout>
