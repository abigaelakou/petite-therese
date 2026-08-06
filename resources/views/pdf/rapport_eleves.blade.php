<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Élèves</title>
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:'DejaVu Sans',sans-serif; font-size:10px; color:#1a1a1a; }
        .header { background:#1B2B6B; color:white; padding:12px 16px; }
        .header h1 { font-size:13px; font-weight:bold; }
        .header p  { font-size:9px; opacity:0.8; }
        .banner { background:#C9A84C; color:#1B2B6B; padding:6px 16px; font-weight:bold; font-size:11px; display:flex; justify-content:space-between; }
        .content { padding:12px 16px; }
        .info-box { background:#EEF1FA; border-radius:6px; padding:8px 12px; margin-bottom:10px; font-size:9px; color:#1B2B6B; }
        table { width:100%; border-collapse:collapse; }
        th { background:#1B2B6B; color:white; padding:5px 6px; font-size:9px; text-align:left; }
        td { padding:4px 6px; border-bottom:1px solid #f0f0f0; font-size:9px; }
        tr:nth-child(even) td { background:#f8f7f4; }
        .footer { margin-top:12px; text-align:center; font-size:8px; color:#888; border-top:1px solid #eee; padding-top:6px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Groupe Scolaire Catholique La Petite Thérèse</h1>
        <p>Port-Bouet / Gonzague Ville — Abidjan, Côte d'Ivoire</p>
    </div>
    <div class="banner">
        <span>LISTE DES ÉLÈVES{{ $classe ? ' — ' . $classe->nom : '' }}</span>
        <span>{{ $annee?->libelle ?? 'Toutes années' }} · {{ now()->format('d/m/Y') }}</span>
    </div>
    <div class="content">
        <div class="info-box">
            Total : {{ $eleves->count() }} élève(s)
            @if($classe) · Classe : {{ $classe->nom }} @endif
            @if($annee) · Année : {{ $annee->libelle }} @endif
        </div>
        <table>
            <thead>
                <tr>
                    <th>#</th><th>Matricule</th><th>Nom & Prénoms</th>
                    <th>Sexe</th><th>Date naiss.</th>
                    <th>Classe</th><th>Parent</th><th>Téléphone</th>
                </tr>
            </thead>
            <tbody>
                @foreach($eleves as $i => $e)
                @php
                    $inscription = $e->inscriptions
                        ->where('statut', 'validee')
                        ->when($anneeId, fn($c) => $c->where('annee_scolaire_id', $anneeId))
                        ->first();
                @endphp
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $e->matricule }}</td>
                    <td><strong>{{ $e->nom }} {{ $e->prenoms }}</strong></td>
                    <td>{{ $e->sexe === 'M' ? 'M' : 'F' }}</td>
                    <td>{{ $e->date_naissance?->format('d/m/Y') }}</td>
                    <td>{{ $inscription?->classe?->nom ?? '—' }}</td>
                    <td>{{ $e->nom_parent }}</td>
                    <td>{{ $e->telephone_parent }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="footer">
            Document généré le {{ now()->format('d/m/Y à H:i') }} — GSCA La Petite Thérèse
        </div>
    </div>
</body>
</html>