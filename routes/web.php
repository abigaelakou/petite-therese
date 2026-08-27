<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

// ── SITE VITRINE ─────────────────────────────────────────────
Route::get('/',            [PageController::class, 'home'])->name('home');
Route::get('/a-propos',    [PageController::class, 'about'])->name('about');
Route::get('/niveaux',     [PageController::class, 'niveaux'])->name('niveaux');
Route::get('/enseignants', [PageController::class, 'enseignants'])->name('enseignants');
Route::get('/admissions',  [PageController::class, 'admissions'])->name('admissions');
Route::get('/galerie',     [PageController::class, 'galerie'])->name('galerie');
Route::get('/contact',     [PageController::class, 'contact'])->name('contact');
Route::post('/contact',    [PageController::class, 'contactStore'])->name('contact.store');
Route::get('/vie-scolaire', [App\Http\Controllers\PageController::class, 'vieScolaireIndex'])
    ->name('vie-scolaire.index');

Route::get('/vie-scolaire/{slug}', [App\Http\Controllers\PageController::class, 'vieScolaireShow'])
    ->name('vie-scolaire.show');

// ── ROUTES PROTÉGÉES ─────────────────────────────────────────
Route::middleware('auth')->group(function () {

    // Reçu paiement PDF
    Route::get('/paiements/{paiement}/recu',
        [App\Http\Controllers\PaiementController::class, 'recu'])
        ->name('paiements.recu');

    // Rapports PDF
    Route::get('/rapports/paiements/pdf',
        [App\Http\Controllers\RapportController::class, 'paiementsPdf'])
        ->name('rapports.paiements.pdf');

    Route::get('/rapports/impayes/pdf',
        [App\Http\Controllers\RapportController::class, 'impayes_Pdf'])
        ->name('rapports.impayes.pdf');

    Route::get('/rapports/eleves/pdf',
        [App\Http\Controllers\RapportController::class, 'elevesPdf'])
        ->name('rapports.eleves.pdf');

    Route::get('/rapports/classes/pdf',
        [App\Http\Controllers\RapportController::class, 'classesPdf'])
        ->name('rapports.classes.pdf');

    // Archives téléchargement sécurisé (Super Admin uniquement)
    Route::get('/archives/{archive}/download', function (\App\Models\Archive $archive) {
        if (!auth()->user()->hasRole('super_admin')) {
            abort(403, 'Accès non autorisé.');
        }
        if (!$archive->chemin_fichier || !\Illuminate\Support\Facades\Storage::disk('local')->exists($archive->chemin_fichier)) {
            abort(404, 'Fichier introuvable.');
        }
        return \Illuminate\Support\Facades\Storage::disk('local')->download($archive->chemin_fichier);
    })->name('archives.download');

    // Circulaires PDF A4
    Route::get('/circulaires/{circulaire}/pdf', function (\App\Models\Circulaire $circulaire) {
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.circulaire', compact('circulaire'))
            ->setPaper('a4', 'portrait');
        return $pdf->stream('circulaire-' . str_pad($circulaire->id, 4, '0', STR_PAD_LEFT) . '.pdf');
    })->name('circulaires.pdf');

    // Circulaires PDF 3 notes par page (parents)
    Route::get('/circulaires/{circulaire}/parents-pdf', function (\App\Models\Circulaire $circulaire) {
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.circulaire-parents', compact('circulaire'))
            ->setPaper('a4', 'portrait');
        return $pdf->stream('note-parents-' . str_pad($circulaire->id, 4, '0', STR_PAD_LEFT) . '.pdf');
    })->name('circulaires.parents.pdf');

    // Circulaires WhatsApp
    Route::get('/circulaires/{circulaire}/whatsapp', function (\App\Models\Circulaire $circulaire) {
        $message = "📢 *GSCA La Petite Thérèse*\n\n"
            . "*" . $circulaire->titre . "*\n\n"
            . strip_tags($circulaire->contenu) . "\n\n"
            . "_La Direction_\n"
            . "_" . ($circulaire->date_publication?->format('d/m/Y') ?? now()->format('d/m/Y')) . "_";

        return redirect("https://wa.me/?text=" . urlencode($message));
    })->name('circulaires.whatsapp');

    // Certificat de scolarité PDF
    Route::get('/certificats/{certificat}/pdf',
        [App\Http\Controllers\CertificatController::class, 'generer'])
        ->name('certificats.pdf');

});