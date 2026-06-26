@extends('layouts.app')

@section('title', 'Corps enseignant')
@section('meta_description', 'Découvrez l\'équipe pédagogique du Groupe Scolaire La Petite Thérèse à Port-Bouet / Gonzague, Abidjan.')

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

    {{-- TEAM AREA --}}
    <div class="team-area py-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <div class="site-heading text-center">
                        <span class="site-title-tagline">
                            <i class="far fa-book-open-reader"></i> Nos enseignants
                        </span>
                        <h2 class="site-title">Rencontrez notre <span>équipe pédagogique</span></h2>
                        <p>Des professionnels qualifiés et passionnés, engagés chaque jour pour la réussite et l'épanouissement de vos enfants.</p>
                    </div>
                </div>
            </div>
            <div class="row">

                {{-- Remplacer chaque bloc par un vrai enseignant --}}

                <div class="col-md-6 col-lg-3">
                    <div class="team-item wow fadeInUp" data-wow-delay=".25s">
                        <div class="team-img">
                            <img src="{{ asset('assets/img/team/01.PNG') }}" alt="Enseignant">
                        </div>
                        <div class="team-social">
                            <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                        </div>
                        <div class="team-content">
                            <div class="team-bio">
                                <h5>Père Luc SENOU</h5>
                                <span>Directrice Général</span>
                            </div>
                        </div>
                        <span class="team-social-btn"><i class="far fa-share-nodes"></i></span>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="team-item wow fadeInUp" data-wow-delay=".50s">
                        <div class="team-img">
                            <img src="{{ asset('assets/img/team/01.PNG') }}" alt="Enseignant">
                        </div>
                        <div class="team-social">
                            <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                        </div>
                        <div class="team-content">
                            <div class="team-bio">
                                <h5>M.Jerome KRABGE</h5>
                                <span>Directeur des études</span>
                            </div>
                        </div>
                        <span class="team-social-btn"><i class="far fa-share-nodes"></i></span>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="team-item wow fadeInUp" data-wow-delay=".75s">
                        <div class="team-img">
                            <img src="{{ asset('assets/img/team/01.PNG') }}" alt="Enseignant">
                        </div>
                        <div class="team-social">
                            <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                        </div>
                        <div class="team-content">
                            <div class="team-bio">
                                <h5>Mme BAMBA </h5>
                                <span>Enseignante — </span>
                            </div>
                        </div>
                        <span class="team-social-btn"><i class="far fa-share-nodes"></i></span>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="team-item wow fadeInUp" data-wow-delay="1s">
                        <div class="team-img">
                            <img src="{{ asset('assets/img/team/01.PNG') }}" alt="Enseignant">
                        </div>
                        <div class="team-social">
                            <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                        </div>
                        <div class="team-content">
                            <div class="team-bio">
                                <h5>M. BRUCE</h5>
                                <span>Enseignant — CM2</span>
                            </div>
                        </div>
                        <span class="team-social-btn"><i class="far fa-share-nodes"></i></span>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="team-item wow fadeInUp" data-wow-delay=".25s">
                        <div class="team-img">
                            <img src="{{ asset('assets/img/team/01.PNG') }}" alt="Enseignant">
                        </div>
                        <div class="team-social">
                            <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                        </div>
                        <div class="team-content">
                            <div class="team-bio">
                                <h5>Mme LAURE</h5>
                                <span>Enseignante-CE2</span>
                            </div>
                        </div>
                        <span class="team-social-btn"><i class="far fa-share-nodes"></i></span>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="team-item wow fadeInUp" data-wow-delay=".50s">
                        <div class="team-img">
                            <img src="{{ asset('assets/img/team/01.PNG') }}" alt="Enseignant">
                        </div>
                        <div class="team-social">
                            <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                        </div>
                        <div class="team-content">
                            <div class="team-bio">
                                <h5>M. Richard KOUAKOU</h5>
                                <span>Enseignant — CM1</span>
                            </div>
                        </div>
                        <span class="team-social-btn"><i class="far fa-share-nodes"></i></span>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="team-item wow fadeInUp" data-wow-delay=".75s">
                        <div class="team-img">
                            <img src="{{ asset('assets/img/team/01.PNG') }}" alt="Enseignant">
                        </div>
                        <div class="team-social">
                            <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                        </div>
                        <div class="team-content">
                            <div class="team-bio">
                                <h5>Mme GNETO</h5>
                                <span>Enseignante — CE1</span>
                            </div>
                        </div>
                        <span class="team-social-btn"><i class="far fa-share-nodes"></i></span>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="team-item wow fadeInUp" data-wow-delay="1s">
                        <div class="team-img">
                            <img src="{{ asset('assets/img/team/01.PNG') }}" alt="Enseignant">
                        </div>
                        <div class="team-social">
                            <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                        </div>
                        <div class="team-content">
                            <div class="team-bio">
                                <h5>M. Alain KAKOU</h5>
                                <span>Enseignant — CM1</span>
                            </div>
                        </div>
                        <span class="team-social-btn"><i class="far fa-share-nodes"></i></span>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="team-item wow fadeInUp" data-wow-delay="1s">
                        <div class="team-img">
                            <img src="{{ asset('assets/img/team/01.PNG') }}" alt="Enseignant">
                        </div>
                        <div class="team-social">
                            <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                        </div>
                        <div class="team-content">
                            <div class="team-bio">
                                <h5>M. OGOU</h5>
                                <span>Enseignant — CM2</span>
                            </div>
                        </div>
                        <span class="team-social-btn"><i class="far fa-share-nodes"></i></span>
                    </div>
                </div>

                 <div class="col-md-6 col-lg-3">
                    <div class="team-item wow fadeInUp" data-wow-delay="1s">
                        <div class="team-img">
                            <img src="{{ asset('assets/img/team/01.PNG') }}" alt="Enseignant">
                        </div>
                        <div class="team-social">
                            <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                        </div>
                        <div class="team-content">
                            <div class="team-bio">
                                <h5>M. KONAN</h5>
                                <span>Enseignant — CP1</span>
                            </div>
                        </div>
                        <span class="team-social-btn"><i class="far fa-share-nodes"></i></span>
                    </div>
                </div>

                 <div class="col-md-6 col-lg-3">
                    <div class="team-item wow fadeInUp" data-wow-delay="1s">
                        <div class="team-img">
                            <img src="{{ asset('assets/img/team/01.PNG') }}" alt="Enseignant">
                        </div>
                        <div class="team-social">
                            <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                        </div>
                        <div class="team-content">
                            <div class="team-bio">
                                <h5>Mme COULIBALY</h5>
                                <span>Enseignante — CP2</span>
                            </div>
                        </div>
                        <span class="team-social-btn"><i class="far fa-share-nodes"></i></span>
                    </div>
                </div>

                 <div class="col-md-6 col-lg-3">
                    <div class="team-item wow fadeInUp" data-wow-delay="1s">
                        <div class="team-img">
                            <img src="{{ asset('assets/img/team/01.PNG') }}" alt="Enseignant">
                        </div>
                        <div class="team-social">
                            <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                        </div>
                        <div class="team-content">
                            <div class="team-bio">
                                <h5>Mme Léa</h5>
                                <span>Enseignante — CE1</span>
                            </div>
                        </div>
                        <span class="team-social-btn"><i class="far fa-share-nodes"></i></span>
                    </div>
                </div>

                
            </div>
        </div>
    </div>

@endsection