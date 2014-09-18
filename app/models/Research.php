<?php

class Research extends Eloquent {

	protected $table = 'researches';

	public function users()
	{
		return $this->belongsToMany('User', 'faculty_research');
	}

}