<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mouvements de minerai - VEM') }}
        </h2>
    </x-slot>

    <div class="container mt-4">

        <h2 class="mb-4">Mouvements de minerai</h2>

        {{-- Messages de succès --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- Messages d'erreur --}}
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        {{-- Tableau des cargaisons --}}
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Date extraction</th>
                <th>Site</th>
                <th>Minerai</th>
                <th>Volume (t)</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($cargaisons as $cargaison)
                <tr>
                    <td>{{ $cargaison->id_cargaison }}</td>
                    <td>{{ $cargaison->date_extraction }}</td>
                    <td>{{ $cargaison->site->nom ?? '—' }}</td>
                    <td>{{ $cargaison->minerai->nom ?? '—' }}</td>
                    <td>{{ $cargaison->volume }}</td>
                    <td>
                        @if($cargaison->statut == 'Extrait')
                            <span class="badge bg-primary">{{ $cargaison->statut }}</span>
                        @elseif($cargaison->statut == 'En transport')
                            <span class="badge bg-warning text-dark">{{ $cargaison->statut }}</span>
                        @elseif($cargaison->statut == 'Stocké')
                            <span class="badge bg-success">{{ $cargaison->statut }}</span>
                        @else
                            <span class="badge bg-secondary">{{ $cargaison->statut }}</span>
                        @endif
                    </td>
                    <td>
                        @if($cargaison->statut == 'Extrait')
                            <form action="{{ route('cargaisons.transport', $cargaison->id_cargaison) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-warning">Mettre en transport</button>
                            </form>
                        @elseif($cargaison->statut == 'En transport')
                            <form action="{{ route('cargaisons.stockage', $cargaison->id_cargaison) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success">Mettre en stockage</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>

    {{-- FORMULAIRE CREATION EXTRACTION --}}
    <div class="container mt-5">
        <h3>Nouvelle extraction</h3>
        <form action="{{ route('cargaisons.store') }}" method="POST" class="mb-5">
            @csrf
            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label">Volume extrait (tonnes)</label>
                    <input type="number" name="volume" class="form-control" min="0" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Site d'extraction</label>
                    <select name="id_site" class="form-control" required>
                        @foreach($sites as $site)
                            <option value="{{ $site->id }}">{{ $site->nom }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Minerai extrait</label>
                    <select name="id_minerais" class="form-control" required>
                        @foreach($minerais as $minerai)
                            <option value="{{ $minerai->id }}">{{ $minerai->nom }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Enregistrer l'extraction</button>
                </div>
            </div>
        </form>
    </div>

</x-app-layout>
