<?php

class FacultyTableSeeder extends Seeder {

	public function run()
	{
		$faculty = array(
			array(
				'user_id'        =>		3,
				'designation'    =>		'Lecturer',
				'contact_email'  =>		'con_email@sust.edu',
				'contact_mobile' =>		'123456',
				'contact_room'   =>		'Room no : 107',
				'education'      =>		'Education',
				'prof_exp'       =>		'Prof Experience',
				'honors'         =>		'Honors',
				'research'       =>		'Research',
				'interests'      =>		'Interests',
				'bio'            =>		'Room no : 107',
				'home_address'   => 	'home address',
				'status'         => 	'Current',
				'created_at'     => 	date('Y-m-d H-i-s'),
				'updated_at'     => 	date('Y-m-d H-i-s')
			)
		);

		DB::table('faculty')->insert($faculty);
	}
}