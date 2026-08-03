@extends('layouts.app')

@section('title', 'Corps enseignant')
@section('meta_description', 'Découvrez l\'équipe pédagogique du Groupe Scolaire Catholique La Petite Thérèse.')

@section('content')

    {{-- BREADCRUMB --}}
    <div class="site-breadcrumb" style="background: url({{ asset('assets/img/breadcrumb/01.jpg') }})">
        <div class="container">
            <h2 class="breadcrumb-title">Corps enseignant</h2>
            <ul class="breadcrumb-menu">
                <li><a href="{{ route('home') }}">Accueil</a></li>
                <li class="active">Corps enseignant</li>
            </ul>
        </div>
    </div>

    {{-- DIRECTION --}}
    @if($direction->count() > 0)
    <div class="team-area py-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <div class="site-heading text-center">
                        <span class="site-title-tagline"><i class="fas fa-book-open-reader"></i> Direction</span>
                        <h2 class="site-title">Notre <span>équipe de direction</span></h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                @foreach($direction as $membre)
                <div class="col-md-6 col-lg-3">
                    <div class="team-item wow fadeInUp" data-wow-delay=".25s">
                        <div class="team-img">
                            <img src="{{ $membre->photo_url }}" alt="{{ $membre->nom_complet }}">
                        </div>
                        <div class="team-social">
                            @if($membre->facebook)
                                <a href="{{ $membre->facebook }}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                            @endif
                            @if($membre->whatsapp)
                                <a href="https://wa.me/{{ $membre->whatsapp }}" target="_blank"><i class="fab fa-whatsapp"></i></a>
                            @endif
                            @if($membre->linkedin)
                                <a href="{{ $membre->linkedin }}" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                            @endif
                        </div>
                        <div class="team-content">
                            <div class="team-bio">
                                <h5>{{ $membre->nom_complet }}</h5>
                                <span>{{ $membre->poste }}</span>
                            </div>
                        </div>
                        <span class="team-social-btn"><i class="fas fa-share-nodes"></i></span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    {{-- ENSEIGNANTS --}}
    <div class="team-area {{ $direction->count() > 0 ? 'pb-120' : 'py-120' }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <div class="site-heading text-center">
                        <span class="site-title-tagline"><i class="fas fa-book-open-reader"></i> Nos enseignants</span>
                        <h2 class="site-title">Rencontrez notre <span>équipe pédagogique</span></h2>
                        <p>Des professionnels qualifiés et passionnés, engagés chaque jour pour la réussite de vos enfants.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @forelse($enseignants as $membre)
                <div class="col-md-6 col-lg-3">
                    <div class="team-item wow fadeInUp" data-wow-delay=".25s">
                        <div class="team-img">
                            <img src="{{ $membre->photo_url }}" alt="{{ $membre->nom_complet }}">
                        </div>
                        <div class="team-social">
                            @if($membre->facebook)
                                <a href="{{ $membre->facebook }}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                            @endif
                            @if($membre->whatsapp)
                                <a href="https://wa.me/{{ $membre->whatsapp }}" target="_blank"><i class="fab fa-whatsapp"></i></a>
                            @endif
                        </div>
                        <div class="team-content">
                            <div class="team-bio">
                                <h5>{{ $membre->nom_complet }}</h5>
                                <span>{{ $membre->poste }}</span>
                            </div>
                        </div>
                        <span class="team-social-btn"><i class="fas fa-share-nodes"></i></span>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <p>L'équipe pédagogique sera présentée prochainement.</p>
                    <a href="{{ route('contact') }}" class="theme-btn mt-3">Nous contacter <i class="fas fa-arrow-right-long"></i></a>
                </div>
                @endforelse
            </div>
        </div>
    </div>

@endsection