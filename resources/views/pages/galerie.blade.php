@extends('layouts.app')

@section('title', 'Galerie')
@section('meta_description', 'Photos et événements du Groupe Scolaire La Petite Thérèse à Port-Bouet / Gonzague, Abidjan.')

@section('content')

    {{-- BREADCRUMB --}}
    <div class="site-breadcrumb" style="background: url({{ asset('assets/img/breadcrumb/01.jpg') }})">
        <div class="container">
            <h2 class="breadcrumb-title">Galerie & Événements</h2>
            <ul class="breadcrumb-menu">
                <li><a href="{{ route('home') }}">Accueil</a></li>
                <li class="active">Galerie & Événements</li>
            </ul>
        </div>
    </div>

    {{-- GALERIE PHOTOS --}}
    <div class="gallery-area py-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <div class="site-heading text-center">
                        <span class="site-title-tagline">
                            <i class="far fa-book-open-reader"></i> Galerie
                        </span>
                        <h2 class="site-title">Notre <span>galerie photos</span></h2>
                        <p>Fêtes scolaires, activités sportives, remises de prix, sorties pédagogiques — la vie de l'école en images.</p>
                    </div>
                </div>
            </div>
            {{-- Remplacer les images par les vraies photos de l'école --}}
            <div class="row popup-gallery">
                <div class="col-md-4 wow fadeInUp" data-wow-delay=".25s">
                    <div class="gallery-item">
                        <div class="gallery-img">
                            <img src="{{ asset('assets/img/gallery/01.jpg') }}" alt="Vie scolaire">
                        </div>
                        <div class="gallery-content">
                            <a class="popup-img gallery-link" href="{{ asset('assets/img/gallery/01.jpg') }}">
                                <i class="fal fa-plus"></i>
                            </a>
                        </div>
                    </div>
                    <div class="gallery-item">
                        <div class="gallery-img">
                            <img src="{{ asset('assets/img/gallery/02.jpg') }}" alt="Vie scolaire">
                        </div>
                        <div class="gallery-content">
                            <a class="popup-img gallery-link" href="{{ asset('assets/img/gallery/02.jpg') }}">
                                <i class="fal fa-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 wow fadeInUp" data-wow-delay=".50s">
                    <div class="gallery-item">
                        <div class="gallery-img">
                            <img src="{{ asset('assets/img/gallery/03.jpg') }}" alt="Vie scolaire">
                        </div>
                        <div class="gallery-content">
                            <a class="popup-img gallery-link" href="{{ asset('assets/img/gallery/03.jpg') }}">
                                <i class="fal fa-plus"></i>
                            </a>
                        </div>
                    </div>
                    <div class="gallery-item">
                        <div class="gallery-img">
                            <img src="{{ asset('assets/img/gallery/04.jpg') }}" alt="Vie scolaire">
                        </div>
                        <div class="gallery-content">
                            <a class="popup-img gallery-link" href="{{ asset('assets/img/gallery/04.jpg') }}">
                                <i class="fal fa-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 wow fadeInUp" data-wow-delay=".75s">
                    <div class="gallery-item">
                        <div class="gallery-img">
                            <img src="{{ asset('assets/img/gallery/05.jpg') }}" alt="Vie scolaire">
                        </div>
                        <div class="gallery-content">
                            <a class="popup-img gallery-link" href="{{ asset('assets/img/gallery/05.jpg') }}">
                                <i class="fal fa-plus"></i>
                            </a>
                        </div>
                    </div>
                    <div class="gallery-item">
                        <div class="gallery-img">
                            <img src="{{ asset('assets/img/gallery/06.jpg') }}" alt="Vie scolaire">
                        </div>
                        <div class="gallery-content">
                            <a class="popup-img gallery-link" href="{{ asset('assets/img/gallery/06.jpg') }}">
                                <i class="fal fa-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ÉVÉNEMENTS --}}
    <!-- <div class="event-area bg py-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <div class="site-heading text-center">
                        <span class="site-title-tagline">
                            <i class="far fa-book-open-reader"></i> Événements
                        </span>
                        <h2 class="site-title">Nos prochains <span>événements</span></h2>
                        <p>Restez informés des activités et événements à venir dans notre école.</p>
                    </div>
                </div>
            </div>
            {{-- Remplacer par les vrais événements de l'école --}}
            <div class="event-slider owl-carousel owl-theme">

                <div class="event-item">
                    <div class="event-location">
                        <span><i class="far fa-map-marker-alt"></i> Port-Bouet / Gonzague Ville, Abidjan</span>
                    </div>
                    <div class="event-img">
                        <img src="{{ asset('assets/img/event/01.jpg') }}" alt="Fête de fin d'année">
                    </div>
                    <div class="event-info">
                        <div class="event-meta">
                            {{-- Remplacer par la vraie date --}}
                            <span class="event-date"><i class="far fa-calendar-alt"></i> Juin 2025</span>
                            <span class="event-time"><i class="far fa-clock"></i> 09h00 – 17h00</span>
                        </div>
                        <h4 class="event-title">Fête de fin d'année scolaire</h4>
                        <p>Remise des bulletins, spectacles des élèves, remises de prix et moments de partage avec les familles.</p>
                        <div class="event-btn">
                            <a href="{{ route('contact') }}" class="theme-btn">
                                Plus d'infos <i class="fas fa-arrow-right-long"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="event-item">
                    <div class="event-location">
                        <span><i class="far fa-map-marker-alt"></i> Port-Bouet / Gonzague Ville, Abidjan</span>
                    </div>
                    <div class="event-img">
                        <img src="{{ asset('assets/img/event/02.jpg') }}" alt="Journée sportive">
                    </div>
                    <div class="event-info">
                        <div class="event-meta">
                            <span class="event-date"><i class="far fa-calendar-alt"></i> Mars 2025</span>
                            <span class="event-time"><i class="far fa-clock"></i> 08h00 – 13h00</span>
                        </div>
                        <h4 class="event-title">Journée sportive inter-classes</h4>
                        <p>Compétitions sportives amicales entre les classes de primaire : course, saut en longueur, relais.</p>
                        <div class="event-btn">
                            <a href="{{ route('contact') }}" class="theme-btn">
                                Plus d'infos <i class="fas fa-arrow-right-long"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="event-item">
                    <div class="event-location">
                        <span><i class="far fa-map-marker-alt"></i> Port-Bouet / Gonzague Ville, Abidjan</span>
                    </div>
                    <div class="event-img">
                        <img src="{{ asset('assets/img/event/03.jpg') }}" alt="Réunion parents">
                    </div>
                    <div class="event-info">
                        <div class="event-meta">
                            <span class="event-date"><i class="far fa-calendar-alt"></i> Octobre 2025</span>
                            <span class="event-time"><i class="far fa-clock"></i> 16h00 – 18h00</span>
                        </div>
                        <h4 class="event-title">Réunion parents-enseignants</h4>
                        <p>Rencontre entre les parents et les enseignants pour faire le point sur la progression des élèves.</p>
                        <div class="event-btn">
                            <a href="{{ route('contact') }}" class="theme-btn">
                                Plus d'infos <i class="fas fa-arrow-right-long"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="event-item">
                    <div class="event-location">
                        <span><i class="far fa-map-marker-alt"></i> Port-Bouet / Gonzague Ville, Abidjan</span>
                    </div>
                    <div class="event-img">
                        <img src="{{ asset('assets/img/event/04.jpg') }}" alt="Rentrée scolaire">
                    </div>
                    <div class="event-info">
                        <div class="event-meta">
                            <span class="event-date"><i class="far fa-calendar-alt"></i> Septembre 2025</span>
                            <span class="event-time"><i class="far fa-clock"></i> 07h30</span>
                        </div>
                        <h4 class="event-title">Rentrée scolaire 2025–2026</h4>
                        <p>Accueil des nouveaux élèves et début officiel de l'année scolaire. Inscriptions encore possibles.</p>
                        <div class="event-btn">
                            <a href="{{ route('admissions') }}" class="theme-btn">
                                S'inscrire <i class="fas fa-arrow-right-long"></i>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div> -->

@endsection