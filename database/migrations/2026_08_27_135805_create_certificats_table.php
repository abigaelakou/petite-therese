<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('certificats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('eleve_id')->constrained('eleves')->cascadeOnDelete();
            $table->foreignId('annee_scolaire_id')->constrained('annees_scolaires')->cascadeOnDelete();
            $table->foreignId('classe_id')->nullable()->constrained('classes')->nullOnDelete();
            $table->string('numero_certificat')->unique();
            $table->foreignId('delivre_par')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('delivre_le')->useCurrent();
            $table->string('motif')->nullable()->default('Usage administratif');
            $table->enum('statut', ['valide', 'annule'])->default('valide');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('certificats');
    }
};