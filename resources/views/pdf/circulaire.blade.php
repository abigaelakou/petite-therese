<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>{{ $circulaire->titre }}</title>
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:'DejaVu Sans',sans-serif; font-size:11px; color:#1a1a1a; }
        .header { background:#1B2B6B; color:white; padding:16px 20px; display:flex; align-items:center; gap:16px; }
        .header-logo img { width:50px; height:50px; border-radius:4px; background:white; }
        .header-text h1 { font-size:13px; font-weight:bold; }
        .header-text p  { font-size:9px; opacity:0.8; margin-top:2px; }
        .banner { background:#C9A84C; color:#1B2B6B; padding:8px 20px; display:flex; justify-content:space-between; align-items:center; }
        .banner .type { font-size:10px; font-weight:bold; text-transform:uppercase; letter-spacing:1px; }
        .banner .date { font-size:10px; }
        .content { padding:20px; }
        .titre { font-size:16px; font-weight:bold; color:#1B2B6B; margin-bottom:8px; text-align:center; }
        .meta { display:flex; gap:16px; justify-content:center; margin-bottom:16px; }
        .meta-item { background:#EEF1FA; padding:4px 12px; border-radius:4px; font-size:9px; color:#1B2B6B; }
        .divider { border-top:2px solid #C9A84C; margin:12px 0; }
        .corps { font-size:11px; line-height:1.7; color:#333; }
        .corps p  { margin-bottom:8px; }
        .corps ul { margin-left:20px; margin-bottom:8px; }
        .corps h2 { color:#1B2B6B; font-size:13px; margin:12px 0 6px; }
        .signature { margin-top:32px; display:flex; justify-content:flex-end; }
        .sig-box { text-align:center; }
        .sig-line { border-top:1px solid #333; margin-top:40px; padding-top:4px; font-size:10px; width:180px; }
        .footer { margin-top:20px; border-top:1px solid #eee; padding-top:8px; text-align:center; font-size:8px; color:#888; }
    </style>
</head>
<body>

    <div class="header">
        <div class="header-logo">
            <img src="{{ public_path('assets/img/logo/logoNew.jpg') }}" alt="Logo">
        </div>
        <div class="header-text">
            <h1>Groupe Scolaire Catholique La Petite Thérèse</h1>
            <p>Port-Bouet / Gonzague Ville — Abidjan, Côte d'Ivoire</p>
            <p>Tél : +225 07 00 00 00 00 · contact@lapetitetherese.ci</p>
        </div>
    </div>

    <div class="banner">
        <span class="type">
            {{ \App\Models\Circulaire::TYPES[$circulaire->type] ?? $circulaire->type }}
            — Destinataires : {{ \App\Models\Circulaire::DESTINATAIRES[$circulaire->destinataires] ?? $circulaire->destinataires }}
        </span>
        <span class="date">
            {{ $circulaire->date_publication?->format('d/m/Y') ?? now()->format('d/m/Y') }}
        </span>
    </div>

    <div class="content">

        <div class="titre">{{ $circulaire->titre }}</div>

        <div class="divider"></div>

        <div class="corps">
            {!! strip_tags($circulaire->contenu, '<p><br><ul><li><ol><strong><em><h2><h3>') !!}
        </div>

        <div class="signature">
            <div class="sig-box">
                <div>Le Directeur</div>
                <div class="sig-line">{{ $circulaire->creePar?->name }}</div>
            </div>
        </div>

        <div class="footer">
            Circulaire N° {{ str_pad($circulaire->id, 4, '0', STR_PAD_LEFT) }}/{{ now()->year }} —
            GSCA La Petite Thérèse — Document officiel
        </div>

    </div>

</body>
</html>