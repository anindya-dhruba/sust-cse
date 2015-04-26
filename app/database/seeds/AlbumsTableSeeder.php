<?php

use Faker\Factory as Faker;
class AlbumsTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 10) as $item)
		{
			$albums[] = array(
				'name'      	=>	$faker->sentence,
				'url'  			=>	$faker->slug,
				'details'       =>	$faker->text(1000),
				'user_id' 		=> 	rand(1, 41),
				'is_public' 	=> 	rand(0, 1),
				'created_at'   	=> 	$faker->dateTimeBetween('-2 years'),
				'updated_at'   	=> 	$faker->dateTimeBetween('-2 years')
			);
		}

		DB::table('albums')->insert($albums);
	}
}