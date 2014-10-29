<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	protected $table = 'users';
	protected $hidden = array('password', 'remember_token');

	public static $genders = array
	(
		''       =>	'Not Specified',
		'Male'   =>	'Male', 
		'Female' =>	'Female'
	);

	public static $marital_statuses = array
	(
		'Single'   =>	'Single',
		'Married'  =>	'Married', 
		'Divorced' =>	'Divorced'
	);

	public static $blood_groups = array
	(
		''   =>	'Not Specified',
		'A'  =>	'A',
		'B'  =>	'B',
		'AB' => 'AB',
		'O'  =>	'O'
	);

	public static $blood_types = array
	(
		''    =>	'Not Specified',
		'+ve' =>	'+ve',
		'-ve' =>	'-ve'
	);

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
		'Assistant Professor'		=>	'Assistant Professor',
		'Head of the Department'	=>	'Head of the Department'
	);

	public function scopeFaculty($query)
	{
		return $query->whereIn('role_id',  [2,3]);
	}

	public function scopeStaff($query)
	{
		return $query->where('role_id', '=', 4);
	}

	public function scopeStudent($query)
	{
		return $query->where('role_id', '=', 5);
	}

	public function events()
	{
		return $this->hasMany('Event')
						->orderBy('start_date', 'desc');
	}

	public function pictures()
	{
		return $this->hasMany('Download')
						->where('type', '=', 'Profile Picture')
						->orderBy('updated_at', 'desc');
	}

	public function role()
	{
		return $this->belongsTo('Role');
	}

	public function batch()
	{
		return $this->belongsTo('Batch');
	}

	public function researches()
	{
		return $this->belongsToMany('Research', 'faculty_research');
	}

	
	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

	public function getRememberToken()
	{
	    return $this->remember_token;
	}

	public function setRememberToken($value)
	{
	    $this->remember_token = $value;
	}

	public function getRememberTokenName()
	{
	    return 'remember_token';
	}

}