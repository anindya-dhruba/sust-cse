<?php

class Notice extends Eloquent {

	protected $table = 'notices';

	function user()
	{
		return $this->belongsTo('User');
	}
}