<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

Route::get('/',             [PageController::class, 'home'])->name('home');
Route::get('/a-propos',     [PageController::class, 'about'])->name('about');
Route::get('/niveaux',      [PageController::class, 'niveaux'])->name('niveaux');
Route::get('/enseignants',  [PageController::class, 'enseignants'])->name('enseignants');
Route::get('/admissions',   [PageController::class, 'admissions'])->name('admissions');
Route::get('/galerie',      [PageController::class, 'galerie'])->name('galerie');
Route::get('/contact',      [PageController::class, 'contact'])->name('contact');

// POST unique pour les deux formulaires (inscription + contact)
Route::post('/contact',     [PageController::class, 'contactStore'])->name('contact.store');
Route::get('/paiements/{paiement}/recu', [App\Http\Controllers\PaiementController::class, 'recu'])
    ->name('paiements.recu')
    ->middleware('auth');


    
    Route::middleware('auth')->group(function () {
    // Reçu paiement
    Route::get('/paiements/{paiement}/recu', [App\Http\Controllers\PaiementController::class, 'recu'])
        ->name('paiements.recu');
 
    // Rapports PDF
    Route::get('/rapports/paiements/pdf', [App\Http\Controllers\RapportController::class, 'paiementsPdf'])
        ->name('rapports.paiements.pdf');
    Route::get('/rapports/impayes/pdf', [App\Http\Controllers\RapportController::class, 'impayes_Pdf'])
        ->name('rapports.impayes.pdf');
    Route::get('/rapports/eleves/pdf', [App\Http\Controllers\RapportController::class, 'elevesPdf'])
        ->name('rapports.eleves.pdf');
    Route::get('/rapports/classes/pdf', [App\Http\Controllers\RapportController::class, 'classesPdf'])
        ->name('rapports.classes.pdf');
});


Route::middleware('auth')->get('/archives/{archive}/download', function(\App\Models\Archive $archive) {
    // Vérifier que seul le super_admin peut télécharger
if (!auth()->user()->hasRole('super_admin')) {
        abort(403, 'Accès non autorisé.');
    }
    if (!$archive->chemin_fichier || !\Illuminate\Support\Facades\Storage::disk('local')->exists($archive->chemin_fichier)) {
        abort(404, 'Fichier introuvable.');
    }
    return \Illuminate\Support\Facades\Storage::disk('local')->download($archive->chemin_fichier);
})->name('archives.download');
 