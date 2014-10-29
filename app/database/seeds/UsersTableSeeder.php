<?php

class UsersTableSeeder extends Seeder {

	public function run()
	{
		$users = [
			[
				'full_name'  =>		'Admin',
				'nick_name'  =>		'Admin',
				'tagname'	 =>		null,
				'reg'		 =>		null,
				'batch_id'	 =>		null,
				'email'      =>		'admin@sust.edu',
				'password'   =>		Hash::make('1'),
				'role_id'    =>		1,
				'designation'=>		null,
				'created_at' =>		date('Y-m-d H-i-s'),
				'updated_at' =>		date('Y-m-d H-i-s')
			],
			[
				'full_name'  =>		'Dr. Shohidur Rahman',
				'nick_name'  =>		'',
				'tagname'	 =>		'SR',
				'reg'		 =>		null,
				'batch_id'	 =>		null,
				'email'      =>		'head@sust.edu',
				'password'   =>		Hash::make('1'),
				'role_id'    =>		2,
				'designation'=>		'Head of the Department',
				'created_at' =>		date('Y-m-d H-i-s'),
				'updated_at' =>		date('Y-m-d H-i-s')
			],
			[
				'full_name'  =>		'Mr. Saiful Islam Khan',
				'nick_name'  =>		'Saif',
				'tagname'	 =>		'SIK',
				'reg'		 =>		null,
				'batch_id'	 =>		null,
				'email'      =>		'faculty@sust.edu',
				'password'   =>		Hash::make('1'),
				'role_id'    =>		3,
				'designation'=>		'Lecturer',
				'created_at' =>		date('Y-m-d H-i-s'),
				'updated_at' =>		date('Y-m-d H-i-s')
			],
			[
				'full_name'  =>		'Stuff Name',
				'nick_name'  =>		'Stuff',
				'tagname'	 =>		'tag-staff',
				'reg'		 =>		null,
				'batch_id'	 =>		null,
				'email'      =>		'staff@sust.edu',
				'password'   =>		Hash::make('1'),
				'role_id'    =>		4,
				'designation'=>		'Lab Assistant',
				'created_at' =>		date('Y-m-d H-i-s'),
				'updated_at' =>		date('Y-m-d H-i-s')
			],
			[
				'full_name'  =>		'Student Name',
				'nick_name'  =>		'Student',
				'tagname'	 =>		null,
				'reg'		 =>		'2010331001',
				'batch_id'	 =>		1,
				'email'      =>		'student@sust.edu',
				'password'   =>		Hash::make('1'),
				'role_id'    =>		5,
				'designation'=>		null,
				'created_at' =>		date('Y-m-d H-i-s'),
				'updated_at' =>		date('Y-m-d H-i-s')
			]

		];

		// for ($i=6; $i <=100 ; $i++)
		// {
		// 	$role_id = rand(3, 5);
		// 	$users[] = [
		// 		'full_name'  =>		"User $i",
		// 		'nick_name'  =>		"User{$i}",
		// 		'tagname' 	 =>		(($role_id == 3) || ($role_id == 4)) ? Str::random(3) : null,
		// 		'reg' 	     =>		($role_id == 5) ? "20103310{$i}" : null,
		// 		'batch_id'	 =>		($role_id == 5) ? 1 : null,
		// 		'email'      =>		"user{$i}@sust.edu",
		// 		'password'   =>		Hash::make("user{$i}"),
		// 		'role_id'    =>		$role_id,
		// 		'designation'=>		($role_id == 3) ? "Lecturer" : null,
		// 		'created_at' =>		date('Y-m-d H-i-s'),
		// 		'updated_at' =>		date('Y-m-d H-i-s')
		// 	];
		// }

		DB::table('users')->insert($users);
	}
}