@extends('app')

@section('title', 'Contact')

@section('content')

    <h1>Formulaire de contact</h1>

    {{-- Message de succès --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Erreurs de validation --}}
    @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ url('/contact') }}" method="POST">
        @csrf

        <input
            type="text"
            name="nom"
            placeholder="Votre nom"
            value="{{ old('nom') }}"
        >

        <input
            type="email"
            name="email"
            placeholder="Email"
            value="{{ old('email') }}"
        >

        <input
            type="text"
            name="subject"
            placeholder="Sujet"
            value="{{ old('subject') }}"
        >

        <textarea name="contenu" placeholder="Message">{{ old('contenu') }}</textarea>

        <button type="submit">Envoyer</button>
    </form>

@endsection
