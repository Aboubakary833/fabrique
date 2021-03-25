@extends('base')
@section('title')
    <title>Accueil</title>
@endsection
@section('style')
    <link rel="stylesheet" href="/css/home.css">
@endsection
@section('content')
    <header>
        <div class="up">
            <a href="{{ route('logout') }}"><img src="/fonts/svgs/sign-out-alt.svg" alt="Se déconnecter"></a>
        </div>
        <div class="down">
            <a href="#"><img src="/fonts/logo.png" alt="Simplon"></a>
        </div>
    </header>
    <main>
        <p>Le nombre daccès disponible est de {{ isset($infos) ? count($infos[1]) : 0 }}</p>
        <div>
            <p>Du Lundi au Vendredi entre <span>17 HEURES</span> et <span>20 HEURES</span></p>
            <p>Du Samedi au Dimanche entre <span>9 HEURES</span> et <span>20 HEURES</span></p>
        </div>
        <div>
            @if (isset($infos))
                @if (count($infos[0]))
                <h1>Vous avez déja reservé un accès!</h1>
                @else
                    <a href="/weekBooking">Réserver l'accès pour 7 jours</a>
                    <a href="/todayBooking">Reserver l'accès pour aujourd'hui</a>
                @endif
            @endif

        </div>
    </main>
    <footer>
        <p>&copy; Copyright - 2021</p>
    </footer>
@endsection
