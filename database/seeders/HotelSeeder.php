<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('hotels')->insert([
            ['name' => "Catalina Inn", 
            'address'=> "2015 Mc Farland Blvd",
            'postcode'=>"35476-2920",
            'city'=>"Northport (Tuscaloosa Area)",
            'state'=>"Alabama",
            'country_id'=>0,
            'longitude'=>-1234,
            'latitude'=>56789,
            'phone'=>"12345",
            'fax'=>"6789/087",
            'email'=>"abc@gmail.com",
            'currency'=>"USD",
            'accommodation_type'=>"Hotel",
            'category'=>"5",
            'web'=>"www.abc.com",
            'type_id'=>1
            ]
        ]);

        DB::table('hotels')->insert([
            ['name' => "Athens Inn", 
            'address'=> "1392 US Highway 72 E",
            'postcode'=>"35611-4405",
            'city'=>"Athens",
            'state'=>"Alabama",
            'country_id'=>1,
            'longitude'=>-15643,
            'latitude'=>7525.234,
            'phone'=>"0987568",
            'fax'=>"9852/6524",
            'email'=>"xyz@gmail.com",
            'currency'=>"Euro",
            'accommodation_type'=>"Inn",
            'category'=>"4",
            'web'=>"www.xyz.com",
            'type_id'=>2
            ]
        ]);
    }
}
