<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('absences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('eleve_id')->constrained()->cascadeOnDelete();
            $table->foreignId('classe_id')->constrained()->cascadeOnDelete();
            $table->foreignId('annee_scolaire_id')->constrained('annees_scolaires')->cascadeOnDelete();
            $table->date('date');
            $table->enum('periode', ['matin','apres_midi','journee_entiere']);
            $table->boolean('justifiee')->default(false);
            $table->string('motif')->nullable();
            $table->foreignId('enregistree_par')->constrained('users');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('absences'); }
};