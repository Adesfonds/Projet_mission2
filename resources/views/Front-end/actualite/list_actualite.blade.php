
@extends('app')

@section('title', 'Equipe')

@section('content')
    <div class="container mt-5">

        <h1 class="mb-4">Actualités</h1>

        <div class="row g-4">

            @forelse ($activities as $activity)
                <div class="col-md-4">
                    <div class="card h-100">

                        @if ($activity->image)
                            <img src="{{ asset('storage/' . $activity->image) }}"
                                 class="card-img-top"
                                 alt="{{ $activity->titres }}"
                                 style="height: 200px; object-fit: cover;">
                        @endif

                        <div class="card-body">
                            <h5 class="card-title">{{ $activity->titres }}</h5>
                            <p class="card-text text-muted">
                                {{ Str::limit($activity->description, 120) }}
                            </p>
                        </div>

                        <div class="card-footer bg-white border-0">
                            <a href="{{ route('actualites.show', $activity->id) }}"
                               class="btn btn-success">
                                Lire la suite
                            </a>
                        </div>

                    </div>
                </div>
            @empty
                <div class="col">
                    <p>Aucune actualité disponible.</p>
                </div>
            @endforelse

        </div>

        <div class="mt-4">
            {{ $activities->links() }}
        </div>

    </div>

@endsection
