@extends('base')
@section('title')
    <title>Entrez votre email de rénitialisation</title>
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
        form {
            margin-top: 10%
        }

        label {
            font-size: 17px;
            font-weight: 500;

        }

        input {
            width: 40%;
            height: 40px;
            border: 1px solid #ddd;
            font-size: 16px;
            margin-top: 20px;
            border-radius: 3px;
            background: transparent;
            outline: none;
        }

        button[type='submit'] {
            width: 20%;
            height: 37px;
            border: none;
            font-size: 16px;
            border-radius: 3px;
            background: #CE0033;
            color: #fff;
            box-shadow: 0 0px 1px #550015;
            margin-top: 2%;
            outline: none;
        }
    </style>
@endsection
@section('content')
    <form action="/toResetPasswordPage" method="POST">
        @csrf
        <label for="email">Entrez votre email : </label><br>
        <input type="email" name="email" id="email" placeholder="exemple@gmail.com"><br>
        <button type="submit">Envoyer</button>
    </form>
@endsection
