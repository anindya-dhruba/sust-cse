<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('RolesTableSeeder');
		$this->call('UsersTableSeeder');
		$this->call('StuffTableSeeder');
		$this->call('FacultyTableSeeder');
		$this->call('NoticesTableSeeder');
		$this->call('AlbumsTableSeeder');
		$this->call('PicturesTableSeeder');
		$this->call('BatchesTableSeeder');
		$this->call('StudentsTableSeeder');
		$this->call('PagesTableSeeder');
		$this->call('FaqTableSeeder');
		$this->call('CoursesTableSeeder');
		$this->call('DownloadsTableSeeder');
		$this->call('MenuTableSeeder');
	}

}