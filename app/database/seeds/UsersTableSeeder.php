<?php

use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 40) as $item) {
			$reg = (rand(0, 1) == 0) ? null : $faker->randomNumber();
			$role_id = ($reg) ? 5 : rand(1, 4);
			$role_id = ($role_id == 2) ? 3 : $role_id;
			$designation = $faker->bs;
			$designation = ($role_id == 5) ? null: $designation;
			$designation = ($role_id == 3) ? $faker->randomElement(User::$designations): $designation;

			$users [] = [
				'first_name'  => $faker->firstName,
				'middle_name' => $faker->lastName,
				'last_name'   => $faker->lastName,
				'tagname'     => $faker->stateAbbr,
				'reg'         => $reg,
				'degree'      => $faker->randomElement(['Undergraduate', 'Graduate', NULL]),
				'batch_id'    => ($role_id == 5) ? Batch::orderByRaw("RAND()")->first()->id: null,
				'email'       => $faker->email,
				'password'    => Hash::make('1'),
				'role_id'     => $role_id,
				'designation' => $designation,
				'created_at'  => $faker->dateTimeBetween('-2 years'),
				'updated_at'  => $faker->dateTimeBetween('-2 years')
			];
		}

		$users [] = [
			'first_name'  => 'Md. Saiful',
			'middle_name' => 'Islam',
			'last_name'   => 'Saif',
			'tagname'     => "SK",
			'reg'         => null,
			'degree'      => null,
			'batch_id'    => null,
			'email'       => 'faculty@sust.edu',
			'password'    => Hash::make('1'),
			'role_id'     => 3,
			'designation' => "Lecturer",
			'created_at'  => $faker->dateTimeBetween('-2 years'),
			'updated_at'  => $faker->dateTimeBetween('-2 years')
		];

		$users [] = [
			'first_name'  => 'Random',
			'middle_name' => '',
			'last_name'   => 'Stuff',
			'tagname'     => "RS",
			'reg'         => null,
			'degree'      => null,
			'batch_id'    => null,
			'email'       => 'staff@sust.edu',
			'password'    => Hash::make('1'),
			'role_id'     => 4,
			'designation' => "Lab Assistant",
			'created_at'  => $faker->dateTimeBetween('-2 years'),
			'updated_at'  => $faker->dateTimeBetween('-2 years')
		];

		DB::table('users')->insert($users);
		DB::table('users')->insert([
			'first_name'  	=>	"Dr. Md. Shohidur",
			'middle_name' 	=>	"Rahman",
			'last_name'   	=> 	"Shohid",
			'tagname'     	=>	"SR",
			'reg'         	=>	null,
			'batch_id'    	=>	null,
			'email'       	=>	'head@sust.edu',
			'password'    	=>	Hash::make('1'),
			'role_id'     	=>	2,
			'designation' 	=>	"Head of the department",
			'created_at'  	=>	$faker->dateTimeBetween('-2 years'),
			'updated_at'  	=>	$faker->dateTimeBetween('-2 years'),
			'fathers_name'	=>	$faker->name,
			'mothers_name'	=>	$faker->name,
			'gender'	  	=>	"Male",
			'phone'		  	=>	"0821-1128-221",
			'mobile'	  	=>	"01723291937",
			'alt_email'	  	=>	"alt@email.com",
			'website'	  	=>	"http://www.example.com",
			'religion'	  	=>	"Islam",
			'nationality'	=>	"Bangladeshi",
			'date_of_birth'	=>	$faker->date(),
			'place_of_birth'=>	"Bangladesh",
			'marital_status'=>	"Married",
			'blood_group'	=>	"A",
			'blood_type'	=>	"+ve",
			'current_employment' => $faker->text(),
			'employment_history' => $faker->text(),
			'present_address' => $faker->text(),
			'permanent_address' => $faker->text(),
			'about' => $faker->text(),
			'contact_room' => $faker->randomDigit,
			'academic_background' => $faker->text(),
			'prof_exp' => $faker->text(),
			'awards_and_honors' => $faker->text(),
			'interests' => $faker->text(),
			'status' => 'Current',
			'publications' => $faker->text()
		]);


	}
}