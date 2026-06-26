<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('pages.home');
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
        return view('pages.enseignants');
    }

    public function admissions()
    {
        return view('pages.admissions');
    }

    public function galerie()
    {
        return view('pages.galerie');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    /**
     * Traite les deux formulaires :
     * - formulaire d'inscription (admissions.blade.php)
     * - formulaire de contact (contact.blade.php)
     * On les distingue via le champ 'form_type'
     */
    public function contactStore(Request $request)
    {
        if ($request->input('form_type') === 'inscription') {

            // Validation formulaire inscription
            $validated = $request->validate([
                'nom_eleve'      => 'required|string|max:100',
                'nom_parent'     => 'required|string|max:100',
                'telephone'      => 'required|string|max:20',
                'email'          => 'nullable|email|max:100',
                'niveau'         => 'required|string|max:20',
                'annee_naissance'=> 'nullable|string|max:10',
                'message'        => 'nullable|string|max:1000',
            ]);

            // TODO: Mail::to('contact@lapetitetherese.ci')->send(new InscriptionMail($validated));

            return redirect()->route('admissions')
                ->with('success', 'Votre demande d\'inscription a bien été envoyée. Nous vous recontacterons rapidement.');

        } else {

            // Validation formulaire contact
            $validated = $request->validate([
                'nom'       => 'required|string|max:100',
                'email'     => 'required|email|max:100',
                'telephone' => 'required|string|max:20',
                'sujet'     => 'required|string|max:150',
                'message'   => 'nullable|string|max:1000',
            ]);

            // TODO: Mail::to('contact@lapetitetherese.ci')->send(new ContactMail($validated));

            return redirect()->route('contact')
                ->with('success', 'Votre message a bien été envoyé. Nous vous répondrons dans les plus brefs délais.');
        }
    }
}