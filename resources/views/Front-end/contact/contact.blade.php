@extends('app')

@section('title', 'Contact - VEM')

@section('content')

    <section class="max-w-3xl mx-auto py-16 px-6">

        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold text-green-900 mb-6 leading-tight">
                Formulaire de contact
            </h1>

            <p class="text-lg text-gray-600">
                Une question, une collaboration ou une demande d’information ? Contactez l’équipe VEM.
            </p>
        </div>

        {{-- Message de succès --}}
        @if(session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-5 py-4 rounded-xl">
                {{ session('success') }}
            </div>
        @endif

        {{-- Erreurs --}}
        @if($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-5 py-4 rounded-xl">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Formulaire --}}
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 md:p-10">

            <form action="{{ url('/contact') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nom</label>
                    <input
                        type="text"
                        name="nom"
                        placeholder="Votre nom"
                        value="{{ old('nom') }}"
                        class="w-full rounded-xl border-gray-300 focus:border-green-600 focus:ring-green-600 p-3"
                    >
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input
                        type="email"
                        name="email"
                        placeholder="Votre email"
                        value="{{ old('email') }}"
                        class="w-full rounded-xl border-gray-300 focus:border-green-600 focus:ring-green-600 p-3"
                    >
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Sujet</label>
                    <input
                        type="text"
                        name="subject"
                        placeholder="Sujet de votre message"
                        value="{{ old('subject') }}"
                        class="w-full rounded-xl border-gray-300 focus:border-green-600 focus:ring-green-600 p-3"
                    >
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Message</label>
                    <textarea
                        name="contenu"
                        rows="5"
                        placeholder="Votre message..."
                        class="w-full rounded-xl border-gray-300 focus:border-green-600 focus:ring-green-600 p-3"
                    >{{ old('contenu') }}</textarea>
                </div>

                <button
                    type="submit"
                    class="w-full bg-green-800 hover:bg-green-900 text-white font-semibold py-3 rounded-xl transition"
                >
                    Envoyer le message
                </button>

            </form>

        </div>

    </section>

@endsection
