<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	protected $table = 'users';
	protected $hidden = array('password');

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
		''  =>	'Not Specified',
		'A' =>	'A',
		'B' =>	'B', 
		'O' =>	'O'
	);

	public static $blood_types = array
	(
		''    =>	'Not Specified',
		'+ve' =>	'+ve',
		'-ve' =>	'-ve'
	);

	public function student()
	{
		return $this->hasOne('Student');
	}

	public function pictures()
	{
		return $this->hasMany('Download')
						->where('type', '=', 'Profile Picture')
						->orderBy('updated_at', 'desc');
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

}