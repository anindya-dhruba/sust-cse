<?php

class CourseNotice extends Eloquent {

	protected $table = 'course_notice';

	function user()
	{
		return $this->belongsTo('User');
	}

	function course()
	{
		return $this->belongsTo('Course');
	}
}