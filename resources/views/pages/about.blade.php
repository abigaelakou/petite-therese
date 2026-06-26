@extends('layouts.app')

@section('title', 'À propos')
@section('meta_description', 'Découvrez l\'histoire, la mission et les valeurs du Groupe Scolaire La Petite Thérèse à Port-Bouet / Gonzague, Abidjan.')

@section('content')

    {{-- ==============================
         BREADCRUMB
    ============================== --}}
    <div class="site-breadcrumb" style="background: url({{ asset('assets/img/breadcrumb/01.jpg') }})">
        <div class="container">
            <h2 class="breadcrumb-title">À propos de nous</h2>
            <ul class="breadcrumb-menu">
                <li><a href="{{ route('home') }}">Accueil</a></li>
                <li class="active">À propos</li>
            </ul>
        </div>
    </div>
    {{-- Breadcrumb End --}}


    {{-- ==============================
         ABOUT AREA
    ============================== --}}
    <div class="about-area py-120">
        <div class="container">
            <div class="row g-4 align-items-center">

                {{-- Images gauche --}}
                <div class="col-lg-6">
                    <div class="about-left wow fadeInLeft" data-wow-delay=".25s">
                        <div class="about-img">
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <img class="img-1" src="{{ asset('assets/img/about/01.jpg') }}" alt="La Petite Thérèse">
                                    <div class="about-experience mt-4">
                                        <div class="about-experience-icon">
                                            <img src="{{ asset('assets/img/icon/exchange-idea.svg') }}" alt="">
                                        </div>
                                        {{-- Remplacer par les vraies années --}}
                                        <b class="text-start">+ de 10 ans <br> d'excellence</b>
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

                {{-- Texte droite --}}
                <div class="col-lg-6">
                    <div class="about-right wow fadeInRight" data-wow-delay=".25s">
                        <div class="site-heading mb-3">
                            <span class="site-title-tagline">
                                <i class="far fa-book-open-reader"></i> À propos de nous
                            </span>
                            <h2 class="site-title">
                                Notre système éducatif <span>vous inspire</span> davantage.
                            </h2>
                        </div>
                        <p class="about-text">
                            Fondé à Port-Bouet / Gonzague Ville à Abidjan, le Groupe Scolaire
                            La Petite Thérèse est un établissement privé engagé dans la formation
                            de qualité des jeunes enfants. Depuis notre création, nous plaçons
                            l'épanouissement de l'élève au cœur de notre pédagogie, de la
                            Maternelle au CM2.
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
                                            <p>Un accompagnement individualisé pour chaque élève, du préscolaire au CM2.</p>
                                        </div>
                                    </div>
                                    <div class="about-item">
                                        <div class="about-item-icon">
                                            <img src="{{ asset('assets/img/icon/global-education.svg') }}" alt="">
                                        </div>
                                        <div class="about-item-content">
                                            <h5>Programmes officiels</h5>
                                            <p>Alignés sur les curricula du Ministère de l'Éducation Nationale de Côte d'Ivoire.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="about-quote">
                                        <p>
                                            « Éduquer un enfant, c'est lui donner les clés pour
                                            ouvrir toutes les portes de l'avenir. »
                                        </p>
                                        <i class="far fa-quote-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="about-bottom">
                            <a href="{{ route('admissions') }}" class="theme-btn">
                                Nous rejoindre <i class="fas fa-arrow-right-long"></i>
                            </a>
                            <div class="about-phone">
                                <div class="icon"><i class="fal fa-headset"></i></div>
                                <div class="number">
                                    <span>Appelez-nous</span>
                                    {{-- Remplacer par le vrai numéro --}}
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
         COUNTER AREA
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
                            <span class="counter" data-count="+" data-to="9" data-speed="3000">9</span>
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
         TÉMOIGNAGES
    ============================== --}}
    <div class="testimonial-area bg py-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <div class="site-heading text-center">
                        <span class="site-title-tagline">
                            <i class="far fa-book-open-reader"></i> Témoignages
                        </span>
                        <h2 class="site-title">Ce que disent <span>nos parents</span></h2>
                        <p>La confiance des familles est notre plus belle récompense.</p>
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
                        {{-- Remplacer par de vrais témoignages --}}
                        <p>Depuis que ma fille est à La Petite Thérèse, j'observe une vraie progression. Les enseignants sont attentifs et les résultats sont là.</p>
                    </div>
                    <div class="testimonial-content">
                        <div class="testimonial-author-img">
                            <img src="{{ asset('assets/img/testimonial/05.JPG') }}" alt="">
                        </div>
                        <div class="testimonial-author-info">
                            <h4>Mme Yao A.</h4>
                            <p>Parent d'élève — CM1</p>
                        </div>
                    </div>
                    <span class="testimonial-quote-icon"><i class="far fa-quote-right"></i></span>
                </div>

                <div class="testimonial-item">
                    <div class="testimonial-rate">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i>
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                    <div class="testimonial-quote">
                        <p>Mon fils a fait tout son primaire ici. La progression est remarquable et les enseignants sont très impliqués dans la réussite des élèves.</p>
                    </div>
                    <div class="testimonial-content">
                        <div class="testimonial-author-img">
                            <img src="{{ asset('assets/img/testimonial/02.PNG') }}" alt="">
                        </div>
                        <div class="testimonial-author-info">
                            <h4>M. Kouassi R.</h4>
                            <p>Parent d'élève — CM2</p>
                        </div>
                    </div>
                    <span class="testimonial-quote-icon"><i class="far fa-quote-right"></i></span>
                </div>

                <div class="testimonial-item">
                    <div class="testimonial-rate">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i>
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                    <div class="testimonial-quote">
                        <p>L'ambiance est familiale et chaleureuse. Ma fille adore aller à l'école chaque matin depuis la Maternelle.</p>
                    </div>
                    <div class="testimonial-content">
                        <div class="testimonial-author-img">
                            <img src="{{ asset('assets/img/testimonial/03.jpg') }}" alt="">
                        </div>
                        <div class="testimonial-author-info">
                            <h4>Mme Bamba S.</h4>
                            <p>Parent d'élève — Maternelle</p>
                        </div>
                    </div>
                    <span class="testimonial-quote-icon"><i class="far fa-quote-right"></i></span>
                </div>

                <div class="testimonial-item">
                    <div class="testimonial-rate">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i>
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                    <div class="testimonial-quote">
                        <p>Le niveau des enseignants est excellent. Mon enfant a toujours eu les meilleurs résultats de sa classe grâce à leur encadrement.</p>
                    </div>
                    <div class="testimonial-content">
                        <div class="testimonial-author-img">
                            <img src="{{ asset('assets/img/testimonial/04.jpg') }}" alt="">
                        </div>
                        <div class="testimonial-author-info">
                            <h4>M. Diallo M.</h4>
                            <p>Parent d'élève — CE2</p>
                        </div>
                    </div>
                    <span class="testimonial-quote-icon"><i class="far fa-quote-right"></i></span>
                </div>

                <div class="testimonial-item">
                    <div class="testimonial-rate">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i>
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                    <div class="testimonial-quote">
                        <p>Je recommande La Petite Thérèse à tous les parents de Gonzague. Sérieux, discipline et bienveillance sont au rendez-vous.</p>
                    </div>
                    <div class="testimonial-content">
                        <div class="testimonial-author-img">
                            <img src="{{ asset('assets/img/testimonial/05.jpg') }}" alt="">
                        </div>
                        <div class="testimonial-author-info">
                            <h4>Mme Ouédraogo P.</h4>
                            <p>Parent d'élève — CP</p>
                        </div>
                    </div>
                    <span class="testimonial-quote-icon"><i class="far fa-quote-right"></i></span>
                </div>

            </div>
        </div>
    </div>
    {{-- Testimonial Area End --}}


    {{-- ==============================
         ÉQUIPE ENSEIGNANTE
    ============================== --}}
    <div class="team-area py-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <div class="site-heading text-center">
                        <span class="site-title-tagline">
                            <i class="far fa-book-open-reader"></i> Nos enseignants
                        </span>
                        <h2 class="site-title">Rencontrez notre <span>équipe pédagogique</span></h2>
                        <p>Des professionnels passionnés, dévoués à l'épanouissement et à la réussite de vos enfants.</p>
                    </div>
                </div>
            </div>
            <div class="row">

                {{-- Remplacer les noms/photos par les vrais enseignants --}}
                <div class="col-md-6 col-lg-3">
                    <div class="team-item wow fadeInUp" data-wow-delay=".25s">
                        <div class="team-img">
                            <img src="{{ asset('assets/img/team/01.PNG') }}" alt="Enseignant">
                        </div>
                        <div class="team-social">
                            <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                            <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                        <div class="team-content">
                            <div class="team-bio">
                                <h5><a href="{{ route('enseignants') }}">Père Luc SENOU</a></h5>
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
                            <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                        <div class="team-content">
                            <div class="team-bio">
                                <h5><a href="{{ route('enseignants') }}">M. Jerome KRABGE.</a></h5>
                                <span>Directeur — Des études </span>
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
                            <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                        <div class="team-content">
                            <div class="team-bio">
                                <h5><a href="{{ route('enseignants') }}">Mme BAMBA </a></h5>
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
                            <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                        <div class="team-content">
                            <div class="team-bio">
                                <h5><a href="{{ route('enseignants') }}">M. BRUCE</a></h5>
                                <span>Enseignant — CM2</span>
                            </div>
                        </div>
                        <span class="team-social-btn"><i class="far fa-share-nodes"></i></span>
                    </div>
                </div>

            </div>
        </div>
    </div>
    {{-- Team Area End --}}


    {{-- ==============================
         PARTENAIRES / LOGOS
    ============================== --}}
    <div class="partner-area bg pt-50 pb-50">
        <div class="container">
            <div class="partner-wrapper partner-slider owl-carousel owl-theme">
                {{-- Remplacer par les vrais logos partenaires (ministère, associations, etc.) --}}
                <img src="{{ asset('assets/img/partner/01.png') }}" alt="Partenaire">
                <img src="{{ asset('assets/img/partner/02.png') }}" alt="Partenaire">
                <img src="{{ asset('assets/img/partner/03.png') }}" alt="Partenaire">
                <img src="{{ asset('assets/img/partner/04.png') }}" alt="Partenaire">
                <img src="{{ asset('assets/img/partner/01.png') }}" alt="Partenaire">
                <img src="{{ asset('assets/img/partner/02.png') }}" alt="Partenaire">
                <img src="{{ asset('assets/img/partner/04.png') }}" alt="Partenaire">
            </div>
        </div>
    </div>
    {{-- Partner Area End --}}

@endsection