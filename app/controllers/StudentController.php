<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;

class StudentController extends BaseController {

	/**
	 * View all students
	 * @return void
	 */
	public function index()
	{
		$students = Student::orderBy('created_at', 'desc')
							->paginate(10);

		return View::make('students.index')
						->with('title', 'Viewing All Students')
						->with('students', $students);
	}

	/**
	 * Add new student
	 */
	public function add()
	{
		return View::make('students.add')
						->with('title', 'Add New Student')
						->with('batches', Batch::orderBy('year', 'desc')->lists('year', 'id'));
	}

	/**
	 * Do Add a student
	 * @return void
	 */
	public function doAdd()
	{
		$rules = array
		(
			'reg'             => 	'required|numeric|unique:students,reg',
			'full_name'       =>	'required',
			'email'           =>	'email|unique:users,email',
			'alternate_email' =>	'email|unique:students,alt_email',
			'batch'           =>	'required',
			'picture'         =>	'image|mimes:jpeg,bmp,png',
			'date_of_birth'   =>	'date',
			'website'		  =>	'url',
			'college_passing_year' => 'digits:4',
			'school_passing_year' => 'digits:4',
		);

		$validation = Validator::make(Input::all(), $rules);
		
		if($validation->fails())
			return Redirect::route('admin.students.add')
								->withInput()
								->withErrors($validation);
		else
		{
			$user            = new User();
			$user->full_name = Input::get('full_name');
			$user->nick_name = Input::get('nick_name');
			$user->email     = Input::get('email');
			$user->role_id   = 5; // student

			if($user->save())
			{
				$student                       = new Student();
				$student->reg                  = Input::get('reg');
				$student->fathers_name         = Input::get('fathers_name');
				$student->mothers_name         = Input::get('mothers_name');
				$student->alt_email            = Input::get('alternate_email');
				$student->phone                = Input::get('phone');
				$student->mobile               = Input::get('mobile');
				$student->website              = Input::get('website');
				$student->thesis               = Input::get('thesis');
				$student->current_employment   = Input::get('current_employment');
				$student->employment_history   = Input::get('employment_history');
				$student->clg_name         = Input::get('college_name');
				$student->clg_exam_name    = Input::get('college_exam_name');
				$student->clg_passing_year = Input::get('college_passing_year');
				$student->clg_board_name   = Input::get('college_board_name');
				$student->clg_result       = Input::get('college_result');
				$student->scl_name          = Input::get('school_name');
				$student->scl_exam_name     = Input::get('school_exam_name');
				$student->scl_passing_year  = Input::get('school_passing_year');
				$student->scl_board_name    = Input::get('school_board_name');
				$student->scl_result        = Input::get('school_result');
				$student->batch_id             = Input::get('batch');
				$student->gender               = Input::get('gender');
				$student->religion             = Input::get('religion');
				$student->nationality          = Input::get('nationality');
				$student->date_of_birth        = (Input::has('date_of_birth')) ? Input::get('date_of_birth') : null;
				$student->place_of_birth       = Input::get('place_of_birth');
				$student->marital_status       = Input::get('marital_status');
				$student->blood_group          = Input::get('blood_group');
				$student->blood_type           = Input::has('blood_type');
				$student->permanent_address    = Input::get('permanent_address');
				$student->present_address      = Input::get('present_address');
				$student->about                = Input::get('about');

				$user->student()->save($student);

				// if picture is uploaded...
		       	if(Input::hasFile('picture'))
			    {
			    	$file = Input::file('picture');

			        $destinationPath = public_path('uploads/user_pictures');
			        
			        // generate random unique name [ randomStr + userId + extn ]
			        $fileName = Str::random(4, 'alpha').$user->id.".".$file->getClientOriginalExtension();

			        // original file starts with original_
			        $file->move($destinationPath, "original_".$fileName);

			        // medium resolution starts with medium_
					Image::make($destinationPath."/original_".$fileName)
					        		->resize(300, null, true)
					        		->save($destinationPath."/medium_".$fileName);

					// low resolution starts with thumbnail_
					Image::make($destinationPath."/original_".$fileName)
					        		->resize(null, 35, true)
					        		->save($destinationPath."/thumbnail_".$fileName);

					$picture = new Download();
					$picture->caption = $user->full_name;
					$picture->type = 'Profile Picture';
					$picture->url = $fileName;
						
					$student->user->pictures()->save($picture);
			    }

			    return Redirect::route('admin.students.show', array('reg' => Input::get('reg')))
			    					->with('success', "Student '$user->full_name' has added successfully.");
			}
			else
				return Redirect::route('admin.students.add')
									->withInput()
									->with('error', 'Some error occured. Try again.');
		}
	}

	/**
	 * Show a student
	 * @param  string $reg
	 * @return void
	 */
	public function show($reg)
	{
		try
		{
		    $student = student::where('reg', '=', $reg)->firstOrFail();

		    return View::make('students.show')
						->with('title', "Viewing Student")
						->with('student', $student);
		}
		catch(ModelNotFoundException $e)
		{
		   return "Page not found.";
		}
	}

	/**
	 * Edit a student
	 * @param  string $reg
	 * @return void
	 */
	public function edit($reg)
	{
		try
		{
		    $student = Student::where('reg', '=', $reg)->firstOrFail();

		    return View::make('students.edit')
						->with('title', "Editing Student Info")
						->with('batches', Batch::orderBy('year', 'desc')->lists('year', 'id'))
						->with('student', $student);
		}
		catch(ModelNotFoundException $e)
		{
		   return "Page not found.";
		}
	}

	/**
	 * Do Edit a student
	 * @return void
	 */
	public function doEdit($reg)
	{
		$rules = array
		(
			'reg'                  => 	'required|numeric|unique:students,reg,'.Input::get('studentId').',user_id',
			'full_name'            =>	'required',
			'email'                =>	'email|unique:users,email,'.Input::get('studentId'),
			'alternate_email'      =>	'email|unique:students,alt_email,'.Input::get('studentId').',user_id',
			'batch'                =>	'required',
			'picture'              =>	'image|mimes:jpeg,bmp,png',
			'date_of_birth'        =>	'date',
			'website'              =>	'url',
			'college_passing_year' => 	'digits:4',
			'school_passing_year'  => 	'digits:4'
		);

		$validation = Validator::make(Input::all(), $rules);
		
		if($validation->fails())
			return Redirect::route('admin.students.edit', array('reg' => $reg))
								->withInput()
								->withErrors($validation);
		else
		{
			$id = Input::get('studentId');
			
			$user = User::find($id);
			$user->full_name = Input::get('full_name');
			$user->nick_name = Input::get('nick_name');
			$user->email     = Input::get('email');
			if($user->save())
			{
				$student = Student::where('user_id', '=', $id)->first();
				$student->reg                  = Input::get('reg');
				$student->fathers_name         = Input::get('fathers_name');
				$student->mothers_name         = Input::get('mothers_name');
				$student->alt_email            = Input::get('alternate_email');
				$student->phone                = Input::get('phone');
				$student->mobile               = Input::get('mobile');
				$student->website              = Input::get('website');
				$student->thesis               = Input::get('thesis');
				$student->current_employment   = Input::get('current_employment');
				$student->employment_history   = Input::get('employment_history');
				$student->clg_name         = Input::get('college_name');
				$student->clg_exam_name    = Input::get('college_exam_name');
				$student->clg_passing_year = Input::get('college_passing_year');
				$student->clg_board_name   = Input::get('college_board_name');
				$student->clg_result       = Input::get('college_result');
				$student->scl_name          = Input::get('school_name');
				$student->scl_exam_name     = Input::get('school_exam_name');
				$student->scl_passing_year  = Input::get('school_passing_year');
				$student->scl_board_name    = Input::get('school_board_name');
				$student->scl_result        = Input::get('school_result');
				$student->batch_id             = Input::get('batch');
				$student->gender               = Input::get('gender');
				$student->religion             = Input::get('religion');
				$student->nationality          = Input::get('nationality');
				$student->date_of_birth        = (Input::has('date_of_birth')) ? Input::get('date_of_birth') : null;
				$student->place_of_birth       = Input::get('place_of_birth');
				$student->marital_status       = Input::get('marital_status');
				$student->blood_group          = Input::get('blood_group');
				$student->blood_type           = Input::has('blood_type');
				$student->permanent_address    = Input::get('permanent_address');
				$student->present_address      = Input::get('present_address');
				$student->about                = Input::get('about');

				// if picture uploads...
		       	if(Input::hasFile('picture'))
			    {
			    	$file = Input::file('picture');

			        $destinationPath = public_path('uploads/user_pictures');
			        
			        // generate random unique name [ randomStr + userId + extn ]
			        $fileName = Str::random(4, 'alpha').$user->id.".".$file->getClientOriginalExtension();

			        // original file starts with original_
			        $file->move($destinationPath, "original_".$fileName);

			        // medium resolution starts with original_
					Image::make($destinationPath."/original_".$fileName)
					        		->resize(300, null, true)
					        		->save($destinationPath."/medium_".$fileName);

					// low resolution starts with original_
					Image::make($destinationPath."/original_".$fileName)
					        		->resize(null, 35, true)
					        		->save($destinationPath."/thumbnail_".$fileName);

					$picture = new Download();
					$picture->caption = $user->full_name;
					$picture->type = 'Profile Picture';
					$picture->url = $fileName;
					
					$student->user->pictures()->save($picture);
			    }

				if($user->student()->save($student))
			    	return Redirect::route('admin.students.show', array('reg' => $student->reg))
		    						->with('success', "'$user->full_name' has been updated successfully.");
		    	else
					return Redirect::route('admin.students.edit', array('reg' => $student->reg))
										->withInput()
										->with('error', 'Some error occured. Try again.');
			}
		}
	}

	/**
	 * Delete a student
	 * @param  string $user_id
	 * @return void
	 */
	public function delete($user_id)
	{
		$user = User::find($user_id);
		if($user->delete())
			return Redirect::route('admin.students')
								->with('success', 'The user has been deleted.');
		else
			return Redirect::route('admin.students')
								->with('errors', 'Some error occured. Try again.');
	}
}

