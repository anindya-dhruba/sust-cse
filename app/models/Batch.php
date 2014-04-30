<?php

class Batch extends Eloquent {

	protected $table = 'batches';

	public function students()
	{
		return $this->hasMany('Student');
	}
}