<?php

class AlbumsTableSeeder extends Seeder {

	public function run()
	{
		$albums = array(
			array(
				'name'      	=>	'CSE 10 batch',
				'url'  			=>	'cse-10-batch',
				'details'       =>	'Album Details',
				'user_id' 		=> 	5,
				'created_at'   	=> 	date('Y-m-d H-i-s'),
				'updated_at'   	=> 	date('Y-m-d H-i-s')
			)
		);

		DB::table('albums')->insert($albums);
	}
}