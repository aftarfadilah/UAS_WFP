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
        // Temporarily change the column to allow for larger values
        Schema::table('transactions', function (Blueprint $table) {
            $table->decimal('total_amount', 20, 2)->nullable()->change();
        });

    
        // Change the column to the desired structure
        Schema::table('transactions', function (Blueprint $table) {
            $table->decimal('total_amount', 20, 2)->change();
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
    }
};
