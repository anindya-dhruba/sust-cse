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
				'created_at' => 	$faker->date(),
				'updated_at' => 	$faker->date()
			),
			array(
				'title'      =>		'Faculty',
				'url'        =>		'faculty',
				'content'    =>		'',
				'is_public'  => 	1,
				'can_update'  => 	0,
				'can_delete'  => 	0,
				'created_at' => 	$faker->date(),
				'updated_at' => 	$faker->date()
			),
			array(
				'title'      =>		'Staff',
				'url'        =>		'staff',
				'content'    =>		'',
				'is_public'  => 	1,
				'can_update'  => 	0,
				'can_delete'  => 	0,
				'created_at' => 	$faker->date(),
				'updated_at' => 	$faker->date()
			),
			array(
				'title'      =>		'Batches',
				'url'        =>		'batches',
				'content'    =>		'',
				'is_public'  => 	1,
				'can_update'  => 	0,
				'can_delete'  => 	0,
				'created_at' => 	$faker->date(),
				'updated_at' => 	$faker->date()
			),
			array(
				'title'      =>		'FAQ',
				'url'        =>		'faqs',
				'content'    =>		'',
				'is_public'  => 	1,
				'can_update'  => 	0,
				'can_delete'  => 	0,
				'created_at' => 	$faker->date(),
				'updated_at' => 	$faker->date()
			),
			array(
				'title'      =>		'Notices',
				'url'        =>		'notices',
				'content'    =>		'',
				'is_public'  => 	1,
				'can_update'  => 	0,
				'can_delete'  => 	0,
				'created_at' => 	$faker->date(),
				'updated_at' => 	$faker->date()
			),
			array(
				'title'      =>		'Events',
				'url'        =>		'events',
				'content'    =>		'',
				'is_public'  => 	1,
				'can_update'  => 	0,
				'can_delete'  => 	0,
				'created_at' => 	$faker->date(),
				'updated_at' => 	$faker->date()
			),
			array(
				'title'      =>		'Courses',
				'url'        =>		'courses',
				'content'    =>		'',
				'is_public'  => 	1,
				'can_update'  => 	0,
				'can_delete'  => 	0,
				'created_at' => 	$faker->date(),
				'updated_at' => 	$faker->date()
			),
			array(
				'title'      =>		'Research',
				'url'        =>		'researches',
				'content'    =>		'',
				'is_public'  => 	1,
				'can_update'  => 	0,
				'can_delete'  => 	0,
				'created_at' => 	$faker->date(),
				'updated_at' => 	$faker->date()
			),
			array(
				'title'      =>		'Gallery',
				'url'        =>		'albums',
				'content'    =>		'',
				'is_public'  => 	1,
				'can_update'  => 	0,
				'can_delete'  => 	0,
				'created_at' => 	$faker->date(),
				'updated_at' => 	$faker->date()
			),
			array(
				'title'      =>		'Students',
				'url'        =>		'students',
				'content'    =>		'',
				'is_public'  => 	1,
				'can_update'  => 	0,
				'can_delete'  => 	0,
				'created_at' => 	$faker->date(),
				'updated_at' => 	$faker->date()
			),
			array(
				'title'      =>		'Graduate - Admission',
				'url'        =>		'students/graduate/admission',
				'content'    =>		'',
				'is_public'  => 	1,
				'can_update'  => 	0,
				'can_delete'  => 	0,
				'created_at' => 	$faker->date(),
				'updated_at' => 	$faker->date()
			),
			array(
				'title'      =>		'Undergraduate - Admission',
				'url'        =>		'students/undergraduate/admission',
				'content'    =>		'',
				'is_public'  => 	1,
				'can_update'  => 	0,
				'can_delete'  => 	0,
				'created_at' => 	$faker->date(),
				'updated_at' => 	$faker->date()
			)

		);

		DB::table('pages')->insert($pages);
	}
}