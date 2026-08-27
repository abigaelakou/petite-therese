<?php

namespace App\Filament\Widgets;

use App\Models\AnneeScolaire;
use App\Models\Eleve;
use App\Models\Inscription;
use App\Models\Paiement;
use App\Models\PreInscription;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 2;

    private function formatMontant(float $montant): string
    {
        if ($montant >= 1_000_000_000)
            return number_format($montant / 1_000_000_000, 1, ',', ' ') . 'Md FCFA';
        if ($montant >= 1_000_000)
            return number_format($montant / 1_000_000, 1, ',', ' ') . 'M FCFA';
        if ($montant >= 100_000)
            return number_format($montant / 1_000, 0, ',', ' ') . 'K FCFA';
        return number_format($montant, 0, ',', ' ') . ' FCFA';
    }

    protected function getStats(): array
    {
        $user = auth()->user();
        $role = $user->getRoleNames()->first();
        $annee = AnneeScolaire::where('est_active', true)->first();

        // ── SUPER ADMIN & DIRECTEUR ──────────────────────────────
        if (in_array($role, ['super_admin', 'directeur'])) {
            $totalEleves = Eleve::where('est_actif', true)->where('est_archive', false)->count();
            $elevesInscrits = $annee
                ? Inscription::where('annee_scolaire_id', $annee->id)->where('statut', 'validee')->count()
                : 0;
            $preInscriptions = PreInscription::where('statut', 'en_attente')->count();
            $totalImpayes = $annee
                ? (float) Paiement::where('annee_scolaire_id', $annee->id)->where('categorie', 'scolarite')->where('reste_a_payer', '>', 0)->sum('reste_a_payer')
                : 0;
            $nbImpayes = $annee
                ? Paiement::where('annee_scolaire_id', $annee->id)->where('categorie', 'scolarite')->where('reste_a_payer', '>', 0)->count()
                : 0;
            $scolariteMois = (float) Paiement::whereMonth('date_paiement', now()->month)->whereYear('date_paiement', now()->year)->where('categorie', 'scolarite')->sum('montant_paye');
            $scolariteAnnee = $annee ? (float) Paiement::where('annee_scolaire_id', $annee->id)->where('categorie', 'scolarite')->sum('montant_paye') : 0;

            return [
                Stat::make('Élèves actifs', $totalEleves)
                    ->description($elevesInscrits . ' inscrits — ' . ($annee?->libelle ?? '—'))
                    ->descriptionIcon('heroicon-m-academic-cap')
                    ->color('primary')->icon('heroicon-o-users'),

                Stat::make('Scolarité ce mois', $this->formatMontant($scolariteMois))
                    ->description('Année : ' . $this->formatMontant($scolariteAnnee))
                    ->descriptionIcon('heroicon-m-arrow-trending-up')
                    ->color('success')->icon('heroicon-o-banknotes'),

                Stat::make('Impayés scolarité', $this->formatMontant($totalImpayes))
                    ->description($nbImpayes . ' élève(s) avec solde dû')
                    ->descriptionIcon('heroicon-m-exclamation-triangle')
                    ->color($totalImpayes > 0 ? 'danger' : 'success')
                    ->icon('heroicon-o-exclamation-circle'),

                Stat::make('Pré-inscriptions', $preInscriptions)
                    ->description('En attente de validation')
                    ->descriptionIcon('heroicon-m-clock')
                    ->color($preInscriptions > 0 ? 'warning' : 'success')
                    ->icon('heroicon-o-clipboard-document-list'),
            ];
        }

        // ── COMPTABLE ────────────────────────────────────────────
        if ($role === 'comptable') {
            $scolariteMois = (float) Paiement::whereMonth('date_paiement', now()->month)->whereYear('date_paiement', now()->year)->where('categorie', 'scolarite')->sum('montant_paye');
            $diversMois = (float) Paiement::whereMonth('date_paiement', now()->month)->whereYear('date_paiement', now()->year)->where('categorie', 'divers')->sum('montant_paye');
            $scolariteAnnee = $annee ? (float) Paiement::where('annee_scolaire_id', $annee->id)->where('categorie', 'scolarite')->sum('montant_paye') : 0;
            $diversAnnee = $annee ? (float) Paiement::where('annee_scolaire_id', $annee->id)->where('categorie', 'divers')->sum('montant_paye') : 0;
            $totalImpayes = $annee ? (float) Paiement::where('annee_scolaire_id', $annee->id)->where('categorie', 'scolarite')->where('reste_a_payer', '>', 0)->sum('reste_a_payer') : 0;
            $nbImpayes = $annee ? Paiement::where('annee_scolaire_id', $annee->id)->where('categorie', 'scolarite')->where('reste_a_payer', '>', 0)->count() : 0;

            return [
                Stat::make('Scolarité ce mois', $this->formatMontant($scolariteMois))
                    ->description('Année : ' . $this->formatMontant($scolariteAnnee))
                    ->descriptionIcon('heroicon-m-arrow-trending-up')
                    ->color('success')->icon('heroicon-o-banknotes'),

                Stat::make('Divers ce mois', $this->formatMontant($diversMois))
                    ->description('Année : ' . $this->formatMontant($diversAnnee))
                    ->descriptionIcon('heroicon-m-shopping-bag')
                    ->color('info')->icon('heroicon-o-receipt-percent'),

                Stat::make('Impayés scolarité', $this->formatMontant($totalImpayes))
                    ->description($nbImpayes . ' élève(s) avec solde dû')
                    ->descriptionIcon('heroicon-m-exclamation-triangle')
                    ->color($totalImpayes > 0 ? 'danger' : 'success')
                    ->icon('heroicon-o-exclamation-circle'),

                Stat::make('Total encaissé', $this->formatMontant($scolariteAnnee + $diversAnnee))
                    ->description('Scolarité + Divers — ' . ($annee?->libelle ?? '—'))
                    ->descriptionIcon('heroicon-m-banknotes')
                    ->color('primary')->icon('heroicon-o-currency-dollar'),
            ];
        }

        // ── ENSEIGNANT ───────────────────────────────────────────
        if ($role === 'enseignant') {
            $mesClasses = \App\Models\Classe::where('enseignant_id', $user->id)
                ->where('annee_scolaire_id', $annee?->id)->count();
            $mesEleves = $annee
                ? Inscription::whereHas('classe', fn($q) => $q->where('enseignant_id', $user->id))
                    ->where('annee_scolaire_id', $annee->id)->where('statut', 'validee')->count()
                : 0;
            $absencesAujourdhui = \App\Models\Absence::whereDate('date', today())
                ->whereHas('classe', fn($q) => $q->where('enseignant_id', $user->id))->count();

            return [
                Stat::make('Mes classes', $mesClasses)
                    ->description($annee?->libelle ?? '—')
                    ->descriptionIcon('heroicon-m-academic-cap')
                    ->color('primary')->icon('heroicon-o-rectangle-stack'),

                Stat::make('Mes élèves', $mesEleves)
                    ->description('Élèves inscrits dans mes classes')
                    ->descriptionIcon('heroicon-m-users')
                    ->color('success')->icon('heroicon-o-users'),

                Stat::make('Absences aujourd\'hui', $absencesAujourdhui)
                    ->description('Dans mes classes')
                    ->descriptionIcon('heroicon-m-exclamation-circle')
                    ->color($absencesAujourdhui > 0 ? 'warning' : 'success')
                    ->icon('heroicon-o-clock'),
            ];
        }

        // ── PARENT ───────────────────────────────────────────────
        if ($role === 'parent') {
            $eleve = \App\Models\Eleve::where('user_id', $user->id)->first();
            $solde = $eleve && $annee
                ? Paiement::soldeEleve($eleve->id, $annee->id)
                : 0;
            $nbAbsences = $eleve
                ? \App\Models\Absence::where('eleve_id', $eleve->id)
                    ->whereYear('date', now()->year)->count()
                : 0;

            return [
                Stat::make('Mon enfant', $eleve?->nom_complet ?? '—')
                    ->description('Matricule : ' . ($eleve?->matricule ?? '—'))
                    ->descriptionIcon('heroicon-m-academic-cap')
                    ->color('primary')->icon('heroicon-o-user'),

                Stat::make('Solde à payer', $this->formatMontant($solde))
                    ->description($annee?->libelle ?? '—')
                    ->descriptionIcon('heroicon-m-banknotes')
                    ->color($solde > 0 ? 'danger' : 'success')
                    ->icon('heroicon-o-banknotes'),

                Stat::make('Absences', $nbAbsences)
                    ->description('Cette année scolaire')
                    ->descriptionIcon('heroicon-m-clock')
                    ->color($nbAbsences > 3 ? 'warning' : 'success')
                    ->icon('heroicon-o-clock'),
            ];
        }


        // ── SECRÉTAIRE ───────────────────────────────────────────
        if ($role === 'secretaire') {
            $totalEleves = Eleve::where('est_actif', true)->where('est_archive', false)->count();
            $elevesInscrits = $anneeActive
                ? Inscription::where('annee_scolaire_id', $anneeActive->id)->where('statut', 'validee')->count()
                : 0;
            $preInscriptions = PreInscription::where('statut', 'en_attente')->count();
            $contacts = \App\Models\Contact::where('statut', 'non_lu')->count();

            return [
                Stat::make('Élèves actifs', $totalEleves)
                    ->description($elevesInscrits . ' inscrits cette année')
                    ->descriptionIcon('heroicon-m-academic-cap')
                    ->color('primary')->icon('heroicon-o-users'),

                Stat::make('Pré-inscriptions', $preInscriptions)
                    ->description('En attente de validation')
                    ->descriptionIcon('heroicon-m-clock')
                    ->color($preInscriptions > 0 ? 'warning' : 'success')
                    ->icon('heroicon-o-clipboard-document-list'),

                Stat::make('Messages non lus', $contacts)
                    ->description('Messages du site à traiter')
                    ->descriptionIcon('heroicon-m-envelope')
                    ->color($contacts > 0 ? 'danger' : 'success')
                    ->icon('heroicon-o-envelope'),
            ];
        }

        return [];
    }
}