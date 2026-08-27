<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Certificat de Scolarité — {{ $eleve->nom }} {{ $eleve->prenoms }}</title>
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body {
            font-family: 'DejaVu Sans', sans-serif;
            color: #1a1a1a;
            background: white;
            width: 210mm;
            min-height: 297mm;
            padding: 0;
        }

        /* ── BORDURE DÉCORATIVE ── */
        .page {
            margin: 8mm;
            border: 3px solid #1B2B6B;
            border-radius: 4px;
            min-height: 277mm;
            position: relative;
            overflow: hidden;
        }

        .page::before {
            content: '';
            position: absolute;
            top: 4px; left: 4px; right: 4px; bottom: 4px;
            border: 1px solid #C9A84C;
            border-radius: 3px;
            pointer-events: none;
        }

        /* Coins décoratifs */
        .corner {
            position: absolute;
            width: 30px;
            height: 30px;
            border-color: #C9A84C;
            border-style: solid;
        }
        .corner-tl { top: 10px; left: 10px; border-width: 2px 0 0 2px; }
        .corner-tr { top: 10px; right: 10px; border-width: 2px 2px 0 0; }
        .corner-bl { bottom: 10px; left: 10px; border-width: 0 0 2px 2px; }
        .corner-br { bottom: 10px; right: 10px; border-width: 0 2px 2px 0; }

        /* ── HEADER ── */
        .header {
            background: #1B2B6B;
            padding: 16px 24px;
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .header-logo img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            border: 3px solid rgba(201,168,76,0.5);
            background: white;
        }

        .header-text { flex: 1; text-align: center; }
        .header-text h1 {
            color: #C9A84C;
            font-size: 13px;
            font-weight: bold;
            letter-spacing: 0.05em;
            margin-bottom: 3px;
        }
        .header-text p {
            color: rgba(255,255,255,0.75);
            font-size: 9px;
            line-height: 1.5;
        }

        /* ── BANDEAU TITRE ── */
        .titre-bandeau {
            background: linear-gradient(135deg, #C9A84C, #A8893A);
            padding: 14px 24px;
            text-align: center;
        }
        .titre-bandeau h2 {
            color: #1B2B6B;
            font-size: 20px;
            font-weight: bold;
            letter-spacing: 0.15em;
            text-transform: uppercase;
        }
        .titre-bandeau p {
            color: rgba(27,43,107,0.7);
            font-size: 10px;
            margin-top: 3px;
            letter-spacing: 0.05em;
        }

        /* ── CONTENU ── */
        .content {
            padding: 24px 36px;
        }

        /* Numéro et date */
        .ref-bar {
            display: flex;
            justify-content: space-between;
            font-size: 9px;
            color: #666;
            margin-bottom: 20px;
            padding-bottom: 8px;
            border-bottom: 1px solid #eee;
        }
        .ref-bar span { font-weight: bold; color: #1B2B6B; }

        /* Texte principal */
        .texte-principal {
            font-size: 13px;
            line-height: 2.0;
            color: #1a1a1a;
            text-align: justify;
            margin-bottom: 20px;
        }

        .texte-principal .highlight {
            color: #1B2B6B;
            font-weight: bold;
            font-size: 14px;
            text-decoration: underline;
            text-underline-offset: 3px;
        }

        .texte-principal .gold {
            color: #A8893A;
            font-weight: bold;
        }

        /* Bloc infos élève */
        .infos-eleve {
            background: #EEF1FA;
            border-left: 4px solid #C9A84C;
            border-radius: 0 8px 8px 0;
            padding: 16px 20px;
            margin: 20px 0;
        }

        .info-row {
            display: flex;
            margin-bottom: 8px;
            font-size: 11px;
        }
        .info-label {
            color: #666;
            width: 160px;
            flex-shrink: 0;
        }
        .info-value {
            color: #1B2B6B;
            font-weight: bold;
        }

        /* Phrase de conclusion */
        .conclusion {
            font-size: 12px;
            color: #333;
            text-align: center;
            font-style: italic;
            margin: 20px 0;
            padding: 12px;
            border-top: 1px dashed #C9A84C;
            border-bottom: 1px dashed #C9A84C;
        }

        /* Zone signature */
        .signatures {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-top: 32px;
        }

        .sig-left {
            font-size: 9px;
            color: #888;
        }

        .sig-right {
            text-align: center;
        }
        .sig-right .lieu-date {
            font-size: 10px;
            color: #333;
            margin-bottom: 40px;
        }
        .sig-right .sig-line {
            border-top: 1px solid #1B2B6B;
            padding-top: 4px;
            width: 180px;
            margin: 0 auto;
        }
        .sig-right .sig-title {
            font-size: 10px;
            font-weight: bold;
            color: #1B2B6B;
        }
        .sig-right .sig-name {
            font-size: 9px;
            color: #666;
        }

        /* Filigrane */
        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 60px;
            font-weight: bold;
            color: rgba(27,43,107,0.04);
            letter-spacing: 8px;
            white-space: nowrap;
            pointer-events: none;
            text-transform: uppercase;
        }

        /* Footer */
        .footer {
            position: absolute;
            bottom: 16px;
            left: 0; right: 0;
            text-align: center;
            font-size: 8px;
            color: #aaa;
        }
    </style>
</head>
<body>
<div class="page">

    {{-- Coins décoratifs --}}
    <div class="corner corner-tl"></div>
    <div class="corner corner-tr"></div>
    <div class="corner corner-bl"></div>
    <div class="corner corner-br"></div>

    {{-- Filigrane --}}
    <div class="watermark">La Petite Thérèse</div>

    {{-- HEADER --}}
    <div class="header">
        <div class="header-logo">
            <img src="{{ public_path('assets/img/logo/logoNew.jpg') }}" alt="Logo">
        </div>
        <div class="header-text">
            <h1>Groupe Scolaire Catholique La Petite Thérèse</h1>
            <p>Port-Bouet / Gonzague Ville — Abidjan, Côte d'Ivoire<br>
            Tél : +225 07 00 00 00 00 · Email : contact@lapetitetherese.ci</p>
        </div>
        <div class="header-logo">
            {{-- Espace symétrique --}}
        </div>
    </div>

    {{-- TITRE --}}
    <div class="titre-bandeau">
        <h2>Certificat de Scolarité</h2>
        <p>Année scolaire {{ $annee?->libelle ?? now()->year . '-' . (now()->year + 1) }}</p>
    </div>

    {{-- CONTENU --}}
    <div class="content">

        {{-- Référence --}}
        <div class="ref-bar">
            <div>N° <span>{{ $certificat->numero_certificat }}</span></div>
            <div>Délivré le : <span>{{ now()->format('d/m/Y') }}</span></div>
        </div>

        {{-- Texte principal --}}
        <div class="texte-principal">
            Le Directeur du Groupe Scolaire Catholique <span class="gold">La Petite Thérèse</span>,
            soussigné, certifie que l'élève :
        </div>

        {{-- Infos élève --}}
        <div class="infos-eleve">
            <div class="info-row">
                <span class="info-label">Nom & Prénoms</span>
                <span class="info-value">{{ strtoupper($eleve->nom) }} {{ $eleve->prenoms }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Matricule</span>
                <span class="info-value">{{ $eleve->matricule }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Date de naissance</span>
                <span class="info-value">
                    {{ $eleve->date_naissance?->format('d/m/Y') }}
                    à {{ $eleve->lieu_naissance }}
                </span>
            </div>
            <div class="info-row">
                <span class="info-label">Sexe</span>
                <span class="info-value">{{ $eleve->sexe === 'M' ? 'Masculin' : 'Féminin' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Classe</span>
                <span class="info-value">{{ $classe?->nom ?? '—' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Année scolaire</span>
                <span class="info-value">{{ $annee?->libelle ?? '—' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Nom du parent / tuteur</span>
                <span class="info-value">{{ $eleve->nom_parent }}</span>
            </div>
        </div>

        {{-- Suite du texte --}}
        <div class="texte-principal">
            est régulièrement inscrit(e) dans notre établissement pour l'année scolaire
            <span class="highlight">{{ $annee?->libelle ?? '—' }}</span>
            et suit normalement les cours de la classe de
            <span class="highlight">{{ $classe?->nom ?? '—' }}</span>.
        </div>

        {{-- Conclusion --}}
        <div class="conclusion">
            Ce certificat est délivré à l'intéressé(e) pour servir et valoir ce que de droit.
        </div>

        {{-- Signatures --}}
        <div class="signatures">
            <div class="sig-left">
                <div>Document officiel</div>
                <div>GSCA La Petite Thérèse</div>
                <div>{{ now()->format('Y') }}</div>
            </div>
            <div class="sig-right">
                <div class="lieu-date">
                    Abidjan, le {{ now()->format('d/m/Y') }}
                </div>
                <div class="sig-line">
                    <div class="sig-title">Le Directeur</div>
                    <div class="sig-name">{{ $directeur?->name ?? 'Le Directeur' }}</div>
                </div>
            </div>
        </div>

    </div>

    {{-- Footer --}}
    <div class="footer">
        Groupe Scolaire Catholique La Petite Thérèse — Port-Bouet / Gonzague — Abidjan, Côte d'Ivoire
    </div>

</div>
</body>
</html>