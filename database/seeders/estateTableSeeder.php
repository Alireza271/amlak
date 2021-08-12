<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\estate;
use App\Models\Location;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Session;

class estateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Session::all();
        $faker = Factory::create();
        $count = 5000;
        for ($i = 0; $i < $count; $i++) {

            estate::create([
                "estate_type_id" => rand(1, 3),
                "building_type_id" => rand(1, 2),
                "city_id" => rand(1, 2),
                "location_id" => rand(1, 3),
                "user_id" => rand(2,3),
                "owner_phone" => rand(9116040200, 9116040264),
                "owner_name" => $faker->name,
                "area" => rand(50, 150),
                "building_area" => rand(50, 150),
                "building_date" => rand(1320, 1400),
                "price" => rand(500, 15000),
                "length" => rand(10, 200),
                "width" => rand(10, 200),
                "description" => $faker->text,
                "address" => $faker->address,
                "created_at" => $faker->dateTimeBetween('-3 years'),
                'floors'=>rand(1,10),
                'floors_count'=>rand(1,10),
                'module'=>rand(1,20),
                "estate_location_type_id"=>rand(1,2)

            ]);

        }

    }
}
