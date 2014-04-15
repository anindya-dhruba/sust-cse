<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;

class StudentController extends BaseController {

	/**
	 * View all students
	 * @return void
	 */
	public function index()
	{
		$students = Student::paginate(10);

		return View::make('students.index')
						->with('title', 'View All Students')
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
			'reg'           => 	'required|unique:students,reg',
			'full_name'     =>	'required',
			'email'         =>	'email|unique:users,email',
			'batch'         =>	'required',
			'picture'		=>	'image|mimes:jpeg,bmp,png',
			'date_of_birth' =>	'date'
		);

		$validation = Validator::make(Input::all(), $rules);
		
		if($validation->fails())
			return Redirect::route('students.add')
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
				$student                 = new Student();
				$student->reg            = Input::get('reg');
				$student->fathers_name   = Input::get('fathers_name');
				$student->mothers_name   = Input::get('mothers_name');
				$student->batch_id       = Input::get('batch');
				$student->gender         = Input::get('gender');
				$student->religion       = Input::get('religion');
				$student->nationality    = Input::get('nationality');
				$student->date_of_birth  = (Input::has('date_of_birth')) ? Input::get('date_of_birth') : null;
				$student->place_of_birth = Input::get('place_of_birth');
				$student->marital_status = Input::get('marital_status');
				$student->blood_group    = Input::get('blood_group');
				$student->blood_type     = Input::has('blood_type');
				$student->home_address   = Input::get('home_address');
				$student->bio            = Input::get('bio');

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

				$user->student()->save($student);

			    return Redirect::route('students.show', array('reg' => Input::get('reg')))
			    					->with('success', "Student '$user->full_name' has added successfully.");
			}
			else
				return Redirect::route('students.add')
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
						->with('title', "Student Details")
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
						->with('title', "Edit $student->reg ")
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
			'reg'           => 	'required|unique:students,reg,'.Input::get('studentId').',user_id',
			'full_name'     =>	'required',
			'email'         =>	'email|unique:users,email,'.Input::get('studentId'),
			'batch'         =>	'required',
			'date_of_birth' =>	'date'
		);

		$validation = Validator::make(Input::all(), $rules);
		
		if($validation->fails())
			return Redirect::route('students.edit', array('reg' => $reg))
								->withInput()
								->withErrors($validation);
		else
		{
			$id = Input::get('studentId');
			
			$user = User::find($id);
			$user->full_name = Input::get('full_name');
			$user->nick_name = Input::get('nick_name');
			$user->email = Input::get('email');
			$user->save();

			$student = Student::where('user_id', '=', $id)->first();
			$student->reg            = Input::get('reg');
			$student->fathers_name   = Input::get('fathers_name');
			$student->mothers_name   = Input::get('mothers_name');
			$student->batch_id       = Input::get('batch');
			$student->gender         = Input::get('gender');
			$student->religion       = Input::get('religion');
			$student->nationality    = Input::get('nationality');
			$student->date_of_birth  = (Input::has('date_of_birth')) ? Input::get('date_of_birth') : null;
			$student->place_of_birth = Input::get('place_of_birth');
			$student->marital_status = Input::get('marital_status');
			$student->blood_group    = Input::get('blood_group');
			$student->blood_type     = Input::has('blood_type');
			$student->home_address   = Input::get('home_address');
			$student->bio            = Input::get('bio');

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
		    	return Redirect::route('students.show', array('reg' => $student->reg))
	    						->with('success', "Student '$user->full_name' has added successfully.");
	    	else
				return Redirect::route('students.edit', array('reg' => $student->reg))
									->withInput()
									->with('error', 'Some error occured. Try again.');
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
			return Redirect::route('students')
								->with('success', 'The user has been deleted.');
		else
			return Redirect::route('students')
								->with('errors', 'Some error occured. Try again.');
	}
}

