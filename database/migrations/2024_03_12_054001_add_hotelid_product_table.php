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
            $table->unsignedBigInteger('partner_reference');
        });

        Schema::table('product', function(Blueprint $table){
            $table->unsignedBigInteger('hotel_id');

            $table->foreign('hotel_id')->references('partner_reference')->on('hotels');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hotels', function(Blueprint $table){
            $table->dropColumn(['partner_reference']);
        });
        
        Schema::table('product', function(Blueprint $table){
            $table->dropForeign(['hotel_id']);
            $table->dropColumn(['hotel_id']);
        });
    }
};
