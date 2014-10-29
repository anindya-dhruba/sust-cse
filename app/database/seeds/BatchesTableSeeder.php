<?php

class BatchesTableSeeder extends Seeder {

	public function run()
	{
		$batches = array(
			array(
				'name'  =>	'1st',
				'Year'  =>	'1992'
			),
			array(
				'name'  =>	'2nd',
				'Year'  =>	'1993'
			),
			array(
				'name'  =>	'3rd',
				'Year'  =>	'1994'
			),
			array(
				'name'  =>	'4th',
				'Year'  =>	'1995'
			),
			array(
				'name'  =>	'5th',
				'Year'  =>	'1996'
			),
			array(
				'name'  =>	'6th',
				'Year'  =>	'1997'
			),
			array(
				'name'  =>	'7th',
				'Year'  =>	'1998'
			),
			array(
				'name'  =>	'8th',
				'Year'  =>	'1999'
			),
			array(
				'name'  =>	'9th',
				'Year'  =>	'2000'
			),
			array(
				'name'  =>	'10th',
				'Year'  =>	'2001'
			),
			array(
				'name'  =>	'11th',
				'Year'  =>	'2002'
			),
			array(
				'name'  =>	'12th',
				'Year'  =>	'2003'
			),
			array(
				'name'  =>	'13th',
				'Year'  =>	'2004'
			),
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
			),
			array(
				'name'  =>	'22th',
				'Year'  =>	'2013'
			)
		);

		DB::table('batches')->insert($batches);
	}
}