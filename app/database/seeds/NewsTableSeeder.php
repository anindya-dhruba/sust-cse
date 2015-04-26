<?php

use Faker\Factory as Faker;

class NewsTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 20) as $item)
		{
			$news[] = [
				'title'      =>		$faker->sentence,
				'url'        =>		$faker->slug,
				'news'       =>		$faker->text(1000),
				'user_id'    =>		User::staff()->orderByRaw("RAND()")->first()->id,
				'is_public'  =>		rand(0, 1),
				'created_at' => 	$faker->dateTimeBetween('-2 years'),
				'updated_at' => 	$faker->dateTimeBetween('-2 years')
			];
		}

		DB::table('news')->insert($news);
	}
}