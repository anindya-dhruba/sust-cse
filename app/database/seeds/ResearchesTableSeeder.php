<?php

class ResearchesTableSeeder extends Seeder {

	public function run()
	{
		$researches = [];

		for ($i=1; $i<=20 ; $i++)
		{
			$researches[] = [
				'name'      	=>		"Research $i",
				'url'        	=>		"researches-{$i}",
				'description' 	=>		'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
				'created_at' 	=> 	date('Y-m-d H-i-s'),
				'updated_at' 	=> 	date('Y-m-d H-i-s')
			];
		}

		DB::table('researches')->insert($researches);
	}
}

