<?php

class PagesTableSeeder extends Seeder {

	public function run()
	{
		$pages = array(
			array(
				'title'      =>		'Admission',
				'url'        =>		'admission',
				'content'    =>		'Admission Details',
				'created_at' => 	date('Y-m-d H-i-s'),
				'updated_at' => 	date('Y-m-d H-i-s')
			)
		);

		DB::table('pages')->insert($pages);
	}
}