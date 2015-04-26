<?php

use Faker\Factory as Faker;
class CoursesTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 30) as $item) {
			$courses[] = array(
				'course_code'	=>	$faker->word(1).'-'.$faker->postcode,
				'url'			=>	$faker->slug,
				'title'			=>	$faker->sentence,
				'credit'    	=>	rand(1, 4),
				'type'			=>	$faker->randomElement(['Major', 'Minor']),
				'semester'		=>	$faker->randomElement(Course::$semesterOptions),
				'details'		=>	$faker->text(1000),
				'faculty_id'	=>	(rand(0, 1) === 0) ? null : User::faculty()->orderByRaw("RAND()")->first()->id,
				'created_at' 	=> 	$faker->dateTimeBetween('-2 years'),
				'updated_at' 	=> 	$faker->dateTimeBetween('-2 years')
			);
		}

		DB::table('courses')->insert($courses);
	}
}