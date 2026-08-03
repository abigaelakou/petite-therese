<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PreInscription extends Model
{
    protected $table = 'pre_inscriptions';

    protected $fillable = [
        'nom_eleve', 'nom_parent', 'telephone',
        'email', 'niveau_souhaite', 'annee_naissance',
        'message', 'statut', 'traite_par',
        'traite_le', 'observations', 'eleve_id',
    ];

    protected $casts = [
        'traite_le' => 'datetime',
    ];

    const STATUTS = [
        'en_attente'   => 'En attente',
        'validee'      => 'Validée',
        'refusee'      => 'Refusée',
        'liste_attente' => 'Liste d\'attente',
    ];

    const NIVEAUX = [
        'ps'  => 'Petite Section (PS)',
        'ms'  => 'Moyenne Section (MS)',
        'gs'  => 'Grande Section (GS)',
        'cp'  => 'CP',
        'ce1' => 'CE1',
        'ce2' => 'CE2',
        'cm1' => 'CM1',
        'cm2' => 'CM2',
    ];

    public function traitePar(): BelongsTo
    {
        return $this->belongsTo(User::class, 'traite_par');
    }

    public function eleve(): BelongsTo
    {
        return $this->belongsTo(Eleve::class);
    }

    // Convertir en vrai élève après validation
    public function convertirEnEleve(User $par): Eleve
    {
        $eleve = Eleve::create([
            'nom'          => $this->nom_eleve,
            'prenoms'      => '',
            'date_naissance' => now()->subYears(
                match($this->niveau_souhaite) {
                    'ps' => 3, 'ms' => 4, 'gs' => 5,
                    'cp' => 6, 'ce1' => 7, 'ce2' => 8,
                    'cm1' => 9, 'cm2' => 10, default => 6
                }
            ),
            'lieu_naissance'  => 'Abidjan',
            'sexe'            => 'M',
            'nom_parent'      => $this->nom_parent,
            'telephone_parent' => $this->telephone,
            'email_parent'    => $this->email,
        ]);

        $this->update([
            'statut'    => 'validee',
            'eleve_id'  => $eleve->id,
            'traite_par' => $par->id,
            'traite_le'  => now(),
        ]);

        return $eleve;
    }
}
