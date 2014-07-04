<?php

class StudentsTableSeeder extends Seeder {

	public function run()
	{
		$students = [];

		for ($i=45; $i <=65 ; $i++)
		{
			$students[] = [
				'user_id'    =>		$i,
				'reg'        =>		"20103310{$i}",
				'batch_id'   =>		6,
				'created_at' => 	date('Y-m-d H-i-s'),
				'updated_at' => 	date('Y-m-d H-i-s')
			];
		}

		DB::table('students')->insert($students);
	}
}