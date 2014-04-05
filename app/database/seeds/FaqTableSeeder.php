<?php

class FaqTableSeeder extends Seeder {

	public function run()
	{
		$faqs = array(
			array(
				'question'      =>		'Question',
				'url'        =>		'question-url',
				'answer'    =>		'This is answer',
				'created_at' => 	date('Y-m-d H-i-s'),
				'updated_at' => 	date('Y-m-d H-i-s')
			)
		);

		DB::table('faq')->insert($faqs);
	}
}