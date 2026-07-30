<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('email');
            $table->string('telephone');
            $table->string('sujet');
            $table->text('message')->nullable();
            $table->enum('statut', ['non_lu','lu','traite'])->default('non_lu');
            $table->foreignId('traite_par')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('traite_le')->nullable();
            $table->text('reponse')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('contacts'); }
};