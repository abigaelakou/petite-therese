@extends('layouts.app')

@section('title', 'Galerie & Événements')
@section('meta_description', 'Photos et événements du Groupe Scolaire Catholique La Petite Thérèse.')

@section('content')

    {{-- BREADCRUMB --}}
    <div class="site-breadcrumb" style="background: url({{ asset('assets/img/breadcrumb/01.jpg') }})">
        <div class="container">
            <h2 class="breadcrumb-title">Galerie & Événements</h2>
            <ul class="breadcrumb-menu">
                <li><a href="{{ route('home') }}">Accueil</a></li>
                <li class="active">Galerie</li>
            </ul>
        </div>
    </div>

    {{-- GALERIE --}}
    <div class="gallery-area py-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <div class="site-heading text-center">
                        <span class="site-title-tagline"><i class="fas fa-book-open-reader"></i> Galerie</span>
                        <h2 class="site-title">Notre <span>galerie photos</span></h2>
                        <p>Fêtes scolaires, sport, remises de prix, sorties pédagogiques — la vie de l'école en images.</p>
                    </div>
                </div>
            </div>

            @if($photos->count() > 0)

            {{-- Filtres par catégorie --}}
            <div class="text-center mb-4">
                <div class="btn-group flex-wrap gap-2" role="group">
                    <button type="button" class="theme-btn filter-btn active" data-filter="all" style="font-size:13px;padding:8px 16px">
                        Tout voir
                    </button>
                    @foreach($categories as $key => $label)
                        @if($photos->where('categorie', $key)->count() > 0)
                        <button type="button" class="theme-btn filter-btn" data-filter="{{ $key }}"
                            style="font-size:13px;padding:8px 16px;background:transparent;border:2px solid var(--theme-color);color:var(--theme-color)">
                            {{ $label }}
                        </button>
                        @endif
                    @endforeach
                </div>
            </div>

            <div class="row popup-gallery" id="galerie-grid">
                @foreach($photos as $photo)
                <div class="col-md-4 col-sm-6 gallery-col" data-categorie="{{ $photo->categorie }}">
                    <div class="gallery-item wow fadeInUp">
                        <div class="gallery-img">
                            <img src="{{ $photo->photo_url }}" alt="{{ $photo->titre ?? $photo->categorie_label }}">
                        </div>
                        <div class="gallery-content">
                            <a class="popup-img gallery-link" href="{{ $photo->photo_url }}">
                                <i class="fas fa-plus"></i>
                            </a>
                        </div>
                        @if($photo->titre)
                        <div class="gallery-caption" style="padding:8px 12px;font-size:13px;color:#555">
                            {{ $photo->titre }}
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>

            @else
            {{-- Fallback galerie statique --}}
            <div class="row popup-gallery">
                <div class="col-md-4">
                    <div class="gallery-item"><div class="gallery-img"><img src="{{ asset('assets/img/gallery/01.jpg') }}" alt=""></div><div class="gallery-content"><a class="popup-img gallery-link" href="{{ asset('assets/img/gallery/01.jpg') }}"><i class="fas fa-plus"></i></a></div></div>
                    <div class="gallery-item"><div class="gallery-img"><img src="{{ asset('assets/img/gallery/02.jpg') }}" alt=""></div><div class="gallery-content"><a class="popup-img gallery-link" href="{{ asset('assets/img/gallery/02.jpg') }}"><i class="fas fa-plus"></i></a></div></div>
                </div>
                <div class="col-md-4">
                    <div class="gallery-item"><div class="gallery-img"><img src="{{ asset('assets/img/gallery/03.jpg') }}" alt=""></div><div class="gallery-content"><a class="popup-img gallery-link" href="{{ asset('assets/img/gallery/03.jpg') }}"><i class="fas fa-plus"></i></a></div></div>
                    <div class="gallery-item"><div class="gallery-img"><img src="{{ asset('assets/img/gallery/04.jpg') }}" alt=""></div><div class="gallery-content"><a class="popup-img gallery-link" href="{{ asset('assets/img/gallery/04.jpg') }}"><i class="fas fa-plus"></i></a></div></div>
                </div>
                <div class="col-md-4">
                    <div class="gallery-item"><div class="gallery-img"><img src="{{ asset('assets/img/gallery/05.jpg') }}" alt=""></div><div class="gallery-content"><a class="popup-img gallery-link" href="{{ asset('assets/img/gallery/05.jpg') }}"><i class="fas fa-plus"></i></a></div></div>
                    <div class="gallery-item"><div class="gallery-img"><img src="{{ asset('assets/img/gallery/06.jpg') }}" alt=""></div><div class="gallery-content"><a class="popup-img gallery-link" href="{{ asset('assets/img/gallery/06.jpg') }}"><i class="fas fa-plus"></i></a></div></div>
                </div>
            </div>
            @endif
        </div>
    </div>

@endsection

@push('scripts')
<script>
// Filtres galerie
document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.filter-btn').forEach(b => {
            b.style.background = 'transparent';
            b.style.color = 'var(--theme-color)';
            b.classList.remove('active');
        });
        this.style.background = 'var(--theme-color)';
        this.style.color = '#fff';
        this.classList.add('active');

        const filter = this.dataset.filter;
        document.querySelectorAll('.gallery-col').forEach(col => {
            if (filter === 'all' || col.dataset.categorie === filter) {
                col.style.display = '';
            } else {
                col.style.display = 'none';
            }
        });
    });
});
</script>
@endpush