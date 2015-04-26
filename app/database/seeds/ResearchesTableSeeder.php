<?php

use Faker\Factory as Faker;

class ResearchesTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();
		$researches = [];

		foreach(range(1, 10) as $item)
		{
			$researches[] = [
				'name'      	=>		$faker->sentence,
				'url'        	=>		$faker->slug,
				'description' 	=>		$faker->text(1000),
				'created_at' 	=> 		$faker->dateTimeBetween('-2 years'),
				'updated_at' 	=> 		$faker->dateTimeBetween('-2 years')
			];
		}

		DB::table('researches')->insert($researches);
	}
}

