<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('eleves', function (Blueprint $table) {
            $table->id();
            $table->string('matricule')->unique();
            $table->string('nom');
            $table->string('prenoms');
            $table->date('date_naissance');
            $table->string('lieu_naissance');
            $table->enum('sexe', ['M','F']);
            $table->string('photo')->nullable();
            $table->string('nom_parent');
            $table->string('telephone_parent');
            $table->string('telephone_parent_2')->nullable();
            $table->string('email_parent')->nullable();
            $table->string('profession_parent')->nullable();
            $table->string('adresse_parent')->nullable();
            $table->string('numero_extrait_naissance')->nullable();
            $table->boolean('est_actif')->default(true);
            $table->boolean('est_archive')->default(false);
            $table->timestamp('archive_le')->nullable();
            $table->foreignId('archive_par')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('eleves'); }
};