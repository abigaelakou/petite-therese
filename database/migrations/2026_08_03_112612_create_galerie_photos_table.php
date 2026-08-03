<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('galerie_photos', function (Blueprint $table) {
            $table->id();
            $table->string('titre')->nullable();
            $table->text('description')->nullable();
            $table->string('photo');
            $table->enum('categorie', [
                'vie_scolaire',
                'fete_scolaire',
                'sport',
                'remise_prix',
                'sortie_pedagogique',
                'autre'
            ])->default('vie_scolaire');
            $table->integer('ordre')->default(0);
            $table->boolean('est_visible')->default(true);
            $table->foreignId('ajoute_par')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('galerie_photos');
    }
};