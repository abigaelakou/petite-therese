<?php

namespace App\Http\Controllers;

use App\Models\AnneeScolaire;
use App\Models\Classe;
use App\Models\Eleve;
use App\Models\Inscription;
use App\Models\Paiement;
use Barryvdh\DomPDF\Facade\Pdf;

class RapportController extends Controller
{
    // ── RAPPORT PAIEMENTS PDF ────────────────────────────────
    public function paiementsPdf()
    {
        $anneeId  = request('annee_id');
        $mois     = request('mois');
        $categorie = request('categorie');

        $paiements = Paiement::with(['eleve', 'anneeScolaire'])
            ->when($anneeId, fn($q) => $q->where('annee_scolaire_id', $anneeId))
            ->when($mois, fn($q) => $q->whereMonth('date_paiement', $mois)->whereYear('date_paiement', now()->year))
            ->when($categorie, fn($q) => $q->where('categorie', $categorie))
            ->orderBy('date_paiement', 'desc')
            ->get();

        $annee = $anneeId ? AnneeScolaire::find($anneeId) : null;
        $totalPaye = $paiements->sum('montant_paye');
        $totalReste = $paiements->sum('reste_a_payer');

        $pdf = Pdf::loadView('pdf.rapport_paiements', compact('paiements', 'annee', 'totalPaye', 'totalReste', 'mois', 'categorie'))
            ->setPaper('a4', 'landscape');

        return $pdf->stream('rapport-paiements-' . now()->format('Y-m-d') . '.pdf');
    }

    // ── RAPPORT IMPAYÉS PDF ──────────────────────────────────
    public function impayes_Pdf()
    {
        $anneeId = request('annee_id');

        $impayes = Paiement::with(['eleve', 'anneeScolaire'])
            ->where('reste_a_payer', '>', 0)
            ->where('categorie', 'scolarite')
            ->when($anneeId, fn($q) => $q->where('annee_scolaire_id', $anneeId))
            ->orderBy('reste_a_payer', 'desc')
            ->get();

        $annee = $anneeId ? AnneeScolaire::find($anneeId) : null;
        $totalImpayes = $impayes->sum('reste_a_payer');

        $pdf = Pdf::loadView('pdf.rapport_impayes', compact('impayes', 'annee', 'totalImpayes'))
            ->setPaper('a4', 'portrait');

        return $pdf->stream('rapport-impayes-' . now()->format('Y-m-d') . '.pdf');
    }

    // ── RAPPORT ÉLÈVES PDF ───────────────────────────────────
    public function elevesPdf()
    {
        $anneeId  = request('annee_id');
        $classeId = request('classe_id');

        $eleves = Eleve::with(['inscriptions.classe', 'inscriptions.anneeScolaire'])
            ->where('est_actif', true)
            ->where('est_archive', false)
            ->when($anneeId, fn($q) => $q->whereHas('inscriptions',
                fn($i) => $i->where('annee_scolaire_id', $anneeId)->where('statut', 'validee')
            ))
            ->when($classeId, fn($q) => $q->whereHas('inscriptions',
                fn($i) => $i->where('classe_id', $classeId)->where('statut', 'validee')
            ))
            ->orderBy('nom')
            ->get();

        $annee  = $anneeId  ? AnneeScolaire::find($anneeId)  : null;
        $classe = $classeId ? Classe::find($classeId) : null;

        $pdf = Pdf::loadView('pdf.rapport_eleves', compact('eleves', 'annee', 'classe', 'anneeId'))
            ->setPaper('a4', 'portrait');

        return $pdf->stream('rapport-eleves-' . now()->format('Y-m-d') . '.pdf');
    }

    // ── RAPPORT CLASSES PDF ──────────────────────────────────
    public function classesPdf()
    {
        $anneeId = request('annee_id');

        $classes = \App\Models\Classe::with([
            'inscriptions' => fn($q) => $q->where('statut', 'validee')
                ->when($anneeId, fn($i) => $i->where('annee_scolaire_id', $anneeId)),
            'inscriptions.eleve',
        ])
        ->when($anneeId, fn($q) => $q->where('annee_scolaire_id', $anneeId))
        ->orderBy('nom')
        ->get()
        ->each(function($classe) {
            $classe->eleves = $classe->inscriptions->map->eleve->filter();
        });

        $annee = $anneeId ? \App\Models\AnneeScolaire::find($anneeId) : null;

        $pdf = Pdf::loadView('pdf.rapport_classes', compact('classes', 'annee'))
            ->setPaper('a4', 'portrait');

        return $pdf->stream('rapport-classes-' . now()->format('Y-m-d') . '.pdf');
    }
}