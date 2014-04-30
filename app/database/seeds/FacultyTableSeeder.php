<?php

class FacultyTableSeeder extends Seeder {

	public function run()
	{
		$faculty = array(
			array(
				'user_id'             =>		3,
				'designation'         =>		'Lecturer',
				'alt_email'           =>		'con_email@sust.edu',
				'mobile'              =>		'123456',
				'contact_room'        =>		'Room no : 107',
				'academic_background' =>		'Education',
				'prof_exp'            =>		'Prof Experience',
				'awards_and_honors'              =>		'Honors',
				'interests'           =>		'Interests',
				'about'               =>		'bio',
				'present_address'     => 		'present address',
				'status'              => 		'Current',
				'created_at'          => 		date('Y-m-d H-i-s'),
				'updated_at'          => 		date('Y-m-d H-i-s')
			)
		);

		DB::table('faculty')->insert($faculty);
	}
}