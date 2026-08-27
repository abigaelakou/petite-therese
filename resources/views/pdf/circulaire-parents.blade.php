<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Note parents — {{ $circulaire->titre }}</title>
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:'DejaVu Sans',sans-serif; font-size:10px; color:#1a1a1a; }

        .note {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 8px;
            page-break-inside: avoid;
        }

        .note-header {
            display: flex;
            align-items: center;
            gap: 8px;
            border-bottom: 2px solid #C9A84C;
            padding-bottom: 6px;
            margin-bottom: 8px;
        }

        .note-header img {
            width: 30px;
            height: 30px;
        }

        .note-header-text h2 {
            font-size: 9px;
            color: #1B2B6B;
            font-weight: bold;
        }

        .note-header-text p {
            font-size: 7px;
            color: #666;
        }

        .note-titre {
            font-size: 11px;
            font-weight: bold;
            color: #1B2B6B;
            margin-bottom: 4px;
            text-align: center;
        }

        .note-type {
            text-align: center;
            margin-bottom: 6px;
        }

        .note-type span {
            background: #EEF1FA;
            color: #1B2B6B;
            padding: 1px 8px;
            border-radius: 10px;
            font-size: 8px;
        }

        .note-contenu {
            font-size: 9px;
            line-height: 1.5;
            color: #333;
        }

        .note-footer {
            margin-top: 6px;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            border-top: 1px solid #eee;
            padding-top: 4px;
        }

        .note-date {
            font-size: 7px;
            color: #888;
        }

        .note-signature {
            text-align: center;
            font-size: 7px;
            color: #444;
        }

        .sig-line {
            border-top: 1px solid #333;
            margin-top: 16px;
            padding-top: 2px;
            width: 80px;
        }

        .separator {
            border: none;
            border-top: 2px dashed #C9A84C;
            margin: 4px 0;
        }
    </style>
</head>
<body>

    @for($i = 0; $i < 3; $i++)
    <div class="note">
        <div class="note-header">
            <img src="{{ public_path('assets/img/logo/logoNew.jpg') }}" alt="Logo">
            <div class="note-header-text">
                <h2>Groupe Scolaire Catholique La Petite Thérèse</h2>
                <p>Port-Bouet / Gonzague — Abidjan · Tél : +225 07 00 00 00 00</p>
            </div>
        </div>

        <div class="note-titre">{{ $circulaire->titre }}</div>

        <div class="note-type">
            <span>{{ \App\Models\Circulaire::TYPES[$circulaire->type] ?? $circulaire->type }}</span>
        </div>

        <div class="note-contenu">
            {!! strip_tags($circulaire->contenu, '<p><br><ul><li><ol><strong><em>') !!}
        </div>

        <div class="note-footer">
            <div class="note-date">
                Abidjan, le {{ $circulaire->date_publication?->format('d/m/Y') ?? now()->format('d/m/Y') }}
            </div>
            <div class="note-signature">
                <div>La Direction</div>
                <div class="sig-line">{{ $circulaire->creePar?->name }}</div>
            </div>
        </div>
    </div>
    @if($i < 2)
    <hr class="separator">
    @endif
    @endfor

</body>
</html>