<?php

// can not use the name "Event" as this is reserved in Laravel 4
class AppEvent extends Eloquent {

	protected $table = 'events';

	public function user()
	{
		return $this->belongsTo('User');
	}
}