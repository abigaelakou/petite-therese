<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Classe;
use App\Models\AnneeScolaire;

class ClassesSeeder extends Seeder
{
    public function run(): void
    {
        $annee = AnneeScolaire::firstOrCreate(
            ['libelle' => '2025-2026'],
            [
                'date_debut'   => '2025-09-01',
                'date_fin'     => '2026-06-30',
                'est_active'   => true,
                'est_archivee' => false,
            ]
        );

        $classes = [
            // Maternelle — 2 classes par niveau
            ['nom' => 'MS A',  'niveau' => 'ms',  'cycle' => 'maternelle', 'capacite' => 35],
            ['nom' => 'MS B',  'niveau' => 'ms',  'cycle' => 'maternelle', 'capacite' => 35],
            ['nom' => 'GS A',  'niveau' => 'gs',  'cycle' => 'maternelle', 'capacite' => 35],
            ['nom' => 'GS B',  'niveau' => 'gs',  'cycle' => 'maternelle', 'capacite' => 35],
            // Primaire — 2 classes par niveau
            ['nom' => 'CP1 A', 'niveau' => 'cp1', 'cycle' => 'primaire', 'capacite' => 40],
            ['nom' => 'CP1 B', 'niveau' => 'cp1', 'cycle' => 'primaire', 'capacite' => 40],
            ['nom' => 'CP2 A', 'niveau' => 'cp2', 'cycle' => 'primaire', 'capacite' => 40],
            ['nom' => 'CP2 B', 'niveau' => 'cp2', 'cycle' => 'primaire', 'capacite' => 40],
            ['nom' => 'CE1 A', 'niveau' => 'ce1', 'cycle' => 'primaire', 'capacite' => 40],
            ['nom' => 'CE1 B', 'niveau' => 'ce1', 'cycle' => 'primaire', 'capacite' => 40],
            ['nom' => 'CE2 A', 'niveau' => 'ce2', 'cycle' => 'primaire', 'capacite' => 40],
            ['nom' => 'CE2 B', 'niveau' => 'ce2', 'cycle' => 'primaire', 'capacite' => 40],
            ['nom' => 'CM1 A', 'niveau' => 'cm1', 'cycle' => 'primaire', 'capacite' => 40],
            ['nom' => 'CM1 B', 'niveau' => 'cm1', 'cycle' => 'primaire', 'capacite' => 40],
            ['nom' => 'CM2 A', 'niveau' => 'cm2', 'cycle' => 'primaire', 'capacite' => 40],
            ['nom' => 'CM2 B', 'niveau' => 'cm2', 'cycle' => 'primaire', 'capacite' => 40],
        ];

        foreach ($classes as $classe) {
            Classe::firstOrCreate(
                ['nom' => $classe['nom'], 'annee_scolaire_id' => $annee->id],
                array_merge($classe, ['annee_scolaire_id' => $annee->id])
            );
        }

        $this->command->info('✓ 16 classes créées pour ' . $annee->libelle);
    }
}