<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mouvements de minerai - VEM') }}
        </h2>
    </x-slot>

    <div class="container mt-4">

        {{-- Messages --}}
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        {{-- Tableau des cargaisons --}}
        <h2 class="mb-4">Mouvements de minerai</h2>
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
                        <span class="badge
                            @if($cargaison->statut == 'Extrait') bg-primary
                            @elseif($cargaison->statut == 'En transport') bg-warning text-dark
                            @elseif($cargaison->statut == 'Stocké') bg-success
                            @endif
                        ">
                            {{ $cargaison->statut }}
                        </span>
                    </td>
                    <td>
                        {{-- Bouton pour créer transport --}}
                        @if($cargaison->statut == 'Extrait')
                            <form method="GET" action="">
                                <input type="hidden" name="selected_cargaison" value="{{ $cargaison->id_cargaison }}">
                                <button class="btn btn-sm btn-info">Créer transport</button>
                            </form>
                        @endif

                        {{-- Bouton pour mettre en stockage --}}
                        @if($cargaison->statut == 'En transport' && $cargaison->transport)
                            <form action="{{ route('transports.arrive', $cargaison->transport->id_transport) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-success btn-sm">
                                    Mettre en stockage
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{-- Formulaire création transport --}}
        @if(request('selected_cargaison'))
            <div class="container mt-5">
                <h3>Créer un transport</h3>
                <form action="{{ route('transports.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="cargaison_id" value="{{ request('selected_cargaison') }}">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Date de départ</label>
                            <input type="date" name="date_depart" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label>Date d'arrivée prévue</label>
                            <input type="date" name="date_arrivee" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label>Destination</label>
                            <input type="text" name="destination" class="form-control" placeholder="Adresse..." required>
                        </div>
                    </div>
                    <button class="btn btn-primary mt-3">Créer le transport</button>
                </form>
            </div>
        @endif

        {{-- Formulaire extraction --}}
        <div class="container mt-5">
            <h3>Nouvelle extraction</h3>
            <form action="{{ route('cargaisons.store') }}" method="POST">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label>Volume (tonnes)</label>
                        <input type="number" name="volume" class="form-control" min="0" required>
                    </div>
                    <div class="col-md-4">
                        <label>Site</label>
                        <select name="id_site" class="form-control" required>
                            @foreach($sites as $site)
                                <option value="{{ $site->id }}">{{ $site->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label>Minerai</label>
                        <select name="id_minerais" class="form-control" required>
                            @foreach($minerais as $minerai)
                                <option value="{{ $minerai->id }}">{{ $minerai->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button class="btn btn-primary">Enregistrer l'extraction</button>
            </form>
        </div>
        @error('date_arrivee')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</x-app-layout>
