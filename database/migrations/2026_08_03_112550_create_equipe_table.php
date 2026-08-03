<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('equipe', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenoms')->nullable();
            $table->string('poste');
            $table->enum('categorie', ['direction','enseignant','staff'])->default('enseignant');
            $table->string('photo')->nullable();
            $table->string('facebook')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('email')->nullable();
            $table->text('bio')->nullable();
            $table->integer('ordre')->default(0);
            $table->boolean('est_visible')->default(true);
            $table->boolean('est_actif')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('equipe');
    }
};