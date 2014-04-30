<?php

class RolesTableSeeder extends Seeder {

	public function run()
	{
		$roles = array(
			array('name' =>'Admin'),
			array('name' =>'Head Of Department'),
			array('name' =>'Faculty'),
			array('name' =>'Stuff'),
			array('name' =>'Student')
		);

		DB::table('roles')->insert($roles);
	}
}