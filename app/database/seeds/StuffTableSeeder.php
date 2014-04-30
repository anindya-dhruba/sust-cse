<?php

class StuffTableSeeder extends Seeder {

	public function run()
	{
		$stuffs = array(
			array(
				'user_id'         =>	4,
				'designation'     =>	'Store Officer',
				'mobile'          =>	'123456',
				'present_address' => 	'present address',
				'status'          => 	'Current',
				'created_at'      => 	date('Y-m-d H-i-s'),
				'updated_at'      => 	date('Y-m-d H-i-s')
			)
		);

		DB::table('stuff')->insert($stuffs);
	}
}