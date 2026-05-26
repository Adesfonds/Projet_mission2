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

            {{-- Titre --}}
            <h1 class="text-3xl md:text-4xl font-bold text-green-900 mb-6 leading-tight">
                {{ $activity->titre }}
            </h1>

            <hr class="mb-6 border-gray-200">

            {{-- Description --}}
            <div class="text-gray-700 leading-8 text-lg whitespace-pre-line">
                {{ $activity->description }}
            </div>

        </div>

        {{-- Retour --}}
        <div class="mt-8">
            <a href="{{ route('actualites.index') }}"
               class="inline-flex items-center px-6 py-3 bg-gray-800 hover:bg-gray-900 text-white rounded-xl transition">
                ← Retour à la liste
            </a>
        </div>

    </section>

@endsection
