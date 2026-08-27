@extends('layouts.app')

@section('title', 'Admissions')
@section('meta_description', 'Inscriptions au Groupe Scolaire La Petite Thérèse — frais de scolarité, pièces à fournir et formulaire d\'inscription en ligne.')

@section('content')

    {{-- BREADCRUMB --}}
    <div class="site-breadcrumb" style="background: url({{ asset('assets/img/breadcrumb/01.jpg') }})">
        <div class="container">
            <h2 class="breadcrumb-title">Admissions</h2>
            <ul class="breadcrumb-menu">
                <li><a href="{{ route('home') }}">Accueil</a></li>
                <li class="active">Admissions</li>
            </ul>
        </div>
    </div>

    {{-- COMMENT S'INSCRIRE --}}
    <div class="about-area py-120">
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-lg-6">
                    <div class="about-left wow fadeInLeft" data-wow-delay=".25s">
                        <div class="about-img">
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <img class="img-1" src="{{ asset('assets/img/about/01.jpg') }}" alt="Admissions">
                                    <div class="about-experience mt-4">
                                        <div class="about-experience-icon">
                                            <img src="{{ asset('assets/img/icon/exchange-idea.svg') }}" alt="">
                                        </div>
                                        <b class="text-start">Inscriptions<br>ouvertes</b>
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
                                <i class="far fa-book-open-reader"></i> Comment s'inscrire
                            </span>
                            <h2 class="site-title">
                                Rejoignez la famille <span>La Petite Thérèse</span>
                            </h2>
                        </div>
                        <p class="about-text">
                            Les inscriptions sont ouvertes toute l'année, sous réserve de disponibilité des places.
                            Nous accueillons les enfants de la Maternelle (dès 3 ans) jusqu'au CM2.
                            La procédure est simple et rapide.
                        </p>

                        {{-- Étapes --}}
                        <div class="about-content">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="about-item">
                                        <div class="about-item-icon">
                                            <img src="{{ asset('assets/img/icon/open-book.svg') }}" alt="">
                                        </div>
                                        <div class="about-item-content">
                                            <h5>Étape 1 — Prise de contact</h5>
                                            <p>Appelez-nous ou venez directement à l'école pour vérifier les disponibilités dans le niveau souhaité.</p>
                                        </div>
                                    </div>
                                    <div class="about-item">
                                        <div class="about-item-icon">
                                            <img src="{{ asset('assets/img/icon/global-education.svg') }}" alt="">
                                        </div>
                                        <div class="about-item-content">
                                            <h5>Étape 2 — Constitution du dossier</h5>
                                            <p>Rassemblez les pièces requises et déposez-les au secrétariat ou envoyez-les via ce formulaire.</p>
                                        </div>
                                    </div>
                                    <div class="about-item">
                                        <div class="about-item-icon">
                                            <img src="{{ asset('assets/img/icon/scholarship.svg') }}" alt="">
                                        </div>
                                        <div class="about-item-content">
                                            <h5>Étape 3 — Paiement et confirmation</h5>
                                            <p>Réglez les frais d'inscription. Votre place est confirmée dès réception du paiement.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="about-bottom">
                            <a href="#formulaire" class="theme-btn">
                                Formulaire d'inscription <i class="fas fa-arrow-right-long"></i>
                            </a>
                            <div class="about-phone">
                                <div class="icon"><i class="fal fa-headset"></i></div>
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

    {{-- FRAIS DE SCOLARITÉ --}}
    <div class="choose-area pt-80 pb-80" id="frais">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <div class="site-heading text-center">
                        <span class="site-title-tagline">
                            <i class="far fa-book-open-reader"></i> Frais de scolarité
                        </span>
                        <h2 class="site-title text-white">Une scolarité <span>accessible</span> à tous</h2>
                        <p class="text-white">
                            {{-- Remplacer par les vrais montants --}}
                            Nos frais sont fixés en début d'année scolaire. Contactez-nous pour obtenir la grille tarifaire complète.
                        </p>
                    </div>
                </div>
            </div>
            <div class="choose-content-wrap mt-4">
                <div class="row g-4 justify-content-center">
                    <div class="col-md-4">
                        <div class="choose-item">
                            <div class="choose-item-icon">
                                <img src="{{ asset('assets/img/icon/teacher.svg') }}" alt="">
                            </div>
                            <div class="choose-item-info">
                                {{-- Remplacer par les vrais montants --}}
                                <h4>Maternelle</h4>
                                <p>MS · GS — Frais à confirmer auprès du secrétariat.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="choose-item">
                            <div class="choose-item-icon">
                                <img src="{{ asset('assets/img/icon/open-book.svg') }}" alt="">
                            </div>
                            <div class="choose-item-info">
                                <h4>Primaire</h4>
                                <p>CP · CE1 · CE2 · CM1 · CM2 — Frais à confirmer auprès du secrétariat.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="choose-item">
                            <div class="choose-item-icon">
                                <img src="{{ asset('assets/img/icon/money.svg') }}" alt="">
                            </div>
                            <div class="choose-item-info">
                                <h4>Paiement échelonné</h4>
                                <p>Possibilité de payer en plusieurs tranches selon accord avec la direction.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- PIÈCES À FOURNIR --}}
    <div class="course-area py-120" id="pieces">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <div class="site-heading text-center">
                        <span class="site-title-tagline">
                            <i class="far fa-book-open-reader"></i> Dossier d'inscription
                        </span>
                        <h2 class="site-title">Pièces à <span>fournir</span></h2>
                    </div>
                </div>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="feature-item">
                        <span class="count">01</span>
                        <div class="feature-icon">
                            <img src="{{ asset('assets/img/icon/open-book.svg') }}" alt="">
                        </div>
                        <div class="feature-content">
                            <h4 class="feature-title">Extrait de naissance</h4>
                            <p>Original ou copie certifiée conforme de l'acte de naissance de l'enfant.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="feature-item">
                        <span class="count">02</span>
                        <div class="feature-icon">
                            <img src="{{ asset('assets/img/icon/teacher.svg') }}" alt="">
                        </div>
                        <div class="feature-content">
                            <h4 class="feature-title">Carnet de santé</h4>
                            <p>Carnet de santé à jour avec les vaccinations obligatoires.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="feature-item">
                        <span class="count">03</span>
                        <div class="feature-icon">
                            <img src="{{ asset('assets/img/icon/graduation.svg') }}" alt="">
                        </div>
                        <div class="feature-content">
                            <h4 class="feature-title">Bulletin scolaire</h4>
                            <p>Dernier bulletin de notes (pour les inscriptions à partir du CP).</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="feature-item">
                        <span class="count">04</span>
                        <div class="feature-icon">
                            <img src="{{ asset('assets/img/icon/scholarship.svg') }}" alt="">
                        </div>
                        <div class="feature-content">
                            <h4 class="feature-title">Photos d'identité</h4>
                            <p>4 photos d'identité récentes de l'enfant (fond blanc).</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="feature-item">
                        <span class="count">05</span>
                        <div class="feature-icon">
                            <img src="{{ asset('assets/img/icon/money.svg') }}" alt="">
                        </div>
                        <div class="feature-content">
                            <h4 class="feature-title">Pièce d'identité parent</h4>
                            <p>Copie de la CNI ou du passeport du parent ou tuteur légal.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- FORMULAIRE D'INSCRIPTION --}}
    <div class="enroll-area pt-80 pb-80" id="formulaire">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="enroll-form">
                        <div class="enroll-form-header text-center mb-4">
                            <span class="site-title-tagline">
                                <i class="far fa-book-open-reader"></i> Formulaire
                            </span>
                            <h2 class="site-title">Demande d'inscription</h2>
                            <p>Remplissez ce formulaire et nous vous recontacterons dans les 24h.</p>
                        </div>

                        {{-- Message de succès --}}
                        @if(session('success'))
                            <div class="alert alert-success mb-4">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('contact.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="form_type" value="inscription">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="nom_eleve" class="form-control @error('nom_eleve') is-invalid @enderror"
                                            placeholder="Nom & prénom de l'élève" required>
                                        @error('nom_eleve')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="nom_parent" class="form-control @error('nom_parent') is-invalid @enderror"
                                            placeholder="Nom & prénom du parent" required>
                                        @error('nom_parent')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="tel" name="telephone" class="form-control @error('telephone') is-invalid @enderror"
                                            placeholder="Téléphone (ex: 07 00 00 00 00)" required>
                                        @error('telephone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control"
                                            placeholder="Email (facultatif)">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select class="form-select @error('niveau') is-invalid @enderror" name="niveau" required>
                                            <option value="">Niveau souhaité</option>
                                            <optgroup label="Maternelle">
                                                <!-- <option value="ps">Petite Section (PS)</option> -->
                                                <option value="ms">Moyenne Section (MS)</option>
                                                <option value="gs">Grande Section (GS)</option>
                                            </optgroup>
                                            <optgroup label="Primaire">
                                                <option value="cp1">CP1</option>
                                                <option value="cp2">CP2</option>
                                                <option value="ce1">CE1</option>
                                                <option value="ce2">CE2</option>
                                                <option value="cm1">CM1</option>
                                                <option value="cm2">CM2</option>
                                            </optgroup>
                                        </select>
                                        @error('niveau')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="annee_naissance" class="form-control"
                                            placeholder="Année de naissance de l'élève">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <textarea name="message" class="form-control" rows="4"
                                    placeholder="Informations complémentaires (école précédente, besoins particuliers...)"></textarea>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="theme-btn">
                                    Envoyer la demande <i class="far fa-paper-plane"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection