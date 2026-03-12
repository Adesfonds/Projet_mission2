@extends('app')

@section('title', 'Contact')

@section('content')

    <h1>Formulaire de contact</h1>

    <form action="{{ url('/contact') }}" method="POST">
        @csrf
        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}">
        <input type="text" name="subject" placeholder="Sujet" value="{{ old('subject') }}">
        <textarea name="message" placeholder="Message">{{ old('message') }}</textarea>
        <button type="submit">Envoyer</button>
    </form>

@endsection
