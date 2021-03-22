@extends('base')
@section('title')
    <title>Email de confirmation envoyé</title>
@endsection
@section('style')
    <style>
        * {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            text-align: center;
        }
        main {
            width: 100vw;
            height: auto;
            margin-top: 30vh;
            position: fixed;
        }
    </style>
@endsection
@section('content')
    <main>
        <h1>Un email de confirmation vous a été envoyé!</h1>
        <p>Veuillez consulter votre boîte de mail!</p>
    </main>
@endsection
