<?php

class Menu extends Eloquent {

	protected $table = 'menus';
	public $timestamps = false;

	public function page()
	{
		return $this->belongsTo('Page');
	}
}