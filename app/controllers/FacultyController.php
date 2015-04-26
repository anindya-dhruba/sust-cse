<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;

class FacultyController extends BaseController {

	/**
	 * View all faculty
	 * @return void
	 */
	public function index()
	{
		if(!$this->permission['faculty']) return Redirect::to('/');

		$faculty = User::faculty()->paginate(10);

		return View::make('faculty.index')
						->with('title', 'Viewing All Faculty')
						->with('faculty', $faculty);
	}

	/**
	 * Show a faculty
	 * @param  string $tagname
	 * @return void
	 */
	public function show($tagname)
	{
		if(!$this->permission['faculty']) return Redirect::to('/');

		try
		{
		    $faculty = User::faculty()->where('tagname', '=', $tagname)->firstOrFail();

		    return View::make('faculty.show')
						->with('title', $faculty->last_name.", ".$faculty->first_name." ".$faculty->middle_name)
						->with('faculty', $faculty);
		}
		catch(ModelNotFoundException $e)
		{
		   return "Page not found.";
		}
	}

	/**
	 * Add new faculty
	 */
	public function add()
	{
		if(!$this->permission['faculty']) return Redirect::to('/');

		return View::make('faculty.add')
						->with('title', 'Add New faculty')
						->with('researches', Research::get());
	}

	/**
	 * Do Add a faculty
	 * @return void
	 */
	public function doAdd()
	{
		if(!$this->permission['faculty']) return Redirect::to('/');

		$rules = array
		(
			'first_name'      =>	'required',
			'last_name'	      =>	'required',
			'designation'	  =>	'required',
			'tagname'	  	  =>	'required|unique:users,tagname',
			'email'           =>	'required|email|unique:users,email',
			'alternate_email' =>	'email|unique:users,alt_email',
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
			$user                      = new User();
			$user->first_name          = Input::get('first_name');
			$user->middle_name         = Input::get('middle_name');
			$user->last_name           = Input::get('last_name');
			$user->designation         = (Input::get('designation') == '') ? null : Input::get('designation');
			$user->email               = (Input::get('email') == '') ? null : Input::get('email');
			$user->role_id             = 3; // faculty
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

			// set password for this user
			$password = Str::random(8);
			$user->password = Hash::make($password);

			// email password
			$data = [
				'email'    =>	Input::get('email'),
				'password' =>	$password
			];

			Mail::send('emails.faculty.welcome', $data, function($message) use ($user) {
			    $message->to($user->email, $user->last_name.", ".$user->first_name." ".$user->middle_name)->subject('Welcome to '.Config::get('myConfig.siteName'));
			});

			if($user->save())
			{
				if(Input::has('research'))
					$user->researches()->attach(Input::get('research'));

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



			    return Redirect::route('admin.faculty.show', array('tagname' => Str::upper(Input::get('tagname'))))
			    					->with('success', "Faculty member has added successfully.");
			}
			else
				return Redirect::back()
									->withInput()
									->with('error', 'Some error occured. Try again.');
		}
	}

	/**
	 * Edit a faculty
	 * @param  string $tagname
	 * @return void
	 */
	public function edit($tagname)
	{
		if(!$this->permission['faculty']) return Redirect::to('/');

		try
		{
		    $faculty = User::where('tagname', '=', $tagname)->firstOrFail();

		    return View::make('faculty.edit')
						->with('title', "Editing {$faculty->last_name}, {$faculty->first_name} {$faculty->middle_name}")
						->with('faculty', $faculty)
						->with('researches', Research::get());
		}
		catch(ModelNotFoundException $e)
		{
		   return "Page not found.";
		}
	}

	/**
	 * Do Edit a faculty
	 * @return void
	 */
	public function doEdit($tagname)
	{

		if(!$this->permission['faculty']) return Redirect::to('/');

		$rules = array
		(
			'first_name'      =>	'required',
			'last_name'       =>	'required',
			'designation'	  =>	'required',
			'tagname'         =>	'required|unique:users,tagname,'.Input::get('facultyId'),
			'email'           =>	'required|email|unique:users,email,'.Input::get('facultyId'),
			'alternate_email' =>	'email|unique:users,alt_email,'.Input::get('facultyId'),
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
			$user                      = User::where('tagname', '=', $tagname)->first();
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

			    return Redirect::route('admin.faculty.show', array('tagname' => Str::upper(Input::get('tagname'))))
			    					->with('success', "Faculty member has added successfully.");
			}
			else
				return Redirect::back()
									->withInput()
									->with('error', 'Some error occured. Try again.');
		}

	}

	/**
	 * Delete a faculty
	 * @param  string $user_id
	 * @return void
	 */
	public function delete($user_id)
	{
		if(!$this->permission['faculty']) return Redirect::to('/');

		$user = User::find($user_id);
		if($user->delete())
			return Redirect::route('admin.faculty')
								->with('success', 'The faculty member has been deleted.');
		else
			return Redirect::route('admin.faculty')
								->with('errors', 'Some error occured. Try again.');
	}

	/**
	 * do add a research of ajax req.
	 * @return json
	 */
	public function doAddResearch()
	{
		$research = new Research;
		$research->name = Input::get('name');
		
		$url = Str::slug(Input::get('name'));
		$urlCount = count(Research::where('url', '=', $url)->get());
		$research->url = ($urlCount > 0) ? "{$url}-{$urlCount}" : $url;

		$research->description = Input::get('description');
		$research->save();

		return $research;
	}
}