@if (count($bookers) == 0)
    <div class="empty">Liste de réservataires vide</div>
@else
    <div class="header">Liste des réservataires</div>
    <div class="label_bookers">
        <div><span>Nom & Prénom</span></div>
        <div><span>Début d'accès</span></div>
        <div><span>Fin d'accès</span></div>
    </div>
    @foreach ($bookers as $booker)
    <div class="reservationsList">
        <div><span>{{ $booker->firstname }} {{ $booker->lastname }}</span></div>
        <div><span>{{ $booker->reservationBegin }}</span></div>
        <div><span>{{ $booker->reservationEnd }}</span></div>
    </div>
    @endforeach
@endif
