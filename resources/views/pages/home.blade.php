@extends('layouts.app')

@section('title', 'Accueil')
@section('meta_description', 'Groupe Scolaire La Petite Thérèse - École d\'excellence à Port-Bouet / Gonzague, Abidjan. Maternelle et Primaire.')

@section('content')

    {{-- ==============================
         HERO SLIDER
    ============================== --}}
    <div class="hero-section">
        <div class="hero-slider owl-carousel owl-theme">

            <div class="hero-single" style="background: url({{ asset('assets/img/slider/slider-1.jpg') }})">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-12 col-lg-7">
                            <div class="hero-content">
                                <h6 class="hero-sub-title" data-animation="fadeInDown" data-delay=".25s">
                                    <i class="fas fa-book-open-reader"></i> Bienvenue à La Petite Thérèse !
                                </h6>
                                <h1 class="hero-title" data-animation="fadeInRight" data-delay=".50s">
                                    Un avenir brillant commence <span>ici</span>
                                </h1>
                                <p data-animation="fadeInLeft" data-delay=".75s">
                                    De la Maternelle au CM2, nous accompagnons chaque élève avec
                                    bienveillance et exigence au cœur de Port-Bouet / Gonzague, Abidjan.
                                </p>
                                <div class="hero-btn" data-animation="fadeInUp" data-delay="1s">
                                    <a href="{{ route('about') }}" class="theme-btn">
                                        Découvrir l'école <i class="fas fa-arrow-right-long"></i>
                                    </a>
                                    <a href="{{ route('contact') }}" class="theme-btn theme-btn2">
                                        Nous contacter <i class="fas fa-arrow-right-long"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="hero-single" style="background: url({{ asset('assets/img/slider/slider-2.jpg') }})">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-12 col-lg-7">
                            <div class="hero-content">
                                <h6 class="hero-sub-title" data-animation="fadeInDown" data-delay=".25s">
                                    <i class="fas fa-book-open-reader"></i> Excellence & Bienveillance
                                </h6>
                                <h1 class="hero-title" data-animation="fadeInRight" data-delay=".50s">
                                    Des enseignants <span>passionnés</span> pour vos enfants
                                </h1>
                                <p data-animation="fadeInLeft" data-delay=".75s">
                                    Une équipe pédagogique qualifiée, engagée pour la réussite
                                    scolaire et l'épanouissement de chaque élève.
                                </p>
                                <div class="hero-btn" data-animation="fadeInUp" data-delay="1s">
                                    <a href="{{ route('enseignants') }}" class="theme-btn">
                                        Notre équipe <i class="fas fa-arrow-right-long"></i>
                                    </a>
                                    <a href="{{ route('admissions') }}" class="theme-btn theme-btn2">
                                        S'inscrire <i class="fas fa-arrow-right-long"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="hero-single" style="background: url({{ asset('assets/img/slider/slider-3.jpg') }})">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-12 col-lg-7">
                            <div class="hero-content">
                                <h6 class="hero-sub-title" data-animation="fadeInDown" data-delay=".25s">
                                    <i class="fas fa-book-open-reader"></i> Inscriptions ouvertes
                                </h6>
                                <h1 class="hero-title" data-animation="fadeInRight" data-delay=".50s">
                                    Rejoignez la famille <span>La Petite Thérèse</span>
                                </h1>
                                <p data-animation="fadeInLeft" data-delay=".75s">
                                    Inscriptions pour l'année scolaire en cours. Places limitées —
                                    contactez-nous dès maintenant pour réserver la place de votre enfant.
                                </p>
                                <div class="hero-btn" data-animation="fadeInUp" data-delay="1s">
                                    <a href="{{ route('admissions') }}" class="theme-btn">
                                        S'inscrire maintenant <i class="fas fa-arrow-right-long"></i>
                                    </a>
                                    <a href="{{ route('niveaux') }}" class="theme-btn theme-btn2">
                                        Nos niveaux <i class="fas fa-arrow-right-long"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    {{-- Hero Slider End --}}


    {{-- ==============================
         FEATURE AREA (points forts)
    ============================== --}}
    <div class="feature-area fa-negative">
        <div class="col-xl-9 ms-auto">
            <div class="feature-wrapper">
                <div class="row g-4">
                    <div class="col-md-6 col-lg-3">
                        <div class="feature-item">
                            <span class="count">01</span>
                            <div class="feature-icon">
                                <img src="{{ asset('assets/img/icon/scholarship.svg') }}" alt="">
                            </div>
                            <div class="feature-content">
                                <h4 class="feature-title">Bourses & Aides</h4>
                                <p>Des dispositifs d'aide existent pour accompagner les familles dans la scolarité de leurs enfants.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="feature-item">
                            <span class="count">02</span>
                            <div class="feature-icon">
                                <img src="{{ asset('assets/img/icon/teacher.svg') }}" alt="">
                            </div>
                            <div class="feature-content">
                                <h4 class="feature-title">Enseignants qualifiés</h4>
                                <p>Une équipe pédagogique diplômée, expérimentée et dédiée à la réussite de chaque élève.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="feature-item">
                            <span class="count">03</span>
                            <div class="feature-icon">
                                <img src="{{ asset('assets/img/icon/library.svg') }}" alt="">
                            </div>
                            <div class="feature-content">
                                <h4 class="feature-title">Bibliothèque scolaire</h4>
                                <p>Un espace de lecture et de travail bien fourni pour encourager la curiosité intellectuelle.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="feature-item">
                            <span class="count">04</span>
                            <div class="feature-icon">
                                <img src="{{ asset('assets/img/icon/money.svg') }}" alt="">
                            </div>
                            <div class="feature-content">
                                <h4 class="feature-title">Frais accessibles</h4>
                                <p>Des frais de scolarité adaptés pour offrir une éducation de qualité au plus grand nombre.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Feature Area End --}}


    {{-- ==============================
         ABOUT AREA (À propos)
    ============================== --}}
    <div class="about-area py-120">
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-lg-6">
                    <div class="about-left wow fadeInLeft" data-wow-delay=".25s">
                        <div class="about-img">
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <img class="img-1" src="{{ asset('assets/img/about/01.jpg') }}" alt="École La Petite Thérèse">
                                    <div class="about-experience mt-4">
                                        <div class="about-experience-icon">
                                            <img src="{{ asset('assets/img/icon/exchange-idea.svg') }}" alt="">
                                        </div>
                                        <b class="text-start">+ de 20 ans <br> d'excellence</b>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <img class="img-2" src="{{ asset('assets/img/about/02.jpg') }}" alt="">
                                    <img class="img-3 mt-4" src="{{ asset('assets/img/about/03.jpg') }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-right wow fadeInRight" data-wow-delay=".25s">
                        <div class="site-heading mb-3">
                            <span class="site-title-tagline">
                                <i class="fas fa-book-open-reader"></i> À propos de nous
                            </span>
                            <h2 class="site-title">
                                Notre système éducatif <span>vous inspire</span> davantage.
                            </h2>
                        </div>
                        <p class="about-text">
                            Fondé à Port-Bouet / Gonzague Ville, le Groupe Scolaire Catholique La Petite Thérèse
                            s'est bâti une réputation d'excellence grâce à son engagement envers la qualité
                            de l'enseignement et le bien-être de chaque élève. De la Maternelle au CM2,
                            nous formons les citoyens de demain.
                        </p>
                        <div class="about-content">
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="about-item">
                                        <div class="about-item-icon">
                                            <img src="{{ asset('assets/img/icon/open-book.svg') }}" alt="">
                                        </div>
                                        <div class="about-item-content">
                                            <h5>Suivi pédagogique</h5>
                                            <p>Un accompagnement personnalisé pour chaque élève tout au long de l'année.</p>
                                        </div>
                                    </div>
                                    <div class="about-item">
                                        <div class="about-item-icon">
                                            <img src="{{ asset('assets/img/icon/global-education.svg') }}" alt="">
                                        </div>
                                        <div class="about-item-content">
                                            <h5>Programmes officiels</h5>
                                            <p>Alignés sur les programmes du Ministère de l'Éducation Nationale de Côte d'Ivoire.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="about-quote">
                                        <p>
                                            « Je veux passer mon ciel à faire du bien sur la terre. »
                                        </p>
                                        <i class="fas fa-quote-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="about-bottom">
                            <a href="{{ route('about') }}" class="theme-btn">
                                En savoir plus <i class="fas fa-arrow-right-long"></i>
                            </a>
                            <div class="about-phone">
                                <div class="icon"><i class="fas fa-headset"></i></div>
                                <div class="number">
                                    <span>Appelez-nous</span>
                                    <h6><a href="tel:+2250700000000">+225 07 00 00 00 00</a></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- About Area End --}}


    {{-- ==============================
         COUNTER AREA (chiffres clés)
    ============================== --}}
    <div class="counter-area pt-60 pb-60">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="counter-box">
                        <div class="icon">
                            <img src="{{ asset('assets/img/icon/graduation.svg') }}" alt="">
                        </div>
                        <div>
                            <span class="counter" data-count="+" data-to="450" data-speed="3000">450</span>
                            <h6 class="title">+ Élèves</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="counter-box">
                        <div class="icon">
                            <img src="{{ asset('assets/img/icon/teacher-2.svg') }}" alt="">
                        </div>
                        <div>
                            <span class="counter" data-count="+" data-to="30" data-speed="3000">30</span>
                            <h6 class="title">+ Enseignants</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="counter-box">
                        <div class="icon">
                            <img src="{{ asset('assets/img/icon/course.svg') }}" alt="">
                        </div>
                        <div>
                            <span class="counter" data-count="+" data-to="8" data-speed="3000">8</span>
                            <h6 class="title">Niveaux scolaires</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="counter-box">
                        <div class="icon">
                            <img src="{{ asset('assets/img/icon/award.svg') }}" alt="">
                        </div>
                        <div>
                            <span class="counter" data-count="+" data-to="20" data-speed="3000">20</span>
                            <h6 class="title">Années d'existence</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Counter Area End --}}


    {{-- ==============================
         NIVEAUX SCOLAIRES
    ============================== --}}
    <div class="course-area py-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <div class="site-heading text-center">
                        <span class="site-title-tagline">
                            <i class="fas fa-book-open-reader"></i> Nos niveaux
                        </span>
                        <h2 class="site-title">Découvrez nos <span>niveaux scolaires</span></h2>
                        <p>Du préscolaire au CM2, nous proposons un parcours éducatif complet et cohérent pour accompagner votre enfant à chaque étape de sa croissance.</p>
                    </div>
                </div>
            </div>

            {{-- CORRECTION : justify-content-center + align-items-stretch pour hauteur égale --}}
            <div class="row justify-content-center align-items-stretch g-4">

                {{-- Maternelle --}}
                <div class="col-md-6 col-lg-5">
                    <div class="course-item wow fadeInUp h-100" data-wow-delay=".25s">
                        <div class="course-img">
                            <span class="course-tag"><i class="fas fa-bookmark"></i> Préscolaire</span>
                            <img src="{{ asset('assets/img/course/01.jpg') }}" alt="Maternelle">
                            <a href="{{ route('niveaux') }}#maternelle" class="btn"><i class="fas fa-link"></i></a>
                        </div>
                        <div class="course-content">
                            <div class="course-meta">
                                <span class="course-meta-left"><i class="fas fa-users"></i> 3 – 5 ans</span>
                            </div>
                            <h4 class="course-title">
                                <a href="{{ route('niveaux') }}#maternelle">Maternelle</a>
                            </h4>
                            <p class="course-text">
                                La Moyenne Section (MS) et Grande Section (GS).
                                Un environnement ludique et sécurisant pour les premiers apprentissages.
                            </p>
                            <div class="course-bottom">
                                <div class="course-bottom-left">
                                    <span><i class="fas fa-clock"></i> 2 niveaux</span>
                                </div>
                                <a href="{{ route('admissions') }}" class="course-price" style="font-size:13px">S'inscrire</a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Primaire --}}
                <div class="col-md-6 col-lg-5">
                    <div class="course-item wow fadeInUp h-100" data-wow-delay=".50s">
                        <div class="course-img">
                            <span class="course-tag"><i class="fas fa-bookmark"></i> Primaire</span>
                            <img src="{{ asset('assets/img/course/02.jpg') }}" alt="Primaire">
                            <a href="{{ route('niveaux') }}#primaire" class="btn"><i class="fas fa-link"></i></a>
                        </div>
                        <div class="course-content">
                            <div class="course-meta">
                                <span class="course-meta-left"><i class="fas fa-users"></i> 6 – 11 ans</span>
                            </div>
                            <h4 class="course-title">
                                <a href="{{ route('niveaux') }}#primaire">École Primaire</a>
                            </h4>
                            <p class="course-text">
                                Du CP au CM2 — 6 années pour consolider les fondamentaux :
                                lecture, écriture, mathématiques, sciences et éveil.
                            </p>
                            <div class="course-bottom">
                                <div class="course-bottom-left">
                                    <span><i class="fas fa-clock"></i> 6 niveaux</span>
                                </div>
                                <a href="{{ route('admissions') }}" class="course-price" style="font-size:13px">S'inscrire</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    {{-- Niveaux Area End --}}


    {{-- ==============================
         ENSEIGNANTS (aperçu)
    ============================== --}}
    <!-- <div class="team-area py-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <div class="site-heading text-center">
                        <span class="site-title-tagline">
                            <i class="fas fa-book-open-reader"></i> Nos enseignants
                        </span>
                        <h2 class="site-title">Rencontrez notre <span>équipe pédagogique</span></h2>
                        <p>Des professionnels passionnés et dévoués à l'épanouissement de vos enfants.</p>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-md-6 col-lg-3">
                    <div class="team-item wow fadeInUp" data-wow-delay=".25s">
                        <div class="team-img">
                            <img src="{{ asset('assets/img/team/01.PNG') }}" alt="Père Luc SENOU">
                        </div>
                        <div class="team-social">
                            <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                            <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                        <div class="team-content">
                            <div class="team-bio">
                                <h5><a href="{{ route('enseignants') }}">Père Luc SENOU</a></h5>
                                <span>Directeur Général</span>
                            </div>
                        </div>
                        <span class="team-social-btn"><i class="fas fa-share-nodes"></i></span>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="team-item wow fadeInUp" data-wow-delay=".50s">
                        <div class="team-img">
                            <img src="{{ asset('assets/img/team/01.PNG') }}" alt="M. Jerome KRAGBE">
                        </div>
                        <div class="team-social">
                            <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                            <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                        <div class="team-content">
                            <div class="team-bio">
                                <h5><a href="{{ route('enseignants') }}">M. Jerome KRAGBE</a></h5>
                                <span>Directeur des Études</span>
                            </div>
                        </div>
                        <span class="team-social-btn"><i class="fas fa-share-nodes"></i></span>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="team-item wow fadeInUp" data-wow-delay=".75s">
                        <div class="team-img">
                            <img src="{{ asset('assets/img/team/01.PNG') }}" alt="M. BRUCE">
                        </div>
                        <div class="team-social">
                            <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                            <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                        <div class="team-content">
                            <div class="team-bio">
                                <h5><a href="{{ route('enseignants') }}">M. BRUCE</a></h5>
                                <span>Enseignant — CM2</span>
                            </div>
                        </div>
                        <span class="team-social-btn"><i class="fas fa-share-nodes"></i></span>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="team-item wow fadeInUp" data-wow-delay="1s">
                        <div class="team-img">
                            <img src="{{ asset('assets/img/team/01.PNG') }}" alt="M. Richard">
                        </div>
                        <div class="team-social">
                            <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                            <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                        <div class="team-content">
                            <div class="team-bio">
                                <h5><a href="{{ route('enseignants') }}">M. Richard</a></h5>
                                <span>Enseignant — CM1</span>
                            </div>
                        </div>
                        <span class="team-social-btn"><i class="fas fa-share-nodes"></i></span>
                    </div>
                </div>

            </div>
        </div>
    </div> -->
    {{-- Team Area End --}}


    {{-- ==============================
         POURQUOI NOUS CHOISIR
    ============================== --}}
    <div class="choose-area pt-80 pb-80">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="choose-content wow fadeInUp" data-wow-delay=".25s">
                        <div class="choose-content-info">
                            <div class="site-heading mb-0">
                                <span class="site-title-tagline">
                                    <i class="fas fa-book-open-reader"></i> Pourquoi nous choisir
                                </span>
                                <h2 class="site-title text-white mb-10">
                                    Nous sommes <span>experts</span> et donnons le meilleur pour votre enfant
                                </h2>
                                <p class="text-white">
                                    À La Petite Thérèse, chaque enfant est unique. Nous adaptons notre
                                    pédagogie pour révéler le potentiel de chacun dans un cadre
                                    sécurisant et stimulant.
                                </p>
                            </div>
                            <div class="choose-content-wrap">
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <div class="choose-item">
                                            <div class="choose-item-icon">
                                                <img src="{{ asset('assets/img/icon/teacher-2.svg') }}" alt="">
                                            </div>
                                            <div class="choose-item-info">
                                                <h4>Enseignants diplômés</h4>
                                                <p>Tous nos enseignants sont certifiés et régulièrement formés.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="choose-item">
                                            <div class="choose-item-icon">
                                                <img src="{{ asset('assets/img/icon/course-material.svg') }}" alt="">
                                            </div>
                                            <div class="choose-item-info">
                                                <h4>Matériel pédagogique</h4>
                                                <p>Manuels, fournitures et ressources adaptés au programme national.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="choose-item">
                                            <div class="choose-item-icon">
                                                <img src="{{ asset('assets/img/icon/online-course.svg') }}" alt="">
                                            </div>
                                            <div class="choose-item-info">
                                                <h4>Activités parascolaires</h4>
                                                <p>Sport, culture, arts — pour le développement global de l'enfant.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="choose-item">
                                            <div class="choose-item-icon">
                                                <img src="{{ asset('assets/img/icon/money.svg') }}" alt="">
                                            </div>
                                            <div class="choose-item-info">
                                                <h4>Frais accessibles</h4>
                                                <p>Une scolarité de qualité à des tarifs adaptés aux familles.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="choose-img wow fadeInRight" data-wow-delay=".25s">
                        <img src="{{ asset('assets/img/choose/01.jpg') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Choose Area End --}}


    {{-- ==============================
         GALERIE APERÇU — DYNAMIQUE
    ============================== --}}
    <div class="gallery-area py-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <div class="site-heading text-center">
                        <span class="site-title-tagline">
                            <i class="fas fa-book-open-reader"></i> Galerie
                        </span>
                        <h2 class="site-title">Notre <span>galerie photos</span></h2>
                        <p>Quelques instants de vie de notre école : fêtes scolaires, activités sportives, remises de prix et journées pédagogiques.</p>
                    </div>
                </div>
            </div>

            @if(isset($photos) && $photos->count() > 0)
            <div class="row popup-gallery">
                @foreach($photos->chunk(2) as $index => $chunk)
                <div class="col-md-4 wow fadeInUp" data-wow-delay="{{ ($index * 0.25) . 's' }}">
                    @foreach($chunk as $photo)
                    <div class="gallery-item">
                        <div class="gallery-img">
                            <img src="{{ $photo->photo_url }}" alt="{{ $photo->titre ?? 'Photo école' }}">
                        </div>
                        <div class="gallery-content">
                            <a class="popup-img gallery-link" href="{{ $photo->photo_url }}">
                                <i class="fas fa-plus"></i>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endforeach
            </div>
            @else
            <div class="row popup-gallery">
                <div class="col-md-4 wow fadeInUp" data-wow-delay=".25s">
                    <div class="gallery-item">
                        <div class="gallery-img"><img src="{{ asset('assets/img/gallery/01.jpg') }}" alt=""></div>
                        <div class="gallery-content"><a class="popup-img gallery-link" href="{{ asset('assets/img/gallery/01.jpg') }}"><i class="fas fa-plus"></i></a></div>
                    </div>
                    <div class="gallery-item">
                        <div class="gallery-img"><img src="{{ asset('assets/img/gallery/02.jpg') }}" alt=""></div>
                        <div class="gallery-content"><a class="popup-img gallery-link" href="{{ asset('assets/img/gallery/02.jpg') }}"><i class="fas fa-plus"></i></a></div>
                    </div>
                </div>
                <div class="col-md-4 wow fadeInUp" data-wow-delay=".50s">
                    <div class="gallery-item">
                        <div class="gallery-img"><img src="{{ asset('assets/img/gallery/03.jpg') }}" alt=""></div>
                        <div class="gallery-content"><a class="popup-img gallery-link" href="{{ asset('assets/img/gallery/03.jpg') }}"><i class="fas fa-plus"></i></a></div>
                    </div>
                    <div class="gallery-item">
                        <div class="gallery-img"><img src="{{ asset('assets/img/gallery/04.jpg') }}" alt=""></div>
                        <div class="gallery-content"><a class="popup-img gallery-link" href="{{ asset('assets/img/gallery/04.jpg') }}"><i class="fas fa-plus"></i></a></div>
                    </div>
                </div>
                <div class="col-md-4 wow fadeInUp" data-wow-delay=".75s">
                    <div class="gallery-item">
                        <div class="gallery-img"><img src="{{ asset('assets/img/gallery/05.jpg') }}" alt=""></div>
                        <div class="gallery-content"><a class="popup-img gallery-link" href="{{ asset('assets/img/gallery/05.jpg') }}"><i class="fas fa-plus"></i></a></div>
                    </div>
                    <div class="gallery-item">
                        <div class="gallery-img"><img src="{{ asset('assets/img/gallery/06.jpg') }}" alt=""></div>
                        <div class="gallery-content"><a class="popup-img gallery-link" href="{{ asset('assets/img/gallery/06.jpg') }}"><i class="fas fa-plus"></i></a></div>
                    </div>
                </div>
            </div>
            @endif

            <div class="text-center mt-4">
                <a href="{{ route('galerie') }}" class="theme-btn">
                    Voir toute la galerie <i class="fas fa-arrow-right-long"></i>
                </a>
            </div>
        </div>
    </div>
    {{-- Gallery Area End --}}


    {{-- ==============================
         CTA (Appel à l'action)
    ============================== --}}
    <div class="cta-area">
        <div class="container">
            <div class="cta-wrapper">
                <div class="row align-items-center">
                    <div class="col-lg-5 ms-lg-auto">
                        <div class="cta-content">
                            <h1>Inscriptions ouvertes — Rejoignez-nous dès aujourd'hui !</h1>
                            <p>
                                Les places sont limitées. Contactez-nous ou remplissez le formulaire
                                d'inscription en ligne pour garantir la place de votre enfant
                                au Groupe Scolaire Catholique La Petite Thérèse.
                            </p>
                            <div class="cta-btn">
                                <a href="{{ route('admissions') }}" class="theme-btn">
                                    S'inscrire maintenant <i class="fas fa-arrow-right-long"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- CTA Area End --}}


    {{-- ==============================
         TÉMOIGNAGES
    ============================== --}}
    <div class="testimonial-area ts-bg pt-80 pb-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <div class="site-heading text-center">
                        <span class="site-title-tagline">
                            <i class="fas fa-book-open-reader"></i> Témoignages
                        </span>
                        <h2 class="site-title text-white">Ce que disent <span>nos parents</span></h2>
                        <p class="text-white">
                            La confiance de nos familles est notre plus belle récompense.
                        </p>
                    </div>
                </div>
            </div>
            <div class="testimonial-slider owl-carousel owl-theme">

                <div class="testimonial-item">
                    <div class="testimonial-rate">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i>
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                    <div class="testimonial-quote">
                        <p>Depuis que ma fille est inscrite à La Petite Thérèse, j'observe une vraie progression. Les enseignants sont attentifs et les résultats sont là.</p>
                    </div>
                    <div class="testimonial-content">
                        <div class="testimonial-author-img">
                            <img src="{{ asset('assets/img/testimonial/03.jpg') }}" alt="">
                        </div>
                        <div class="testimonial-author-info">
                            <h4>Mme Yao A.</h4>
                            <p>Parent d'élève — CM1</p>
                        </div>
                    </div>
                    <span class="testimonial-quote-icon"><i class="fas fa-quote-right"></i></span>
                </div>

                <div class="testimonial-item">
                    <div class="testimonial-rate">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i>
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                    <div class="testimonial-quote">
                        <p>Mon fils est passé du CP au CM2 ici. La progression est remarquable et les enseignants sont très impliqués.</p>
                    </div>
                    <div class="testimonial-content">
                        <div class="testimonial-author-img">
                            <img src="{{ asset('assets/img/testimonial/01.PNG') }}" alt="">
                        </div>
                        <div class="testimonial-author-info">
                            <h4>M. Kouassi R.</h4>
                            <p>Parent d'élève — CM2</p>
                        </div>
                    </div>
                    <span class="testimonial-quote-icon"><i class="fas fa-quote-right"></i></span>
                </div>

                <div class="testimonial-item">
                    <div class="testimonial-rate">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i>
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                    <div class="testimonial-quote">
                        <p>L'ambiance à La Petite Thérèse est familiale et chaleureuse. Ma fille adore aller à l'école chaque matin.</p>
                    </div>
                    <div class="testimonial-content">
                        <div class="testimonial-author-img">
                            <img src="{{ asset('assets/img/testimonial/04.jpg') }}" alt="">
                        </div>
                        <div class="testimonial-author-info">
                            <h4>Mme Bamba S.</h4>
                            <p>Parent d'élève — Maternelle</p>
                        </div>
                    </div>
                    <span class="testimonial-quote-icon"><i class="fas fa-quote-right"></i></span>
                </div>

            </div>
        </div>
    </div>
    {{-- Testimonial Area End --}}


    {{-- ==============================
         FORMULAIRE D'INSCRIPTION RAPIDE
    ============================== --}}
    <div class="enroll-area pt-80 pb-80">
        <div class="container">
            <div class="col-lg-12">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6">
                        <div class="enroll-left wow fadeInLeft" data-wow-delay=".25s">
                            <div class="enroll-form">
                                <div class="enroll-form-header">
                                    <h3>Demande d'inscription</h3>
                                    <p>Remplissez ce formulaire et nous vous recontacterons rapidement.</p>
                                </div>

                                @if(session('success'))
                                    <div class="alert alert-success mb-3">{{ session('success') }}</div>
                                @endif

                                {{-- CORRECTION : route contact.store + form_type --}}
                                <form action="{{ route('contact.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="form_type" value="inscription">
                                    <div class="form-group">
                                        <input type="text" name="nom_eleve" class="form-control"
                                            placeholder="Nom de l'élève" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="tel" name="telephone" class="form-control"
                                            placeholder="Téléphone du parent" required>
                                    </div>
                                    <div class="form-group">
                                        <select class="form-select" name="niveau" required>
                                            <option value="">Choisir un niveau</option>
                                            <!-- <option value="ps">Petite Section (PS)</option> -->
                                            <option value="ms">Moyenne Section (MS)</option>
                                            <option value="gs">Grande Section (GS)</option>
                                            <option value="cp">CP</option>
                                            <option value="ce1">CE1</option>
                                            <option value="ce2">CE2</option>
                                            <option value="cm1">CM1</option>
                                            <option value="cm2">CM2</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <textarea name="message" class="form-control"
                                            placeholder="Informations complémentaires" rows="4"></textarea>
                                    </div>
                                    <button class="theme-btn" type="submit">
                                        Envoyer la demande <i class="fas fa-arrow-right-long"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="enroll-right wow fadeInUp" data-wow-delay=".25s">
                            <div class="skill-content">
                                <div class="site-heading mb-3">
                                    <span class="site-title-tagline">
                                        <i class="fas fa-book-open-reader"></i> Nos résultats
                                    </span>
                                    <h2 class="site-title text-white">
                                        Excellence et <span>réussite</span> au rendez-vous
                                    </h2>
                                </div>
                                <p class="text-white">
                                    Année après année, nos élèves obtiennent d'excellents résultats
                                    aux examens officiels. Notre taux de réussite au CEPE
                                    témoigne de la qualité de notre encadrement.
                                </p>
                                <div class="skills-section">
                                    <div class="progress-box">
                                        <h5>Taux de réussite CEPE <span class="pull-right">100%</span></h5>
                                        <div class="progress" data-value="100">
                                            <div class="progress-bar" role="progressbar"></div>
                                        </div>
                                    </div>
                                    <div class="progress-box">
                                        <h5>Passage CM1 → CM2 <span class="pull-right">88%</span></h5>
                                        <div class="progress" data-value="88">
                                            <div class="progress-bar" role="progressbar"></div>
                                        </div>
                                    </div>
                                    <div class="progress-box">
                                        <h5>Satisfaction des parents <span class="pull-right">95%</span></h5>
                                        <div class="progress" data-value="95">
                                            <div class="progress-bar" role="progressbar"></div>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{ route('about') }}" class="theme-btn mt-5">
                                    En savoir plus <i class="fas fa-arrow-right-long"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Enroll Area End --}}

@endsection