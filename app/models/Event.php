<?php

class Event extends Eloquent {

	protected $table = 'events';

	function user()
	{
		return $this->belongsTo('User');
	}
}