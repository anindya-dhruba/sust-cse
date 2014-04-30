<?php

class NoticesTableSeeder extends Seeder {

	public function run()
	{
		$notices = array(
			array(
				'title'      =>		'New Website is on the way',
				'url'        =>		'new-website-is-on-the-way',
				'notice'     =>		'Notice is here',
				'user_id'    =>		4,
				'created_at' => 	date('Y-m-d H-i-s'),
				'updated_at' => 	date('Y-m-d H-i-s')
			)
		);

		DB::table('notices')->insert($notices);
	}
}