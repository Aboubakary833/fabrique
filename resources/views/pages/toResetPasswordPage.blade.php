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
            width: 40vw;
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
            margin-top: 10%
        }

        label {
            font-size: 17px;
            font-weight: 500;

        }

        input {
            width: 60%;
            height: 40px;
            border: 1px solid #707070;
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

        footer {
            width: 100%;
            height: auto;
            position: fixed;
            text-align: center;
            color: #707070;
            font-weight: 500;
            bottom: 0;
            left: 0;
        }
    </style>
@endsection
@section('content')
    <main>
        <form action="/toResetPasswordPage" method="POST">
            @csrf
            <label for="email">Entrez votre email : </label><br>
            <input type="email" name="email" id="email" placeholder="exemple@gmail.com"><br>
            <button type="submit">Envoyer</button>
        </form>
    </main>
    <footer>
        <p>&copy; Copyright - 2021</p>
    </footer>
@endsection
