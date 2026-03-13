<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Suivi des transports - VEM') }}
        </h2>
    </x-slot>

    <div class="container mt-4">

        <h2 class="mb-4">Suivi des transports de cargaisons</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
            <tr>
                <th>ID Cargaison</th>
                <th>Destination</th>
                <th>Date départ</th>
                <th>Date arrivée</th>
                <th>Statut transport</th>
            </tr>
            </thead>
            <tbody>
            @foreach($transports as $transport)
                <tr>
                    <td>{{ $transport->cargaison->id_cargaison ?? '—' }}</td>
                    <td>{{ $transport->destination }}</td>
                    <td>{{ $transport->date_depart }}</td>
                    <td>{{ $transport->date_arrivee ?? '—' }}</td>
                    <td>
                        @if($transport->statut_transport == 'Arrivé')
                            <span class="badge bg-success">{{ $transport->statut_transport }}</span>
                        @elseif($transport->statut_transport == 'En transport')
                            <span class="badge bg-warning">{{ $transport->statut_transport }}</span>
                        @else
                            <span class="badge bg-info">{{ $transport->statut_transport }}</span>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
</x-app-layout>
