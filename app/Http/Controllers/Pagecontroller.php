<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\PreInscription;
use App\Models\GaleriePhoto;

class PageController extends Controller
{
    public function home()
    {
        // Galerie aperçu (6 premières photos visibles)
        $photos = GaleriePhoto::visibles()->limit(6)->get();

        return view('pages.home', compact('photos'));
    }

    public function about()
    {
        return view('pages.about');
    }

    public function niveaux()
    {
        return view('pages.niveaux');
    }

    public function enseignants()
    {
        // Chargé depuis la BDD
        $direction   = \App\Models\Equipe::direction()->get();
        $enseignants = \App\Models\Equipe::enseignants()->get();

        return view('pages.enseignants', compact('direction', 'enseignants'));
    }

    public function admissions()
    {
        return view('pages.admissions');
    }

    public function galerie()
    {
        $photos     = GaleriePhoto::visibles()->get();
        $categories = GaleriePhoto::CATEGORIES;

        return view('pages.galerie', compact('photos', 'categories'));
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function contactStore(Request $request)
    {
        if ($request->input('form_type') === 'inscription') {

            $validated = $request->validate([
                'nom_eleve'       => 'required|string|max:100',
                'nom_parent'      => 'required|string|max:100',
                'telephone'       => 'required|string|max:20',
                'email'           => 'nullable|email|max:100',
                'niveau'          => 'required|string|max:20',
                'annee_naissance' => 'nullable|string|max:10',
                'message'         => 'nullable|string|max:1000',
            ]);

            PreInscription::create([
                'nom_eleve'       => $validated['nom_eleve'],
                'nom_parent'      => $validated['nom_parent'],
                'telephone'       => $validated['telephone'],
                'email'           => $validated['email'] ?? null,
                'niveau_souhaite' => $validated['niveau'],
                'annee_naissance' => $validated['annee_naissance'] ?? null,
                'message'         => $validated['message'] ?? null,
                'statut'          => 'en_attente',
            ]);

            return redirect()->route('admissions')
                ->with('success', 'Votre demande d\'inscription a bien été envoyée. Nous vous recontacterons rapidement.');

        } else {

            $validated = $request->validate([
                'nom'       => 'required|string|max:100',
                'email'     => 'required|email|max:100',
                'telephone' => 'required|string|max:20',
                'sujet'     => 'required|string|max:150',
                'message'   => 'nullable|string|max:1000',
            ]);

            Contact::create([
                'nom'       => $validated['nom'],
                'email'     => $validated['email'],
                'telephone' => $validated['telephone'],
                'sujet'     => $validated['sujet'],
                'message'   => $validated['message'] ?? null,
                'statut'    => 'non_lu',
            ]);

            return redirect()->route('contact')
                ->with('success', 'Votre message a bien été envoyé. Nous vous répondrons dans les plus brefs délais.');
        }
    }
}