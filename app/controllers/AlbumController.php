<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;

class AlbumController extends BaseController {

	/**
	 * View all albums
	 * @return void
	 */
	public function albums()
	{
		if(!$this->permission['albums']) return Redirect::to('/');

		$albums = Album::paginate(10);

		return View::make('albums.index')
						->with('title', 'Viewing All Albums')
						->with('albums', $albums);
	}

	/**
	 * Generates url for album
	 * @return string
	 */
	public function generateUrl()
	{
		if(!$this->permission['albums']) return Redirect::to('/');

		$url = Str::slug(Input::get('name'));
		$urlCount = count(Album::where('url', '=', $url)->get());
		return ($urlCount > 0) ? "{$url}-{$urlCount}" : $url;
	}

	/**
	 * Add new album
	 */
	public function add()
	{
		if(!$this->permission['albums']) return Redirect::to('/');

		return View::make('albums.add')
						->with('title', 'Add New Album');
	}

	/**
	 * Do Add a Album
	 * @return void
	 */
	public function doAdd()
	{
		if(!$this->permission['albums']) return Redirect::to('/');

		$rules = array
		(
	    	'name' 		=> 'required',
	    	'url' 		=> 'required|unique:albums',
	    	'details' 	=> 'required'
		);

		$validation = Validator::make(Input::all(), $rules);

		
		if($validation->fails())
			return Redirect::back()
								->withInput()
								->withErrors($validation);

		else
		{
			$album = new Album;
			$album->name    	= Input::get('name');
			$album->url       	= Input::get('url');
			$album->is_public 	= Input::get('is_public', 0);
			$album->details    	= Input::get('details');
			$album->user_id   	= Auth::user()->id;

			if($album->save())
			    return Redirect::route('admin.albums.show', array('pageUrl' => $album->url))
			    					->with('success', "Album '$album->name' has added successfully.");
			else
				return Redirect::back()
									->withInput()
									->with('error', 'Some error occured. Try again.');
		}
	}

	/**
	 * Show a  album
	 * @param  string $url
	 * @return void
	 */
	public function show($url)
	{
		if(!$this->permission['albums']) return Redirect::to('/');

		try
		{
		    $album = Album::where('url', '=', $url)->firstOrFail();

		    return View::make('albums.show')
						->with('title', 'Viewing Album')
						->with('album', $album);
		}
		catch(ModelNotFoundException $e)
		{
		   return "Page not found.";
		}
	}

	/**
	 * Edit a album
	 * @param  string $url
	 * @return void
	 */
	public function edit($url)
	{
		if(!$this->permission['albums']) return Redirect::to('/');

		try
		{
		    $album = Album::where('url', '=', $url)->firstOrFail();

		    return View::make('albums.edit')
						->with('title', "Editing Album")
						->with('album', $album);
		}
		catch(ModelNotFoundException $e)
		{
		   return "Page not found.";
		}
	}

	/**
	 * Do edit a album
	 * @param  string $url
	 * @return void
	 */
	public function doEdit($url)
	{
		if(!$this->permission['albums']) return Redirect::to('/');

		$rules = array
		(
	    	'name' 		=> 'required',
	    	'url' 		=> 'required|unique:albums,url,'.Input::get('albumId'),
	    	'details' 	=> 'required'
		);

		$validation = Validator::make(Input::all(), $rules);
		
		if($validation->fails())
			return Redirect::back()
								->withInput()
								->withErrors($validation);
		else
		{
			$album = Album::where('url', '=', $url)->first();
			$album->name     	= Input::get('name');
			$album->url       	= Input::get('url');
			$album->is_public 	= Input::get('is_public', 0);
			$album->details    	= Input::get('details');

			if($album->save())
			    return Redirect::route('admin.albums.show', ['url' => $album->url])
			    					->with('success', "album '$album->name' has updated successfully.");
			else
				return Redirect::back()
									->withInput()
									->with('error', 'Some error occured. Try again.');
		}
	}

	/**
	 * Delete a album
	 * @param  int $id
	 * @return void
	 */
	public function delete($id)
	{
		if(!$this->permission['albums']) return Redirect::to('/');

		$album = Album::find($id);
		if($album->delete())
			return Redirect::route('admin.albums')
								->with('success', "The album has been deleted.");
		else
			return Redirect::route('admin.albums')
								->with('errors', 'Some error occured. Try again.');
	}
}
