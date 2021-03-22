@if (count($reservations) == 0)
    <div class="empty">Pas de demande réservation</div>
@else
    <div class="header">Liste des réservations</div>
    <div class="label_reservations">
        <div><span>Nom & Prénom</span></div>
        <div><span>Début d'accès</span></div>
        <div><span>Fin d'accès</span></div>
    </div>
    @foreach ($reservations as $reservation)
    <div class="reservationsList">
        <div><span>{{ $reservation->firstname }} {{ $reservation->lastname }}</span></div>
        <div><span>{{ $reservation->reservationBegin }}</span></div>
        <div><span>{{ $reservation->reservationEnd }}</span></div>
        <div><a href="reservations/validate/{{ $reservation->reservationId }}" class="validate">Valider</a></div>
        <div><a href="reservations/delete/{{ $reservation->reservationId }}" class="delete">Supprimer</a></div>
    </div>
    @endforeach
@endif
<div class="reserve_form">
        <h1>Configurer les réservations daccès</h1>
        <form action="/admin/reservations" method="post">
            @csrf
            <label for="reservationTotal">Nombre de place : </label>
            <input type="number" name="reservationTotal" id="reservationTotal" max="25"><br>
            <label for="reservationEnd">Fin du cycle d'accès : </label>
            <input type="date" name="reservationEnd" id="reservationEnd"><br>
            <button type="submit">Mettre en place les accès</button>
        </form>
    </div>
