<?php

namespace App\Http\Controllers;

use App\Models\Paiement;
use Barryvdh\DomPDF\Facade\Pdf;

class PaiementController extends Controller
{
    public function recu(Paiement $paiement)
    {
        $paiement->load([
            'eleve',
            'anneeScolaire',
            'anneePrecedente',
            'enregistrePar',
        ]);

        // Récupérer la classe actuelle de l'élève pour cette année
        $classe = null;
        if ($paiement->eleve && $paiement->annee_scolaire_id) {
            $inscription = $paiement->eleve->inscriptions()
                ->where('annee_scolaire_id', $paiement->annee_scolaire_id)
                ->where('statut', 'validee')
                ->with('classe')
                ->first();
            $classe = $inscription?->classe;
        }

        $pdf = Pdf::loadView('pdf.recu_paiement', [
            'paiement' => $paiement,
            'classe'   => $classe,
        ])->setPaper('a5', 'portrait');

        return $pdf->stream('recu-' . $paiement->numero_recu . '.pdf');
    }
}