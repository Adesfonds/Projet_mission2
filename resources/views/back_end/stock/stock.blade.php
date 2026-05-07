<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestion des Stocks - VEM') }}
        </h2>
    </x-slot>

    {{-- Menu simple Mouvements / Suivi --}}
    <div class="bg-white shadow mb-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex space-x-4 py-3">
                <a href="{{ route('stock.index') }}"
                   class="px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('stock.index') ? 'bg-gray-900 text-white' : 'text-gray-700 hover:bg-gray-200' }}">
                    Inventaire de materiel
                </a>

            </nav>
        </div>
    </div>

    <div class="bg-white shadow mb-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex space-x-4 py-3">
                <a href="{{ route('mouvements.index') }}"
                   class="px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('mouvements.index') ? 'bg-gray-900 text-white' : 'text-gray-700 hover:bg-gray-200' }}">
                    Suivi des entrées
                </a>

            </nav>
        </div>
    </div>

    <div class="bg-white shadow mb-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex space-x-4 py-3">
                <a href="{{ route('commandes.create') }}"
                   class="px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('commandes.create') ? 'bg-gray-900 text-white' : 'text-gray-700 hover:bg-gray-200' }}">
                    Faire Commandes
                </a>

            </nav>
        </div>

    <div class="bg-white shadow mb-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex space-x-4 py-3">
                <a href="{{ route('commandes.index') }}"
                   class="px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('commandes.index') ? 'bg-gray-900 text-white' : 'text-gray-700 hover:bg-gray-200' }}">
                    Suivres Commandes
                </a>

            </nav>
        </div>



</x-app-layout>
