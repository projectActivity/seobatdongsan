<?php

use Illuminate\Database\Seeder;

class ChuDeTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker\Factory::create();
        $limit = 30;

        for ($i = 0; $i < $limit; $i++)
        {
        	DB::table('ChuDe')->insert([
        		'tenchude' => $faker->sentence($nbWords = 2, $variableNbWords = true),
        		'duan' => $faker->boolean($chanceOfGettingTrue = 3),
        		'tomtat' => $faker->sentence($nbWords = 13, $variableNbWords = true),
        		'hinhanh' => $faker->imageUrl($width = 640, $height = 480)
        	]);
        }
    }
}
