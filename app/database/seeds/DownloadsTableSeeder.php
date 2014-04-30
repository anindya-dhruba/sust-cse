<?php

class DownloadsTableSeeder extends Seeder {

	public function run()
	{
		$downloads = array(
			array(
				'caption'    =>		'2010',
				'url'        =>		'student-2010.pdf',
				'type'       =>		'Student List',
				'details'    =>		'Details',
				'user_id'    =>		1,
				'created_at' => 	date('Y-m-d H-i-s'),
				'updated_at' => 	date('Y-m-d H-i-s')
			)
		);

		DB::table('downloads')->insert($downloads);
	}
}