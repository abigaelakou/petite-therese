<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE classes MODIFY COLUMN niveau ENUM('ms','gs','cp1','cp2','ce1','ce2','cm1','cm2') NOT NULL");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE classes MODIFY COLUMN niveau ENUM('ps','ms','gs','cp','ce1','ce2','cm1','cm2') NOT NULL");
    }
};