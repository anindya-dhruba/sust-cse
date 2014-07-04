<?php

class UsersTableSeeder extends Seeder {

	public function run()
	{
		$users = [
			[
				'full_name'  =>		'Admin',
				'nick_name'  =>		'Admin',
				'email'      =>		'admin@sust.edu',
				'password'   =>		Hash::make('admin'),
				'role_id'    =>		1,
				'created_at' =>		date('Y-m-d H-i-s'),
				'updated_at' =>		date('Y-m-d H-i-s')
			],
			[
				'full_name'  =>		'Head of Department',
				'nick_name'  =>		'Head of Department',
				'email'      =>		'head@sust.edu',
				'password'   =>		Hash::make('head'),
				'role_id'    =>		2,
				'created_at' =>		date('Y-m-d H-i-s'),
				'updated_at' =>		date('Y-m-d H-i-s')
			]
		];

		for ($i=3; $i <=65 ; $i++)
		{
			$users[] = [
				'full_name'  =>		"User $i",
				'nick_name'  =>		"User{$i}",
				'email'      =>		"user{$i}@sust.edu",
				'password'   =>		Hash::make("user{$i}"),
				'role_id'    =>		4,
				'created_at' =>		date('Y-m-d H-i-s'),
				'updated_at' =>		date('Y-m-d H-i-s')
			];
		}

		DB::table('users')->insert($users);
	}
}