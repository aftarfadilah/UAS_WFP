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
            $table->string('name');
            $table->string('address');
            $table->string('postcode');
            $table->double('longitude', 8, 3);
            $table->double('latitude', 8, 3);
            $table->string('country_id');
            $table->string('city');
            $table->string('state');
            $table->string('phone');
            $table->string('fax');
            $table->string('email');
            $table->string('currency');
            $table->string('accommodation_type');
            $table->string('category');
            $table->string('web');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hotels', function (Blueprint $table){
            $table->dropColumn(['name', 'address', 'postcode', 'longitude', 'latitude', 'country_id', 'city', 'state', 'country_id', 
                                'phone', 'fax', 'email', 'currency', 'accommodation_type', 'category', 'web']);
        });
    }
};
