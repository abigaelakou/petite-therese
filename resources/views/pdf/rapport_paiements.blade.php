<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Rapport Paiements</title>
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:'DejaVu Sans',sans-serif; font-size:10px; color:#1a1a1a; }
        .header { background:#1B2B6B; color:white; padding:12px 16px; }
        .header h1 { font-size:13px; font-weight:bold; }
        .header p  { font-size:9px; opacity:0.8; margin-top:2px; }
        .banner { background:#C9A84C; color:#1B2B6B; padding:6px 16px; font-weight:bold; font-size:11px; display:flex; justify-content:space-between; }
        .content { padding:12px 16px; }
        .filters { background:#f8f7f4; border-radius:6px; padding:8px 12px; margin-bottom:10px; font-size:9px; color:#555; }
        table { width:100%; border-collapse:collapse; margin-top:8px; }
        th { background:#1B2B6B; color:white; padding:5px 6px; font-size:9px; text-align:left; }
        td { padding:4px 6px; border-bottom:1px solid #f0f0f0; font-size:9px; }
        tr:nth-child(even) td { background:#f8f7f4; }
        .total-row td { background:#EEF1FA; font-weight:bold; border-top:2px solid #1B2B6B; }
        .badge { padding:1px 5px; border-radius:3px; font-size:8px; }
        .badge-complet { background:#dcfce7; color:#16a34a; }
        .badge-partiel { background:#fef3c7; color:#d97706; }
        .badge-retard  { background:#fee2e2; color:#dc2626; }
        .footer { margin-top:12px; text-align:center; font-size:8px; color:#888; border-top:1px solid #eee; padding-top:6px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Groupe Scolaire Catholique La Petite Thérèse</h1>
        <p>Port-Bouet / Gonzague Ville — Abidjan, Côte d'Ivoire</p>
    </div>
    <div class="banner">
        <span>RAPPORT DES PAIEMENTS</span>
        <span>{{ now()->format('d/m/Y') }}</span>
    </div>
    <div class="content">
        <div class="filters">
            Année : {{ $annee?->libelle ?? 'Toutes' }} &nbsp;·&nbsp;
            Mois : {{ $mois ? \Carbon\Carbon::createFromFormat('m', $mois)->translatedFormat('F') : 'Tous' }} &nbsp;·&nbsp;
            Catégorie : {{ $categorie ? \App\Models\Paiement::CATEGORIES[$categorie] : 'Toutes' }} &nbsp;·&nbsp;
            Total enregistrements : {{ $paiements->count() }}
        </div>
        <table>
            <thead>
                <tr>
                    <th>N° Reçu</th><th>Matricule</th><th>Élève</th>
                    <th>Type</th><th>Mode</th>
                    <th>Attendu</th><th>Payé</th><th>Reste</th>
                    <th>Statut</th><th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($paiements as $p)
                @php $flat = array_merge(\App\Models\Paiement::TYPES_SCOLARITE, \App\Models\Paiement::TYPES_DIVERS); @endphp
                <tr>
                    <td>{{ $p->numero_recu }}</td>
                    <td>{{ $p->eleve?->matricule }}</td>
                    <td>{{ $p->eleve?->nom }} {{ $p->eleve?->prenoms }}</td>
                    <td>{{ $flat[$p->type] ?? $p->type }}</td>
                    <td>{{ \App\Models\Paiement::MODES[$p->mode_paiement] ?? $p->mode_paiement }}</td>
                    <td>{{ number_format($p->montant_attendu, 0, ',', ' ') }}</td>
                    <td>{{ number_format($p->montant_paye, 0, ',', ' ') }}</td>
                    <td style="{{ $p->reste_a_payer > 0 ? 'color:#dc2626;font-weight:bold' : 'color:#16a34a' }}">
                        {{ number_format($p->reste_a_payer, 0, ',', ' ') }}
                    </td>
                    <td><span class="badge badge-{{ $p->statut === 'complet' ? 'complet' : ($p->statut === 'en_retard' ? 'retard' : 'partiel') }}">
                        {{ \App\Models\Paiement::STATUTS[$p->statut] ?? $p->statut }}
                    </span></td>
                    <td>{{ $p->date_paiement?->format('d/m/Y') }}</td>
                </tr>
                @endforeach
                <tr class="total-row">
                    <td colspan="5">TOTAL ({{ $paiements->count() }} paiements)</td>
                    <td>{{ number_format($paiements->sum('montant_attendu'), 0, ',', ' ') }} FCFA</td>
                    <td>{{ number_format($totalPaye, 0, ',', ' ') }} FCFA</td>
                    <td style="color:#dc2626">{{ number_format($totalReste, 0, ',', ' ') }} FCFA</td>
                    <td colspan="2"></td>
                </tr>
            </tbody>
        </table>
        <div class="footer">
            Document généré le {{ now()->format('d/m/Y à H:i') }} — GSCA La Petite Thérèse
        </div>
    </div>
</body>
</html>