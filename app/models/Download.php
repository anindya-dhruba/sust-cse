<?php

class Download extends Eloquent {

	protected $table = 'downloads';

	public function user()
	{
		return $this->belongsTo('User');
	}
}