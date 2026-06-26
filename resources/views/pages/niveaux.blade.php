@extends('layouts.app')
@section('title', 'Niveaux scolaires')
@section('content')
    <div class="site-breadcrumb" style="background: url({{ asset('assets/img/breadcrumb/01.jpg') }})">
        <div class="container">
            <h2 class="breadcrumb-title">Niveaux scolaires</h2>
            <ul class="breadcrumb-menu">
                <li><a href="{{ route('home') }}">Accueil</a></li>
                <li class="active">Niveaux scolaires</li>
            </ul>
        </div>
    </div>
    <div class="py-120 container text-center">
        <h2>Page en construction</h2>
    </div>
@endsection