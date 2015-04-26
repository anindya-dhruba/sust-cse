<?php

class News extends Eloquent {

	protected $table = 'news';

	function user()
	{
		return $this->belongsTo('User');
	}
}