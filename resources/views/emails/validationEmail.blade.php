@extends('base')
@section('title')
    <title>Vérification email</title>
@endsection
@section('content')
    <main>
        <h1>{{ $text['title'] }}</h1>
        <p>{{ $text['content'] }} <a href="http://localhost:8000/verified/{{ $text['email'] }}">Lien de vérification</a></p>
    </main>
@endsection
