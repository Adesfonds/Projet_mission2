<x-app-layout>
    <div class="p-6">

        <h2 class="text-xl font-bold mb-4"> Détail du matériel</h2>

        <div class="border p-4 rounded bg-white">
            <p><strong>Nom :</strong> {{ $materiel->nom }}</p>
            <p><strong>Description :</strong> {{ $materiel->description }}</p>
            <p><strong>Stock :</strong> {{ $materiel->stock }}</p>
            <p><strong>Seuil d’alerte :</strong> {{ $materiel->seuil_alerte }}</p>
        </div>

        <a href="{{ route('stock.index') }}" class="text-blue-600 mt-4 inline-block">
            ← Retour à l’inventaire
        </a>

    </div>
</x-app-layout>
