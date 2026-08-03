<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Equipe;

class EquipeSeeder extends Seeder
{
    public function run(): void
    {
        $membres = [
            // ── DIRECTION ──────────────────────────────────────────
            [
                'nom'        => 'Père Luc SENOU',
                'prenoms'    => '',
                'poste'      => 'Directeur Général',
                'categorie'  => 'direction',
                'ordre'      => 1,
                'est_visible' => true,
                'est_actif'  => true,
            ],
            [
                'nom'        => 'M. Jerome KRAGBE',
                'prenoms'    => '',
                'poste'      => 'Directeur des Études',
                'categorie'  => 'direction',
                'ordre'      => 2,
                'est_visible' => true,
                'est_actif'  => true,
            ],

            // ── ENSEIGNANTS ────────────────────────────────────────
            [
                'nom'        => 'Mme BAMBA',
                'prenoms'    => '',
                'poste'      => 'Enseignante',
                'categorie'  => 'enseignant',
                'ordre'      => 3,
                'est_visible' => true,
                'est_actif'  => true,
            ],
            [
                'nom'        => 'M. BRUCE',
                'prenoms'    => '',
                'poste'      => 'Enseignant — CM2',
                'categorie'  => 'enseignant',
                'ordre'      => 4,
                'est_visible' => true,
                'est_actif'  => true,
            ],
            [
                'nom'        => 'M. OGOU',
                'prenoms'    => '',
                'poste'      => 'Enseignant — CM2',
                'categorie'  => 'enseignant',
                'ordre'      => 5,
                'est_visible' => true,
                'est_actif'  => true,
            ],
            [
                'nom'        => 'M. Richard KOUAKOU',
                'prenoms'    => '',
                'poste'      => 'Enseignant — CM1',
                'categorie'  => 'enseignant',
                'ordre'      => 6,
                'est_visible' => true,
                'est_actif'  => true,
            ],
            [
                'nom'        => 'M. Alain KAKOU',
                'prenoms'    => '',
                'poste'      => 'Enseignant — CM1',
                'categorie'  => 'enseignant',
                'ordre'      => 7,
                'est_visible' => true,
                'est_actif'  => true,
            ],
            [
                'nom'        => 'Mme GNETO',
                'prenoms'    => '',
                'poste'      => 'Enseignante — CE1',
                'categorie'  => 'enseignant',
                'ordre'      => 8,
                'est_visible' => true,
                'est_actif'  => true,
            ],
            [
                'nom'        => 'Mme Léa',
                'prenoms'    => '',
                'poste'      => 'Enseignante — CE1',
                'categorie'  => 'enseignant',
                'ordre'      => 9,
                'est_visible' => true,
                'est_actif'  => true,
            ],
            [
                'nom'        => 'Mme LAURE',
                'prenoms'    => '',
                'poste'      => 'Enseignante — CE2',
                'categorie'  => 'enseignant',
                'ordre'      => 10,
                'est_visible' => true,
                'est_actif'  => true,
            ],
            [
                'nom'        => 'M. KONAN',
                'prenoms'    => '',
                'poste'      => 'Enseignant — CP1',
                'categorie'  => 'enseignant',
                'ordre'      => 11,
                'est_visible' => true,
                'est_actif'  => true,
            ],
            [
                'nom'        => 'Mme COULIBALY',
                'prenoms'    => '',
                'poste'      => 'Enseignante — CP2',
                'categorie'  => 'enseignant',
                'ordre'      => 12,
                'est_visible' => true,
                'est_actif'  => true,
            ],
        ];

        foreach ($membres as $membre) {
            Equipe::firstOrCreate(
                ['nom' => $membre['nom'], 'poste' => $membre['poste']],
                $membre
            );
        }

        $this->command->info('✓ ' . count($membres) . ' membres de l\'équipe insérés');
    }
}