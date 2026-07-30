<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('pre_inscriptions', function (Blueprint $table) {
            $table->id();
            $table->string('nom_eleve');
            $table->string('nom_parent');
            $table->string('telephone');
            $table->string('email')->nullable();
            $table->string('niveau_souhaite');
            $table->string('annee_naissance')->nullable();
            $table->text('message')->nullable();
            $table->enum('statut', ['en_attente','validee','refusee','liste_attente'])->default('en_attente');
            $table->foreignId('traite_par')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('traite_le')->nullable();
            $table->text('observations')->nullable();
            $table->foreignId('eleve_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('pre_inscriptions'); }
};