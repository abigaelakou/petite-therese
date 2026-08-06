<x-filament-panels::page>

    {{-- HEADER ──────────────────────────────────────────────── --}}
    <div style="background:linear-gradient(135deg,#1B2B6B,#12205A);border-radius:16px;padding:1.5rem 2rem;margin-bottom:1.5rem;box-shadow:0 4px 20px rgba(27,43,107,0.2);">
        <div style="color:#C9A84C;font-size:0.8rem;font-weight:700;text-transform:uppercase;letter-spacing:0.1em;margin-bottom:4px;">Module</div>
        <div style="color:#fff;font-size:1.4rem;font-weight:800;">Rapports & Exports</div>
        <div style="color:rgba(255,255,255,0.6);font-size:0.9rem;margin-top:4px;">Générez vos rapports PDF (nouvel onglet) ou exportez en Excel</div>
    </div>

    {{-- FILTRES ──────────────────────────────────────────────── --}}
    <x-filament::section>
        <x-slot name="heading">Filtres</x-slot>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:1rem;">

            <div>
                <label style="font-size:0.8rem;font-weight:600;color:#1B2B6B;display:block;margin-bottom:6px;">Année scolaire</label>
                <select wire:model.live="annee_id" style="width:100%;padding:8px 12px;border:2px solid #e5e7eb;border-radius:8px;font-size:0.875rem;outline:none;">
                    <option value="">Toutes les années</option>
                    @foreach($this->getAnnees() as $id => $libelle)
                        <option value="{{ $id }}" {{ $annee_id == $id ? 'selected' : '' }}>{{ $libelle }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label style="font-size:0.8rem;font-weight:600;color:#1B2B6B;display:block;margin-bottom:6px;">Classe (pour rapport élèves/classes)</label>
                <select wire:model.live="classe_id" style="width:100%;padding:8px 12px;border:2px solid #e5e7eb;border-radius:8px;font-size:0.875rem;outline:none;">
                    <option value="">Toutes les classes</option>
                    @foreach($this->getClasses() as $id => $nom)
                        <option value="{{ $id }}" {{ $classe_id == $id ? 'selected' : '' }}>{{ $nom }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label style="font-size:0.8rem;font-weight:600;color:#1B2B6B;display:block;margin-bottom:6px;">Mois (pour rapport paiements)</label>
                <select wire:model.live="mois" style="width:100%;padding:8px 12px;border:2px solid #e5e7eb;border-radius:8px;font-size:0.875rem;outline:none;">
                    <option value="">Toute l'année</option>
                    @foreach($this->getMois() as $num => $label)
                        <option value="{{ $num }}" {{ $mois == $num ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label style="font-size:0.8rem;font-weight:600;color:#1B2B6B;display:block;margin-bottom:6px;">Catégorie paiement</label>
                <select wire:model.live="categorie" style="width:100%;padding:8px 12px;border:2px solid #e5e7eb;border-radius:8px;font-size:0.875rem;outline:none;">
                    <option value="">Toutes</option>
                    <option value="scolarite" {{ $categorie === 'scolarite' ? 'selected' : '' }}>Scolarité</option>
                    <option value="divers" {{ $categorie === 'divers' ? 'selected' : '' }}>Divers</option>
                </select>
            </div>

        </div>
    </x-filament::section>

    {{-- RAPPORTS ─────────────────────────────────────────────── --}}
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(300px,1fr));gap:1.5rem;margin-top:1.5rem;">

        {{-- Paiements --}}
        <x-filament::section>
            <x-slot name="heading"><span style="color:#1B2B6B;font-weight:800;">💰 Paiements</span></x-slot>
            <p style="color:#6b7280;font-size:0.85rem;margin-bottom:1rem;">
                Liste complète des paiements selon les filtres appliqués. Scolarité et/ou divers.
            </p>
            <div style="display:flex;gap:0.75rem;flex-wrap:wrap;">
                <a href="{{ route('rapports.paiements.pdf', ['annee_id' => $annee_id, 'mois' => $mois, 'categorie' => $categorie]) }}"
                   target="_blank"
                   style="background:#dc2626;color:white;padding:8px 16px;border-radius:8px;font-size:0.8rem;font-weight:700;text-decoration:none;display:flex;align-items:center;gap:6px;">
                    📄 PDF
                </a>
                <button wire:click="exportPaiementsExcel"
                   style="background:#16a34a;color:white;padding:8px 16px;border-radius:8px;font-size:0.8rem;font-weight:700;border:none;cursor:pointer;display:flex;align-items:center;gap:6px;">
                    📊 Excel
                </button>
            </div>
        </x-filament::section>

        {{-- Impayés --}}
        <x-filament::section>
            <x-slot name="heading"><span style="color:#dc2626;font-weight:800;">⚠️ Impayés</span></x-slot>
            <p style="color:#6b7280;font-size:0.85rem;margin-bottom:1rem;">
                Tous les élèves avec solde de scolarité impayé. Inclut les téléphones pour relance.
            </p>
            <div style="display:flex;gap:0.75rem;flex-wrap:wrap;">
                <a href="{{ route('rapports.impayes.pdf', ['annee_id' => $annee_id]) }}"
                   target="_blank"
                   style="background:#dc2626;color:white;padding:8px 16px;border-radius:8px;font-size:0.8rem;font-weight:700;text-decoration:none;display:flex;align-items:center;gap:6px;">
                    📄 PDF
                </a>
                <button wire:click="exportImpayesExcel"
                   style="background:#16a34a;color:white;padding:8px 16px;border-radius:8px;font-size:0.8rem;font-weight:700;border:none;cursor:pointer;display:flex;align-items:center;gap:6px;">
                    📊 Excel
                </button>
            </div>
        </x-filament::section>

        {{-- Élèves --}}
        <x-filament::section>
            <x-slot name="heading"><span style="color:#1B2B6B;font-weight:800;">👨‍🎓 Liste des Élèves</span></x-slot>
            <p style="color:#6b7280;font-size:0.85rem;margin-bottom:1rem;">
                Liste des élèves avec classe, infos personnelles et contacts parents.
            </p>
            <div style="display:flex;gap:0.75rem;flex-wrap:wrap;">
                <a href="{{ route('rapports.eleves.pdf', ['annee_id' => $annee_id, 'classe_id' => $classe_id]) }}"
                   target="_blank"
                   style="background:#dc2626;color:white;padding:8px 16px;border-radius:8px;font-size:0.8rem;font-weight:700;text-decoration:none;display:flex;align-items:center;gap:6px;">
                    📄 PDF
                </a>
                <button wire:click="exportElevesExcel"
                   style="background:#16a34a;color:white;padding:8px 16px;border-radius:8px;font-size:0.8rem;font-weight:700;border:none;cursor:pointer;display:flex;align-items:center;gap:6px;">
                    📊 Excel
                </button>
            </div>
        </x-filament::section>

        {{-- Classes --}}
        <x-filament::section>
            <x-slot name="heading"><span style="color:#1B2B6B;font-weight:800;">🏫 Classes & Élèves</span></x-slot>
            <p style="color:#6b7280;font-size:0.85rem;margin-bottom:1rem;">
                Liste de toutes les classes avec leurs élèves inscrits. Filtrable par année et par classe.
            </p>
            <div style="display:flex;gap:0.75rem;flex-wrap:wrap;">
                <a href="{{ route('rapports.classes.pdf', ['annee_id' => $annee_id, 'classe_id' => $classe_id]) }}"
                   target="_blank"
                   style="background:#dc2626;color:white;padding:8px 16px;border-radius:8px;font-size:0.8rem;font-weight:700;text-decoration:none;display:flex;align-items:center;gap:6px;">
                    📄 PDF
                </a>
            </div>
        </x-filament::section>

    </div>

</x-filament-panels::page>