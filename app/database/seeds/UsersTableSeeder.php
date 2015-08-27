<?php

use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

//		foreach(range(1, 40) as $item) {
//			$reg = (rand(0, 1) == 0) ? null : $faker->randomNumber();
//			$role_id = ($reg) ? 5 : rand(1, 4);
//			$role_id = ($role_id == 2) ? 3 : $role_id;
//			$designation = $faker->bs;
//			$designation = ($role_id == 5) ? null: $designation;
//			$designation = ($role_id == 3) ? $faker->randomElement(User::$designations): $designation;
//
//			$users [] = [
//				'first_name'  => $faker->firstName,
//				'middle_name' => $faker->lastName,
//				'last_name'   => $faker->lastName,
//				'tagname'     => $faker->stateAbbr,
//				'reg'         => $reg,
//				'batch_id'    => ($role_id == 5) ? Batch::orderByRaw("RAND()")->first()->id: null,
//				'email'       => $faker->email,
//				'password'    => Hash::make('1'),
//				'role_id'     => $role_id,
//				'designation' => $designation,
//				'created_at'  => $faker->dateTimeBetween('-2 years'),
//				'updated_at'  => $faker->dateTimeBetween('-2 years')
//			];
//		}
//
//		$users [] = [
//			'first_name'  => 'Md. Saiful',
//			'middle_name' => 'Islam',
//			'last_name'   => 'Saif',
//			'tagname'     => "SK",
//			'reg'         => null,
//			'batch_id'    => null,
//			'email'       => 'faculty@sust.edu',
//			'password'    => Hash::make('1'),
//			'role_id'     => 3,
//			'designation' => "Lecturer",
//			'created_at'  => $faker->dateTimeBetween('-2 years'),
//			'updated_at'  => $faker->dateTimeBetween('-2 years')
//		];
//
//		$users [] = [
//			'first_name'  => 'Random',
//			'middle_name' => '',
//			'last_name'   => 'Stuff',
//			'tagname'     => "RS",
//			'reg'         => null,
//			'batch_id'    => null,
//			'email'       => 'staff@sust.edu',
//			'password'    => Hash::make('1'),
//			'role_id'     => 4,
//			'designation' => "Lab Assistant",
//			'created_at'  => $faker->dateTimeBetween('-2 years'),
//			'updated_at'  => $faker->dateTimeBetween('-2 years')
//		];
//
//		DB::table('users')->insert($users);

		DB::table('users')->insert([
			'first_name'  	=>	"Dr. Md.",
			'middle_name' 	=>	"Shahidur",
			'last_name'   	=> 	"Rahman",
			'tagname'     	=>	"SR",
			'reg'         	=>	null,
			'batch_id'    	=>	null,
			'email'       	=>	'head@sust.edu',
			'password'    	=>	Hash::make('1'),
			'role_id'     	=>	2,
			'designation' 	=>	"Head of the department",
			'created_at'  	=>	$faker->date(),
			'updated_at'  	=>	$faker->date(),
			'gender'	  	=>	"Male",
			'religion'	  	=>	"Islam",
			'nationality'	=>	"Bangladeshi",
			'marital_status'=>	"Married",
			'status' => 'Current',
		]);


	}
}