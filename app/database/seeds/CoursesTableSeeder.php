<?php

class CoursesTableSeeder extends Seeder {

	public function run()
	{
		$courses = array(
			array(
				'course_code'	=>	'CSE 101',
				'url'			=>	'cse-101',
				'title'			=>	'Programming with C',
				'credit'    	=>	3,
				'type'			=>	'Major',
				'semester'		=>	'1/1',
				'details'		=>	'Course Details',
				'created_at' 	=> 	date('Y-m-d H-i-s'),
				'updated_at' 	=> 	date('Y-m-d H-i-s')
			)
		);

		DB::table('courses')->insert($courses);
	}
}