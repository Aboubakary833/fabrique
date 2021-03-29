@extends('base')
@section('title')
    <title>Admin Panel</title>
@endsection
@section('style')
    <link rel="stylesheet" href="/css/admin.css">
@endsection
@section('content')
    <header>
        <div class="up">
            <a href="{{ route('adminLogout') }}"><img src="/fonts/svgs/sign-out-alt.svg" alt="Se déconnecter"></a>
        </div>
        <div class="down">
            <a href="{{ route('admin') }}"><img src="/fonts/logo.png" alt="Simplon"></a>
        </div>
    </header>
    <main>
        <div class="nav">
            <div class="newbies">Nouveaux inscrits</div>
            <div class="reservation">Réservations</div>
            <div class="reservConfig">Configurer une reservation</div>
            <div class="bookers">Liste des réservataires</div>
            <div class="subscribers">Liste des apprenants</div>
        </div>
        <div id="target">

        </div>
    </main>
    <script src="/js/admin.js" type="module"></script>
    <script type="text/javascript">
        const logoutBtn = document.querySelector('.up a');
        logoutBtn.addEventListener('click', function() {
            history.replaceState(null, null, '/');
        })
    </script>
@endsection
