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
        Schema::table('hotels', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('products', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('hotel_types', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('product_types', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hotels', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('products', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('hotel_types', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('product_types', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
