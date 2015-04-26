<?php

class MenusTableSeeder extends Seeder {

	public function run()
	{
		$menus = array(
			array(
				'page_id'  		=>	1,
				'page_icon'		=>	'fa-home',
				'page_location'	=>	'top',
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
				'page_id'  		=>	11,
				'page_icon'		=>	'fa-user',
				'page_location'	=>	'side',
				'parent_id'		=>	0,
				'order'       	=>	4
			),
			array(
				'page_id'  		=>	5,
				'page_icon'		=>	'fa-question-circle',
				'page_location'	=>	'top',
				'parent_id'		=>	0,
				'order'       	=>	5
			),
			array(
				'page_id'  		=>	8,
				'page_icon'		=>	'fa-book',
				'page_location'	=>	'side',
				'parent_id'		=>	0,
				'order'       	=>	8
			),
			array(
				'page_id'  		=>	9,
				'page_icon'		=>	'fa-lightbulb-o',
				'page_location'	=>	'side',
				'parent_id'		=>	0,
				'order'       	=>	9
			),
			array(
				'page_id'  		=>	10,
				'page_icon'		=>	'fa-picture-o',
				'page_location'	=>	'side',
				'parent_id'		=>	0,
				'order'       	=>	10
			),
		);

		DB::table('menus')->insert($menus);
	}
}