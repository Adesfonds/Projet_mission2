@extends('app')

@section('title', 'Détail du rapport')

@section('content')
    <div class="container mt-5">

        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-start mb-4">

            <div>
                <h1 class="mb-2">{{ $rapport->titre }}</h1>

                <p class="text-muted mb-0">
                    Rapport {{ ucfirst($rapport->type) }} |
                    Date : {{ \Carbon\Carbon::parse($rapport->date_rapport)->format('d/m/Y') }}
                </p>
            </div>

            <span class="badge bg-success fs-6">
            {{ ucfirst($rapport->type) }}
        </span>

        </div>

        <hr>

        {{-- CARTE INFOS --}}
        <div class="card mb-4 shadow-sm">

            <div class="card-body">

                <h5 class="card-title mb-3">Résumé du rapport</h5>

                <p class="card-text">
                    {!! nl2br(e($rapport->contenu)) !!}
                </p>

            </div>

        </div>

        {{-- FICHIER PDF --}}
        @if ($rapport->fichier)
            <div class="card mb-4 border-primary">

                <div class="card-body">

                    <h5 class="card-title">Document associé</h5>

                    <p class="text-muted">
                        Vous pouvez télécharger le rapport complet au format PDF.
                    </p>

                    <a href="{{ asset('storage/' . $rapport->fichier) }}"
                       class="btn btn-primary"
                       target="_blank">
                        📄 Télécharger le PDF
                    </a>

                </div>

            </div>
        @endif

        {{-- METADONNEES --}}
        <div class="card mb-4">

            <div class="card-body">

                <h5 class="card-title">Informations techniques</h5>

                <ul class="list-group list-group-flush">

                    <li class="list-group-item">
                        <strong>ID :</strong> {{ $rapport->id }}
                    </li>

                    <li class="list-group-item">
                        <strong>Type :</strong> {{ $rapport->type }}
                    </li>

                    <li class="list-group-item">
                        <strong>Date du rapport :</strong> {{ $rapport->date_rapport }}
                    </li>

                    <li class="list-group-item">
                        <strong>Créé le :</strong> {{ $rapport->created_at }}
                    </li>

                    <li class="list-group-item">
                        <strong>Dernière mise à jour :</strong> {{ $rapport->updated_at }}
                    </li>

                </ul>

            </div>

        </div>

        {{-- ACTIONS --}}
        <div class="d-flex gap-2">

            <a href="{{ url()->previous() }}" class="btn btn-secondary">
                ← Retour
            </a>

            <a href="{{ route('rapports.mensuel') }}" class="btn btn-outline-success">
                Liste des rapports
            </a>

        </div>

    </div>
@endsection
