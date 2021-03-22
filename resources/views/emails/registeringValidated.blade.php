@extends('base')
@section('title')
    <title>Vérification email</title>
@endsection
@section('content')
    <main>
        <h1>{{ $detail['title'] }}</h1>
        <p>{{ $detail['content'] }} <a href="{{ $detail['link'] }}">page de connexion</a></p>
    </main>
@endsection
