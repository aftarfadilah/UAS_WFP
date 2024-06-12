<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('types')->insert([
            ['name'=>'Inn'],
            ['name'=>'Resort'],
            ['name'=>'Chain_hotel'],
            ['name'=>'Motel'],
            ['name'=>'All-Suites'],
            ['name'=>'Conference'],
            ['name'=>'Extended_stay_hotel'],
            ['name'=>'Boutique_hotel'],
            ['name'=>'Bunkhouses'],
            ['name'=>'Bed_and_breakfasts'],
            ['name'=>'Eco_hotel'],
            ['name'=>'Pop-up_hotel'],
            ['name'=>'Pet-friendly_hotel'],
            ['name'=>'Roadhouses'],
            ['name'=>'Gastro_hotel'],
            ['name'=>'Micro_hotel'],
            ['name'=>'Transit_hotel'],
            ['name'=>'Heritage_hotel'],
            ['name'=>'hostel'],
            ['name'=>'Unique_concept_hotel'],
        ]);
    }
}
