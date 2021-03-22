@if (count($subscribers) == 0)
    <div class="empty">Aucun apprenant inscrit pour l'instant!</div>
@else
    <div class="header">Liste des apprenants</div>
    @foreach ($subscribers as $subscriber)
    <div class="subscribersList">
        <div><span>{{ $subscriber->firstname }} {{ $subscriber->lastname }}</span></div>
        <div><span>{{ $subscriber->lastname }}</span></div>
        <div><span>{{ $subscriber->birthday }}</span></div>
        <div><span>{{ $subscriber->email }}</span></div>
        <div><a href="subscribers/delete/{{ $subscriber->userId }}" class="delete">Supprimer</a></div>
    </div>
    @endforeach
@endif
