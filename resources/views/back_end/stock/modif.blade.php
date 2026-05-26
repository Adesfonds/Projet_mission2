<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Détail du matériel
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto py-8 px-6">

        <form action="{{ route('stock.update', $materiel->id_materiel) }}" method="POST"
              class="bg-white shadow-lg rounded-2xl border border-gray-100 p-6 space-y-6">

            @csrf
            @method('PUT')

            {{-- TITRE --}}
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-4">
                    Informations du matériel
                </h3>
            </div>

            {{-- NOM --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Nom
                </label>
                <input type="text"
                       name="nom"
                       value="{{ $materiel->nom }}"
                       class="w-full border border-gray-200 rounded-xl px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            {{-- DESCRIPTION --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Description
                </label>
                <input type="text"
                       name="description"
                       value="{{ $materiel->description }}"
                       class="w-full border border-gray-200 rounded-xl px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            {{-- SEUIL --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Seuil d’alerte
                </label>
                <input type="number"
                       name="seuil_alerte"
                       value="{{ $materiel->seuil_alerte }}"
                       class="w-full border border-gray-200 rounded-xl px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            {{-- BOUTON --}}
            <div class="flex justify-end pt-4">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-xl transition">
                    Mettre à jour
                </button>
            </div>

        </form>

    </div>

</x-app-layout>
