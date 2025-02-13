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
        Schema::table('hotels', function(Blueprint $table){
            $table->unsignedBigInteger('type_id');

            $table->foreign('type_id')->references('id')->on('hotel_types');
        });

        Schema::table('products', function(Blueprint $table){
            $table->unsignedBigInteger('type_id');

            $table->foreign('type_id')->references('id')->on('product_types');
        });

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hotels', function(Blueprint $table){
            $table->dropForeign(['type_id']);
            $table->dropColumn(['type_id']);
        });

        Schema::table('products', function(Blueprint $table){
            $table->dropForeign(['type_id']);
            $table->dropColumn(['type_id']);
        });
    }
};
