@extends('app')

@section('title', 'Détail activité - VEM')

@section('content')

    <section class="max-w-5xl mx-auto py-16 px-6">

        {{-- Image --}}
        @if ($activity->image)
            <div class="mb-10">
                <img
                    src="{{ asset('storage/' . $activity->image) }}"
                    alt="{{ $activity->titre }}"
                    class="w-full h-96 object-cover rounded-2xl shadow-lg border border-gray-100"
                >
            </div>
        @endif

        {{-- Contenu --}}
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 md:p-10">

            <h1 class="text-3xl md:text-4xl font-bold text-green-900 mb-6">
                {{ $activity->titre }}
            </h1>

            <hr class="mb-6 border-gray-200">

            <div class="text-gray-700 leading-8 text-lg whitespace-pre-line">
                {{ $activity->description }}
            </div>

        </div>

        {{-- LISTE DES COMMENTAIRES --}}
        <div class="mt-10">
            <h3 class="text-lg font-semibold text-gray-700 mb-6">
                Commentaires ({{ $activity->messages->count() }})
            </h3>

            @forelse ($activity->messages as $msg)
                <div class="bg-white rounded-2xl shadow border border-gray-100 p-5 mb-4">
                    <p class="text-gray-800">{{ $msg->message }}</p>
                    <p class="text-xs text-gray-400 mt-2">{{ $msg->created_at->diffForHumans() }}</p>
                </div>
            @empty
                <p class="text-gray-400 italic">Aucun commentaire pour le moment.</p>
            @endforelse
        </div>

        {{-- FORMULAIRE AJOUT COMMENTAIRE --}}
        <h3 class="text-lg font-semibold text-gray-700 mt-10 mb-4">
            Ajouter un Commentaire
        </h3>

        <form action="{{ route('messages.store') }}" method="POST">
            @csrf

            <input class="border rounded-xl p-3 w-full"
                   type="text"
                   name="contenu"
                   placeholder="Votre commentaire..."
                   required
                   maxlength="255">

            <input type="hidden" name="actu_id" value="{{ $activity->id }}">

            <button class="mt-4 bg-green-700 hover:bg-green-800 text-white py-3 px-6 rounded-xl transition">
                Ajouter
            </button>
        </form>

        {{-- Retour --}}
        <div class="mt-8">
            <a href="{{ route('actualites.index') }}"
               class="inline-flex items-center px-6 py-3 bg-gray-800 hover:bg-gray-900 text-white rounded-xl transition">
                ← Retour à la liste
            </a>
        </div>

    </section>

@endsection
