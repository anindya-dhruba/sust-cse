<?php

class PagesTableSeeder extends Seeder {

	public function run()
	{
		$pages = array(
			array(
				'title'      =>		'Home',
				'url'        =>		'home',
				'content'    =>		'<h2>Welcome to SUST CSE.</h2><br/>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',
				'is_public'  => 	1,
				'can_update'  => 	1,
				'can_delete'  => 	0,
				'created_at' => 	date('Y-m-d H-i-s'),
				'updated_at' => 	date('Y-m-d H-i-s')
			),
			array(
				'title'      =>		'Faculty',
				'url'        =>		'faculty',
				'content'    =>		'',
				'is_public'  => 	1,
				'can_update'  => 	0,
				'can_delete'  => 	0,
				'created_at' => 	date('Y-m-d H-i-s'),
				'updated_at' => 	date('Y-m-d H-i-s')
			),
			array(
				'title'      =>		'Stuff',
				'url'        =>		'stuffs',
				'content'    =>		'',
				'is_public'  => 	1,
				'can_update'  => 	0,
				'can_delete'  => 	0,
				'created_at' => 	date('Y-m-d H-i-s'),
				'updated_at' => 	date('Y-m-d H-i-s')
			),
			array(
				'title'      =>		'Students',
				'url'        =>		'batches',
				'content'    =>		'',
				'is_public'  => 	1,
				'can_update'  => 	0,
				'can_delete'  => 	0,
				'created_at' => 	date('Y-m-d H-i-s'),
				'updated_at' => 	date('Y-m-d H-i-s')
			),
			array(
				'title'      =>		'FAQ',
				'url'        =>		'faqs',
				'content'    =>		'',
				'is_public'  => 	1,
				'can_update'  => 	0,
				'can_delete'  => 	0,
				'created_at' => 	date('Y-m-d H-i-s'),
				'updated_at' => 	date('Y-m-d H-i-s')
			),
			array(
				'title'      =>		'Notices',
				'url'        =>		'notices',
				'content'    =>		'',
				'is_public'  => 	1,
				'can_update'  => 	0,
				'can_delete'  => 	0,
				'created_at' => 	date('Y-m-d H-i-s'),
				'updated_at' => 	date('Y-m-d H-i-s')
			),
			array(
				'title'      =>		'Events',
				'url'        =>		'events',
				'content'    =>		'',
				'is_public'  => 	1,
				'can_update'  => 	0,
				'can_delete'  => 	0,
				'created_at' => 	date('Y-m-d H-i-s'),
				'updated_at' => 	date('Y-m-d H-i-s')
			),
			array(
				'title'      =>		'Courses',
				'url'        =>		'courses',
				'content'    =>		'',
				'is_public'  => 	1,
				'can_update'  => 	0,
				'can_delete'  => 	0,
				'created_at' => 	date('Y-m-d H-i-s'),
				'updated_at' => 	date('Y-m-d H-i-s')
			)

		);

		DB::table('pages')->insert($pages);
	}
}