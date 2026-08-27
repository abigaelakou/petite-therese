<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('paiements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('eleve_id')->constrained()->cascadeOnDelete();
            $table->foreignId('annee_scolaire_id')->constrained('annees_scolaires')->cascadeOnDelete();
            $table->string('numero_recu')->unique();
            $table->enum('type', ['inscription','scolarite_t1','scolarite_t2','scolarite_t3','autre']);
            $table->decimal('montant_attendu', 10, 2);
            $table->decimal('montant_paye', 10, 2);
            $table->decimal('reste_a_payer', 10, 2)->default(0);
            $table->enum('mode_paiement', ['especes','mobile_money','cheque','virement'])->default('especes');
            $table->string('reference_mobile_money')->nullable();
            $table->date('date_paiement');
            $table->enum('statut', ['partiel','complet','en_retard'])->default('partiel');
            $table->foreignId('enregistre_par')->constrained('users');
            $table->text('observations')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('paiements'); }
};