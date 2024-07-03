<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
    

    
        // Change the column to the desired structure
        Schema::table('transactions', function (Blueprint $table) {
            $table->decimal('total_amount', 20, 2)->change();
        });
        Schema::table('product_transaction', function (Blueprint $table) {
            $table->decimal('subtotal', 20, 2)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->decimal('total_amount', 10, 2)->change();
        });
        Schema::table('product_transaction', function (Blueprint $table) {
            $table->decimal('subtotal', 10, 2)->change();
        });
    }
};
