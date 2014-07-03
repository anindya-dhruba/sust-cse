<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;

class FacultyController extends BaseController {

	/**
	 * View all faculty
	 * @return void
	 */
	public function index()
	{
		$faculty = Faculty::paginate(10);

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
		try
		{
		    $faculty = faculty::where('tagname', '=', $tagname)->firstOrFail();

		    return View::make('faculty.show')
						->with('title', 'Viewing Faculty')
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
		return View::make('faculty.add')
						->with('title', 'Add New faculty');
	}

	/**
	 * Do Add a faculty
	 * @return void
	 */
	public function doAdd()
	{
		$rules = array
		(
			'full_name'       =>	'required',
			'designation'	  =>	'required',
			'tagname'	  	  =>	'required|unique:faculty,tagname',
			'email'           =>	'required|email|unique:users,email',
			'alternate_email' =>	'email|unique:students,alt_email',
			'status'          =>	'required',
			'picture'         =>	'image|mimes:jpeg,bmp,png',
			'website'		  =>	'url'
		);

		$validation = Validator::make(Input::all(), $rules);
		
		if($validation->fails())
			return Redirect::route('admin.faculty.add')
								->withInput()
								->withErrors($validation);
		else
		{
			$user            = new User();
			$user->full_name = Input::get('full_name');
			$user->nick_name = Input::get('nick_name');
			$user->email     = Input::get('email');
			$user->role_id   = 3; // faculty

			if($user->save())
			{
				$faculty                       = new Faculty();
				$faculty->designation          = Input::get('designation');
				$faculty->tagname          	   = Str::upper(Input::get('tagname'));
				$faculty->alt_email            = Input::get('alternate_email');
				$faculty->phone                = Input::get('phone');
				$faculty->mobile               = Input::get('mobile');
				$faculty->website              = Input::get('website');
				$faculty->status               = Input::get('status');
				$faculty->contact_room         = Input::get('contact_room');
				$faculty->permanent_address    = Input::get('permanent_address');
				$faculty->present_address      = Input::get('present_address');
				$faculty->academic_background  = Input::get('academic_background');
				$faculty->prof_exp  	 	   = Input::get('professional_experience');
				$faculty->awards_and_honors    = Input::get('awards_and_honors');
				$faculty->interests   		   = Input::get('interests');
				$faculty->about                = Input::get('about');

				$user->faculty()->save($faculty);

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
						
					$faculty->user->pictures()->save($picture);
			    }

			    return Redirect::route('admin.faculty.show', array('tagname' => Str::upper(Input::get('tagname'))))
			    					->with('success', "Faculty '$user->full_name' has added successfully.");
			}
			else
				return Redirect::route('admin.faculty.add')
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
		try
		{
		    $faculty = Faculty::where('tagname', '=', $tagname)->firstOrFail();

		    return View::make('faculty.edit')
						->with('title', "Editing Faculty Info")
						->with('faculty', $faculty);
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
		$rules = array
		(
			'full_name'       =>	'required',
			'designation'	  =>	'required',
			'tagname'         =>	'required|unique:faculty,tagname,'.Input::get('facultyId').',user_id',
			'email'           =>	'required|email|unique:users,email,'.Input::get('facultyId'),
			'alt_email' 	  =>	'email|unique:faculty,alt_email,'.Input::get('facultyId').',user_id',
			'status'          =>	'required',
			'picture'         =>	'image|mimes:jpeg,bmp,png',
			'website'		  =>	'url'
		);

		$validation = Validator::make(Input::all(), $rules);
		
		if($validation->fails())
			return Redirect::route('admin.faculty.edit', array('tagname' => $tagname))
								->withInput()
								->withErrors($validation);
		else
		{
			$id = Input::get('facultyId');

			$user            = User::find($id);
			$user->full_name = Input::get('full_name');
			$user->nick_name = Input::get('nick_name');
			$user->email     = Input::get('email');

			if($user->save())
			{
				$faculty                       = Faculty::where('user_id', '=', $id)->first();
				$faculty->designation          = Input::get('designation');
				$faculty->tagname          	   = Str::upper(Input::get('tagname'));
				$faculty->alt_email            = Input::get('alternate_email');
				$faculty->phone                = Input::get('phone');
				$faculty->mobile               = Input::get('mobile');
				$faculty->website              = Input::get('website');
				$faculty->status               = Input::get('status');
				$faculty->contact_room         = Input::get('contact_room');
				$faculty->permanent_address    = Input::get('permanent_address');
				$faculty->present_address      = Input::get('present_address');
				$faculty->academic_background  = Input::get('academic_background');
				$faculty->prof_exp  	 	   = Input::get('professional_experience');
				$faculty->awards_and_honors    = Input::get('awards_and_honors');
				$faculty->interests   		   = Input::get('interests');
				$faculty->about                = Input::get('about');

				$user->faculty()->save($faculty);

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
						
					$faculty->user->pictures()->save($picture);
			    }

			    return Redirect::route('admin.faculty.show', array('tagname' => Str::upper(Input::get('tagname'))))
			    					->with('success', "Faculty '$user->full_name' has been updated successfully.");
			}
			else
				return Redirect::route('admin.faculty.edit', array('tagname', $faculty->tagname))
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
		$user = User::find($user_id);
		if($user->delete())
			return Redirect::route('admin.faculty')
								->with('success', 'The faculty member has been deleted.');
		else
			return Redirect::route('admin.faculty')
								->with('errors', 'Some error occured. Try again.');
	}
}