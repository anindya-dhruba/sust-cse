<?php

class RolesTableSeeder extends Seeder {

	public function run()
	{
		$roles = array(
			array(
					'name'     =>	'Admin',
					'adminMenu'=>	1,
					'notices'  => 	1,
					'events'   => 	1,
					'pages'	   =>	1,
					'faculty'  => 	1,
					'students' => 	1,
					'stuffs'   => 	1,
					'menus'    => 	1,
					'batches'  => 	1,
					'albums'   => 	1,
					'pictures' => 	1,
					'sliders'  => 	1,
					'faqs'     => 	1,
					'courses'  =>	1
				),
			array(
					'name' 	   =>	'Head Of Department',
					'adminMenu'=>	1,
					'notices'  => 	1,
					'events'   => 	1,
					'pages'	   =>	1,
					'faculty'  => 	1,
					'students' => 	1,
					'stuffs'   => 	1,
					'menus'    => 	1,
					'batches'  => 	1,
					'albums'   => 	1,
					'pictures' => 	1,
					'sliders'  => 	1,
					'faqs'     => 	1,
					'courses'  =>	1
				),
			array(
					'name' 	   =>	'Faculty',
					'adminMenu'=>	0,
					'notices'  => 	0,
					'events'   => 	0,
					'pages'	   =>	0,
					'faculty'  => 	0,
					'students' => 	0,
					'stuffs'   => 	0,
					'menus'    => 	0,
					'batches'  => 	0,
					'albums'   => 	0,
					'pictures' => 	0,
					'sliders'  => 	0,
					'faqs'     => 	0,
					'courses'  =>	0
				),
			array(
					'name' 	   =>	'Stuff',
					'adminMenu'=>	1,
					'notices'  => 	1,
					'events'   => 	1,
					'pages'	   =>	1,
					'faculty'  => 	1,
					'students' => 	1,
					'stuffs'   => 	1,
					'menus'    => 	1,
					'batches'  => 	1,
					'albums'   => 	1,
					'pictures' => 	1,
					'sliders'  => 	1,
					'faqs'     => 	1,
					'courses'  =>	1
				),
			array(
					'name' 	   =>	'Student',
					'adminMenu'=>	0,
					'notices'  => 	0,
					'events'   => 	0,
					'pages'	   =>	0,
					'faculty'  => 	0,
					'students' => 	0,
					'stuffs'   => 	0,
					'menus'    => 	0,
					'batches'  => 	0,
					'albums'   => 	0,
					'pictures' => 	0,
					'sliders'  => 	0,
					'faqs'     => 	0,
					'courses'  =>	0
				)
		);

		DB::table('roles')->insert($roles);
	}
}