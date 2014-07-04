<?php

class EventsTableSeeder extends Seeder {

	public function run()
	{
		$events = [];
		for ($i=1; $i<=50; $i++)
		{
			$events[] = [
				'title'      =>		"This is demo event $i",
				'url'        =>		"demo-event-$i",
				'event'      =>		"Lorem ipsum dolor sit amet, $i consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.",
				'start_date' =>		"2014-06-12",
				'end_date' 	 =>		"2014-06-15",
				'user_id'    =>		4,
				'is_public'  =>		1,
				'created_at' => 	date('Y-m-d H-i-s'),
				'updated_at' => 	date('Y-m-d H-i-s')
			];
		}

		DB::table('events')->insert($events);
	}
}