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
        Schema::table('payments', function (Blueprint $table) {
            $table->string('name')->nullable()->change();
            $table->integer('payment_type_id')->nullable()->change();
            $table->string('sales_stage')->nullable()->change();
            $table->decimal('amount', 15 , 2)->default(0);
            $table->foreignId('sale_id')->nullable()->constrained('sales')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropForeign(['sale_id']);
            $table->dropColumn(['amount', 'sale_id']);
        });
    }
};
