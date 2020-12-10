<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        for($i=0; $i < 49; $i++){
            DB::table('orders')->insert([
               'vendor_id' => rand(1, 30),
               'tag_id' => rand(1, 13),
               'orders' => $faker->text,
               'cost' => $faker->randomNumber(6),
               'dishes' => rand(0, 1) 
            ]);
        }
    }
}
