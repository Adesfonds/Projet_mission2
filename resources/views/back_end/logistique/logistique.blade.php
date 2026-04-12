<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Logistique - VEM') }}
        </h2>
    </x-slot>

    {{-- Menu simple Mouvements / Suivi --}}
    <div class="bg-white shadow mb-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex space-x-4 py-3">
                <a href="{{ route('cargaisons.index') }}"
                   class="px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('cargaisons.mouvements') ? 'bg-gray-900 text-white' : 'text-gray-700 hover:bg-gray-200' }}">
                    Mouvements de minerai
                </a>

                <a href="{{ route('transports.index') }}"
                   class="px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('transports.*') ? 'bg-gray-900 text-white' : 'text-gray-700 hover:bg-gray-200' }}">
                    Suivi des transports
                </a>
                <a href="{{ route('logistique.liste_pdf') }}"
                   class="px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('logistique.*') ? 'bg-gray-900 text-white' : 'text-gray-700 hover:bg-gray-200' }}">
                    Bons de transport
                </a>
            </nav>
        </div>
    </div>

    {{-- Contenu principal --}}
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            @yield('content')
        </div>
    </div>
</x-app-layout>
