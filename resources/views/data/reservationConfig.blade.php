@extends('base')
@section('content')

<div class="header">Mise en place des accès</div>
<div class="reservartionConfig">
    <div class="reservationHeader">
        <div class="bloc_1">
            <span>Jour</span>
            <span>Date complet</span>
        </div>
        <div class="bloc_2">
            <span>Ouverture</span>
            <span>Fermeture</span>
        </div>
    </div>
    <form action="{{ route('workup') }}" method="post">
        @csrf
        @foreach ($reservationsDays as $day => $date)
        <div class="form_bloc">
            <div class="day_date">
                <input type="checkbox" name="{{ $day }}" value="{{ $date }}">
                <span>{{ $day }}</span>
            <label for="{{ $day }}">{{ $date }}</label>
            </div>
            <div class="begin_end">
                <input type="time" name="{{ $day }}openHour" id="openHour">
                <input type="time" name="{{ $day }}closeHour">
            </div>
        </div>
        @endforeach
        <label for="amount">Nombre d'apprenants : </label><input type="number" name="amount" min="0" max="25" id="amount" required><br />
        <button type="submit">Mettre en place</button>
    </form>
</div>
@endsection
