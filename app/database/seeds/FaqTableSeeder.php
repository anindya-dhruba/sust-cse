<?php

use Faker\Factory as Faker;

class FaqTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 20) as $item)
		{
			$faqs[] = [
				'question'      =>		$faker->sentence,
				'url'        	=>		$faker->slug,
				'answer'    	=>		$faker->text(500),
				'created_at' 	=> 		$faker->dateTimeBetween('-2 years'),
				'updated_at' 	=> 		$faker->dateTimeBetween('-2 years')
			];
		}

		DB::table('faq')->insert($faqs);
	}
}

