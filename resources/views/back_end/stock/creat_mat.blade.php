<x-app-layout>
    <div class="p-6">

        <h2 class="text-xl font-bold mb-4">Créer un matériel</h2>

        <form action="{{ route('stock.store') }}" method="POST" class="space-y-4">
            @csrf

            <!-- Nom -->
            <div>
                <label class="block font-medium">Nom</label>
                <input type="text" name="nom" class="border p-2 w-full" required>
            </div>

            <!-- Description -->
            <div>
                <label class="block font-medium">Description</label>
                <input type="text" name="description" class="border p-2 w-full">
            </div>

            <!-- Stock -->
            <div>
                <label class="block font-medium">Stock</label>
                <input type="number" name="stock" class="border p-2 w-full" required>
            </div>

            <!-- Seuil -->
            <div>
                <label class="block font-medium">Seuil d’alerte</label>
                <input type="number" name="seuil_alerte" class="border p-2 w-full" required>
            </div>

            <!-- Bouton -->
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                Enregistrer
            </button>

        </form>

    </div>
</x-app-layout>
