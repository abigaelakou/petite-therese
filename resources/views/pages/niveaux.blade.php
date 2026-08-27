@extends('layouts.app')

@section('title', 'Niveaux scolaires — Maternelle & Primaire')
@section('meta_description', 'Découvrez les niveaux scolaires du Groupe Scolaire Catholique La Petite Thérèse : Maternelle (MS, GS) et Primaire (CP1, CP2, CE1, CE2, CM1, CM2).')

@section('content')

{{-- BREADCRUMB --}}
<div class="site-breadcrumb" style="background: url({{ asset('assets/img/breadcrumb/01.jpg') }})">
    <div class="container">
        <h2 class="breadcrumb-title">Niveaux Scolaires</h2>
        <ul class="breadcrumb-menu">
            <li><a href="{{ route('home') }}">Accueil</a></li>
            <li class="active">Niveaux Scolaires</li>
        </ul>
    </div>
</div>

{{-- INTRO --}}
<div class="pt-120 pb-60">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center wow fadeInUp" data-wow-delay=".25s">
                <div class="site-heading">
                    <span class="site-title-tagline">
                        <i class="fas fa-graduation-cap"></i> Notre offre pédagogique
                    </span>
                    <h2 class="site-title">De la Maternelle <span>au CM2</span></h2>
                    <p>
                        Le Groupe Scolaire Catholique La Petite Thérèse accompagne vos enfants
                        de la Moyenne Section jusqu'au CM2, dans un environnement bienveillant,
                        stimulant et ancré dans les valeurs chrétiennes.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ══════════════════════════════════════════════
     SECTION MATERNELLE
══════════════════════════════════════════════ --}}
<section id="maternelle" style="background:#f8f7f4;padding:80px 0;">
    <div class="container">

        {{-- Titre section --}}
        <div class="row mb-50">
            <div class="col-12 wow fadeInUp" data-wow-delay=".25s">
                <div style="display:flex;align-items:center;gap:16px;margin-bottom:8px;">
                    <div style="width:50px;height:50px;background:#C9A84C;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <i class="fas fa-child" style="color:#1B2B6B;font-size:1.3rem;"></i>
                    </div>
                    <div>
                        <span style="color:#C9A84C;font-size:13px;font-weight:700;text-transform:uppercase;letter-spacing:0.1em;">Cycle 1</span>
                        <h2 style="color:#1B2B6B;font-weight:800;font-size:28px;margin:0;">École Maternelle</h2>
                    </div>
                </div>
                <div style="height:3px;background:linear-gradient(to right,#C9A84C,transparent);margin-top:16px;"></div>
            </div>
        </div>

        <div class="row g-4">

            {{-- MS --}}
            <div class="col-md-6 wow fadeInLeft" data-wow-delay=".25s">
                <div style="background:white;border-radius:16px;padding:32px;box-shadow:0 4px 20px rgba(0,0,0,0.06);height:100%;border-top:4px solid #C9A84C;">
                    <div style="display:flex;align-items:center;gap:14px;margin-bottom:20px;">
                        <div style="width:60px;height:60px;background:#EEF1FA;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1.8rem;flex-shrink:0;">
                            🌱
                        </div>
                        <div>
                            <h3 style="color:#1B2B6B;font-weight:800;font-size:20px;margin:0;">Moyenne Section</h3>
                            <span style="color:#C9A84C;font-size:13px;font-weight:700;">MS · 4 à 5 ans</span>
                        </div>
                    </div>
                    <p style="color:#555;line-height:1.8;margin-bottom:20px;">
                        La Moyenne Section marque les premiers pas dans la vie scolaire.
                        L'enfant développe sa motricité, son langage et sa socialisation
                        dans un cadre ludique et rassurant.
                    </p>
                    <ul style="list-style:none;padding:0;margin:0;">
                        <li style="display:flex;align-items:center;gap:10px;padding:8px 0;border-bottom:1px solid #f5f5f5;font-size:14px;color:#444;">
                            <i class="fas fa-check-circle" style="color:#C9A84C;"></i> Éveil au langage et à la communication
                        </li>
                        <li style="display:flex;align-items:center;gap:10px;padding:8px 0;border-bottom:1px solid #f5f5f5;font-size:14px;color:#444;">
                            <i class="fas fa-check-circle" style="color:#C9A84C;"></i> Activités artistiques et créatives
                        </li>
                        <li style="display:flex;align-items:center;gap:10px;padding:8px 0;border-bottom:1px solid #f5f5f5;font-size:14px;color:#444;">
                            <i class="fas fa-check-circle" style="color:#C9A84C;"></i> Développement de la motricité fine
                        </li>
                        <li style="display:flex;align-items:center;gap:10px;padding:8px 0;font-size:14px;color:#444;">
                            <i class="fas fa-check-circle" style="color:#C9A84C;"></i> Initiation aux mathématiques par le jeu
                        </li>
                    </ul>
                    <div style="margin-top:20px;padding:12px 16px;background:#EEF1FA;border-radius:8px;font-size:13px;color:#1B2B6B;">
                        <i class="fas fa-users" style="color:#C9A84C;"></i>
                        <strong>2 classes :</strong> MS A et MS B
                    </div>
                </div>
            </div>

            {{-- GS --}}
            <div class="col-md-6 wow fadeInRight" data-wow-delay=".35s">
                <div style="background:white;border-radius:16px;padding:32px;box-shadow:0 4px 20px rgba(0,0,0,0.06);height:100%;border-top:4px solid #1B2B6B;">
                    <div style="display:flex;align-items:center;gap:14px;margin-bottom:20px;">
                        <div style="width:60px;height:60px;background:#EEF1FA;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1.8rem;flex-shrink:0;">
                            🌿
                        </div>
                        <div>
                            <h3 style="color:#1B2B6B;font-weight:800;font-size:20px;margin:0;">Grande Section</h3>
                            <span style="color:#C9A84C;font-size:13px;font-weight:700;">GS · 5 à 6 ans</span>
                        </div>
                    </div>
                    <p style="color:#555;line-height:1.8;margin-bottom:20px;">
                        La Grande Section prépare l'enfant à l'entrée au CP1.
                        C'est une année charnière où l'enfant consolide ses acquis
                        et développe son autonomie et sa curiosité intellectuelle.
                    </p>
                    <ul style="list-style:none;padding:0;margin:0;">
                        <li style="display:flex;align-items:center;gap:10px;padding:8px 0;border-bottom:1px solid #f5f5f5;font-size:14px;color:#444;">
                            <i class="fas fa-check-circle" style="color:#C9A84C;"></i> Pré-lecture et pré-écriture
                        </li>
                        <li style="display:flex;align-items:center;gap:10px;padding:8px 0;border-bottom:1px solid #f5f5f5;font-size:14px;color:#444;">
                            <i class="fas fa-check-circle" style="color:#C9A84C;"></i> Numération et logique mathématique
                        </li>
                        <li style="display:flex;align-items:center;gap:10px;padding:8px 0;border-bottom:1px solid #f5f5f5;font-size:14px;color:#444;">
                            <i class="fas fa-check-circle" style="color:#C9A84C;"></i> Développement du langage oral
                        </li>
                        <li style="display:flex;align-items:center;gap:10px;padding:8px 0;font-size:14px;color:#444;">
                            <i class="fas fa-check-circle" style="color:#C9A84C;"></i> Éducation civique et morale
                        </li>
                    </ul>
                    <div style="margin-top:20px;padding:12px 16px;background:#EEF1FA;border-radius:8px;font-size:13px;color:#1B2B6B;">
                        <i class="fas fa-users" style="color:#C9A84C;"></i>
                        <strong>2 classes :</strong> GS A et GS B
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════
     SECTION PRIMAIRE
══════════════════════════════════════════════ --}}
<section id="primaire" style="padding:80px 0;">
    <div class="container">

        {{-- Titre section --}}
        <div class="row mb-50">
            <div class="col-12 wow fadeInUp" data-wow-delay=".25s">
                <div style="display:flex;align-items:center;gap:16px;margin-bottom:8px;">
                    <div style="width:50px;height:50px;background:#1B2B6B;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <i class="fas fa-book-open" style="color:#C9A84C;font-size:1.2rem;"></i>
                    </div>
                    <div>
                        <span style="color:#C9A84C;font-size:13px;font-weight:700;text-transform:uppercase;letter-spacing:0.1em;">Cycle 2 & 3</span>
                        <h2 style="color:#1B2B6B;font-weight:800;font-size:28px;margin:0;">École Primaire</h2>
                    </div>
                </div>
                <div style="height:3px;background:linear-gradient(to right,#1B2B6B,transparent);margin-top:16px;"></div>
            </div>
        </div>

        <div class="row g-4">

            @php
            $niveaux = [
                ['nom' => 'CP1', 'age' => '6 à 7 ans', 'emoji' => '📖', 'couleur' => '#C9A84C', 'desc' => 'Le CP1 est la première année du primaire. L\'enfant apprend à lire, à écrire et à compter. C\'est une étape fondamentale dans la scolarité.', 'competences' => ['Apprentissage de la lecture', 'Initiation à l\'écriture cursive', 'Calcul et numération de base', 'Découverte du monde']],
                ['nom' => 'CP2', 'age' => '7 à 8 ans', 'emoji' => '✏️', 'couleur' => '#1B2B6B', 'desc' => 'Au CP2, l\'enfant consolide ses apprentissages fondamentaux. La lecture devient fluide et l\'écriture plus maîtrisée. Les bases mathématiques se renforcent.', 'competences' => ['Lecture fluide et compréhension', 'Rédaction de phrases simples', 'Opérations mathématiques', 'Éveil scientifique']],
                ['nom' => 'CE1', 'age' => '8 à 9 ans', 'emoji' => '🔢', 'couleur' => '#C9A84C', 'desc' => 'Le CE1 marque l\'entrée dans le cycle 3. L\'élève développe son esprit critique, enrichit son vocabulaire et approfondit ses connaissances mathématiques.', 'competences' => ['Lecture et analyse de textes', 'Expression écrite développée', 'Géométrie et mesures', 'Histoire et géographie']],
                ['nom' => 'CE2', 'age' => '9 à 10 ans', 'emoji' => '🌍', 'couleur' => '#1B2B6B', 'desc' => 'En CE2, l\'élève gagne en autonomie et en rigueur. Les disciplines s\'approfondissent et l\'élève développe des méthodes de travail solides.', 'competences' => ['Production de textes variés', 'Fractions et nombres décimaux', 'Sciences et technologie', 'Éducation civique']],
                ['nom' => 'CM1', 'age' => '10 à 11 ans', 'emoji' => '🔬', 'couleur' => '#C9A84C', 'desc' => 'Le CM1 prépare à l\'année du certificat. L\'élève développe son sens de l\'analyse et sa capacité à argumenter. Les matières deviennent plus exigeantes.', 'competences' => ['Rédaction et dissertation simple', 'Mathématiques avancées', 'Sciences expérimentales', 'Histoire de la Côte d\'Ivoire']],
                ['nom' => 'CM2', 'age' => '11 à 12 ans', 'emoji' => '🎓', 'couleur' => '#1B2B6B', 'desc' => 'Le CM2 est l\'année du CEPE. L\'élève se prépare à l\'examen de fin de cycle primaire et à l\'entrée en 6ème. C\'est une année clé de consolidation.', 'competences' => ['Préparation au CEPE', 'Maîtrise des 4 opérations', 'Expression orale et écrite', 'Préparation au collège']],
            ];
            @endphp

            @foreach($niveaux as $i => $niveau)
            <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="{{ ($i % 3) * 0.1 }}s">
                <div style="background:white;border-radius:16px;padding:28px;box-shadow:0 4px 20px rgba(0,0,0,0.06);height:100%;border-top:4px solid {{ $niveau['couleur'] }};transition:transform 0.3s,box-shadow 0.3s;"
                     onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 12px 30px rgba(0,0,0,0.12)'"
                     onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 4px 20px rgba(0,0,0,0.06)'">

                    <div style="display:flex;align-items:center;gap:12px;margin-bottom:16px;">
                        <div style="width:52px;height:52px;background:#EEF1FA;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1.6rem;flex-shrink:0;">
                            {{ $niveau['emoji'] }}
                        </div>
                        <div>
                            <h3 style="color:#1B2B6B;font-weight:800;font-size:18px;margin:0;">{{ $niveau['nom'] }}</h3>
                            <span style="color:{{ $niveau['couleur'] }};font-size:12px;font-weight:700;">{{ $niveau['age'] }}</span>
                        </div>
                    </div>

                    <p style="color:#666;line-height:1.7;font-size:13px;margin-bottom:16px;">
                        {{ $niveau['desc'] }}
                    </p>

                    <ul style="list-style:none;padding:0;margin:0 0 16px;">
                        @foreach($niveau['competences'] as $comp)
                        <li style="display:flex;align-items:center;gap:8px;padding:6px 0;border-bottom:1px solid #f5f5f5;font-size:13px;color:#444;">
                            <i class="fas fa-check-circle" style="color:{{ $niveau['couleur'] }};font-size:11px;flex-shrink:0;"></i>
                            {{ $comp }}
                        </li>
                        @endforeach
                    </ul>

                    <div style="padding:10px 14px;background:#EEF1FA;border-radius:8px;font-size:12px;color:#1B2B6B;">
                        <i class="fas fa-users" style="color:#C9A84C;"></i>
                        <strong>2 classes :</strong> {{ $niveau['nom'] }} A et {{ $niveau['nom'] }} B
                    </div>

                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>

{{-- CTA ADMISSIONS --}}
<div style="background:linear-gradient(135deg,#1B2B6B 0%,#12205A 100%);padding:80px 0;">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center wow fadeInUp" data-wow-delay=".25s">
                <span style="color:#C9A84C;font-size:13px;font-weight:700;text-transform:uppercase;letter-spacing:0.1em;display:block;margin-bottom:12px;">
                    <i class="fas fa-pencil-alt"></i> Inscriptions ouvertes
                </span>
                <h2 style="color:white;font-weight:800;font-size:32px;margin-bottom:16px;">
                    Inscrivez votre enfant dès aujourd'hui !
                </h2>
                <p style="color:rgba(255,255,255,0.7);font-size:15px;margin-bottom:32px;line-height:1.7;">
                    Offrez à votre enfant la meilleure éducation dans un cadre bienveillant et stimulant.
                    Contactez-nous pour plus d'informations sur les inscriptions.
                </p>
                <div style="display:flex;gap:16px;justify-content:center;flex-wrap:wrap;">
                    <a href="{{ route('admissions') }}" class="theme-btn">
                        Faire une pré-inscription <i class="fas fa-arrow-right"></i>
                    </a>
                    <a href="{{ route('contact') }}"
                       style="display:inline-flex;align-items:center;gap:8px;background:transparent;color:white;padding:12px 24px;border-radius:8px;border:2px solid rgba(255,255,255,0.3);text-decoration:none;font-weight:700;transition:all 0.2s;"
                       onmouseover="this.style.borderColor='#C9A84C';this.style.color='#C9A84C'"
                       onmouseout="this.style.borderColor='rgba(255,255,255,0.3)';this.style.color='white'">
                        Nous contacter <i class="fas fa-phone"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection