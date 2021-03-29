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
        width: 60vw;
        height: fit-content;
        background: rgb(245, 245, 245);
        border: 1px solid #ddd;
        border-radius: 5px;
        margin: 25vh auto;
        padding: 5vh;
        box-shadow: 0 3px 10px #ddd;
}
    form {
        width: inherit;
        height: auto;
        display: block;
        text-align: center;
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
        margin-top: 3%;
        outline: none;
    }

    button[type='submit'] {
        width: 50%;
        height: 37px;
        background-color: #CE0033;
        border: 1px solid #CE0033;
        color: #fff;
        font-weight: 500;
        box-shadow: 0 1px 3px #ddd;
        font-size: 16px;
        border-radius: 3px;
        margin-top: 2%;
        outline: none;
    }
    </style>
@endsection
@section('content')
    <main>
        <form action="/resetPassword" method="post">
            @csrf
            <label for="password">Votre nouveau mot de passe : </label><br>
            <input type="hidden" name="email" value="{{ $email }}">
            <input type="password" name="password" id="password" placeholder="Nouveau  mot de passe">
            <button type="submit">Envoyer</button>
        </form>
    </main>
@endsection
