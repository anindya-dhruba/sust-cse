<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;

class PictureController extends BaseController {

	/**
	 * View all pictures
	 * @return void
	 */
	public function index()
	{
		if(!$this->permission['pictures']) return Redirect::to('/');

		$pictures = Picture::with('user')->paginate(10);

		return View::make('pictures.index')
						->with('title', 'Viewing All Pictures')
						->with('pictures', $pictures);
	}

	/**
	 * Generates url for picture
	 * @return string
	 */
	public function generateUrl()
	{
		if(!$this->permission['pictures']) return Redirect::to('/');

		$url = Str::slug(Input::get('caption'));
		$urlCount = count(Picture::where('url', '=', $url)->get());
		return ($urlCount > 0) ? "{$url}-{$urlCount}" : $url;
	}

	/**
	 * Add new picture
	 */
	public function add()
	{
		if(!$this->permission['pictures']) return Redirect::to('/');

		return View::make('pictures.add')
						->with('title', 'Add New Picture')
						->with('albumOptions', Album::orderBy('name')->lists('name', 'id'));
	}

	/**
	 * Do Add a Picture
	 * @return void
	 */
	public function doAdd()
	{
		if(!$this->permission['pictures']) return Redirect::to('/');

		$rules = array
		(
	    	'caption' 		=> 'required',
	    	'url' 			=> 'required|unique:pictures',
	    	'picture'       => 'required|image|mimes:jpeg,bmp,png',
	    	'album' 		=> 'required',
	    	'details' 		=> 'required'
		);

		$validation = Validator::make(Input::all(), $rules);

		
		if($validation->fails())
			return Redirect::back()
								->withInput()
								->withErrors($validation);

		else
		{
	    	$file = Input::file('picture');

	        $destinationPath = public_path('uploads/album_pictures');
	        
	        // generate random unique name [ timestamp + userId + extn ]
	        $fileName = strtotime(date('Y-m-d H:i:s')).Auth::user()->id.".".$file->getClientOriginalExtension();

	        // original file starts with original_
	        $file->move($destinationPath, "original_".$fileName);

	        // slider resolution starts with slider_
			Image::make($destinationPath."/original_".$fileName)
			        		->resize(1000, null, true)
			        		->save($destinationPath."/slider_".$fileName);

	        // medium resolution starts with medium_
			Image::make($destinationPath."/original_".$fileName)
			        		->resize(300, null, true)
			        		->save($destinationPath."/medium_".$fileName);

			// low resolution starts with thumbnail_
			Image::make($destinationPath."/original_".$fileName)
			        		->resize(130, null, true)
			        		->save($destinationPath."/thumbnail_".$fileName);

			$picture = new Picture();
			$picture->caption = Input::get('caption');
			$picture->is_public = Input::get('is_public', 0);
			$picture->url = Input::get('url');
			$picture->file_url = $fileName;
			$picture->details = Input::get('details');
			$picture->album_id = Input::get('album');
			$picture->user_id = Auth::user()->id;

			if($picture->save())
			    return Redirect::route('admin.pictures.show', array('pageUrl' => $picture->url))
			    					->with('success', "Picture '$picture->caption' has added successfully.");
			else
				return Redirect::back()
									->withInput()
									->with('error', 'Some error occured. Try again.');
		}
	}

	/**
	 * Show a  picture
	 * @param  string $url
	 * @return void
	 */
	public function show($url)
	{
		if(!$this->permission['pictures']) return Redirect::to('/');

		try
		{
		    $picture = Picture::where('url', '=', $url)->firstOrFail();

		    return View::make('pictures.show')
						->with('title', 'Viewing Picture')
						->with('picture', $picture);
		}
		catch(ModelNotFoundException $e)
		{
		   return "Page not found.";
		}
	}

	/**
	 * Edit a picture
	 * @param  string $url
	 * @return void
	 */
	public function edit($url)
	{
		if(!$this->permission['pictures']) return Redirect::to('/');

		try
		{
		    $picture = picture::where('url', '=', $url)->firstOrFail();

		    return View::make('pictures.edit')
						->with('title', "Editing picture")
						->with('picture', $picture)
						->with('albumOptions', Album::orderBy('name')->lists('name', 'id'));
		}
		catch(ModelNotFoundException $e)
		{
		   return "Page not found.";
		}
	}

	/**
	 * Do edit a picture
	 * @param  string $url
	 * @return void
	 */
	public function doEdit($url)
	{
		if(!$this->permission['pictures']) return Redirect::to('/');

		$rules = array
		(
	    	'caption' 	=> 'required',
	    	'url' 		=> 'required|unique:pictures,url,'.Input::get('pictureId'),
	    	'details' 	=> 'required',
	    	'album'		=> 'required'
		);

		$validation = Validator::make(Input::all(), $rules);
		
		if($validation->fails())
			return Redirect::route('admin.pictures.edit', array('url' => $url))
								->withInput()
								->withErrors($validation);
		else
		{
			$picture = Picture::where('url', '=', $url)->first();
			$picture->caption     	= Input::get('caption');
			$picture->url       	= Input::get('url');
			$picture->is_public 	= Input::get('is_public', 0);
			$picture->details    	= Input::get('details');
			$picture->album_id    	= Input::get('album');

			if($picture->save())
			    return Redirect::route('admin.pictures.show', array('url' => $picture->url))
			    					->with('success', "picture '$picture->caption' has updated successfully.");
			else
				return Redirect::route('admin.pictures.edit', array('url' => $url))
									->withInput()
									->with('error', 'Some error occured. Try again.');
		}
	}

	/**
	 * Delete a picture
	 * @param  int $id
	 * @return void
	 */
	public function delete($id)
	{
		if(!$this->permission['pictures']) return Redirect::to('/');

		$picture = picture::find($id);
		if($picture->delete())
			return Redirect::route('admin.pictures')
								->with('success', "The picture has been deleted.");
		else
			return Redirect::route('admin.pictures')
								->with('errors', 'Some error occured. Try again.');
	}
}