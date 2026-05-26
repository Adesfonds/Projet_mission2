<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Logistique - VEM
        </h2>
    </x-slot>

    {{-- NAVIGATION LOGISTIQUE --}}
    <div class="bg-white shadow-sm border-b border-gray-100">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <nav class="flex gap-2 py-3">

                {{-- MOUVEMENTS --}}
                <a href="{{ route('cargaisons.index') }}"
                   class="px-4 py-2 rounded-xl text-sm font-medium transition
                   {{ request()->routeIs('cargaisons.*')
                        ? 'bg-gray-900 text-white'
                        : 'text-gray-700 hover:bg-gray-100' }}">
                    Mouvements de minerai
                </a>

                {{-- TRANSPORTS --}}
                <a href="{{ route('transports.index') }}"
                   class="px-4 py-2 rounded-xl text-sm font-medium transition
                   {{ request()->routeIs('transports.*')
                        ? 'bg-gray-900 text-white'
                        : 'text-gray-700 hover:bg-gray-100' }}">
                    Suivi des transports
                </a>

                {{-- BONS DE TRANSPORT --}}
                <a href="{{ route('logistique.liste_pdf') }}"
                   class="px-4 py-2 rounded-xl text-sm font-medium transition
                   {{ request()->routeIs('logistique.*')
                        ? 'bg-gray-900 text-white'
                        : 'text-gray-700 hover:bg-gray-100' }}">
                    Bons de transport
                </a>

            </nav>

        </div>

    </div>


</x-app-layout>
