<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('inscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('eleve_id')->constrained()->cascadeOnDelete();
            $table->foreignId('classe_id')->constrained()->cascadeOnDelete();
            $table->foreignId('annee_scolaire_id')->constrained('annees_scolaires')->cascadeOnDelete();
            $table->enum('type', ['nouvelle','reinscription'])->default('nouvelle');
            $table->date('date_inscription');
            $table->enum('statut', ['en_attente','validee','refusee'])->default('en_attente');
            $table->foreignId('validee_par')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('validee_le')->nullable();
            $table->foreignId('inscription_precedente_id')->nullable()->constrained('inscriptions')->nullOnDelete();
            $table->boolean('passage_automatique')->default(false);
            $table->text('observations')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('inscriptions'); }
};