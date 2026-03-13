<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mouvements de minerai - VEM') }}
        </h2>
    </x-slot>

    <div class="container mt-4">

        <h2 class="mb-4">Mouvements de minerai (Extractions)</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Date extraction</th>
                <th>Site</th>
                <th>Volume (t)</th>
                <th>Responsable</th>
                <th>Statut</th>
            </tr>
            </thead>
            <tbody>
            @foreach($cargaisons as $cargaison)
                <tr>
                    <td>{{ $cargaison->id_cargaison }}</td>
                    <td>{{ $cargaison->date_extraction }}</td>
                    <td>{{ $cargaison->site->nom ?? '—' }}</td>
                    <td>{{ $cargaison->volume }}</td>
                    <td>{{ $cargaison->utilisateur->name ?? '—' }}</td>
                    <td>
                        <span class="badge bg-info">{{ $cargaison->statut }}</span>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>

    {{-- FORMULAIRE CREATION EXTRACTION --}}
    <form action="{{ route('cargaisons.store') }}" method="POST" class="mb-5">
        @csrf

        <div class="row">

            <div class="col-md-4">
                <label class="form-label">Volume extrait (tonnes)</label>
                <input type="number" name="volume" class="form-control" required>
            </div>

            <div class="col-md-4">
                <label class="form-label">Site d'extraction</label>
                <select name="id_site" class="form-control" required>
                    <option value="1">Site du Vercors</option>
                </select>
            </div>

            <div class="col-md-4 d-flex align-items-end">
                <button type="submit" class="btn btn-primary">
                    Enregistrer l'extraction
                </button>
            </div>

        </div>

    </form>
</x-app-layout>
