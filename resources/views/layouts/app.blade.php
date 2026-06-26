<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('meta_description', 'Groupe Scolaire Catholique La Petite Thérèse - Établissement d\'excellence à Port-Bouet / Gonzague, Abidjan')">
    <meta name="keywords" content="@yield('meta_keywords', 'école, Port-Bouet, Gonzague, Abidjan, La Petite Thérèse, maternelle, primaire')">
    <meta name="csrf-token">
    <title>@yield('title', 'Groupe Scolaire Catholique La Petite Thérèse') | Port-Bouet, Abidjan</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/logo/logoNew.png') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/all-fontawesome.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/brands.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    @stack('styles')
</head>

<body>

    {{-- Preloader --}}
    <div class="preloader">
        <div class="loader-book">
            <div class="loader-book-page"></div>
            <div class="loader-book-page"></div>
            <div class="loader-book-page"></div>
        </div>
    </div>

    {{-- ==============================
         HEADER
    ============================== --}}
    <header class="header">

        {{-- Header Top --}}
        <div class="header-top">
            <div class="container">
                <div class="header-top-wrap">
                    <div class="header-top-left">
                        <div class="header-top-social">
                            <span>Suivez-nous : </span>
                            <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                            <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                            <a href="#" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                        </div>
                    </div>
                    <div class="header-top-right">
                        <div class="header-top-contact">
                            <ul>
                                <li>
                                    <a href="#">
                                        <i class="fas fa-map-marker-alt"></i>
                                        Port-Bouet / Gonzague Ville, Abidjan
                                    </a>
                                </li>
                                <li>
                                    <a href="mailto:contact@lapetitetherese.ci">
                                        <i class="fas fa-envelope"></i>
                                        contact@lapetitetherese.ci
                                    </a>
                                </li>
                                <li>
                                    <a href="tel:+2250700000000">
                                        <i class="fas fa-phone-volume"></i>
                                        +225 07 00 00 00 00
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Header Top End --}}

        {{-- Navigation principale --}}
        <div class="main-navigation">
            <nav class="navbar navbar-expand-lg">
                <div class="container position-relative">

                    {{-- CORRECTION 1 : .jpg au lieu de .png + taille contrôlée --}}
                    <a class="navbar-brand" href="{{ route('home') }}">
                        <img src="{{ asset('assets/img/logo/logoNew.jpg') }}"
                             alt="GSC La Petite Thérèse"
                             style="max-height: 65px; width: auto;">
                    </a>

                    <div class="mobile-menu-right">
                        <div class="search-btn">
                            <button type="button" class="nav-right-link search-box-outer">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                        <button class="navbar-toggler" type="button"
                            data-bs-toggle="collapse" data-bs-target="#main_nav"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-mobile-icon"><i class="fas fa-bars"></i></span>
                        </button>
                    </div>

                    <div class="collapse navbar-collapse" id="main_nav">
                        <ul class="navbar-nav">

                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
                                   href="{{ route('home') }}">
                                    Accueil
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}"
                                   href="{{ route('about') }}">
                                    À propos
                                </a>
                            </li>

                            {{-- CORRECTION 2 : col-md-4 au lieu de col-md-3 (3 colonnes au lieu de 4) --}}
                            <li class="nav-item mega-menu dropdown">
                                <a class="nav-link dropdown-toggle {{ request()->routeIs('niveaux*') ? 'active' : '' }}"
                                   href="#" data-bs-toggle="dropdown">
                                    Niveaux scolaires
                                </a>
                                <div class="dropdown-menu fade-down">
                                    <div class="mega-content">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-12 col-sm-4 col-md-4">
                                                    <h5>Notre école</h5>
                                                    <div class="menu-about">
                                                        <a href="{{ route('home') }}" class="menu-about-logo">
                                                            <img src="{{ asset('assets/img/logo/logoNew.jpg') }}"
                                                                 alt="GSC La Petite Thérèse"
                                                                 style="max-height: 50px; width: auto;">
                                                        </a>
                                                        <p>Un cadre bienveillant et stimulant pour l'épanouissement de vos enfants, de la Maternelle au CM2.</p>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-4 col-md-4">
                                                    <h5>Préscolaire & Primaire</h5>
                                                    <ul class="mega-menu-item">
                                                        <li><a class="dropdown-item" href="{{ route('niveaux') }}#maternelle">Maternelle (PS – MS – GS)</a></li>
                                                        <li><a class="dropdown-item" href="{{ route('niveaux') }}#primaire">CP & CE1</a></li>
                                                        <li><a class="dropdown-item" href="{{ route('niveaux') }}#primaire">CE2 & CM1</a></li>
                                                        <li><a class="dropdown-item" href="{{ route('niveaux') }}#primaire">CM2</a></li>
                                                    </ul>
                                                </div>
                                                <div class="col-12 col-sm-4 col-md-4">
                                                    <h5>Ressources</h5>
                                                    <ul class="mega-menu-item">
                                                        <li><a class="dropdown-item" href="{{ route('enseignants') }}">Notre équipe pédagogique</a></li>
                                                        <li><a class="dropdown-item" href="{{ route('admissions') }}">Admissions & Frais</a></li>
                                                        <li><a class="dropdown-item" href="{{ route('galerie') }}">Galerie photos</a></li>
                                                        <li><a class="dropdown-item" href="{{ route('contact') }}">Nous contacter</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('enseignants*') ? 'active' : '' }}"
                                   href="{{ route('enseignants') }}">
                                    Enseignants
                                </a>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle {{ request()->routeIs('admissions*') ? 'active' : '' }}"
                                   href="#" data-bs-toggle="dropdown">
                                    Admissions
                                </a>
                                <ul class="dropdown-menu fade-down">
                                    <li><a class="dropdown-item" href="{{ route('admissions') }}">Comment s'inscrire</a></li>
                                    <li><a class="dropdown-item" href="{{ route('admissions') }}#frais">Frais de scolarité</a></li>
                                    <li><a class="dropdown-item" href="{{ route('admissions') }}#formulaire">Formulaire d'inscription</a></li>
                                </ul>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('galerie') ? 'active' : '' }}"
                                   href="{{ route('galerie') }}">
                                    Galerie
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}"
                                   href="{{ route('contact') }}">
                                    Contact
                                </a>
                            </li>

                        </ul>

                        <div class="nav-right">
                            <div class="search-btn">
                                <button type="button" class="nav-right-link search-box-outer">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                            <div class="nav-right-btn mt-2">
                                <a href="{{ route('admissions') }}" class="theme-btn">
                                    <span class="fas fa-pencil"></span> S'inscrire
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </nav>
        </div>
        {{-- Navigation End --}}

    </header>
    {{-- Header End --}}


    {{-- Popup Search --}}
    <div class="search-popup">
        <button class="close-search"><span class="fas fa-times"></span></button>
        <form action="#">
            <div class="form-group">
                <input type="search" name="search-field" placeholder="Rechercher..." required>
                <button type="submit"><i class="fas fa-search"></i></button>
            </div>
        </form>
    </div>


    {{-- ==============================
         CONTENU PRINCIPAL
    ============================== --}}
    <main class="main">
        @yield('content')
    </main>


    {{-- ==============================
         FOOTER
    ============================== --}}
    <footer class="footer-area">
        <div class="footer-shape">
            <img src="{{ asset('assets/img/shape/03.png') }}" alt="">
        </div>
        <div class="footer-widget">
            <div class="container">
                <div class="row footer-widget-wrapper pt-100 pb-70">

                    {{-- Colonne 1 : À propos --}}
                    <div class="col-md-6 col-lg-4">
                        <div class="footer-widget-box about-us">
                            <a href="{{ route('home') }}" class="footer-logo">
                                {{-- CORRECTION 1 : .jpg + fond blanc visible sur footer sombre
                                     → idéalement remplacer par une version PNG fond transparent --}}
                                <img src="{{ asset('assets/img/logo/logo-lightN.PNG') }}"
                                     alt="GSC La Petite Thérèse"
                                     style="max-height: 80px; width: auto;">
                            </a>
                            <p class="mb-3">
                                Le Groupe Scolaire Catholique La Petite Thérèse offre une éducation de qualité
                                dans un environnement bienveillant, de la Maternelle au CM2,
                                à Port-Bouet / Gonzague Ville, Abidjan.
                            </p>
                            <ul class="footer-contact">
                                <li>
                                    <a href="tel:+2250700000000">
                                        <i class="fas fa-phone"></i>+225 07 00 00 00 00
                                    </a>
                                </li>
                                <li>
                                    <i class="fas fa-map-marker-alt"></i>
                                    Port-Bouet / Gonzague Ville, Abidjan
                                </li>
                                <li>
                                    <a href="mailto:contact@lapetitetherese.ci">
                                        <i class="fas fa-envelope"></i>contact@lapetitetherese.ci
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    {{-- Colonne 2 : Liens rapides --}}
                    <div class="col-md-6 col-lg-2">
                        <div class="footer-widget-box list">
                            <h4 class="footer-widget-title">Liens rapides</h4>
                            <ul class="footer-list">
                                <li><a href="{{ route('about') }}"><i class="fas fa-caret-right"></i> À propos</a></li>
                                <li><a href="{{ route('niveaux') }}"><i class="fas fa-caret-right"></i> Niveaux scolaires</a></li>
                                <li><a href="{{ route('enseignants') }}"><i class="fas fa-caret-right"></i> Enseignants</a></li>
                                <li><a href="{{ route('galerie') }}"><i class="fas fa-caret-right"></i> Galerie</a></li>
                                <li><a href="{{ route('admissions') }}"><i class="fas fa-caret-right"></i> Admissions</a></li>
                                <li><a href="{{ route('contact') }}"><i class="fas fa-caret-right"></i> Contact</a></li>
                            </ul>
                        </div>
                    </div>

                    {{-- Colonne 3 : Niveaux --}}
                    <div class="col-md-6 col-lg-3">
                        <div class="footer-widget-box list">
                            <h4 class="footer-widget-title">Niveaux scolaires</h4>
                            <ul class="footer-list">
                                <li><a href="{{ route('niveaux') }}#maternelle"><i class="fas fa-caret-right"></i> Maternelle (PS – MS – GS)</a></li>
                                <li><a href="{{ route('niveaux') }}#primaire"><i class="fas fa-caret-right"></i> CP – CE1 – CE2</a></li>
                                <li><a href="{{ route('niveaux') }}#primaire"><i class="fas fa-caret-right"></i> CM1 – CM2</a></li>
                            </ul>
                        </div>
                    </div>

                    {{-- Colonne 4 : Newsletter --}}
                    <div class="col-md-6 col-lg-3">
                        <div class="footer-widget-box list">
                            <h4 class="footer-widget-title">Actualités</h4>
                            <div class="footer-newsletter">
                                <p>Abonnez-vous pour recevoir les dernières nouvelles de l'école.</p>
                                <div class="subscribe-form">
                                    <form action="#">
                                        <input type="email" class="form-control" placeholder="Votre email">
                                        <button class="theme-btn" type="submit">
                                            S'abonner <i class="fas fa-paper-plane"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        {{-- Copyright --}}
        <div class="copyright">
            <div class="container">
                <div class="copyright-wrapper">
                    <div class="row">
                        <div class="col-md-6 align-self-center">
                            <p class="copyright-text">
                                &copy; Copyright {{ date('Y') }}
                                <a href="{{ route('home') }}"> Groupe Scolaire Catholique La Petite Thérèse </a>
                                Tous droits réservés.
                            </p>
                        </div>
                        <div class="col-md-6 align-self-center">
                            <ul class="footer-social">
                                <li><a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a></li>
                                <li><a href="#" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a></li>
                                <li><a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </footer>
    {{-- Footer End --}}


    {{-- Scroll to top --}}
    <a href="#" id="scroll-top"><i class="fas fa-arrow-up-from-arc"></i></a>


    {{-- ==============================
         SCRIPTS
    ============================== --}}
    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/modernizr.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.appear.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/js/counter-up.js') }}"></script>
    <script src="{{ asset('assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

    @stack('scripts')

</body>
</html>