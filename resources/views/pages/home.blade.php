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
            <a href="/home"><img src="/fonts/logo.png" alt="Simplon"></a>
        </div>
    </header>
    <main>
        @if (isset($no_booking))
            <h1 style="margin: 40vh auto;">{{ $no_booking }}</h1>
        @else
            @if (isset($is_underway))
            <h1 style="margin: 40vh auto;">{{ $is_underway }}</h1>
            @else
                <p>Le nombre de places restants est de : <strong>{{ $data[0] }}</strong></p>
                <form action="{{ route('reserve') }}" method="post">
                    @csrf
                    @foreach ($data[1] as $key => $value)
                        <div>
                            <span class="jour"><strong>{{ $key }}</strong></span>
                            <span class="date">{{ $value["date"] }}</span>
                            <span class="hours">de <strong>{{ $value["BeginHour"] }}</strong> à <strong>{{ $value["EndHour"] }}</strong></span>
                            <input type="checkbox" name="{{ $key }}" value="{{ $value["date"] }},{{ $value["BeginHour"] }},{{ $value["EndHour"] }}">
                        </div>
                    @endforeach
                    <input type="hidden" name="reservationEnd" value="{{ $data[2] }}">
                    <button type="submit">Réserver</button>
                </form>
            @endif
        @endif

    </main>
    <footer>
        <p>&copy; Copyright - 2021</p>
    </footer>
    <script type="text/javascript">
        const logoutBtn = document.querySelector('.up a');
        logoutBtn.addEventListener('click', function() {
            history.replaceState(null, null, '/');
        })
    </script>
@endsection
