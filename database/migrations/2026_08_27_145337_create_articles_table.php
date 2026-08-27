<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('slug')->unique();
            $table->text('extrait')->nullable();
            $table->longText('contenu');
            $table->string('photo_couverture')->nullable();
            $table->enum('categorie', [
                'evenement',
                'sortie_pedagogique',
                'remise_prix',
                'fete_scolaire',
                'sport',
                'annonce',
                'autre',
            ])->default('evenement');
            $table->enum('statut', ['brouillon', 'publie'])->default('brouillon');
            $table->timestamp('publie_le')->nullable();
            $table->foreignId('auteur_id')->nullable()->constrained('users')->nullOnDelete();
            $table->integer('vues')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};