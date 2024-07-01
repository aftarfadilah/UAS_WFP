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
        Schema::table('products', function (Blueprint $table) {
            $table->decimal('price', 12, 2)->nullable(false);
            $table->dropColumn('tipe_kamar');

            $table->unsignedBigInteger('hotel_id')->nullable(false);
            $table->foreign('hotel_id')->references('id')->on('hotels');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('price');
            $table->string('tipe_kamar', 255)->nullable(false);

            $table->dropForeign(['hotel_id']);
            $table->dropColumn('hotel_id');
        });
    }
};
