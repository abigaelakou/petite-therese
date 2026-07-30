<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('annee_scolaire_id')->constrained('annees_scolaires')->cascadeOnDelete();
            $table->string('nom');
            $table->enum('niveau', ['ps','ms','gs','cp','ce1','ce2','cm1','cm2']);
            $table->enum('cycle', ['maternelle','primaire']);
            $table->integer('capacite')->default(30);
            $table->foreignId('enseignant_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('classes'); }
};