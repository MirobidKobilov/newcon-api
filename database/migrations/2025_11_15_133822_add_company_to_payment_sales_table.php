<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('payment_sales', function (Blueprint $table) {
            $table->foreignId('company_id')->nullable()->constrained('companies')->onDelete('cascade');

            $table->dropForeign(['sale_id']);

            $table->dropColumn('sale_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payment_sales', function (Blueprint $table) {
            $table->foreignId('sale_id')->constrained('sales')->onDelete('cascade');
        });
    }
};
