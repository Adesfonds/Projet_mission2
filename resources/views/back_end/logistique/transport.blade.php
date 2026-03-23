<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transport des cargaisons - VEM') }}
        </h2>
    </x-slot>

    <div class="container mt-4">
        <h2 class="mb-4">Cargaisons à transporter</h2>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
                <th>Transporteur</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($cargaisons as $cargaison)
                <tr>
                    <td>{{ $cargaison->id }}</td>
                    <td>{{ $cargaison->date_extraction->format('d/m/Y H:i') }}</td>
                    <td>{{ $cargaison->site->nom ?? '—' }}</td>
                    <td>{{ $cargaison->volume }}</td>
                    <td>{{ $cargaison->utilisateur->name ?? '—' }}</td>
                    <td>{{ $cargaison->transporteur->nom ?? '—' }}</td>
                    <td>
                        @if($cargaison->statut == 'Extrait')
                            <form action="{{ route('cargaisons.transport', $cargaison->id) }}" method="POST" class="d-flex gap-1">
                                @csrf
                                <select name="id_transport" class="form-select form-select-sm" required>
                                    <option value="">-- Choisir transporteur --</option>
                                    @foreach($transporteurs as $transport)
                                        <option value="{{ $transport->id_transport }}">{{ $transport->nom }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-sm btn-warning">🚚 Transport</button>
                            </form>
                        @else
                            <span class="text-muted">En transport</span>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
