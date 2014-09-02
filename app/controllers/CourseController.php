<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;

class CourseController extends BaseController {

	/**
	 * View all courses
	 * @return void
	 */
	public function index()
	{
		if(!$this->permission['courses']) return Redirect::to('/');

		$courses = Course::orderBy('semester')->paginate(10);

		return View::make('courses.index')
						->with('title', 'Viewing All Courses')
						->with('courses', $courses);
	}

	/**
	 * Generates slug/url for course
	 * @return string
	 */
	public function generateUrl()
	{
		if(!$this->permission['courses']) return Redirect::to('/');
		
		$url = Str::slug(Input::get('course_code'));
		$urlCount = count(Course::where('url', '=', $url)->get());
		return ($urlCount > 0) ? "{$url}-{$urlCount}" : $url;
	}

	/**
	 * Show a  course
	 * @param  string $url
	 * @return void
	 */
	public function show($url)
	{
		if(!$this->permission['courses']) return Redirect::to('/');
		
		try
		{
		    $course = Course::where('url', '=', $url)->firstOrFail();

		    return View::make('courses.show')
						->with('title', $course->course_code)
						->with('course', $course);
		}
		catch(ModelNotFoundException $e)
		{
		   return "Page not found.";
		}
	}

	/**
	 * add a course
	 */
	public function add()
	{
		if(!$this->permission['courses']) return Redirect::to('/');

		return View::make('courses.add')
						->with('title', 'Add New Course');
	}

	/**
	 * Do Add a course
	 * @return void
	 */
	public function doAdd()
	{
		if(!$this->permission['courses']) return Redirect::to('/');
		
		$rules = array
		(
	    	'title' 		=> 'required|unique:courses',
	    	'course_code' 	=> 'required|unique:courses',
	    	'url' 			=> 'required|unique:courses',
	    	'credit'	 	=> 'required|numeric'
		);

		$validation = Validator::make(Input::all(), $rules);
		
		if($validation->fails())
			return Redirect::back()
								->withInput()
								->withErrors($validation);
		else
		{
			$course               = new Course;
			$course->title        = Input::get('title');
			$course->course_code  = Input::get('course_code');
			$course->url          = Input::get('url');
			$course->credit       = Input::get('credit');
			$course->type         = Input::get('type');
			$course->semester     = Input::get('semester');
			$course->prerequisite = (Input::get('prerequisite') == '') ? null : Input::get('prerequisite');
			$course->details      = Input::get('details');

			if($course->save())
			{
			    return Redirect::route('admin.courses.show', array('url' => $course->url))
			    					->with('success', "Course '$course->title' has added successfully.");
			}
			else
				return Redirect::back()
									->withInput()
									->with('error', 'Some error occured. Try again.');
		}
	}

	/**
	 * Edit a course
	 * @param  string $url
	 * @return void
	 */
	public function edit($url)
	{
		if(!$this->permission['courses']) return Redirect::to('/');
		
		try
		{
		    $course = Course::where('url', '=', $url)->firstOrFail();

		    return View::make('courses.edit')
						->with('title', "Editing Course")
						->with('course', $course);
		}
		catch(ModelNotFoundException $e)
		{
		   return "Page not found.";
		}
	}

	/**
	 * Do edit a course
	 * @param  string $url
	 * @return void
	 */
	public function doEdit($url)
	{
		if(!$this->permission['courses']) return Redirect::to('/');
		
		$rules = array
		(
	    	'title' 		=> 'required|unique:courses,title,'.Input::get('courseId'),
	    	'course_code' 	=> 'required|unique:courses,course_code,'.Input::get('courseId'),
	    	'url' 			=> 'required|unique:courses,url,'.Input::get('courseId'),
	    	'credit'	 	=> 'required|numeric'
		);

		$validation = Validator::make(Input::all(), $rules);
		
		if($validation->fails())
			return Redirect::back()
								->withInput()
								->withErrors($validation);
		else
		{
			$course               = Course::where('url', '=', $url)->first();
			$course->title        = Input::get('title');
			$course->course_code  = Input::get('course_code');
			$course->url          = Input::get('url');
			$course->credit       = Input::get('credit');
			$course->type         = Input::get('type');
			$course->semester     = Input::get('semester');
			$course->prerequisite = (Input::get('prerequisite') == '') ? null : Input::get('prerequisite');
			$course->details      = Input::get('details');

			if($course->save())
			{
			    return Redirect::route('admin.courses.show', array('url' => $course->url))
			    					->with('success', "Course '$course->title' has updated successfully.");
			}
			else
				return Redirect::back()
									->withInput()
									->with('error', 'Some error occured. Try again.');
		}
	}

	/**
	 * Delete a course
	 * @param  string $url
	 * @return void
	 */
	public function delete($id)
	{
		if(!$this->permission['courses']) return Redirect::to('/');
		
		$course = Course::find($id);
		
		if($course->delete())
			return Redirect::route('admin.courses')
									->with('success', "The course has been deleted.");
		else
			return Redirect::route('admin.courses')
									->with('error', 'Some error occured. Try again.');
	}
}

