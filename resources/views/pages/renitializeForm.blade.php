@extends('base')
@section('title')
    <title>Formulaire de rénitialisation</title>
@endsection
@section('style')
    <style>
    * {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        text-align: center;
    }

    main {
        width: 90vw;
        margin: auto;
        height: auto;
    }

    label {
        font-size: 17px;
        font-weight: 500;
    }

    input {
        width: 50%;
        height: 37px;
        border: 1px solid #ddd;
        font-size: 16px;
        border-radius: 3px;
        background: transparent;
        margin-top: 8%;
        outline: none;
    }

    button[type='submit'] {
        width: 50%;
        height: 37px;
        border: 1px solid #CE0033;
        font-size: 16px;
        border-radius: 3px;
        background: transparent;
        margin-top: 8%;
        outline: none;
    }
    </style>
@endsection
@section('content')
    <main>
        <form action="/resetPassword" method="post">
            @csrf
            <label for="password">Votre nouveau mot de passe : </label><br>
            <input type="password" name="password" id="password" placeholder="* * * * * * * *">
            <button type="submit">Envoyer</button>
        </form>
    </main>
@endsection
