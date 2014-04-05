<?php

class PicturesTableSeeder extends Seeder {

	public function run()
	{
		$pictures = array(
			array(
				'album_id'      =>	1,
				'caption'  		=>	'Picture 1',
				'url'       	=>	'picture-1',
				'is_cover' 		=> 	true,
				'details'		=>	'picture details',
				'created_at'   	=> 	date('Y-m-d H-i-s'),
				'updated_at'   	=> 	date('Y-m-d H-i-s')
			)
		);

		DB::table('pictures')->insert($pictures);
	}
}