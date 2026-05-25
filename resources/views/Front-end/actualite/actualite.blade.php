@extends('app')

@section('title', 'Contact')

@section('content')
    <div class="container mt-5">

        {{-- Image --}}
        @if ($activity->image)
            <img src="{{ asset('storage/' . $activity->image) }}"
                 class="img-fluid rounded mb-4"
                 alt="{{ $activity->titres }}"
                 style="max-height: 400px; width: 100%; object-fit: cover;">
        @endif

        {{-- Titre --}}
        <h1>{{ $activity->titres }}</h1>
        <hr>

        {{-- Description --}}
        <div class="mb-4">
            {!! nl2br(e($activity->description)) !!}
        </div>

        <a href="{{ route('actualites.index') }}" class="btn btn-secondary mb-5">
            ← Retour à la liste
        </a>

    </div>

@endsection
