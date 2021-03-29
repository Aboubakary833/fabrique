@extends('base')
@section('title')
    <title>connexion</title>
@endsection
@section('style')
    <link rel="stylesheet" href="/css/app.css">
@endsection
@section('content')
    <main>
        <div class="simplon-img">
            <img src="/images/logo_Simplon.png" alt="Logo_Simplon">
        </div>
        <div class="form">
            <h1>Connexion</h1>
            @error('email')
                <strong id="error">Email ou mot de passe incorrect!</strong>
            @enderror
            <form action="/" method="POST">
            @csrf
                <div class="custom_inp">
                    <img src="/fonts/svgs/envelope.svg" alt="Email">
                    <input type="email" name="email" placeholder="exemple@gmail.com" autocomplete="false" required>
                </div>
                <div class="custom_inp">
                    <img src="/fonts/svgs/lock.svg" alt="Mot de passe">
                    <input type="password" name="password" placeholder=". . . . . . .  ." required>
                </div>
                <button type="submit">Se connecter</button>
            </form>
            <div class="form_subLinks">
                <a href="{{ route('toResetPasswordPage') }}">Mot de passe oublié?</a>
                <a href="{{ route('register') }}">Sinscrire</a>
            </div>
        </div>
    </main>
    <script type="text/javascript">
        const email = document.querySelector('input[type="email"]');
        const password = document.querySelector('input[type="password"]');
        email.addEventListener('focus', function() {
            this.parentNode.style.boxShadow = '0 0 0 3px rgba(0, 0, 0, 0.5)';
        });
        password.addEventListener('focus', function() {
            this.parentNode.style.boxShadow = '0 0 0 3px rgba(0, 0, 0, 0.5)';
        });
        email.addEventListener('blur', function() {
            this.parentNode.style.boxShadow = 'none';
        });
        password.addEventListener('blur', function() {
            this.parentNode.style.boxShadow = 'none';
        })
    </script>
@endsection
