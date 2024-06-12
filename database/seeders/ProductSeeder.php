<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::table('product')->insert([
        //     ['name'=> "King Room",
        //     'tipe_kamar'=>"Suite Presidensial King",
        //     'hotel_id'=> 1]
        // ]);

        // DB::table('product')->insert([
        //     ['name'=>"Junior King Room",
        //     'tipe_kamar'=>"Suite Junior King",
        //     'hotel_id'=> 1]
        // ]);

        // DB::table('product')->insert([
        //     ['name'=>"Junior Double Room",
        //     'tipe_kamar'=>"Suite Junior Double",
        //     'hotel_id'=>2]
        // ]);

        DB::table('products')->where('id', '1')
        ->update(['available_room'=>5]);

        DB::table('products')->where('id', '3')
        ->update(['available_room'=>0]);
    }
}
