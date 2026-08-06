<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Classes</title>
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:'DejaVu Sans',sans-serif; font-size:10px; color:#1a1a1a; }
        .header { background:#1B2B6B; color:white; padding:12px 16px; }
        .header h1 { font-size:13px; font-weight:bold; }
        .header p  { font-size:9px; opacity:0.8; }
        .banner { background:#C9A84C; color:#1B2B6B; padding:6px 16px; font-weight:bold; font-size:11px; display:flex; justify-content:space-between; }
        .content { padding:12px 16px; }
        .classe-block { margin-bottom:20px; page-break-inside:avoid; }
        .classe-title { background:#EEF1FA; border-left:4px solid #C9A84C; padding:6px 10px; font-weight:bold; font-size:11px; color:#1B2B6B; margin-bottom:6px; display:flex; justify-content:space-between; }
        table { width:100%; border-collapse:collapse; margin-bottom:4px; }
        th { background:#1B2B6B; color:white; padding:4px 6px; font-size:9px; text-align:left; }
        td { padding:3px 6px; border-bottom:1px solid #f0f0f0; font-size:9px; }
        tr:nth-child(even) td { background:#f8f7f4; }
        .empty { color:#999; font-style:italic; font-size:9px; padding:6px; }
        .footer { margin-top:12px; text-align:center; font-size:8px; color:#888; border-top:1px solid #eee; padding-top:6px; }
        .summary { background:#f8f7f4; border-radius:6px; padding:8px 12px; margin-bottom:12px; font-size:9px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Groupe Scolaire Catholique La Petite Thérèse</h1>
        <p>Port-Bouet / Gonzague Ville — Abidjan, Côte d'Ivoire</p>
    </div>
    <div class="banner">
        <span>LISTE DES CLASSES PAR ÉLÈVE</span>
        <span>{{ $annee?->libelle ?? 'Toutes années' }} · {{ now()->format('d/m/Y') }}</span>
    </div>
    <div class="content">

        <div class="summary">
            <strong>Résumé :</strong>
            {{ $classes->count() }} classe(s) —
            Total élèves inscrits : {{ $classes->sum(fn($c) => $c->eleves->count()) }}
            @if($annee) · Année scolaire : {{ $annee->libelle }} @endif
        </div>

        @foreach($classes as $classe)
        <div class="classe-block">
            <div class="classe-title">
                <span>{{ $classe->nom }} — {{ \App\Models\Classe::NIVEAUX[$classe->niveau] ?? $classe->niveau }}</span>
                <span>{{ $classe->eleves->count() }} élève(s) / Capacité : {{ $classe->capacite }}</span>
            </div>

            @if($classe->eleves->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Matricule</th>
                        <th>Nom & Prénoms</th>
                        <th>Sexe</th>
                        <th>Date naissance</th>
                        <th>Téléphone parent</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($classe->eleves->sortBy('nom') as $i => $eleve)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $eleve->matricule }}</td>
                        <td><strong>{{ $eleve->nom }} {{ $eleve->prenoms }}</strong></td>
                        <td>{{ $eleve->sexe }}</td>
                        <td>{{ $eleve->date_naissance?->format('d/m/Y') }}</td>
                        <td>{{ $eleve->telephone_parent }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="empty">Aucun élève inscrit dans cette classe.</div>
            @endif
        </div>
        @endforeach

        <div class="footer">
            Document généré le {{ now()->format('d/m/Y à H:i') }} — GSCA La Petite Thérèse
        </div>
    </div>
</body>
</html>