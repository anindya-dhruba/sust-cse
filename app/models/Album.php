<?php

class Album extends Eloquent {

	protected $table = 'albums';

	public function user()
	{
		return $this->belongsTo('User');
	}
}