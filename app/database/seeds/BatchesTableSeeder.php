<?php

class BatchesTableSeeder extends Seeder {

	public function run()
	{
		$batches = array(
			array(
				'name'  =>	'14th',
				'Year'  =>	'2005'
			),
			array(
				'name'  =>	'15th',
				'Year'  =>	'2006'
			),
			array(
				'name'  =>	'16th',
				'Year'  =>	'2007'
			),
			array(
				'name'  =>	'17th',
				'Year'  =>	'2008'
			),
			array(
				'name'  =>	'18th',
				'Year'  =>	'2009'
			),
			array(
				'name'  =>	'19th',
				'Year'  =>	'2010'
			),
			array(
				'name'  =>	'20th',
				'Year'  =>	'2011'
			),
			array(
				'name'  =>	'21th',
				'Year'  =>	'2012'
			)
		);

		DB::table('batches')->insert($batches);
	}
}