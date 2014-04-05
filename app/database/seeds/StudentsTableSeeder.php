<?php

class StudentsTableSeeder extends Seeder {

	public function run()
	{
		$students = array(
			array(
				'user_id'    =>		5,
				'reg'        =>		'2010330113',
				'batch_id'   =>		6,
				'created_at' => 	date('Y-m-d H-i-s'),
				'updated_at' => 	date('Y-m-d H-i-s')
			)
		);

		DB::table('students')->insert($students);
	}
}