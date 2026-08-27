@extends('layouts.app')

@section('title', $article->titre)
@section('meta_description', $article->extrait ?? Str::limit(strip_tags($article->contenu), 160))

@section('content')

{{-- ── BREADCRUMB ── --}}
<div class="site-breadcrumb" style="background: url({{ asset('assets/img/breadcrumb/01.jpg') }})">
    <div class="container">
        <h2 class="breadcrumb-title">{{ Str::limit($article->titre, 40) }}</h2>
        <ul class="breadcrumb-menu">
            <li><a href="{{ route('home') }}">Accueil</a></li>
            <li><a href="{{ route('vie-scolaire.index') }}">Vie Scolaire</a></li>
            <li class="active">{{ Str::limit($article->titre, 30) }}</li>
        </ul>
    </div>
</div>

{{-- ── CONTENU ── --}}
<div class="blog-single py-120">
    <div class="container">
        <div class="row g-4">

            {{-- Article principal --}}
            <div class="col-lg-8">
                <div class="blog-single-wrap wow fadeInUp" data-wow-delay=".25s">

                    {{-- Image de couverture --}}
                    @if($article->photo_couverture)
                    <div class="blog-single-img mb-30" style="border-radius:12px;overflow:hidden;">
                        <img src="{{ asset('storage/' . $article->photo_couverture) }}"
                             alt="{{ $article->titre }}"
                             style="width:100%;max-height:460px;object-fit:cover;">
                    </div>
                    @endif

                    {{-- Meta --}}
                    <ul class="blog-single-meta" style="display:flex;flex-wrap:wrap;gap:20px;list-style:none;padding:0;font-size:13px;color:#888;margin-bottom:20px;padding-bottom:16px;border-bottom:1px solid #eee;">
                        <li>
                            <span style="background:#EEF1FA;color:#1B2B6B;padding:4px 14px;border-radius:20px;font-weight:700;font-size:12px;">
                                {{ \App\Models\Article::CATEGORIES[$article->categorie] ?? $article->categorie }}
                            </span>
                        </li>
                        <li><i class="fas fa-calendar-alt" style="color:#C9A84C;"></i> {{ $article->publie_le?->translatedFormat('d F Y') }}</li>
                        <li><i class="fas fa-user" style="color:#C9A84C;"></i> {{ $article->auteur?->name ?? 'La Direction' }}</li>
                        <li><i class="fas fa-eye" style="color:#C9A84C;"></i> {{ $article->vues }} vue(s)</li>
                    </ul>

                    {{-- Titre --}}
                    <h2 style="color:#1B2B6B;font-weight:800;font-size:26px;line-height:1.3;margin-bottom:20px;">
                        {{ $article->titre }}
                    </h2>

                    {{-- Extrait --}}
                    @if($article->extrait)
                    <div style="background:#f8f7f4;border-left:4px solid #C9A84C;padding:16px 20px;border-radius:0 8px 8px 0;margin-bottom:24px;">
                        <p style="font-size:15px;color:#555;font-style:italic;margin:0;line-height:1.7;">
                            {{ $article->extrait }}
                        </p>
                    </div>
                    @endif

                    {{-- Contenu --}}
                    <div style="font-size:15px;color:#333;line-height:1.9;">
                        {!! $article->contenu !!}
                    </div>

                    {{-- Partage --}}
                    <div class="mt-40 pt-20" style="border-top:1px solid #eee;">
                        <p style="font-size:13px;color:#888;margin-bottom:12px;font-weight:600;">
                            <i class="fas fa-share-alt" style="color:#C9A84C;"></i> Partager cet article :
                        </p>
                        <div style="display:flex;gap:10px;flex-wrap:wrap;">

                            {{-- WhatsApp --}}
                            <a href="https://wa.me/?text={{ urlencode($article->titre . "\n\n" . url()->current()) }}"
                               target="_blank"
                               style="display:inline-flex;align-items:center;gap:8px;background:#25D366;color:white;padding:10px 20px;border-radius:8px;text-decoration:none;font-weight:700;font-size:13px;">
                                <i class="fab fa-whatsapp"></i> WhatsApp
                            </a>

                            {{-- Facebook --}}
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                               target="_blank"
                               style="display:inline-flex;align-items:center;gap:8px;background:#1877F2;color:white;padding:10px 20px;border-radius:8px;text-decoration:none;font-weight:700;font-size:13px;">
                                <i class="fab fa-facebook-f"></i> Facebook
                            </a>

                            {{-- Copier le lien --}}
                            <button onclick="navigator.clipboard.writeText('{{ url()->current() }}');this.innerHTML='<i class=\'fas fa-check\'></i> Lien copié !';setTimeout(()=>this.innerHTML='<i class=\'fas fa-link\'></i> Copier le lien',2000)"
                               style="display:inline-flex;align-items:center;gap:8px;background:#f0f0f0;color:#333;padding:10px 20px;border-radius:8px;border:none;cursor:pointer;font-weight:700;font-size:13px;">
                                <i class="fas fa-link"></i> Copier le lien
                            </button>

                        </div>
                    </div>

                    {{-- Navigation prev/next --}}
                    <div class="mt-30 pt-20" style="border-top:1px solid #eee;display:flex;justify-content:space-between;flex-wrap:wrap;gap:12px;">
                        <a href="{{ route('vie-scolaire.index') }}"
                           style="display:inline-flex;align-items:center;gap:8px;color:#1B2B6B;font-weight:700;text-decoration:none;font-size:14px;">
                            <i class="fas fa-arrow-left"></i> Retour aux actualités
                        </a>
                    </div>

                </div>
            </div>

            {{-- Sidebar --}}
            <div class="col-lg-4">

                {{-- Articles récents --}}
                <div class="sidebar-widget wow fadeInRight" data-wow-delay=".25s"
                     style="background:#f8f7f4;border-radius:12px;padding:24px;margin-bottom:24px;">
                    <h4 style="color:#1B2B6B;font-weight:800;margin-bottom:20px;padding-bottom:12px;border-bottom:2px solid #C9A84C;">
                        <i class="fas fa-newspaper" style="color:#C9A84C;"></i> Articles récents
                    </h4>
                    @forelse($articlesRecents as $recent)
                    <div style="display:flex;gap:12px;margin-bottom:16px;padding-bottom:16px;border-bottom:1px solid #eee;">
                        @if($recent->photo_couverture)
                        <img src="{{ asset('storage/' . $recent->photo_couverture) }}"
                             style="width:65px;height:65px;border-radius:8px;object-fit:cover;flex-shrink:0;">
                        @else
                        <div style="width:65px;height:65px;border-radius:8px;background:linear-gradient(135deg,#1B2B6B,#2E9EC5);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <span style="font-size:1.5rem;">📰</span>
                        </div>
                        @endif
                        <div>
                            <a href="{{ route('vie-scolaire.show', $recent->slug) }}"
                               style="color:#1B2B6B;font-weight:700;font-size:13px;text-decoration:none;line-height:1.4;display:block;margin-bottom:4px;">
                                {{ Str::limit($recent->titre, 45) }}
                            </a>
                            <span style="font-size:11px;color:#aaa;">
                                <i class="fas fa-calendar-alt"></i> {{ $recent->publie_le?->format('d/m/Y') }}
                            </span>
                        </div>
                    </div>
                    @empty
                    <p style="font-size:13px;color:#888;">Aucun autre article.</p>
                    @endforelse
                </div>

                {{-- Catégories --}}
                <div class="sidebar-widget wow fadeInRight" data-wow-delay=".35s"
                     style="background:#f8f7f4;border-radius:12px;padding:24px;margin-bottom:24px;">
                    <h4 style="color:#1B2B6B;font-weight:800;margin-bottom:20px;padding-bottom:12px;border-bottom:2px solid #C9A84C;">
                        <i class="fas fa-tags" style="color:#C9A84C;"></i> Catégories
                    </h4>
                    @foreach(\App\Models\Article::CATEGORIES as $key => $label)
                    <a href="{{ route('vie-scolaire.index', ['categorie' => $key]) }}"
                       style="display:flex;justify-content:space-between;align-items:center;padding:10px 0;border-bottom:1px solid #eee;text-decoration:none;color:#333;font-size:14px;transition:color 0.2s;">
                        <span>{{ $label }}</span>
                        <i class="fas fa-caret-right" style="color:#C9A84C;font-size:12px;"></i>
                    </a>
                    @endforeach
                </div>

                {{-- CTA Admissions --}}
                <div class="wow fadeInRight" data-wow-delay=".45s"
                     style="background:linear-gradient(135deg,#1B2B6B,#12205A);border-radius:12px;padding:24px;text-align:center;">
                    <img src="{{ asset('assets/img/icon/scholarship.svg') }}" alt="" style="width:50px;margin-bottom:12px;filter:brightness(0) invert(1);">
                    <h5 style="color:#C9A84C;font-weight:800;margin-bottom:8px;">Inscriptions ouvertes</h5>
                    <p style="color:rgba(255,255,255,0.7);font-size:13px;margin-bottom:16px;">
                        Rejoignez la famille La Petite Thérèse dès aujourd'hui !
                    </p>
                    <a href="{{ route('admissions') }}" class="theme-btn" style="width:100%;text-align:center;">
                        S'inscrire <i class="fas fa-arrow-right"></i>
                    </a>
                </div>

            </div>

        </div>
    </div>
</div>

@endsection