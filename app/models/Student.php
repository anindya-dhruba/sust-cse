<?php

class Student extends Eloquent {

	protected $table = 'students';
	protected $primaryKey = 'reg';

	public function user()
	{
		return $this->belongsTo('User');
	}

	public function batch()
	{
		return $this->belongsTo('Batch');
	}
}