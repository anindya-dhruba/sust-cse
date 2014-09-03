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
	 * show all notices 
	 * @return void
	 */
	public function notices()
	{
	    $notices = Notice::where('is_public', '=', 1)
	    					->orderBy('created_at', 'desc')
	    					->paginate(5);

	    return View::make('public.notices.index')
					->with('title', "All Notices")
					->with('notices', $notices);
	}

	/**
	 * show one notice
	 * @param  string $url
	 * @return void
	 */
	public function noticesShow($url)
	{
		try
		{
		    $notice = Notice::where('url', '=', $url)->firstOrFail();

		    return View::make('public.notices.show')
						->with('title', "$notice->title")
						->with('notice', $notice);
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
					->with('title', $student->full_name)
					->with('student', $student);
	}

	/**
	 * show all faculty
	 * @return void
	 */
	public function faculty()
	{
		$hotd = User::faculty()->where('designation', '=', 'Head of the Department')->first();
		$professors = User::faculty()->where('designation', '=', 'Professor')->get();
		$aProfessors = User::faculty()->where('designation', '=', 'Associate Professor')->get();
		$lecturers = User::faculty()->where('designation', '=', 'Lecturer')->get();

	    return View::make('public.faculty.index')
					->with('title', "Faculty")
					->with('hotd', $hotd)
					->with('professors', $professors)
					->with('aProfessors', $aProfessors)
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
						->with('title', $faculty->full_name)
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
	    								->with('prerequisiteCourse')
	    								->orderBy('prerequisite')
	    								->get()
	    								->toArray();
	    }

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
		    $course = Course::where('url', '=', $url)->firstOrFail();

		    return View::make('public.courses.show')
						->with('title', "$course->title")
						->with('course', $course);
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
		$user = Auth::user();

		if($user->role_id == 1)
		{
			return View::make('public.admin.show')
								->with('title', $user->full_name)
								->with('admin', $user);
		}
		// head / faculty
		else if($user->role_id == 2 || $user->role_id == 3)
		{
			return View::make('public.faculty.show')
								->with('title', $user->full_name)
								->with('faculty', $user);
		}
		else if($user->role_id == 4)
		{
			return View::make('public.stuffs.show')
								->with('title', $user->full_name)
								->with('stuff', $user);
		}
		// student
		else if($user->role_id == 5)
		{
			return View::make('public.students.show')
							->with('student', $user)
							->with('title', $user->full_name);
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
		// stuff
		else if($user->role_id == 4)
			return View::make('public.stuffs.edit')
								->with('title', 'Edit Profile')
								->with('stuff', $user);
		
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
				'full_name'            =>	'required',
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
				$user->full_name           = Input::get('full_name');
				$user->nick_name           = (Input::get('nick_name') == '') ? null : Input::get('nick_name');
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
						$picture->caption = $user->full_name;
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
				'full_name'       =>	'required',
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
				$user->full_name           = Input::get('full_name');
				$user->nick_name           = (Input::get('nick_name') == '') ? null : Input::get('nick_name');
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
				$user->journal_papers      = (Input::get('journal_papers') == '') ? null :Input::get('journal_papers');
				$user->conference_papers   = (Input::get('conference_papers') == '') ? null :Input::get('conference_papers');

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
						$picture->caption = $user->full_name;
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
		// stuff
		else if($user->role_id == 4)
		{
			$rules = array
			(
				'full_name'       =>	'required',
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
				$user->full_name           = Input::get('full_name');
				$user->nick_name           = (Input::get('nick_name') == '') ? null : Input::get('nick_name');
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
						$picture->caption = $user->full_name;
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
				'full_name'            =>	'required',
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
				$user->full_name           = Input::get('full_name');
				$user->nick_name           = (Input::get('nick_name') == '') ? null : Input::get('nick_name');
				$user->email               = (Input::get('email') == '') ? null : Input::get('email');
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
	 * show all stuffs
	 * @return void
	 */
	public function stuffs()
	{
		$stuffs = User::stuff()->get();

	    return View::make('public.stuffs.index')
					->with('title', "Stuffs")
					->with('stuffs', $stuffs);
	}

	/**
	 * Show a stuff
	 * @param  string $tagname
	 * @return void
	 */
	public function stuffsShow($tagname)
	{
		try
		{
		    $stuff = User::stuff()->where('tagname', '=', $tagname)->firstOrFail();

		    return View::make('public.stuffs.show')
						->with('title', $stuff->full_name)
						->with('stuff', $stuff);
		}
		catch(ModelNotFoundException $e)
		{
		   return "Page not found.";
		}
	}
	
}
