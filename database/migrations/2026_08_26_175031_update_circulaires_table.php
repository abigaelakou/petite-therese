<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('circulaires', function (Blueprint $table) {
            if (!Schema::hasColumn('circulaires', 'type')) {
                $table->enum('type', ['information','convocation','evenement','urgent','autre'])
                    ->default('information')->after('titre');
            }
            if (!Schema::hasColumn('circulaires', 'destinataires')) {
                $table->enum('destinataires', ['tous','enseignants','parents','personnel'])
                    ->default('tous')->after('type');
            }
            if (!Schema::hasColumn('circulaires', 'contenu')) {
                $table->longText('contenu')->after('destinataires');
            }
            if (!Schema::hasColumn('circulaires', 'fichier_joint')) {
                $table->string('fichier_joint')->nullable()->after('contenu');
            }
            if (!Schema::hasColumn('circulaires', 'statut')) {
                $table->enum('statut', ['brouillon','publiee','archivee'])
                    ->default('brouillon')->after('fichier_joint');
            }
            if (!Schema::hasColumn('circulaires', 'date_publication')) {
                $table->timestamp('date_publication')->nullable()->after('statut');
            }
            if (!Schema::hasColumn('circulaires', 'cree_par')) {
                $table->foreignId('cree_par')->nullable()->constrained('users')->nullOnDelete()->after('date_publication');
            }
        });
    }

    public function down(): void {}
};