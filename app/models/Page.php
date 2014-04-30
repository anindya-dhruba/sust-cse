<?php

class Page extends Eloquent {

	protected $table = 'pages';

	public function menu()
	{
		return $this->hasOne('Menu');
	}
}