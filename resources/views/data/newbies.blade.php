@if (count($newbies) == 0)
    <div class="empty">Pas de nouvelle inscription</div>
@else
    <div class="header">Liste des nouveaux inscrits</div>
    @foreach ($newbies as $newby)
    <div class="newbiesList">
        <div><span>{{ $newby->firstname }} {{ $newby->lastname }}</span></div>
        <div><a href="newbies/profil/{{ $newby->userId }}" class="profil">Voir profil</a></div>
        <div><a href="newbies/validate/{{ $newby->userId }}/{{ $newby->email }}" class="validate">Valider</a></div>
        <div><a href="newbies/delete/{{ $newby->userId }}" class="delete">Supprimer</a></div>
    </div>
    @endforeach
@endif
