<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('circulaires', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->text('contenu');
            $table->enum('destinataires', ['tous','parents','enseignants','eleves']);
            $table->enum('statut', ['brouillon','publiee'])->default('brouillon');
            $table->timestamp('publiee_le')->nullable();
            $table->foreignId('creee_par')->constrained('users');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('circulaires'); }
};