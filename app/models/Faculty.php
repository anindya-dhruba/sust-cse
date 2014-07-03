<?php

class Faculty extends Eloquent {

	protected $table = 'faculty';
	protected $primaryKey = 'tagname';

	public static $statusOptions = array
	(
		'Current' 		=> 'Current',
		'On Leave'		=> 'On Leave',
		'Not Available'	=> 'Not Available'
	);

	public static $designations = array
	(
		'Lecturer'					=>	'Lecturer',
		'Professor'					=>	'Professor',
		'Associate Professor'		=>	'Associate Professor',
		'Head of the Department'	=>	'Head of the Department'
	);
	
	public function user()
	{
		return $this->belongsTo('User');
	}
}