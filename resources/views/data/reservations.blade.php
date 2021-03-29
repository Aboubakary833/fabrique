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
