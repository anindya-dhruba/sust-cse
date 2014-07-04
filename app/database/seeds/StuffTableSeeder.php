<?php

class StuffTableSeeder extends Seeder {

	public function run()
	{
		$stuffs = [];

		for ($i=24; $i <=44 ; $i++)
		{
			$stuffs[] = [
				'user_id'         =>	$i,
				'designation'     =>	'Store Officer',
				'mobile'          =>	'123456',
				'present_address' => 	'present address',
				'status'          => 	'Current',
				'created_at'      => 	date('Y-m-d H-i-s'),
				'updated_at'      => 	date('Y-m-d H-i-s')
			];
		}

		DB::table('stuff')->insert($stuffs);
	}
}