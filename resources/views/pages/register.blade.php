@extends('base')
@section('title')
    <title>inscription</title>
@endsection
@section('style')
    <link rel="stylesheet" href="/css/register.css">
@endsection
@section('content')
    <main>
        <div class="container">
            <div class="logo">
                <img src="/fonts/logo.png" alt="Logo_Simplon">
            </div>
            <h1>Inscription</h1>
            <form action="register" method="post">
                @csrf
                <label for="lastname">NOM : </label>
                <input type="text" name="lastname" id="lastname" placeholder="Dianda, Sow" required><br>
                <label for="firstname">PRENOM : </label>
                <input type="text" name="firstname" id="firstname" placeholder="Jacqueline, Ahmad" required><br>
                <label for="birthday">NAISSANCE : </label>
                <input type="date" name="birthday" id="birthday" placeholder="01/01/2000" required><br>
                <label for="email">EMAIL : </label>
                <input type="email" name="email" id="email" placeholder="exemple@gmail.com" required><br>
                <label for="confirmEmail">CONFIRMATION EMAIL : </label>
                <input type="email" name="confirmEmail" id="confirmEmail" placeholder="exemple@gmail.com" required><br>
                <label for="password">MOT DE PASSE : </label>
                <input type="password" name="password" id="password" placeholder="* * * * * * * *" required><br>
                <label for="confirmPassword">CONFIRMATION MOT DE PASSE : </label>
                <input type="password" name="confirmPassword" id="confirmPassword" placeholder="* * * * * * * *" required><br>
                <button type="submit">S'inscrire</button>
            </form>
        </div>
    </main>
@endsection
