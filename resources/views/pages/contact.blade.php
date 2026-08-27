@extends('layouts.app')

@section('title', 'Contact')
@section('meta_description', 'Contactez le Groupe Scolaire La Petite Thérèse à Port-Bouet / Gonzague, Abidjan. Téléphone, email et formulaire de contact.')

@section('content')

    {{-- BREADCRUMB --}}
    <div class="site-breadcrumb" style="background: url({{ asset('assets/img/breadcrumb/01.jpg') }})">
        <div class="container">
            <h2 class="breadcrumb-title">Contactez-nous</h2>
            <ul class="breadcrumb-menu">
                <li><a href="{{ route('home') }}">Accueil</a></li>
                <li class="active">Contact</li>
            </ul>
        </div>
    </div>

    {{-- CONTACT AREA --}}
    <div class="contact-area py-120">
        <div class="container">

            
            <div class="contact-content">
                <div class="row">
                    <div class="col-md-3">
                        <div class="contact-info">
                            <div class="contact-info-icon">
                                <i class="fas fa-map-location-dot"></i>
                            </div>
                            <div class="contact-info-content">
                                <h5>Adresse</h5>
                                <p>Port-Bouet / Gonzague Ville, Abidjan, Côte d'Ivoire</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="contact-info">
                            <div class="contact-info-icon">
                                <i class="fas fa-phone-volume"></i>
                            </div>
                            <div class="contact-info-content">
                                <h5>Téléphone</h5>
                               
                                <p><a href="tel:+2250700000000">+225 07 00 00 00 00</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="contact-info">
                            <div class="contact-info-icon">
                                <i class="fas fa-envelopes"></i>
                            </div>
                            <div class="contact-info-content">
                                <h5>Email</h5>
                                
                                <p><a href="mailto:contact@lapetitetherese.ci">contact@lapetitetherese.ci</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="contact-info">
                            <div class="contact-info-icon">
                                <i class="fas fa-alarm-clock"></i>
                            </div>
                            <div class="contact-info-content">
                                <h5>Horaires</h5>
                                <p>Lun – Ven : 07h30 – 17h00<br>Sam : 08h00 – 12h00</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Formulaire + image (classes exactes du template) --}}
            <div class="contact-wrapper">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="contact-img">
                            <img src="{{ asset('assets/img/contact/01.jpg') }}" alt="La Petite Thérèse">
                        </div>
                    </div>
                    <div class="col-lg-7 align-self-center">
                        <div class="contact-form">
                            <div class="contact-form-header">
                                <h2>Écrivez-nous</h2>
                                <p>Une question sur les inscriptions, les frais ou la vie scolaire ? Envoyez-nous un message et nous vous répondrons dans les plus brefs délais.</p>
                            </div>

                            {{-- Message succès --}}
                            @if(session('success'))
                                <div class="alert alert-success mb-4">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('contact.store') }}" id="contact-form">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control @error('nom') is-invalid @enderror"
                                                name="nom" placeholder="Votre nom" required>
                                            @error('nom')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                name="email" placeholder="Votre email" required>
                                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control @error('telephone') is-invalid @enderror"
                                        name="telephone" placeholder="Votre téléphone" required>
                                    @error('telephone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control @error('sujet') is-invalid @enderror"
                                        name="sujet" placeholder="Sujet de votre message" required>
                                    @error('sujet')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group">
                                    <textarea name="message" cols="30" rows="5" class="form-control"
                                        placeholder="Votre message"></textarea>
                                </div>
                                <button type="submit" class="theme-btn">
                                    Envoyer le message <i class="far fa-paper-plane"></i>
                                </button>
                                <div class="col-md-12 mt-3">
                                    <div class="form-messege text-success"></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- CARTE GOOGLE MAPS — Port-Bouet / Gonzague, Abidjan --}}
    <div class="contact-map">
        
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3973.121400619854!2d-3.8976928!3d5.2436153!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xfc1f13e3110d067%3A0xf2284bda2365d9e2!2sGroupe%20Scolaire%20Catholique%20La%20Petite%20Therese!5e0!3m2!1sfr!2sci!4v1782479166588!5m2!1sfr!2sci" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin">
            style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>

@endsection