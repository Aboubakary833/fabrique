@extends('base')
@section('title')
    <title>Vérification email</title>
@endsection
@section('content')
    <main>
        <h1>{{ $details['title'] }}</h1>
        <p>{{ $details['content'] }}</p>
        <p><strong>{{ $details['link'] }}</strong></p>
    </main>
@endsection
