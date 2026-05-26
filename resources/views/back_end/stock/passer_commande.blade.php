<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Passer une commande fournisseur
        </h2>
    </x-slot>

    <div class="max-w-5xl mx-auto py-8 px-6 space-y-6">

        {{-- ERREURS --}}
        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl">
                <ul class="list-disc ml-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- CARD FORM --}}
        <div class="bg-white shadow-lg rounded-2xl border border-gray-100 p-6">

            <form method="POST" action="{{ route('commandes.store') }}" class="space-y-6">
                @csrf

                {{-- FOURNISSEUR --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Fournisseur
                    </label>

                    <select name="id_fournisseur"
                            class="w-full border border-gray-200 rounded-xl px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            required>

                        <option value="">-- Choisir un fournisseur --</option>

                        @foreach($fournisseurs as $fournisseur)
                            <option value="{{ $fournisseur->id_fournisseur }}">
                                {{ $fournisseur->nom }}
                            </option>
                        @endforeach

                    </select>
                </div>

                {{-- MATÉRIELS --}}
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">
                        Matériels à commander
                    </h3>

                    <div class="space-y-3 bg-gray-50 p-4 rounded-xl border">

                        @foreach($materiels as $materiel)
                            <div class="flex items-center justify-between gap-4 bg-white p-3 rounded-lg border">

                                {{-- NOM --}}
                                <div class="text-gray-700 font-medium">
                                    {{ $materiel->description }}
                                </div>

                                {{-- QUANTITÉ --}}
                                <input type="number"
                                       min="1"
                                       name="materiels[{{ $materiel->id_materiel }}][quantite]"
                                       placeholder="Qté"
                                       class="w-28 border border-gray-200 rounded-lg px-2 py-1 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                       required>

                            </div>
                        @endforeach

                    </div>
                </div>

                {{-- BOUTON --}}
                <div class="flex justify-end">
                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-xl transition">
                        Créer la commande
                    </button>
                </div>

            </form>

        </div>

    </div>

</x-app-layout>
