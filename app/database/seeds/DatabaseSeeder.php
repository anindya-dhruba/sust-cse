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
		$this->call('BatchesTableSeeder');
		$this->call('UsersTableSeeder');
		$this->call('NoticesTableSeeder');
		$this->call('AlbumsTableSeeder');
		$this->call('PicturesTableSeeder');
		$this->call('PagesTableSeeder');
		$this->call('FaqTableSeeder');
		$this->call('CoursesTableSeeder');
		$this->call('DownloadsTableSeeder');
		$this->call('MenusTableSeeder');
		$this->call('EventsTableSeeder');
		$this->call('ResearchesTableSeeder');
	}

}