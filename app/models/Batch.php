<?php

class Batch extends Eloquent {

	protected $table = 'batches';

	public function users()
	{
		return $this->hasMany('User')
						->where('role_id', '=', 5);
	}
}