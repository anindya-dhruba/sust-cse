<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;

class StudentController extends BaseController {

	/**
	 * View all students
	 * @return void
	 */
	public function index()
	{
		if(!$this->permission['students']) return Redirect::to('/');

		$students = User::student()
							->orderBy('created_at', 'desc')
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
		if(!$this->permission['students']) return Redirect::to('/');

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
		if(!$this->permission['students']) return Redirect::to('/');

		$rules = array
		(
			'reg'             => 	'required|numeric|unique:users,reg',
			'full_name'       =>	'required',
			'email'           =>	'email|unique:users,email',
			'alternate_email' =>	'email|unique:users,alt_email',
			'batch'           =>	'required',
			'picture'         =>	'image|mimes:jpeg,bmp,png',
			'date_of_birth'   =>	'date',
			'website'		  =>	'url'
		);

		$validation = Validator::make(Input::all(), $rules);
		
		if($validation->fails())
			return Redirect::back()
								->withInput()
								->withErrors($validation);
		else
		{
			$user                      = new User();
			$user->full_name           = Input::get('full_name');
			$user->nick_name           = (Input::get('nick_name') == '') ? null : Input::get('nick_name');
			$user->email               = Input::get('email');
			$user->role_id             = 5; // student
			$user->reg                 = Input::get('reg');
			$user->fathers_name        = (Input::get('fathers_name') == '') ? null : Input::get('fathers_name');
			$user->mothers_name        = (Input::get('mothers_name') == '') ? null : Input::get('mothers_name');
			$user->alt_email           = (Input::get('alternate_email') == '') ? null : Input::get('alternate_email');
			$user->phone               = (Input::get('phone') == '') ? null : Input::get('phone');
			$user->mobile              = (Input::get('mobile') == '') ? null : Input::get('mobile');
			$user->website             = (Input::get('website') == '') ? null : Input::get('website');
			$user->current_employment  = (Input::get('current_employment') == '') ? null : Input::get('current_employment');
			$user->employment_history  = (Input::get('employment_history') == '') ? null : Input::get('employment_history');
			$user->academic_background = (Input::get('academic_background') == '') ? null : Input::get('academic_background');
			$user->batch_id            = Input::get('batch');
			$user->gender              = (Input::get('gender') == '') ? null : Input::get('gender');
			$user->religion            = (Input::get('religion') == '') ? null : Input::get('religion');
			$user->nationality         = (Input::get('nationality') == '') ? null : Input::get('nationality');
			$user->date_of_birth       = (Input::has('date_of_birth')) ? Input::get('date_of_birth') : null;
			$user->place_of_birth      = (Input::get('place_of_birth') == '') ? null : Input::get('place_of_birth');
			$user->marital_status      = (Input::get('marital_status') == '') ? null : Input::get('marital_status');
			$user->blood_group         = (Input::get('blood_group') == '') ? null : Input::get('blood_group');
			$user->blood_type          = (Input::has('blood_type') == '') ? null : Input::has('blood_type');
			$user->permanent_address   = (Input::get('permanent_address') == '') ? null : Input::get('permanent_address');
			$user->present_address     = (Input::get('present_address') == '') ? null : Input::get('present_address');
			$user->about               = (Input::get('about') == '') ? null : Input::get('about');

			if($user->save())
			{
				// if picture is uploaded...
		       	if(Input::hasFile('picture'))
			    {
			    	$file = Input::file('picture');

			        $destinationPath = public_path('uploads/user_pictures');
			        
			        // generate random unique name [ timestamp + userId + extn ]
			        $fileName = strtotime(date('Y-m-d H:i:s')).$user->id.".".$file->getClientOriginalExtension();

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
						
					$user->pictures()->save($picture);
			    }

			    return Redirect::route('admin.students.show', array('reg' => Input::get('reg')))
			    					->with('success', "Student '$user->full_name' has added successfully.");
			}
			else
				return Redirect::back()
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
		if(!$this->permission['students']) return Redirect::to('/');

		try
		{
		    $student = User::where('reg', '=', $reg)->firstOrFail();

		    return View::make('students.show')
						->with('title', $student->reg)
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
		if(!$this->permission['students']) return Redirect::to('/');

		try
		{
		    $student = User::where('reg', '=', $reg)->firstOrFail();

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
		if(!$this->permission['students']) return Redirect::to('/');

		$rules = array
		(
			'reg'                  => 	'required|numeric|unique:users,reg,'.Input::get('studentId'),
			'full_name'            =>	'required',
			'email'                =>	'email|unique:users,email,'.Input::get('studentId'),
			'alternate_email'      =>	'email|unique:users,alt_email,'.Input::get('studentId'),
			'batch'                =>	'required',
			'picture'              =>	'image|mimes:jpeg,bmp,png',
			'date_of_birth'        =>	'date',
			'website'              =>	'url',
			'college_passing_year' => 	'digits:4',
			'school_passing_year'  => 	'digits:4'
		);

		$validation = Validator::make(Input::all(), $rules);
		
		if($validation->fails())
			return Redirect::back()
								->withInput()
								->withErrors($validation);
		else
		{
			$user                      = User::where('reg', '=', $reg)->first();
			$user->full_name           = Input::get('full_name');
			$user->nick_name           = (Input::get('nick_name') == '') ? null : Input::get('nick_name');
			$user->email               = Input::get('email');
			$user->reg                 = Input::get('reg');
			$user->fathers_name        = (Input::get('fathers_name') == '') ? null : Input::get('fathers_name');
			$user->mothers_name        = (Input::get('mothers_name') == '') ? null : Input::get('mothers_name');
			$user->alt_email           = (Input::get('alternate_email') == '') ? null : Input::get('alternate_email');
			$user->phone               = (Input::get('phone') == '') ? null : Input::get('phone');
			$user->mobile              = (Input::get('mobile') == '') ? null : Input::get('mobile');
			$user->website             = (Input::get('website') == '') ? null : Input::get('website');
			$user->current_employment  = (Input::get('current_employment') == '') ? null : Input::get('current_employment');
			$user->employment_history  = (Input::get('employment_history') == '') ? null : Input::get('employment_history');
			$user->academic_background = (Input::get('academic_background') == '') ? null : Input::get('academic_background');
			$user->batch_id            = Input::get('batch');
			$user->gender              = (Input::get('gender') == '') ? null : Input::get('gender');
			$user->religion            = (Input::get('religion') == '') ? null : Input::get('religion');
			$user->nationality         = (Input::get('nationality') == '') ? null : Input::get('nationality');
			$user->date_of_birth       = (Input::has('date_of_birth')) ? Input::get('date_of_birth') : null;
			$user->place_of_birth      = (Input::get('place_of_birth') == '') ? null : Input::get('place_of_birth');
			$user->marital_status      = (Input::get('marital_status') == '') ? null : Input::get('marital_status');
			$user->blood_group         = (Input::get('blood_group') == '') ? null : Input::get('blood_group');
			$user->blood_type          = (Input::has('blood_type') == '') ? null : Input::has('blood_type');
			$user->permanent_address   = (Input::get('permanent_address') == '') ? null : Input::get('permanent_address');
			$user->present_address     = (Input::get('present_address') == '') ? null : Input::get('present_address');
			$user->about               = (Input::get('about') == '') ? null : Input::get('about');

			if($user->save())
			{
				// if picture is uploaded...
		       	if(Input::hasFile('picture'))
			    {
			    	$file = Input::file('picture');

			        $destinationPath = public_path('uploads/user_pictures');
			        
			        // generate random unique name [ timestamp + userId + extn ]
			        $fileName = strtotime(date('Y-m-d H:i:s')).$user->id.".".$file->getClientOriginalExtension();

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
						
					$user->pictures()->save($picture);
			    }

			    return Redirect::route('admin.students.show', array('reg' => Input::get('reg')))
			    					->with('success', "Student '$user->full_name' has updated successfully.");
			}
			else
				return Redirect::back()
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
		if(!$this->permission['students']) return Redirect::to('/');

		$user = User::find($user_id);
		if($user->delete())
			return Redirect::route('admin.students')
								->with('success', 'The user has been deleted.');
		else
			return Redirect::route('admin.students')
								->with('errors', 'Some error occured. Try again.');
	}
}

