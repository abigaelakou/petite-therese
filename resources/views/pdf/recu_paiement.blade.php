<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Reçu {{ $paiement->numero_recu }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 11px;
            color: #1a1a1a;
            width: 148mm;
            min-height: 210mm;
            padding: 0;
        }

        /* ── HEADER ── */
        .header {
            background: #1B2B6B;
            color: white;
            padding: 12px 16px;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .header-logo {
            width: 45px;
            height: 45px;
            background: white;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: #1B2B6B;
            font-size: 10px;
            text-align: center;
            flex-shrink: 0;
        }
        .header-text h1 { font-size: 12px; font-weight: bold; margin-bottom: 2px; }
        .header-text p  { font-size: 9px; opacity: 0.8; line-height: 1.4; }

        /* ── TITRE REÇU ── */
        .recu-banner {
            background: #C9A84C;
            color: #1B2B6B;
            padding: 7px 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .recu-banner .title { font-size: 13px; font-weight: bold; letter-spacing: 2px; text-transform: uppercase; }
        .recu-banner .numero { font-size: 11px; font-weight: bold; }

        /* ── BODY ── */
        .body { padding: 12px 16px; }

        /* ── DEUX COLONNES ── */
        .two-col { width: 100%; margin-bottom: 10px; border-collapse: collapse; }
        .two-col td { width: 50%; vertical-align: top; padding: 0 4px 0 0; }
        .two-col td:last-child { padding: 0 0 0 4px; }

        /* ── BLOC INFO ── */
        .bloc {
            border: 1px solid #e5e7eb;
            border-radius: 4px;
            overflow: hidden;
            margin-bottom: 8px;
        }
        .bloc-title {
            background: #EEF1FA;
            color: #1B2B6B;
            font-weight: bold;
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 4px 8px;
            border-bottom: 1px solid #e5e7eb;
        }
        .bloc-content { padding: 6px 8px; }
        .info-row { margin-bottom: 3px; }
        .info-label { color: #666; font-size: 9px; }
        .info-value { font-weight: bold; font-size: 10px; }

        /* ── MONTANTS ── */
        .montants-bloc {
            border: 1px solid #e5e7eb;
            border-radius: 4px;
            overflow: hidden;
            margin-bottom: 8px;
        }
        .montants-title {
            background: #1B2B6B;
            color: white;
            font-weight: bold;
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 4px 8px;
        }
        .montant-row {
            display: table;
            width: 100%;
            padding: 4px 8px;
            border-bottom: 1px solid #f3f4f6;
        }
        .montant-row:last-child { border-bottom: none; }
        .montant-label { display: table-cell; color: #444; font-size: 10px; }
        .montant-val   { display: table-cell; text-align: right; font-weight: bold; font-size: 10px; }
        .montant-reporte { color: #dc2626; }
        .montant-total {
            background: #f8f7f4;
            border-top: 2px solid #1B2B6B !important;
        }
        .montant-total .montant-label,
        .montant-total .montant-val { font-size: 12px; font-weight: bold; }
        .montant-reste-ok  { background: #dcfce7; }
        .montant-reste-ok .montant-label,
        .montant-reste-ok .montant-val { color: #16a34a; font-weight: bold; }
        .montant-reste-du  { background: #fee2e2; }
        .montant-reste-du .montant-label,
        .montant-reste-du .montant-val { color: #dc2626; font-weight: bold; }

        /* ── TAMPON SOLDÉ ── */
        .solde-stamp {
            text-align: center;
            border: 3px solid #16a34a;
            color: #16a34a;
            font-size: 16px;
            font-weight: bold;
            padding: 4px 12px;
            letter-spacing: 4px;
            display: inline-block;
            transform: rotate(-8deg);
            opacity: 0.6;
            margin: 4px auto;
        }

        /* ── SIGNATURES ── */
        .signatures { width: 100%; border-collapse: collapse; margin-top: 8px; }
        .signatures td {
            width: 50%;
            text-align: center;
            padding: 4px 8px;
            font-size: 9px;
            color: #444;
        }
        .sig-line {
            border-top: 1px solid #333;
            margin-top: 28px;
            padding-top: 3px;
            font-size: 9px;
        }

        /* ── FOOTER ── */
        .footer {
            background: #f8f7f4;
            border-top: 1px solid #e5e7eb;
            padding: 6px 16px;
            text-align: center;
            font-size: 8px;
            color: #888;
            margin-top: 8px;
        }

        /* ── BADGE ── */
        .badge {
            background: #EEF1FA;
            color: #1B2B6B;
            padding: 1px 6px;
            border-radius: 3px;
            font-size: 9px;
            font-weight: bold;
        }
        .badge-or {
            background: #FDF8EC;
            color: #A8893A;
        }
    </style>
</head>
<body>

    {{-- ── HEADER ── --}}
    <div class="header">
        <img src="{{ public_path('assets/img/logo/logoNew.jpg') }}" 
     style="width:45px; height:45px; object-fit:contain; border-radius:4px; background:white; padding:2px;">
        <div class="header-text">
            <h1>Groupe Scolaire Catholique La Petite Thérèse</h1>
            <p>Port-Bouet / Gonzague Ville — Abidjan, Côte d'Ivoire</p>
            <p>Tél : +225 07 00 00 00 00 &nbsp;·&nbsp; contact@lapetitetherese.ci</p>
        </div>
    </div>

    {{-- ── BANNIÈRE REÇU ── --}}
    <div class="recu-banner">
        <span class="title">Reçu de Paiement</span>
        <span class="numero">{{ $paiement->numero_recu }}</span>
    </div>

    <div class="body">

        {{-- ── DEUX COLONNES : ÉLÈVE + PAIEMENT ── --}}
        <table class="two-col">
            <tr>
                {{-- Colonne gauche : infos élève --}}
                <td>
                    <div class="bloc">
                        <div class="bloc-title">Élève</div>
                        <div class="bloc-content">
                            <div class="info-row">
                                <div class="info-label">Nom & Prénoms</div>
                                <div class="info-value">{{ $paiement->eleve?->nom }} {{ $paiement->eleve?->prenoms }}</div>
                            </div>
                            <div class="info-row">
                                <div class="info-label">Matricule</div>
                                <div class="info-value"><span class="badge">{{ $paiement->eleve?->matricule }}</span></div>
                            </div>
                            <div class="info-row">
                                <div class="info-label">Classe</div>
                                <div class="info-value">
                                    <span class="badge badge-or">
                                        {{ $classe?->nom ?? '—' }}
                                    </span>
                                </div>
                            </div>
                            <div class="info-row">
                                <div class="info-label">Année scolaire</div>
                                <div class="info-value">{{ $paiement->anneeScolaire?->libelle }}</div>
                            </div>
                        </div>
                    </div>
                </td>

                {{-- Colonne droite : infos parent + paiement --}}
                <td>
                    <div class="bloc">
                        <div class="bloc-title">Parent / Tuteur</div>
                        <div class="bloc-content">
                            <div class="info-row">
                                <div class="info-label">Nom</div>
                                <div class="info-value">{{ $paiement->eleve?->nom_parent }}</div>
                            </div>
                            <div class="info-row">
                                <div class="info-label">Téléphone</div>
                                <div class="info-value">{{ $paiement->eleve?->telephone_parent }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="bloc">
                        <div class="bloc-title">Détails</div>
                        <div class="bloc-content">
                            <div class="info-row">
                                <div class="info-label">Type</div>
                                <div class="info-value">{{ $paiement->type_label }}</div>
                            </div>
                            <div class="info-row">
                                <div class="info-label">Mode</div>
                                <div class="info-value">{{ \App\Models\Paiement::MODES[$paiement->mode_paiement] ?? $paiement->mode_paiement }}</div>
                            </div>
                            @if($paiement->reference_mobile_money)
                            <div class="info-row">
                                <div class="info-label">Référence</div>
                                <div class="info-value">{{ $paiement->reference_mobile_money }}</div>
                            </div>
                            @endif
                            <div class="info-row">
                                <div class="info-label">Date</div>
                                <div class="info-value">{{ $paiement->date_paiement->format('d/m/Y') }}</div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        </table>

        {{-- ── MONTANTS ── --}}
        <div class="montants-bloc">
            <div class="montants-title">Détail des montants</div>

            <div class="montant-row">
                <span class="montant-label">Montant attendu</span>
                <span class="montant-val">{{ number_format($paiement->montant_attendu, 0, ',', ' ') }} FCFA</span>
            </div>

            @if($paiement->montant_reporte > 0)
            <div class="montant-row montant-reporte">
                <span class="montant-label">⚠ Solde reporté ({{ $paiement->anneePrecedente?->libelle }})</span>
                <span class="montant-val">+ {{ number_format($paiement->montant_reporte, 0, ',', ' ') }} FCFA</span>
            </div>
            @endif

            <div class="montant-row montant-total">
                <span class="montant-label">Montant payé aujourd'hui</span>
                <span class="montant-val">{{ number_format($paiement->montant_paye, 0, ',', ' ') }} FCFA</span>
            </div>

            @if($paiement->reste_a_payer <= 0)
            <div class="montant-row montant-reste-ok">
                <span class="montant-label">✓ Paiement soldé</span>
                <span class="montant-val">0 FCFA</span>
            </div>
            @else
            <div class="montant-row montant-reste-du">
                <span class="montant-label">⚠ Reste à payer</span>
                <span class="montant-val">{{ number_format($paiement->reste_a_payer, 0, ',', ' ') }} FCFA</span>
            </div>
            @endif
        </div>

        @if($paiement->observations)
        <div style="font-size:9px; color:#666; font-style:italic; margin-bottom:8px; padding:4px 8px; background:#f8f7f4; border-radius:3px;">
            Note : {{ $paiement->observations }}
        </div>
        @endif

        {{-- ── TAMPON SOLDÉ ── --}}
        @if($paiement->reste_a_payer <= 0)
        <div style="text-align:center; margin: 4px 0;">
            <span class="solde-stamp">SOLDÉ</span>
        </div>
        @endif

        {{-- ── SIGNATURES ── --}}
        <table class="signatures">
            <tr>
                <td>
                    <div>Le Comptable</div>
                    <div class="sig-line">{{ $paiement->enregistrePar?->name }}</div>
                </td>
                <td>
                    <div>Le Parent / Tuteur</div>
                    <div class="sig-line">{{ $paiement->eleve?->nom_parent }}</div>
                </td>
            </tr>
        </table>

    </div>

    {{-- ── FOOTER ── --}}
    <div class="footer">
        Document généré le {{ now()->format('d/m/Y à H:i') }} &nbsp;·&nbsp;
        Groupe Scolaire Catholique La Petite Thérèse &nbsp;·&nbsp;
        Ce reçu est un document officiel, conservez-le précieusement.
    </div>

</body>
</html>