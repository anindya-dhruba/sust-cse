<?php

use Faker\Factory as Faker;

class DownloadsTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 20) as $item)
		{
			$downloads = [
				'caption'    => $faker->sentence,
				'url'        => 'download-me.pdf',
				'type'       => $faker->randomElement(['Syllabus', 'Student List', 'Teacher List', 'Stuff List', 'Profile Picture', 'Other']),
				'details'    => $faker->text(1000),
				'user_id'    => 1,
				'created_at' => $faker->dateTimeBetween('-2 years'),
				'updated_at' => $faker->dateTimeBetween('-2 years')
			];
		}

		DB::table('downloads')->insert($downloads);
	}
}