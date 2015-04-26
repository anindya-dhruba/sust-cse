<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;

class PublicController extends BaseController {

	/**
	 * Show a  page
	 * @param  string $pageUrl
	 * @return void
	 */
	public function pages($pageUrl = 'home')
	{
		try
		{
		    $page = Page::where('url', '=', $pageUrl)->firstOrFail();

		    if($page->id == 1) 	$layout = 'layouts.home';
		    else 				$layout = 'layouts.default';

		    return View::make('public.pages.show')
						->with('title', "$page->title")
						->with('page', $page)
						->with('layout', $layout);
		}
		catch(ModelNotFoundException $e)
		{
		   return "Page not found.";
		}
	}

	/**
	 * show all faqs
	 * @return void
	 */
	public function faqs()
	{
	    $faqs = Faq::get();

	    return View::make('public.faqs.index')
					->with('title', "Frequently Asked Questions")
					->with('faqs', $faqs);
	}

	/**
	 * show all news
	 * @return void
	 */
	public function news()
	{
	    $news = News::where('is_public', '=', 1)
	    					->orderBy('created_at', 'desc')
	    					->paginate(5);

	    return View::make('public.news.index')
					->with('title', "All News")
					->with('news', $news);
	}

	/**
	 * show one news
	 * @param  string $url
	 * @return void
	 */
	public function newsShow($url)
	{
		try
		{
		    $news = News::where('url', '=', $url)->firstOrFail();

		    return View::make('public.news.show')
						->with('title', "$news->title")
						->with('news', $news);
		}
		catch(ModelNotFoundException $e)
		{
		   return "Page not found.";
		}
	}

	/**
	 * show all batches
	 * @return void
	 */
	public function batches()
	{
		$batches = Batch::orderBy('year', 'desc')->get();

	    return View::make('public.batches.index')
					->with('title', "All Batches")
					->with('batches', $batches);
	}

	/**
	 * show a batch details
	 * @param  digit $year
	 * @return void
	 */
	public function batchesShow($year)
	{
		$batch = Batch::where('year', '=', $year)->first();

	    return View::make('public.batches.show')
					->with('title', "$batch->name Batch")
					->with('batch', $batch);
	}

	/**
	 * shows a student details
	 * @param  digit $year
	 * @param  digit $reg
	 * @return void
	 */
	public function studentsShow($year, $reg)
	{
		$student = User::where('reg', '=', $reg)->first();

	    return View::make('public.students.show')
					->with('title', "{$student->last_name}, {$student->first_name} {$student->middle_name}")
					->with('student', $student);
	}

	/**
	 * show all faculty
	 * @return void
	 */
	public function faculty()
	{
		$hotd = User::faculty()->where('designation', '=', 'Head of the Department')->first();
		$professors = User::faculty()->where('designation', '=', 'Professor')->orderBy('last_name')->get();
		$aProfessors = User::faculty()->where('designation', '=', 'Associate Professor')->orderBy('last_name')->get();
		$assisProfessors = User::faculty()->where('designation', '=', 'Assistant Professor')->orderBy('last_name')->get();
		$lecturers = User::faculty()->where('designation', '=', 'Lecturer')->orderBy('last_name')->get();

	    return View::make('public.faculty.index')
					->with('title', "Faculty")
					->with('hotd', $hotd)
					->with('professors', $professors)
					->with('aProfessors', $aProfessors)
					->with('assisProfessors', $assisProfessors)
					->with('lecturers', $lecturers)
					->with('faculty', $lecturers);
	}

	/**
	 * Show a faculty
	 * @param  string $tagname
	 * @return void
	 */
	public function facultyShow($tagname)
	{
		try
		{
		    $faculty = User::where('tagname', '=', $tagname)->firstOrFail();

		    return View::make('public.faculty.show')
						->with('title', "{$faculty->last_name}, {$faculty->first_name} {$faculty->middle_name}")
						->with('faculty', $faculty);
		}
		catch(ModelNotFoundException $e)
		{
		   return "Page not found.";
		}
	}

	/**
	 * show all events 
	 * @return void
	 */
	public function events()
	{
	    $events = AppEvent::where('is_public', '=', 1)
	    					->orderBy('start_date', 'desc')
	    					->paginate(5);

	    return View::make('public.events.index')
					->with('title', "All Events")
					->with('events', $events);
	}

	/**
	 * show one event
	 * @param  string $url
	 * @return void
	 */
	public function eventsShow($url)
	{
		try
		{
		    $event = AppEvent::where('url', '=', $url)->firstOrFail();

		    return View::make('public.events.show')
						->with('title', $event->title)
						->with('event', $event);
		}
		catch(ModelNotFoundException $e)
		{
		   return "Page not found.";
		}
	}

	/**
	 * show all courses 
	 * @return void
	 */
	public function courses()
	{
	    $semesters = Course::$semesterOptions;
	    $courses = [];

	    foreach ($semesters as $key => $semester)
	    {
	    	$courses[$key] = Course::where('semester', '=', $semester)
	    								->with('prerequisiteCourse', 'taking_by')
	    								->orderBy('prerequisite')
	    								->get()
	    								->toArray();
	    }

//		return $courses;

	    return View::make('public.courses.index')
					->with('title', "Courses")
					->with('allCourses', $courses);
	}

	/**
	 * show one course
	 * @param  string $url
	 * @return void
	 */
	public function coursesShow($url)
	{
		try
		{
		    $course = Course::with('taking_by')->where('url', '=', $url)->firstOrFail();

			$notices = CourseNotice::where('course_id', '=', $course->id)
									->where('user_id', '=', $course->faculty_id)
									->orderBy('created_at', 'desc')
									->paginate(10);

		    return View::make('public.courses.show')
						->with('title', "$course->title")
						->with('course', $course)
						->with('notices', $notices);
		}
		catch(ModelNotFoundException $e)
		{
		   return "Page not found.";
		}
	}

	/**
	 * show profile of current user
	 * @return void
	 */
	public function profile()
	{
		if(Auth::user()->role_id == 1)
		{
			$user = Auth::user();
			return View::make('public.admin.show')
								->with('title', "{$user->last_name}, {$user->first_name} {$user->middle_name}")
								->with('admin', $user);
		}
		// head / faculty
		else if(Auth::user()->role_id == 2 || Auth::user()->role_id == 3)
		{
			$user = User::with('coursesTaking')->where('id', '=', Auth::id())->first();


			return View::make('public.faculty.show')
								->with('title', "{$user->last_name}, {$user->first_name} {$user->middle_name}")
								->with('faculty', $user);
		}
		// staff
		else if(Auth::user()->role_id == 4)
		{
			$user = Auth::user();
			return View::make('public.staff.show')
								->with('title', "{$user->last_name}, {$user->first_name} {$user->middle_name}")
								->with('staff', $user);
		}
		// student
		else if(Auth::user()->role_id == 5)
		{
			$user = Auth::user();
			return View::make('public.students.show')
							->with('title', "{$user->last_name}, {$user->first_name} {$user->middle_name}")
							->with('student', $user);
		}
	}

	/**
	 * show edit profile page
	 * @return void
	 */
	public function editProfile()
	{
		$user = Auth::user();

		// admin
		if($user->role_id == 1)
		{
			return View::make('public.admin.edit')
								->with('title', 'Edit Profile')
								->with('admin', $user);
		}
		// head / faculty
		else if($user->role_id == 2 || $user->role_id == 3)
		{
			return View::make('public.faculty.edit')
								->with('title', 'Edit Profile')
								->with('faculty', $user)
								->with('researches', Research::get());
		}
		// staff
		else if($user->role_id == 4)
			return View::make('public.staff.edit')
								->with('title', 'Edit Profile')
								->with('staff', $user);
		
		// student
		else if($user->role_id == 5)
		{
			return View::make('public.students.edit')
								->with('title', 'Edit Profile')
								->with('student', $user)
								->with('batches', Batch::orderBy('year', 'desc')->lists('year', 'id'));
		}
	}

	/**
	 * do update a user profile
	 * @return void
	 */
	public function doEditProfile()
	{
		$user = Auth::user();

		// admin
		if($user->role_id == 1)
		{
			$rules = array
			(
				'first_name'           =>	'required',
				'last_name'            =>	'required',
				'email'                =>	'email|unique:users,email,'.Input::get('id'),
				'picture'              =>	'image|mimes:jpeg,bmp,png'
			);

			$validation = Validator::make(Input::all(), $rules);
			
			if($validation->fails())
				return Redirect::back()
									->withInput()
									->withErrors($validation);
			else
			{
				$user->first_name          = Input::get('first_name');
				$user->last_name           = Input::get('last_name');
				$user->email               = (Input::get('email') == '') ? null : Input::get('email');
				
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
						$picture->caption = "{$user->last_name}, {$user->first_name} {$user->middle_name}";
						$picture->type = 'Profile Picture';
						$picture->url = $fileName;
							
						$user->pictures()->save($picture);
				    }

				    return Redirect::route('profile.show')
				    					->with('success', "Your profile has updated successfully.");
				}
				else
					return Redirect::back()
										->withInput()
										->with('error', 'Some error occured. Try again.');
			}
		}
		// head / faculty
		else if($user->role_id == 2 || $user->role_id == 3)
		{
			$rules = array
			(
				'first_name'      =>	'required',
				'last_name'       =>	'required',
				'designation'	  =>	'required',
				'tagname'         =>	'required|unique:users,tagname,'.Input::get('id'),
				'email'           =>	'required|email|unique:users,email,'.Input::get('id'),
				'alternate_email' =>	'email|unique:users,alt_email,'.Input::get('id'),
				'date_of_birth'	  =>	'date',
				'status'          =>	'required',
				'picture'         =>	'image|mimes:jpeg,bmp,png',
				'website'		  =>	'url'
			);


			$validation = Validator::make(Input::all(), $rules);
			
			if($validation->fails())
				return Redirect::back()
									->withInput()
									->withErrors($validation);
			else
			{
				$user->first_name          = Input::get('first_name');
				$user->middle_name         = Input::get('middle_name');
				$user->last_name           = Input::get('last_name');
				$user->designation         = (Input::get('designation') == '') ? null : Input::get('designation');
				$user->email               = (Input::get('email') == '') ? null : Input::get('email');
				$user->alt_email           = (Input::get('alternate_email') == '') ? null : Input::get('alternate_email');
				$user->phone               = (Input::get('phone') == '') ? null : Input::get('phone');
				$user->mobile              = (Input::get('mobile') == '') ? null : Input::get('mobile');
				$user->nationality         = (Input::get('nationality') == '') ? null : Input::get('nationality');
				$user->permanent_address   = (Input::get('permanent_address') == '') ? null : Input::get('permanent_address');
				$user->present_address     = (Input::get('present_address') == '') ? null : Input::get('present_address');
				$user->tagname             = (Input::get('tagname') == '') ? null : Str::upper(Input::get('tagname'));
				$user->status              = (Input::get('status') == '') ? null : Input::get('status');
				$user->date_of_birth       = (Input::get('date_of_birth') == '') ? null : Input::get('date_of_birth');
				$user->gender              = (Input::get('gender') == '') ? null : Input::get('gender');
				$user->religion            = (Input::get('religion') == '') ? null : Input::get('religion');
				$user->blood_group         = (Input::get('blood_group') == '') ? null : Input::get('blood_group');
				$user->blood_type          = (Input::get('blood_type') == '') ? null : Input::get('blood_type');
				$user->website             = (Input::get('website') == '') ? null : Input::get('website');
				$user->contact_room        = (Input::get('contact_room') == '') ? null : Input::get('contact_room');
				$user->academic_background = (Input::get('academic_background') == '') ? null :Input::get('academic_background');
				$user->prof_exp            = (Input::get('professional_experience') == '') ? null :Input::get('professional_experience');
				$user->awards_and_honors   = (Input::get('awards_and_honors') == '') ? null :Input::get('awards_and_honors');
				$user->interests           = (Input::get('interests') == '') ? null :Input::get('interests');
				$user->about               = (Input::get('about') == '') ? null :Input::get('about');
				$user->publications        = (Input::get('publications') == '') ? null :Input::get('publications');

				if($user->save())
				{
					if(Input::has('research'))
						$user->researches()->sync(Input::get('research'));
					else
						$user->researches()->sync([]);

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
						$picture->caption = "{$user->last_name}, {$user->first_name} {$user->middle_name}";
						$picture->type = 'Profile Picture';
						$picture->url = $fileName;
							
						$user->pictures()->save($picture);
				    }

				    return Redirect::route('profile.show')
				    					->with('success', "Your profile has updated successfully.");
				}
				else
					return Redirect::back()
										->withInput()
										->with('error', 'Some error occured. Try again.');
			}
		}
		// staff
		else if($user->role_id == 4)
		{
			$rules = array
			(
				'first_name'      =>	'required',
				'last_name'       =>	'required',
				'designation'	  =>	'required',
				'tagname'         =>	'required|unique:users,tagname,'.Input::get('id'),
				'email'           =>	'required|email|unique:users,email,'.Input::get('id'),
				'alternate_email' =>	'email|unique:users,alt_email,'.Input::get('id'),
				'date_of_birth'	  =>	'date',
				'status'          =>	'required',
				'picture'         =>	'image|mimes:jpeg,bmp,png',
				'website'		  =>	'url'
			);


			$validation = Validator::make(Input::all(), $rules);
			
			if($validation->fails())
				return Redirect::back()
									->withInput()
									->withErrors($validation);
			else
			{
				$user->first_name          = Input::get('first_name');
				$user->middle_name         = Input::get('middle_name');
				$user->last_name           = Input::get('last_name');
				$user->designation         = (Input::get('designation') == '') ? null : Input::get('designation');
				$user->email               = (Input::get('email') == '') ? null : Input::get('email');
				$user->alt_email           = (Input::get('alternate_email') == '') ? null : Input::get('alternate_email');
				$user->phone               = (Input::get('phone') == '') ? null : Input::get('phone');
				$user->mobile              = (Input::get('mobile') == '') ? null : Input::get('mobile');
				$user->nationality         = (Input::get('nationality') == '') ? null : Input::get('nationality');
				$user->permanent_address   = (Input::get('permanent_address') == '') ? null : Input::get('permanent_address');
				$user->present_address     = (Input::get('present_address') == '') ? null : Input::get('present_address');
				$user->tagname             = (Input::get('tagname') == '') ? null : Str::upper(Input::get('tagname'));
				$user->status              = (Input::get('status') == '') ? null : Input::get('status');
				$user->date_of_birth       = (Input::get('date_of_birth') == '') ? null : Input::get('date_of_birth');
				$user->gender              = (Input::get('gender') == '') ? null : Input::get('gender');
				$user->religion            = (Input::get('religion') == '') ? null : Input::get('religion');
				$user->blood_group         = (Input::get('blood_group') == '') ? null : Input::get('blood_group');
				$user->blood_type          = (Input::get('blood_type') == '') ? null : Input::get('blood_type');
				$user->website             = (Input::get('website') == '') ? null : Input::get('website');
				$user->contact_room        = (Input::get('contact_room') == '') ? null : Input::get('contact_room');
				$user->academic_background = (Input::get('academic_background') == '') ? null :Input::get('academic_background');
				$user->about               = (Input::get('about') == '') ? null :Input::get('about');

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
						$picture->caption = "{$user->last_name}, {$user->first_name} {$user->middle_name}";
						$picture->type = 'Profile Picture';
						$picture->url = $fileName;
							
						$user->pictures()->save($picture);
				    }

				    return Redirect::route('profile.show')
				    					->with('success', "Your profile has updated successfully.");
				}
				else
					return Redirect::back()
										->withInput()
										->with('error', 'Some error occured. Try again.');
			}
		}
		// student
		else if($user->role_id == 5)
		{
			$rules = array
			(
				'reg'                  => 	'required|numeric|unique:users,reg,'.Input::get('id'),
				'first_name'           =>	'required',
				'last_name'            =>	'required',
				'email'                =>	'email|unique:users,email,'.Input::get('id'),
				'alternate_email'      =>	'email|unique:users,alt_email,'.Input::get('id'),
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
				$user->first_name          = Input::get('first_name');
				$user->middle_name         = Input::get('middle_name');
				$user->last_name           = Input::get('last_name');
				$user->email               = (Input::get('email') == '') ? null : Input::get('email');
				$user->reg                 = Input::get('reg');
				$user->degree              = (Input::get('degree') == '') ? null : Input::get('degree');
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
						$picture->caption = "{$user->last_name}, {$user->first_name} {$user->middle_name}";
						$picture->type = 'Profile Picture';
						$picture->url = $fileName;
							
						$user->pictures()->save($picture);
				    }

				    return Redirect::route('profile.show')
				    					->with('success', "Your profile has updated successfully.");
				}
				else
					return Redirect::back()
										->withInput()
										->with('error', 'Some error occured. Try again.');
			}
		}
	}

	/**
	 * show edit password
	 * @return void
	 */
	public function editPassword()
	{
		return View::make('public.users.editPassword')
							->with('title', 'Change Password');
	}

	/**
	 * do edit password
	 * @return void
	 */
	public function doEditPassword()
	{
		$rules = array
		(
			'old_password'				=> 'required',
	    	'new_password' 				=> 'required|confirmed',
	    	'new_password_confirmation' => 'required'
		);

		$validation = Validator::make(Input::all(), $rules);
		
		if($validation->fails())
		{
			return Redirect::back()
								->withInput()
								->withErrors($validation);
		}
		else
		{
			if(Hash::check(Input::get('old_password'), Auth::user()->password))
			{
				$user = Auth::user();
				$user->password = Hash::make(Input::get('new_password'));
				$user->save();

				return Redirect::route('profile.show')
										->with('success', 'Your password has been changed.');
			}
			else
			{
				return Redirect::back()
								->withInput()
								->with('error', 'Old Password does not match.');
			}
		}
	}

	/**
	 * show all staff
	 * @return void
	 */
	public function staff()
	{
		$staff = User::staff()->get();

	    return View::make('public.staff.index')
					->with('title', "Staff")
					->with('staff', $staff);
	}

	/**
	 * Show a staff
	 * @param  string $tagname
	 * @return void
	 */
	public function staffShow($tagname)
	{
		try
		{
		    $staff = User::staff()->where('tagname', '=', $tagname)->firstOrFail();

		    return View::make('public.staff.show')
						->with('title', "{$staff->last_name}, {$staff->first_name} {$staff->middle_name}")
						->with('staff', $staff);
		}
		catch(ModelNotFoundException $e)
		{
		   return "Page not found.";
		}
	}

	/**
	 * show all research areas
	 * @return void
	 */
	public function researches()
	{
		$researches = Research::with('users')->get();

	    return View::make('public.researches.index')
					->with('title', "Research")
					->with('researches', $researches);
	}

	/**
	 * Show a research
	 * @param  string $url
	 * @return void
	 */
	public function researchShow($url)
	{
		try
		{
		    $research = Research::with('users')->where('url', '=', $url)->firstOrFail();

		    return View::make('public.researches.show')
						->with('title', $research->name)
						->with('research', $research);
		}
		catch(ModelNotFoundException $e)
		{
		   return "Page not found.";
		}
	}

	/**
	 * show all albums
	 * @return void
	 */
	public function albums()
	{
		$albums = Album::where('is_public', '=', 1)->with('pictures')->get();

	    return View::make('public.albums.index')
					->with('title', "Gallery (".(count($albums)) ." albums)")
					->with('albums', $albums);
	}
	
	/**
	 * Show a album
	 * @param  string $url
	 * @return void
	 */
	public function albumShow($url)
	{
		try
		{
		    $album = Album::where('url', '=', $url)->firstOrFail();
		    $pictures = Picture::where('album_id', '=', $album->id)->where('is_public', '=', 1)->get();

		    return View::make('public.albums.show')
						->with('title',"Album: ".$album->name." (".count($pictures)." Pictures)")
						->with('pictures', $pictures)
						->with('album', $album);
		}
		catch(ModelNotFoundException $e)
		{
		   return "Page not found.";
		}
	}

	/**
	 * Show a picture
	 * @param  string $url, $picUrl
	 * @return void
	 */
	public function pictureShow($url, $picUrl)
	{
		try
		{
		    $picture = Picture::with('album')->where('url', '=', $picUrl)->firstOrFail();

		    return View::make('public.pictures.show')
						->with('title', $picture->caption)
						->with('picture', $picture)
						->with('albumUrl', $url);
		}
		catch(ModelNotFoundException $e)
		{
		   return "Page not found.";
		}
	}

	public function noticeShow($url, $noticeUrl)
	{
		try
		{
			$notice = CourseNotice::with('user')->where('url', '=', $noticeUrl)->firstOrFail();

			//			return $notice;

			return View::make('public.notices.show')
				->with('title', "$notice->title")
				->with('notice', $notice)
				->with('url', $url);
		}
		catch(ModelNotFoundException $e)
		{
			return "Page not found.";
		}
	}

	/**
	 * Generates slug/url for page
	 * @return string
	 */
	public function noticeGenerateUrl()
	{
		$url = Str::slug(Input::get('title'));
		$urlCount = count(CourseNotice::where('url', '=', $url)->get());
		return ($urlCount > 0) ? "{$url}-{$urlCount}" : $url;
	}

	public function noticeAdd($url)
	{
		try
		{
			$course = Course::where('url', '=', $url)->firstOrFail();

			return View::make('public.notices.add')
						->with('title', 'Add New Notice - '.$course->course_code)
						->with('course', $course);
		}
		catch(ModelNotFoundException $e)
		{
			return "Page not found.";
		}
	}

	public function noticeDoAdd($url)
	{
		$rules = array
		(
			'title' 	=> 'required',
			'url' 		=> 'required|unique:course_notice',
			'notice'	=> 'required'
		);

		$validation = Validator::make(Input::all(), $rules);

		if($validation->fails())
			return Redirect::back()
				->withInput()
				->withErrors($validation);
		else
		{
			$course = Course::where('url', '=', $url)->first();


			$notice           = new CourseNotice();
			$notice->title    = Input::get('title');
			$notice->url      = Input::get('url');
			$notice->notice   = Input::get('notice');
			$notice->course_id = $course->id;
			$notice->user_id   = Auth::id();

			if($notice->save())
				return Redirect::route('notices.show', array('url' => $url, 'noticeUrl' => $notice->url))
					->with('success', "Notice '$notice->title' has added successfully.");
			else
				return Redirect::back()
					->withInput()
					->with('error', 'Some error occurred. Try again.');
		}
	}

	public function noticeEdit($url, $noticeUrl)
	{
		try
		{
			$notice = CourseNotice::where('url', '=', $noticeUrl)->firstOrFail();

			return View::make('public.notices.edit')
				->with('title', 'Editing Notice')
				->with('notice', $notice)
				->with('url', $url);
		}
		catch(ModelNotFoundException $e)
		{
			return "Page not found.";
		}
	}

	public function noticeDoEdit($url, $noticeUrl)
	{
		$rules = array
		(
			'title' 	=> 'required',
			'url' 		=> 'required|unique:course_notice,url,'.Input::get('noticeId'),
			'notice'	=> 'required'
		);

		$validation = Validator::make(Input::all(), $rules);

		if($validation->fails())
			return Redirect::back()
				->withInput()
				->withErrors($validation);
		else
		{
			$course = Course::where('url', '=', $url)->first();


			$notice           = CourseNotice::find(Input::get('noticeId'));
			$notice->title    = Input::get('title');
			$notice->url      = Input::get('url');
			$notice->notice   = Input::get('notice');
			$notice->course_id = $course->id;

			if($notice->save())
				return Redirect::route('notices.show', array('url' => $url, 'noticeUrl' => $notice->url))
					->with('success', "Notice '$notice->title' has updated successfully.");
			else
				return Redirect::back()
					->withInput()
					->with('error', 'Some error occurred. Try again.');
		}

	}

	public function noticeDelete($url, $noticeId)
	{
		$notice = CourseNotice::find($noticeId);
		if($notice->delete())
			return Redirect::route('courses.show', [$url])
				->with('success', 'The notice has been deleted.');
		else
			return Redirect::back()
				->with('errors', 'Some error occurred. Try again.');
	}

	public function students()
	{
		return View::make('public.students.index')
			->with('title', "Students");
	}

	public function graduate()
	{
		$students = User::student()->graduate()->with('batch')->orderBy('batch_id', 'desc')->paginate(10);

		return View::make('public.students.graduate')
							->with('title', "Graduate Students")
							->with('students', $students);
	}

	public function undergraduate()
	{
		$students = User::student()->undergraduate()->with('batch')->orderBy('batch_id', 'desc')->paginate(10);

		return View::make('public.students.undergraduate')
			->with('title', "Undergraduate Students")
			->with('students', $students);
	}


}
