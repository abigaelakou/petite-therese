<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste Impayés</title>
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:'DejaVu Sans',sans-serif; font-size:10px; color:#1a1a1a; }
        .header { background:#1B2B6B; color:white; padding:12px 16px; }
        .header h1 { font-size:13px; font-weight:bold; }
        .header p  { font-size:9px; opacity:0.8; }
        .banner { background:#dc2626; color:white; padding:6px 16px; font-weight:bold; font-size:11px; display:flex; justify-content:space-between; }
        .content { padding:12px 16px; }
        .alerte { background:#fee2e2; border:1px solid #fca5a5; border-radius:6px; padding:8px 12px; margin-bottom:10px; font-size:9px; color:#dc2626; font-weight:bold; }
        table { width:100%; border-collapse:collapse; }
        th { background:#1B2B6B; color:white; padding:5px 6px; font-size:9px; text-align:left; }
        td { padding:4px 6px; border-bottom:1px solid #f0f0f0; font-size:9px; }
        tr:nth-child(even) td { background:#fff5f5; }
        .total-row td { background:#fee2e2; font-weight:bold; border-top:2px solid #dc2626; color:#dc2626; }
        .footer { margin-top:12px; text-align:center; font-size:8px; color:#888; border-top:1px solid #eee; padding-top:6px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Groupe Scolaire Catholique La Petite Thérèse</h1>
        <p>Port-Bouet / Gonzague Ville — Abidjan, Côte d'Ivoire</p>
    </div>
    <div class="banner">
        <span>⚠️ LISTE DES IMPAYÉS — SCOLARITÉ</span>
        <span>{{ $annee?->libelle ?? 'Toutes années' }} · {{ now()->format('d/m/Y') }}</span>
    </div>
    <div class="content">
        <div class="alerte">
            {{ $impayes->count() }} élève(s) avec solde impayé —
            Total dû : {{ number_format($totalImpayes, 0, ',', ' ') }} FCFA
        </div>
        <table>
            <thead>
                <tr>
                    <th>#</th><th>Matricule</th><th>Nom & Prénoms</th>
                    <th>Type</th><th>Attendu</th><th>Payé</th>
                    <th>Reste dû</th><th>Tél. Parent</th><th>Relancé</th>
                </tr>
            </thead>
            <tbody>
                @foreach($impayes as $i => $p)
                @php $flat = array_merge(\App\Models\Paiement::TYPES_SCOLARITE, \App\Models\Paiement::TYPES_DIVERS); @endphp
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $p->eleve?->matricule }}</td>
                    <td><strong>{{ $p->eleve?->nom }} {{ $p->eleve?->prenoms }}</strong></td>
                    <td>{{ $flat[$p->type] ?? $p->type }}</td>
                    <td>{{ number_format($p->montant_attendu, 0, ',', ' ') }}</td>
                    <td>{{ number_format($p->montant_paye, 0, ',', ' ') }}</td>
                    <td style="color:#dc2626;font-weight:bold">{{ number_format($p->reste_a_payer, 0, ',', ' ') }} FCFA</td>
                    <td>{{ $p->eleve?->telephone_parent }}</td>
                    <td>{{ $p->relance_envoyee ? '✓' : '—' }}</td>
                </tr>
                @endforeach
                <tr class="total-row">
                    <td colspan="6">TOTAL IMPAYÉ ({{ $impayes->count() }} élèves)</td>
                    <td colspan="3">{{ number_format($totalImpayes, 0, ',', ' ') }} FCFA</td>
                </tr>
            </tbody>
        </table>
        <div class="footer">
            Document généré le {{ now()->format('d/m/Y à H:i') }} — CONFIDENTIEL — GSCA La Petite Thérèse
        </div>
    </div>
</body>
</html>