<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Gestion des Stocks - VEM
        </h2>

        <div class="max-w-7xl mx-auto py-8 px-6 space-y-6">
                <a href="{{ route('stock.index') }}"
                   class="px-4 py-2 rounded-lg text-sm font-medium transition
                   {{ request()->routeIs('stock.index') ? 'bg-gray-900 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                    Inventaire matériel
                </a>

                <a href="{{ route('mouvements.index') }}"
                   class="px-4 py-2 rounded-lg text-sm font-medium transition
                   {{ request()->routeIs('mouvements.index') ? 'bg-gray-900 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                    Suivi des entrées
                </a>

                <a href="{{ route('commandes.create') }}"
                   class="px-4 py-2 rounded-lg text-sm font-medium transition
                   {{ request()->routeIs('commandes.create') ? 'bg-gray-900 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                    Faire commande
                </a>

                <a href="{{ route('commandes.index') }}"
                   class="px-4 py-2 rounded-lg text-sm font-medium transition
                   {{ request()->routeIs('commandes.index') ? 'bg-gray-900 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                    Suivi des commandes
                </a>

            </div>
    </x-slot>



</x-app-layout>
