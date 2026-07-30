<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('eleve_id')->constrained()->cascadeOnDelete();
            $table->foreignId('annee_scolaire_id')->nullable()->constrained('annees_scolaires')->nullOnDelete();
            $table->enum('type', ['extrait_naissance','carnet_sante','certificat_scolarite','attestation','autre']);
            $table->string('nom_fichier');
            $table->string('chemin_fichier');
            $table->foreignId('ajoute_par')->constrained('users');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('documents'); }
};