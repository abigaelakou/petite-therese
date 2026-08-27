<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('eleve_id')->constrained()->cascadeOnDelete();
            $table->foreignId('classe_id')->constrained()->cascadeOnDelete();
            $table->foreignId('annee_scolaire_id')->constrained('annees_scolaires')->cascadeOnDelete();
            $table->string('matiere');
            $table->integer('coefficient')->default(1);
            $table->enum('periode', ['trimestre_1','trimestre_2','trimestre_3','semestre_1','semestre_2']);
            $table->enum('type_evaluation', ['composition','devoir','interrogation','examen']);
            $table->decimal('note', 5, 2);
            $table->decimal('note_sur', 5, 2)->default(20);
            $table->foreignId('saisie_par')->constrained('users');
            $table->text('appreciation')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('notes'); }
};