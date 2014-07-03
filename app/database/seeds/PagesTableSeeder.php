<?php

class PagesTableSeeder extends Seeder {

	public function run()
	{
		$pages = array(
			array(
				'title'      =>		'Home',
				'url'        =>		'home',
				'content'    =>		'Home Details Details',
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
				'url'        =>		'stuff',
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
		);

		DB::table('pages')->insert($pages);
	}
}