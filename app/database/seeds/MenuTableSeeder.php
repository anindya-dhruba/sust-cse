<?php

class MenuTableSeeder extends Seeder {

	public function run()
	{
		$menus = array(
			array(
				'page_type'     =>	'custom',
				'page_id'  		=>	1,
				'page_name'  	=>	'',
				'page_icon'		=>	'glyphicon glyphicon-th-large',
				'order'       	=>	1
			),
			array(
				'page_type'     =>	'dynamic',
				'page_id'  		=>	null,
				'page_name'  	=>	'Faculty',
				'page_icon'		=>	'glyphicon glyphicon-th-large',
				'order'       	=>	2
			),
			array(
				'page_type'     =>	'dynamic',
				'page_id'  		=>	null,
				'page_name'  	=>	'Stuff',
				'page_icon'		=>	'glyphicon glyphicon-th-large',
				'order'       	=>	3
			),
			array(
				'page_type'     =>	'dynamic',
				'page_id'  		=>	null,
				'page_name'  	=>	'Students',
				'page_icon'		=>	'glyphicon glyphicon-th-large',
				'order'       	=>	4
			),
			array(
				'page_type'     =>	'dynamic',
				'page_id'  		=>	null,
				'page_name'  	=>	'FAQs',
				'page_icon'		=>	'glyphicon glyphicon-th-large',
				'order'       	=>	5
			),
			array(
				'page_type'     =>	'dynamic',
				'page_id'  		=>	null,
				'page_name'  	=>	'Notices',
				'page_icon'		=>	'glyphicon glyphicon-th-large',
				'order'       	=>	6
			),
		);

		DB::table('menus')->insert($menus);
	}
}