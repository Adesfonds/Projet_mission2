@extends('app')

@section('title', 'Rapports mensuels')

@section('content')
    <div class="container mt-5">

        <h1 class="mb-4">Rapports mensuels</h1>

        <div class="row g-4">

            @forelse ($rapports as $rapport)
                <div class="col-md-4">
                    <div class="card h-100">

                        <div class="card-body">
                            <h5 class="card-title">{{ $rapport->titre }}</h5>

                            <p class="text-muted">
                                {{ Str::limit($rapport->contenu, 120) }}
                            </p>

                            <p><strong>Date :</strong> {{ $rapport->date_rapport }}</p>
                        </div>

                        <div class="card-footer bg-white border-0">
                            <a href="{{ route('rapports.show', $rapport->id) }}"
                               class="btn btn-success">
                                Voir
                            </a>
                        </div>

                    </div>
                </div>
            @empty
                <p>Aucun rapport mensuel.</p>
            @endforelse

        </div>

        <div class="mt-4">
            {{ $rapports->links() }}
        </div>

    </div>
@endsection
