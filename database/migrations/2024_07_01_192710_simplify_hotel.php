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
            $table->dropColumn(['longitude', 'latitude', 'country_id', 'currency', 'accommodation_type', 'category']);
            $table->string('fax', 255)->nullable(true)->change();
            $table->string('web', 255)->nullable(true)->change();
            $table->string('phone', 255)->nullable(true)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hotels', function (Blueprint $table) {
            $table->double('longitude', 8, 3)->nullable(false);
            $table->double('latitude', 8, 3)->nullable(false);
            $table->unsignedBigInteger('country_id')->nullable(false);
            $table->string('currency', 255)->nullable(false);
            $table->string('accommodation_type', 255)->nullable(false);
            $table->string('category', 255)->nullable(false);
            $table->string('fax', 255)->nullable(false)->change();
            $table->string('web', 255)->nullable(false)->change();
            $table->string('phone', 255)->nullable(false)->change();
        });
    }
};
