<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Postgres uchun string -> decimal konvertatsiyasi
        DB::statement('ALTER TABLE companies ALTER COLUMN deposit TYPE numeric(12,2) USING deposit::numeric(12,2)');

        Schema::table('companies', function (Blueprint $table) {
            $table->decimal('deposit', 12, 2)->default(0)->change();
        });
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE companies ALTER COLUMN deposit TYPE varchar USING deposit::varchar');

        Schema::table('companies', function (Blueprint $table) {
            $table->string('deposit')->nullable()->change();
        });
    }
};
