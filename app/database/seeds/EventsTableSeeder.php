<?php

use Faker\Factory as Faker;

class EventsTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		$events = [];
		foreach(range(1, 20) as $item)
		{
			$events[] = [
				'title'      =>		$faker->sentence,
				'url'        =>		$faker->slug,
				'event'      =>		$faker->text(1000),
				'start_date' =>		$faker->dateTimeBetween('-3 months'),
				'end_date' 	 =>		$faker->dateTimeBetween('-2 months'),
				'user_id'    =>		User::staff()->orderByRaw("RAND()")->first()->id,
				'is_public'  =>		rand(0, 1),
				'created_at' => 	$faker->dateTimeBetween('-2 years'),
				'updated_at' => 	$faker->dateTimeBetween('-2 years')
			];
		}

		DB::table('events')->insert($events);
	}
}