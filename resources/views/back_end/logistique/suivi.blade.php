<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Suivi des transports de cargaisons - VEM') }}
        </h2>
    </x-slot>

    <div class="container mt-4">

        {{-- Messages flash --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <h2 class="mb-4">Transports en cours et terminés</h2>

        <table class="table table-bordered table-striped table-hover">
            <thead class="table-dark text-center">
            <tr>
                <th>ID Cargaison</th>
                <th>Volume (t)</th>
                <th>Site</th>
                <th>Destination</th>
                <th>Date départ</th>
                <th>Date arrivée</th>
                <th>Statut transport</th>
            </tr>
            </thead>
            <tbody class="text-center">
            @forelse($transports as $transport)
                <tr>
                    <td>{{ $transport->cargaison->id_cargaison ?? '—' }}</td>
                    <td>{{ $transport->cargaison->volume ?? '—' }}</td>
                    <td>{{ $transport->cargaison->site->nom ?? '—' }}</td>
                    <td>{{ $transport->destination }}</td>
                    <td>{{ $transport->date_depart }}</td>
                    <td>{{ $transport->date_arrivee ?? '—' }}</td>
                    <td>
                        @if($transport->statut_transport == 'Terminé')
                            <span class="badge bg-success">{{ $transport->statut_transport }}</span>
                        @elseif($transport->statut_transport == 'En cours')
                            <span class="badge bg-warning text-dark">{{ $transport->statut_transport }}</span>
                        @else
                            <span class="badge bg-info">{{ $transport->statut_transport }}</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Aucun transport enregistré.</td>
                </tr>
            @endforelse
            </tbody>
        </table>

    </div>
</x-app-layout>
