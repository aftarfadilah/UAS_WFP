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
        Schema::table('product', function(Blueprint $table){
            $table->dropForeign(['hotel_id']);
        });

        Schema::rename('product', 'products');

        Schema::table('products', function(Blueprint $table){
            $table->foreign('hotel_id')->references('partner_reference')->on('hotels')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function(Blueprint $table){
            $table->dropForeign(['hotel_id']);
            $table->dropColumn(['hotel_id']);
        });
    }
};
