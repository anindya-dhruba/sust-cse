<?php

class Batch extends Eloquent {

	protected $table = 'batches';

	public static function typeList()
	{
		return [
			'Undergraduate-Major'			=> 'Undergraduate-Major',
			'Undergraduate-Second Major'	=> 'Undergraduate-Second Major',
			'Graduate-Masters'				=> 'Graduate-Masters',
			'Graduate-Ph.D.'				=> 'Graduate-Ph.D.'
		];

	}

	public static function lists()
	{
		$batches = Batch::orderBy('year', 'desc')->orderBy('type')->get();

		$batchList = [];
		foreach($batches as $batch){
			$batchList[$batch->id] = "{$batch->year} - {$batch->type}";
		}

		return $batchList;
	}

	public function users()
	{
		return $this->hasMany('User')
						->where('role_id', '=', 5);
	}

}