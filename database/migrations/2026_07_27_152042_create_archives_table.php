<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('archives', function (Blueprint $table) {
            $table->id();
            $table->foreignId('annee_scolaire_id')->constrained('annees_scolaires')->cascadeOnDelete();
            $table->enum('type', ['annee_scolaire','eleve','classe','paiements','bulletins']);
            $table->string('description');
            $table->string('chemin_fichier')->nullable();
            $table->foreignId('archive_par')->constrained('users');
            $table->timestamp('archivee_le');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('archives'); }
};