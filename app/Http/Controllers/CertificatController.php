<?php

namespace App\Http\Controllers;

use App\Models\Certificat;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;

class CertificatController extends Controller
{
    public function generer(Certificat $certificat)
    {
        // Vérifier les droits
        if (!auth()->user()->hasAnyRole(['super_admin', 'directeur', 'secretaire'])) {
            abort(403, 'Accès non autorisé.');
        }

        // Vérifier que le certificat est valide
        if ($certificat->statut === 'annule') {
            abort(403, 'Ce certificat a été annulé.');
        }

        $certificat->load(['eleve', 'anneeScolaire', 'classe', 'delivrePar']);
        $eleve  = $certificat->eleve;
        $annee  = $certificat->anneeScolaire;
        $classe = $certificat->classe;

        // Directeur de l'école
        $directeur = User::role('directeur')->first();

        $pdf = Pdf::loadView('pdf.certificat_scolarite', compact(
            'certificat', 'eleve', 'annee', 'classe', 'directeur'
        ))->setPaper('a4', 'portrait');

        $filename = 'certificat-' . $certificat->numero_certificat . '.pdf';

        return $pdf->stream($filename);
    }
}