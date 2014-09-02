<?php

class MenusTableSeeder extends Seeder {

	public function run()
	{
		$menus = array(
			array(
				'page_id'  		=>	1,
				'page_icon'		=>	'fa-home',
				'page_location'	=>	'side',
				'parent_id'		=>	0,
				'order'       	=>	1
			),
			array(
				'page_id'  		=>	2,
				'page_icon'		=>	'fa-users',
				'page_location'	=>	'side',
				'parent_id'		=>	0,
				'order'       	=>	2
			),
			array(
				'page_id'  		=>	3,
				'page_icon'		=>	'fa-users',
				'page_location'	=>	'side',
				'parent_id'		=>	0,
				'order'       	=>	3
			),
			array(
				'page_id'  		=>	4,
				'page_icon'		=>	'fa-user',
				'page_location'	=>	'side',
				'parent_id'		=>	0,
				'order'       	=>	4
			),
			array(
				'page_id'  		=>	5,
				'page_icon'		=>	'fa-question-circle',
				'page_location'	=>	'side',
				'parent_id'		=>	0,
				'order'       	=>	5
			),
			array(
				'page_id'  		=>	6,
				'page_icon'		=>	'fa-calendar',
				'page_location'	=>	'side',
				'parent_id'		=>	0,
				'order'       	=>	6
			),
			array(
				'page_id'  		=>	7,
				'page_icon'		=>	'fa-map-marker',
				'page_location'	=>	'side',
				'parent_id'		=>	0,
				'order'       	=>	7
			),
			array(
				'page_id'  		=>	8,
				'page_icon'		=>	'fa-map-marker',
				'page_location'	=>	'side',
				'parent_id'		=>	0,
				'order'       	=>	8
			),
		);

		DB::table('menus')->insert($menus);
	}
}