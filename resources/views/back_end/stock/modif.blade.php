<x-app-layout>
    <div class="p-6">

        <h2 class="text-xl font-bold mb-4">Détail du matériel</h2>

        <form action="{{ route('stock.update', $materiel->id_materiel) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="border p-4 rounded bg-white">

                <label>Nom :</label>
                <input type="text" name="nom" value="{{ $materiel->nom }}" class="border w-full mb-2">

                <label>Description :</label>
                <input type="text" name="description" value="{{ $materiel->description }}" class="border w-full mb-2">

                <label>Seuil d’alerte :</label>
                <input type="number" name="seuil_alerte" value="{{ $materiel->seuil_alerte }}" class="border w-full mb-2">

            </div>

            <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 mt-4 rounded">
                Mettre à jour
            </button>
        </form>

    </div>
</x-app-layout>
