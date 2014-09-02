<?php

class Role extends Eloquent {

	public function users()
	{
		return $this->hasMany('User');
	}
}