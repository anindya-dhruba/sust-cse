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
				'created_at' => 	date('Y-m-d H-i-s'),
				'updated_at' => 	date('Y-m-d H-i-s')
			)
		);

		DB::table('pages')->insert($pages);
	}
}