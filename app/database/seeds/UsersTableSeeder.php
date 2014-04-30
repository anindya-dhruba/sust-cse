<?php

class UsersTableSeeder extends Seeder {

	public function run()
	{
		$users = array(
			array(
				'full_name'  =>'Admin',
				'nick_name'  =>'Admin',
				'email'      =>'admin@sust.edu',
				'password'   => Hash::make('admin'),
				'role_id'    => 1,
				'created_at' => date('Y-m-d H-i-s'),
				'updated_at' => date('Y-m-d H-i-s')
			),
			array(
				'full_name'  =>'Head of Department',
				'nick_name'  =>'Head of Department',
				'email'      =>'head@sust.edu',
				'password'   => Hash::make('head'),
				'role_id'    => 2,
				'created_at' => date('Y-m-d H-i-s'),
				'updated_at' => date('Y-m-d H-i-s')
			),
			array(
				'full_name'  =>'Faculty',
				'nick_name'  =>'Faculty',
				'email'      =>'faculty@sust.edu',
				'password'   => Hash::make('faculty'),
				'role_id'    => 3,
				'created_at' => date('Y-m-d H-i-s'),
				'updated_at' => date('Y-m-d H-i-s')
			),
			array(
				'full_name'  =>'Stuff',
				'nick_name'  =>'Stuff',
				'email'      =>'stuff@sust.edu',
				'password'   => Hash::make('stuff'),
				'role_id'    => 4,
				'created_at' => date('Y-m-d H-i-s'),
				'updated_at' => date('Y-m-d H-i-s')
			),
			array(
				'full_name'  =>'Student',
				'nick_name'  =>'Student',
				'email'      =>'student@sust.edu',
				'password'   => Hash::make('student'),
				'role_id'    => 5,
				'created_at' => date('Y-m-d H-i-s'),
				'updated_at' => date('Y-m-d H-i-s')
			)
		);

		DB::table('users')->insert($users);
	}
}