@extends('layouts.app')

@section('title', 'Vie Scolaire — Actualités')
@section('meta_description', 'Découvrez la vie scolaire du Groupe Scolaire Catholique La Petite Thérèse.')

@section('content')

{{-- BREADCRUMB --}}
<div class="site-breadcrumb" style="background: url({{ asset('assets/img/breadcrumb/01.jpg') }})">
    <div class="container">
        <h2 class="breadcrumb-title">Vie Scolaire</h2>
        <ul class="breadcrumb-menu">
            <li><a href="{{ route('home') }}">Accueil</a></li>
            <li class="active">Vie Scolaire</li>
        </ul>
    </div>
</div>

<div class="blog-area py-120">
    <div class="container">

        {{-- Intro --}}
        <div class="row mb-20">
            <div class="col-lg-8 mx-auto text-center wow fadeInUp" data-wow-delay=".25s">
                <div class="site-heading">
                    <span class="site-title-tagline">
                        <i class="far fa-newspaper"></i> Actualités
                    </span>
                    <h2 class="site-title">La vie à <span>La Petite Thérèse</span></h2>
                    <p>Retrouvez ici toutes les actualités, événements et moments forts
                       de la vie scolaire de notre établissement.</p>
                </div>
            </div>
        </div>

        {{-- Filtres --}}
        <div class="row mb-40">
            <div class="col-12 text-center wow fadeInUp" data-wow-delay=".35s">
                <div style="display:inline-flex;flex-wrap:wrap;gap:6px;justify-content:center;">
                    <a href="{{ route('vie-scolaire.index') }}"
                       style="padding:6px 16px;border-radius:20px;font-size:12px;font-weight:700;text-decoration:none;
                              {{ !request('categorie') ? 'background:#1B2B6B;color:white;' : 'background:#f0f0f0;color:#555;' }}">
                        Tous
                    </a>
                    @foreach(\App\Models\Article::CATEGORIES as $key => $label)
                    <a href="{{ route('vie-scolaire.index', ['categorie' => $key]) }}"
                       style="padding:6px 16px;border-radius:20px;font-size:12px;font-weight:700;text-decoration:none;
                              {{ request('categorie') === $key ? 'background:#C9A84C;color:#1B2B6B;' : 'background:#f0f0f0;color:#555;' }}">
                        {{ $label }}
                    </a>
                    @endforeach
                </div>
            </div>
        </div>

        @if($articles->count() > 0)

        {{-- Article vedette --}}
        @if(!request('categorie') && $articles->currentPage() === 1)
        @php $featured = $articles->first(); @endphp
        <div class="row mb-40 wow fadeInUp" data-wow-delay=".25s">
            <div class="col-12">
                <div style="border-radius:16px;overflow:hidden;box-shadow:0 8px 30px rgba(0,0,0,0.1);display:grid;grid-template-columns:45% 55%;height:280px;">

                    {{-- Image --}}
                    <div style="position:relative;overflow:hidden;">
                        @if($featured->photo_couverture)
                        <img src="{{ asset('storage/' . $featured->photo_couverture) }}"
                             alt="{{ $featured->titre }}"
                             style="width:100%;height:100%;object-fit:cover;transition:transform 0.5s;"
                             onmouseover="this.style.transform='scale(1.05)'"
                             onmouseout="this.style.transform='scale(1)'">
                        @else
                        <div style="width:100%;height:100%;background:linear-gradient(135deg,#1B2B6B,#2E9EC5);display:flex;align-items:center;justify-content:center;">
                            <i class="fas fa-newspaper" style="font-size:4rem;color:rgba(255,255,255,0.2);"></i>
                        </div>
                        @endif
                        <span style="position:absolute;top:16px;left:16px;background:#C9A84C;color:#1B2B6B;padding:5px 14px;border-radius:20px;font-size:11px;font-weight:800;">
                            ⭐ À la une
                        </span>
                    </div>

                    {{-- Contenu --}}
                    <div style="padding:32px;background:white;display:flex;flex-direction:column;justify-content:center;">
                        <div style="display:flex;gap:10px;font-size:11px;color:#aaa;margin-bottom:12px;flex-wrap:wrap;align-items:center;">
                            <span style="background:#EEF1FA;color:#1B2B6B;padding:3px 10px;border-radius:20px;font-weight:700;font-size:10px;">
                                {{ \App\Models\Article::CATEGORIES[$featured->categorie] ?? '' }}
                            </span>
                            <span><i class="fas fa-calendar" style="color:#C9A84C;"></i> {{ $featured->publie_le?->format('d/m/Y') }}</span>
                            <span><i class="fas fa-eye" style="color:#C9A84C;"></i> {{ $featured->vues }}</span>
                        </div>
                        <h3 style="color:#1B2B6B;font-weight:800;font-size:20px;margin-bottom:12px;line-height:1.35;">
                            {{ Str::limit($featured->titre, 80) }}
                        </h3>
                        @if($featured->extrait)
                        <p style="color:#777;line-height:1.7;margin-bottom:20px;font-size:13px;">
                            {{ Str::limit($featured->extrait, 130) }}
                        </p>
                        @endif
                        <a href="{{ route('vie-scolaire.show', $featured->slug) }}" class="theme-btn" style="align-self:flex-start;">
                            Lire l'article <i class="fas fa-arrow-right-long"></i>
                        </a>
                    </div>

                </div>
            </div>
        </div>
        @endif

        {{-- Grille articles --}}
        <div class="row g-4">
            @foreach($articles as $article)
            @if(!request('categorie') && $articles->currentPage() === 1 && $loop->first)
                @continue
            @endif
            <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="{{ ($loop->index % 3) * 0.1 }}s">
                <div style="border-radius:12px;overflow:hidden;box-shadow:0 2px 20px rgba(0,0,0,0.07);height:100%;display:flex;flex-direction:column;background:white;transition:transform 0.3s,box-shadow 0.3s;"
                     onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 8px 30px rgba(0,0,0,0.12)'"
                     onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 2px 20px rgba(0,0,0,0.07)'">

                    <div style="position:relative;overflow:hidden;height:195px;">
                        @if($article->photo_couverture)
                        <img src="{{ asset('storage/' . $article->photo_couverture) }}"
                             alt="{{ $article->titre }}"
                             style="width:100%;height:100%;object-fit:cover;transition:transform 0.4s;"
                             onmouseover="this.style.transform='scale(1.05)'"
                             onmouseout="this.style.transform='scale(1)'">
                        @else
                        <div style="width:100%;height:100%;background:linear-gradient(135deg,#1B2B6B,#2E9EC5);display:flex;align-items:center;justify-content:center;">
                            <i class="fas fa-newspaper" style="font-size:2.5rem;color:rgba(255,255,255,0.25);"></i>
                        </div>
                        @endif
                        <span style="position:absolute;top:10px;left:10px;background:#C9A84C;color:#1B2B6B;padding:3px 10px;border-radius:20px;font-size:10px;font-weight:700;">
                            {{ \App\Models\Article::CATEGORIES[$article->categorie] ?? $article->categorie }}
                        </span>
                    </div>

                    <div style="padding:18px;flex:1;display:flex;flex-direction:column;">
                        <div style="display:flex;gap:10px;font-size:11px;color:#bbb;margin-bottom:8px;">
                            <span><i class="fas fa-calendar-alt" style="color:#C9A84C;"></i> {{ $article->publie_le?->format('d/m/Y') }}</span>
                            <span><i class="fas fa-eye" style="color:#C9A84C;"></i> {{ $article->vues }}</span>
                        </div>
                        <h5 style="font-size:15px;font-weight:700;color:#1B2B6B;margin-bottom:8px;line-height:1.4;flex:1;">
                            <a href="{{ route('vie-scolaire.show', $article->slug) }}"
                               style="color:inherit;text-decoration:none;">
                                {{ Str::limit($article->titre, 65) }}
                            </a>
                        </h5>
                        @if($article->extrait)
                        <p style="font-size:12px;color:#999;line-height:1.6;margin-bottom:12px;">
                            {{ Str::limit($article->extrait, 80) }}
                        </p>
                        @endif
                        <div style="padding-top:10px;border-top:1px solid #f5f5f5;margin-top:auto;">
                            <a href="{{ route('vie-scolaire.show', $article->slug) }}"
                               style="display:inline-flex;align-items:center;gap:5px;color:#C9A84C;font-weight:700;font-size:13px;text-decoration:none;">
                                Lire la suite <i class="fas fa-arrow-right" style="font-size:10px;"></i>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
            @endforeach
        </div>

        @if($articles->hasPages())
        <div class="row mt-40">
            <div class="col-12 d-flex justify-content-center">
                {{ $articles->links() }}
            </div>
        </div>
        @endif

        @else
        <div class="text-center py-80 wow fadeInUp">
            <i class="fas fa-newspaper" style="font-size:4rem;color:#ddd;margin-bottom:20px;display:block;"></i>
            <h5 style="color:#1B2B6B;margin-bottom:10px;">Aucun article pour l'instant</h5>
            <p style="color:#888;">Les actualités seront publiées ici très prochainement.</p>
            <a href="{{ route('home') }}" class="theme-btn mt-3">Retour à l'accueil</a>
        </div>
        @endif

    </div>
</div>

@endsection