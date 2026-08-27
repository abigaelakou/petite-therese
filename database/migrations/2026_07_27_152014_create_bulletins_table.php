<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('bulletins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('eleve_id')->constrained()->cascadeOnDelete();
            $table->foreignId('classe_id')->constrained()->cascadeOnDelete();
            $table->foreignId('annee_scolaire_id')->constrained('annees_scolaires')->cascadeOnDelete();
            $table->enum('periode', ['trimestre_1','trimestre_2','trimestre_3','semestre_1','semestre_2']);
            $table->decimal('moyenne_generale', 5, 2)->nullable();
            $table->integer('rang')->nullable();
            $table->integer('effectif_classe')->nullable();
            $table->string('mention')->nullable();
            $table->text('appreciation_directeur')->nullable();
            $table->text('appreciation_enseignant')->nullable();
            $table->boolean('est_publie')->default(false);
            $table->timestamp('publie_le')->nullable();
            $table->foreignId('genere_par')->constrained('users');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('bulletins'); }
};