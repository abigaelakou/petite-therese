<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('meta_description', 'Groupe Scolaire Catholique La Petite Thérèse - Établissement d\'excellence à Port-Bouet / Gonzague, Abidjan')">
    <meta name="keywords" content="@yield('meta_keywords', 'école, Port-Bouet, Gonzague, Abidjan, La Petite Thérèse, maternelle, primaire')">
    <title>@yield('title', 'Groupe Scolaire Catholique La Petite Thérèse') | Port-Bouet, Abidjan</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/logo/logoNew.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/all-fontawesome.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/brands.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <style>
        /* ── BOUTON PORTAIL ── */
        .btn-portail {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: linear-gradient(135deg, #1B2B6B, #12205A);
            color: #C9A84C !important;
            padding: 7px 16px;
            border-radius: 6px;
            font-size: 0.82rem;
            font-weight: 700;
            text-decoration: none !important;
            border: 1px solid rgba(201,168,76,0.3);
            transition: all 0.25s ease;
        }
        .btn-portail:hover {
            background: linear-gradient(135deg, #C9A84C, #A8893A);
            color: #1B2B6B !important;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(201,168,76,0.3);
        }
    </style>

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
                                    <a href="#"><i class="fas fa-map-marker-alt"></i> Port-Bouet / Gonzague Ville, Abidjan</a>
                                </li>
                                <li>
                                    <a href="mailto:contact@lapetitetherese.ci"><i class="fas fa-envelope"></i> contact@lapetitetherese.ci</a>
                                </li>
                                <li>
                                    <a href="tel:+2250700000000"><i class="fas fa-phone-volume"></i> +225 07 00 00 00 00</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Navigation principale --}}
        <div class="main-navigation">
            <nav class="navbar navbar-expand-lg">
                <div class="container position-relative">

                    <a class="navbar-brand" href="{{ route('home') }}">
                        <img src="{{ asset('assets/img/logo/logoNew.jpg') }}"
                             alt="GSC La Petite Thérèse"
                             style="max-height: 65px; width: auto;">
                    </a>

                    <div class="mobile-menu-right">
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
                                   href="{{ route('home') }}">Accueil</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}"
                                   href="{{ route('about') }}">À propos</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('niveaux*') ? 'active' : '' }}"
                                   href="{{ route('niveaux') }}">Niveaux</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('enseignants*') ? 'active' : '' }}"
                                   href="{{ route('enseignants') }}">Enseignants</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('galerie') ? 'active' : '' }}"
                                   href="{{ route('galerie') }}">Galerie</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('vie-scolaire*') ? 'active' : '' }}"
                                   href="{{ route('vie-scolaire.index') }}">Vie Scolaire</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admissions*') ? 'active' : '' }}"
                                   href="{{ route('admissions') }}">Admissions</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}"
                                   href="{{ route('contact') }}">Contact</a>
                            </li>

                        </ul>

                        {{-- Bouton Portail uniquement --}}
                        <div class="nav-right">
                            <div class="nav-right-btn mt-2">
                                <a href="/admin" class="btn-portail">
                                    <i class="fas fa-lock"></i> Portail
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </nav>
        </div>

    </header>

    {{-- CONTENU PRINCIPAL --}}
    <main class="main">
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer class="footer-area">
        <div class="footer-shape">
            <img src="{{ asset('assets/img/shape/03.png') }}" alt="">
        </div>
        <div class="footer-widget">
            <div class="container">
                <div class="row footer-widget-wrapper pt-100 pb-70">

                    <div class="col-md-6 col-lg-4">
                        <div class="footer-widget-box about-us">
                            <a href="{{ route('home') }}" class="footer-logo">
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
                                <li><a href="tel:+2250700000000"><i class="fas fa-phone"></i>+225 07 00 00 00 00</a></li>
                                <li><i class="fas fa-map-marker-alt"></i> Port-Bouet / Gonzague Ville, Abidjan</li>
                                <li><a href="mailto:contact@lapetitetherese.ci"><i class="fas fa-envelope"></i>contact@lapetitetherese.ci</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-2">
                        <div class="footer-widget-box list">
                            <h4 class="footer-widget-title">Liens rapides</h4>
                            <ul class="footer-list">
                                <li><a href="{{ route('about') }}"><i class="fas fa-caret-right"></i> À propos</a></li>
                                <li><a href="{{ route('niveaux') }}"><i class="fas fa-caret-right"></i> Niveaux</a></li>
                                <li><a href="{{ route('enseignants') }}"><i class="fas fa-caret-right"></i> Enseignants</a></li>
                                <li><a href="{{ route('galerie') }}"><i class="fas fa-caret-right"></i> Galerie</a></li>
                                <li><a href="{{ route('vie-scolaire.index') }}"><i class="fas fa-caret-right"></i> Vie Scolaire</a></li>
                                <li><a href="{{ route('admissions') }}"><i class="fas fa-caret-right"></i> Admissions</a></li>
                                <li><a href="{{ route('contact') }}"><i class="fas fa-caret-right"></i> Contact</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3">
                        <div class="footer-widget-box list">
                            <h4 class="footer-widget-title">Niveaux scolaires</h4>
                            <ul class="footer-list">
                                <li><a href="{{ route('niveaux') }}#maternelle"><i class="fas fa-caret-right"></i> Maternelle (MS – GS)</a></li>
                                <li><a href="{{ route('niveaux') }}#primaire"><i class="fas fa-caret-right"></i> CP1 & CP2</a></li>
                                <li><a href="{{ route('niveaux') }}#primaire"><i class="fas fa-caret-right"></i> CE1 & CE2</a></li>
                                <li><a href="{{ route('niveaux') }}#primaire"><i class="fas fa-caret-right"></i> CM1 & CM2</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3">
                        <div class="footer-widget-box list">
                            <h4 class="footer-widget-title">Restez informé</h4>
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
                                <div class="mt-3">
                                    <a href="/admin" style="color:rgba(255,255,255,0.35);font-size:11px;text-decoration:none;">
                                        <i class="fas fa-lock" style="font-size:10px;"></i> Portail Administration
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

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

    <a href="#" id="scroll-top"><i class="fas fa-arrow-up-from-arc"></i></a>

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