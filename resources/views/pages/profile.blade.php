@extends('base')
@section('title')
    <title>Profil</title>
@endsection
@section('style')
    <link rel="stylesheet" href="/css/profile.css">
@endsection
@section('content')
    <main>
        <div class="header">Information du nouveau inscrit</div>
        <div class="user">
           @foreach ($userInfos as $userInfo)
               <div>
                   <span class="label">PRENOM : </span>
                   <span class="info">{{ $userInfo->firstname }}</span>
               </div>
               <div>
                <span class="label">NOM : </span>
                <span class="info">{{ $userInfo->lastname }}</span>
            </div>
            <div>
                <span class="label">NAISSANCE : </span>
                <span class="info">{{ $userInfo->birthday }}</span>
            </div>
            <div>
                <span class="label">EMAIL : </span>
                <span class="info">{{ $userInfo->email }}</span>
            </div>
            <div>
                <span class="label">DATE VERIFICATION EMAIL : </span>
                <span class="info">{{ $userInfo->email_verified_at }}</span>
            </div>
            <div>
                <span class="label">DATE INSCRIPTON : </span>
                <span class="info">{{ $userInfo->created_at }}</span>
            </div>
            <div class="validate">
                <a href="{{ route('validate', [$userInfo->userId]) }}">Valider</a>
            </div>
            <div class="delete">
                <a href="{{ route('delete', [$userInfo->userId]) }}">Supprimer</a>
            </div>
            </div>
            <div class="adminpage">
                <a href="{{ route('admin') }}">Retour à a page admin</a>
            </div>
           @endforeach
        </div>
    </main>
@endsection
