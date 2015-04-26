<?php

use Faker\Factory as Faker;

class PicturesTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 20) as $item){
			$pictures[] = [
				'album_id'   => rand(1, 10),
				'caption'    => $faker->sentence,
				'url'        => $faker->slug,
				'details'    => $faker->text(1000),
				'user_id'    => rand(1, 41),
				'created_at' => $faker->dateTimeBetween('-2 years'),
				'updated_at' => $faker->dateTimeBetween('-2 years')
			];
		}

		DB::table('pictures')->insert($pictures);
	}
}