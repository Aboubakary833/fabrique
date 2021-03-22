@extends('base')
@section('title')
    <title>envoi de mail de rénitialisation</title>
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
            margin-top: 20vh;
            text-align: center;
            position: fixed;
        }
        main p {
            width: fit-content;
            height: fit-content;
            padding: 15px 20px;
            margin: auto;
            border: 1px solid #f80;
            background: rgba(255, 136, 0, 0.4);
            color: #000;
            font-weight: 500;
            font-size: 17px;
        }
    </style>
@endsection
@section('content')
    <main>
        <p>Un email de rénitialisation de mot de passe vous a été envoyé!</p>
    </main>
@endsection
