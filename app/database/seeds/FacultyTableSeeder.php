<?php

class FacultyTableSeeder extends Seeder {

	public function run()
	{
		$faculty = [];

		for ($i=3; $i<=23; $i++)
		{
			$faculty[] = [
				'user_id'             =>		$i,
				'designation'         =>		'Lecturer',
				'tagname'         	  =>		"mzi{$i}",
				'alt_email'           =>		'con_email@sust.edu',
				'mobile'              =>		'123456',
				'contact_room'        =>		'Room no : 107',
				'academic_background' =>		'Education',
				'prof_exp'            =>		'Prof Experience',
				'awards_and_honors'   =>		'Honors',
				'interests'           =>		'Interests',
				'about'               =>		'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
				'present_address'     => 		'present address',
				'status'              => 		'Current',
				'created_at'          => 		date('Y-m-d H-i-s'),
				'updated_at'          => 		date('Y-m-d H-i-s')
			];
		}
		
		DB::table('faculty')->insert($faculty);
	}
}