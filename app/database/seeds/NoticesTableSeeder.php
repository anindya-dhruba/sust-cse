<?php

class NoticesTableSeeder extends Seeder {

	public function run()
	{
		$notices = [];
		for ($i=1; $i<=30; $i++)
		{
			$notices[] = [
				'title'      =>		"This is demo notice $i",
				'url'        =>		"demo-notice-$i",
				'notice'     =>		"Lorem ipsum dolor sit amet, $i consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.",
				'user_id'    =>		4,
				'is_public'  =>		1,
				'created_at' => 	date('Y-m-d H-i-s'),
				'updated_at' => 	date('Y-m-d H-i-s')
			];
		}

		DB::table('notices')->insert($notices);
	}
}