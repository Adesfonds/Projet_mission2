<x-app-layout>
    <div class="p-6">

        <h1 class="text-xl font-bold mb-4">Passer une commande fournisseur</h1>

        <form method="POST" action="{{ route('commandes.store') }}">
            @csrf

            {{-- Fournisseur --}}
            <div class="mb-4">
                <label class="block font-semibold">Fournisseur</label>

                <select name="id_fournisseur" class="border p-2 w-full" required>
                    <option value="">-- Choisir un fournisseur --</option>

                    @foreach($fournisseurs as $fournisseur)
                        <option value="{{ $fournisseur->id_fournisseur }}">
                            {{ $fournisseur->nom }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Matériels --}}
            <h2 class="text-lg font-bold mt-6 mb-2">Matériels</h2>

            <div class="border p-4 rounded">
                @foreach($materiels as $materiel)
                    <div class="flex items-center gap-4 mb-2">
                    <select>
                        <option class="w-1/2">
                            {{ $materiel->description }}
                        </option>
                    </select>
                        <input type="number"
                               min="0"
                               name="materiels[{{ $materiel->id_materiel }}][quantite]"
                               placeholder="Quantité"
                               class="border p-1 w-32">

                    </div>
                @endforeach
            </div>

            {{-- Bouton --}}
            <div class="mt-6">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                    Créer la commande
                </button>
            </div>

        </form>

    </div>
</x-app-layout>
