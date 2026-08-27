<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('paiements', function (Blueprint $table) {
            // Modifier le type enum avec nouveaux types
            DB::statement("ALTER TABLE paiements MODIFY COLUMN type ENUM(
                'inscription',
                'versement_1',
                'versement_2',
                'versement_3',
                'versement_4',
                'cantine',
                'sortie_pedagogique',
                'fete_scolaire',
                'uniforme',
                'fournitures',
                'autre'
            ) NOT NULL");

            // Ajouter catégorie pour distinguer scolarité vs divers
            $table->enum('categorie', ['scolarite', 'divers'])->default('scolarite')->after('type');

            // Ajouter champ relance
            $table->boolean('relance_envoyee')->default(false)->after('statut');
            $table->timestamp('relance_le')->nullable()->after('relance_envoyee');
            $table->foreignId('relance_par')->nullable()->constrained('users')->nullOnDelete()->after('relance_le');

            // Ajouter report année précédente
            $table->decimal('montant_reporte', 10, 2)->default(0)->after('reste_a_payer');
            $table->foreignId('annee_precedente_id')->nullable()->constrained('annees_scolaires')->nullOnDelete()->after('montant_reporte');
        });
    }

    public function down(): void
    {
        Schema::table('paiements', function (Blueprint $table) {
            $table->dropColumn(['categorie', 'relance_envoyee', 'relance_le', 'relance_par', 'montant_reporte', 'annee_precedente_id']);
            DB::statement("ALTER TABLE paiements MODIFY COLUMN type ENUM('inscription','scolarite_t1','scolarite_t2','scolarite_t3','autre') NOT NULL");
        });
    }
};