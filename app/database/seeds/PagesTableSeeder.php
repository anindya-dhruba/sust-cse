<?php

use Faker\Factory as Faker;

class PagesTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();
		$pages = array(
			array(
				'title'      =>		'Home',
				'url'        =>		'home',
				'content'    =>		'',
				'is_public'  => 	1,
				'can_update'  => 	0,
				'can_delete'  => 	0,
				'created_at' => 	$faker->dateTimeBetween('-2 years'),
				'updated_at' => 	$faker->dateTimeBetween('-2 years')
			),
			array(
				'title'      =>		'Faculty',
				'url'        =>		'faculty',
				'content'    =>		'',
				'is_public'  => 	1,
				'can_update'  => 	0,
				'can_delete'  => 	0,
				'created_at' => 	$faker->dateTimeBetween('-2 years'),
				'updated_at' => 	$faker->dateTimeBetween('-2 years')
			),
			array(
				'title'      =>		'Staff',
				'url'        =>		'staff',
				'content'    =>		'',
				'is_public'  => 	1,
				'can_update'  => 	0,
				'can_delete'  => 	0,
				'created_at' => 	$faker->dateTimeBetween('-2 years'),
				'updated_at' => 	$faker->dateTimeBetween('-2 years')
			),
			array(
				'title'      =>		'Batches',
				'url'        =>		'batches',
				'content'    =>		'',
				'is_public'  => 	1,
				'can_update'  => 	0,
				'can_delete'  => 	0,
				'created_at' => 	$faker->dateTimeBetween('-2 years'),
				'updated_at' => 	$faker->dateTimeBetween('-2 years')
			),
			array(
				'title'      =>		'FAQ',
				'url'        =>		'faqs',
				'content'    =>		'',
				'is_public'  => 	1,
				'can_update'  => 	0,
				'can_delete'  => 	0,
				'created_at' => 	$faker->dateTimeBetween('-2 years'),
				'updated_at' => 	$faker->dateTimeBetween('-2 years')
			),
			array(
				'title'      =>		'Notices',
				'url'        =>		'notices',
				'content'    =>		'',
				'is_public'  => 	1,
				'can_update'  => 	0,
				'can_delete'  => 	0,
				'created_at' => 	$faker->dateTimeBetween('-2 years'),
				'updated_at' => 	$faker->dateTimeBetween('-2 years')
			),
			array(
				'title'      =>		'Events',
				'url'        =>		'events',
				'content'    =>		'',
				'is_public'  => 	1,
				'can_update'  => 	0,
				'can_delete'  => 	0,
				'created_at' => 	$faker->dateTimeBetween('-2 years'),
				'updated_at' => 	$faker->dateTimeBetween('-2 years')
			),
			array(
				'title'      =>		'Courses',
				'url'        =>		'courses',
				'content'    =>		'',
				'is_public'  => 	1,
				'can_update'  => 	0,
				'can_delete'  => 	0,
				'created_at' => 	$faker->dateTimeBetween('-2 years'),
				'updated_at' => 	$faker->dateTimeBetween('-2 years')
			),
			array(
				'title'      =>		'Research',
				'url'        =>		'researches',
				'content'    =>		'',
				'is_public'  => 	1,
				'can_update'  => 	0,
				'can_delete'  => 	0,
				'created_at' => 	$faker->dateTimeBetween('-2 years'),
				'updated_at' => 	$faker->dateTimeBetween('-2 years')
			),
			array(
				'title'      =>		'Gallery',
				'url'        =>		'albums',
				'content'    =>		'',
				'is_public'  => 	1,
				'can_update'  => 	0,
				'can_delete'  => 	0,
				'created_at' => 	$faker->dateTimeBetween('-2 years'),
				'updated_at' => 	$faker->dateTimeBetween('-2 years')
			),
			array(
				'title'      =>		'Students',
				'url'        =>		'students',
				'content'    =>		'',
				'is_public'  => 	1,
				'can_update'  => 	0,
				'can_delete'  => 	0,
				'created_at' => 	$faker->dateTimeBetween('-2 years'),
				'updated_at' => 	$faker->dateTimeBetween('-2 years')
			),
			array(
				'title'      =>		'Students - Graduate',
				'url'        =>		'students/graduate',
				'content'    =>		'',
				'is_public'  => 	1,
				'can_update'  => 	0,
				'can_delete'  => 	0,
				'created_at' => 	$faker->dateTimeBetween('-2 years'),
				'updated_at' => 	$faker->dateTimeBetween('-2 years')
			),
			array(
				'title'      =>		'Students - Undergraduate',
				'url'        =>		'students/undergraduate',
				'content'    =>		'',
				'is_public'  => 	1,
				'can_update'  => 	0,
				'can_delete'  => 	0,
				'created_at' => 	$faker->dateTimeBetween('-2 years'),
				'updated_at' => 	$faker->dateTimeBetween('-2 years')
			)

		);

		DB::table('pages')->insert($pages);
	}
}