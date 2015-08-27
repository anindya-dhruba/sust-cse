<?php

use Faker\Factory as Faker;
class BatchesTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		$batches = [];
		foreach(range(1, 10) as $item)
		{
			$batches[] = [
				'type'  =>	$faker->randomElement(['Undergraduate-Major', 'Undergraduate-Second Major', 'Graduate-Masters', 'Graduate-Ph.D.']),
				'Year'  =>	$faker->randomElement(range(1992, 2014))
			];
		}

		DB::table('batches')->insert($batches);
	}
}