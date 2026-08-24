<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE archives MODIFY COLUMN type ENUM(
            'annee_scolaire',
            'eleve',
            'classe',
            'paiements',
            'bulletins',
            'registre_commerce',
            'dossier_administratif',
            'contrat',
            'autorisation',
            'correspondance',
            'rapport_inspection',
            'autre'
        ) NOT NULL");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE archives MODIFY COLUMN type ENUM(
            'annee_scolaire','eleve','classe','paiements','bulletins'
        ) NOT NULL");
    }
};