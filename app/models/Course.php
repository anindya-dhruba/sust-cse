<?php

class Course extends Eloquent {

	public function prerequisiteCourse()
	{
		return $this->belongsTo('Course', 'prerequisite');
	}

	public static $typeOptions = [
		'Major' => 	'Major',
		'Minor'	=>	'Minor'
	];

	public static $semesterOptions = [
		'1/1'	=>	'1/1',
		'1/2'	=>	'1/2',
		'2/1'	=>	'2/1',
		'2/2'	=>	'2/2',
		'3/1'	=>	'3/1',
		'3/2'	=>	'3/2',
		'4/1'	=>	'4/1',
		'4/2'	=>	'4/2'
	];

	public static function prerequisiteOptions($except = 0)
	{
		$courses = self::orderBy('semester')
							->where('id', '!=', $except)
							->get();

		$returnCourses = [];
		foreach ($courses as $key => $course)
		{
			$returnCourses[$course->id] = $course->course_code." - ".$course->title;
		}

		return ['' => 'No prerequisite course'] + $returnCourses;

	}

}