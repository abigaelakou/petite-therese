<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background: #f5f5f5; }
        .container { max-width: 600px; margin: 20px auto; background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
        .header { background: #1B2B6B; padding: 24px; text-align: center; }
        .header h1 { color: white; font-size: 18px; margin: 0; }
        .header p  { color: rgba(255,255,255,0.7); font-size: 12px; margin: 6px 0 0; }
        .banner { background: #C9A84C; padding: 10px 24px; }
        .banner p { color: #1B2B6B; font-weight: bold; font-size: 13px; margin: 0; }
        .content { padding: 24px; }
        .titre { font-size: 18px; font-weight: bold; color: #1B2B6B; margin-bottom: 8px; }
        .meta { display: flex; gap: 12px; margin-bottom: 16px; flex-wrap: wrap; }
        .badge { background: #EEF1FA; color: #1B2B6B; padding: 4px 10px; border-radius: 20px; font-size: 11px; }
        .corps { color: #333; font-size: 14px; line-height: 1.7; border-left: 4px solid #C9A84C; padding-left: 16px; margin: 16px 0; }
        .btn { display: inline-block; background: linear-gradient(135deg, #C9A84C, #A8893A); color: #1B2B6B; padding: 12px 24px; border-radius: 8px; text-decoration: none; font-weight: bold; font-size: 14px; margin-top: 16px; }
        .footer { background: #f8f7f4; padding: 16px 24px; text-align: center; font-size: 11px; color: #888; border-top: 1px solid #eee; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Groupe Scolaire Catholique La Petite Thérèse</h1>
            <p>Port-Bouet / Gonzague Ville — Abidjan, Côte d'Ivoire</p>
        </div>

        <div class="banner">
            <p>📢 Nouvelle circulaire publiée</p>
        </div>

        <div class="content">
            <div class="titre">{{ $circulaire->titre }}</div>

            <div class="meta">
                <span class="badge">
                    {{ \App\Models\Circulaire::TYPES[$circulaire->type] ?? $circulaire->type }}
                </span>
                <span class="badge">
                    Destinataires : {{ \App\Models\Circulaire::DESTINATAIRES[$circulaire->destinataires] ?? $circulaire->destinataires }}
                </span>
                <span class="badge">
                    Publiée le {{ $circulaire->date_publication?->format('d/m/Y à H:i') }}
                </span>
            </div>

            <div class="corps">
                {!! strip_tags($circulaire->contenu, '<p><br><ul><li><ol><strong><em>') !!}
            </div>

            <a href="{{ config('app.url') }}/admin/circulaires" class="btn">
                Voir dans l'application
            </a>
        </div>

        <div class="footer">
            Vous recevez cet email car vous êtes membre du personnel de GSCA La Petite Thérèse.<br>
            Publié par : {{ $circulaire->creePar?->name }} — {{ now()->format('d/m/Y') }}
        </div>
    </div>
</body>
</html>