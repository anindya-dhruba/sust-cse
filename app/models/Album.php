<?php

class Album extends Eloquent {

	protected $table = 'albums';

	public function user()
	{
		return $this->belongsTo('User');
	}

	public function pictures()
	{
		return $this->hasMany('Picture');
	}
}