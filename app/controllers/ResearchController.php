<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;

class ResearchController extends BaseController {

	/**
	 * View all research
	 * @return void
	 */
	public function index()
	{
		if(!$this->permission['researches']) return Redirect::to('/');

		$researches = Research::paginate(10);

		return View::make('researches.index')
						->with('title', 'Viewing All Research')
						->with('researches', $researches);
	}

	/**
	 * Generates slug/url for research
	 * @return string
	 */
	public function generateUrl()
	{
		if(!$this->permission['researches']) return Redirect::to('/');
		
		$url = Str::slug(Input::get('name'));
		$urlCount = count(Research::where('url', '=', $url)->get());
		return ($urlCount > 0) ? "{$url}-{$urlCount}" : $url;
	}

	/**
	 * Show a  research
	 * @param  string $url
	 * @return void
	 */
	public function show($url)
	{
		if(!$this->permission['researches']) return Redirect::to('/');
		
		try
		{
		    $research = Research::where('url', '=', $url)->firstOrFail();

		    return View::make('researches.show')
						->with('title', $research->name)
						->with('research', $research);
		}
		catch(ModelNotFoundException $e)
		{
		   return "Page not found.";
		}
	}

	/**
	 * add a research
	 */
	public function add()
	{
		if(!$this->permission['researches']) return Redirect::to('/');

		return View::make('researches.add')
						->with('title', 'Add New Research Topic');
	}

	/**
	 * Do Add a research
	 * @return void
	 */
	public function doAdd()
	{
		if(!$this->permission['researches']) return Redirect::to('/');
		
		$rules = array
		(
	    	'name' 			=> 'required|unique:researches',
	    	'url' 			=> 'required|unique:researches',
	    	'description' 	=> 'required'
		);

		$validation = Validator::make(Input::all(), $rules);
		
		if($validation->fails())
			return Redirect::back()
								->withInput()
								->withErrors($validation);
		else
		{
			$research               = new Research;
			$research->name         = Input::get('name');
			$research->url          = Input::get('url');
			$research->description  = Input::get('description');
			
			if($research->save())
			{
			    return Redirect::route('admin.researches.show', array('url' => $research->url))
			    					->with('success', "Research Topic '$research->name' has added successfully.");
			}
			else
				return Redirect::back()
									->withInput()
									->with('error', 'Some error occured. Try again.');
		}
	}

	/**
	 * Edit a research
	 * @param  string $url
	 * @return void
	 */
	public function edit($url)
	{
		if(!$this->permission['researches']) return Redirect::to('/');
		
		try
		{
		    $research = Research::where('url', '=', $url)->firstOrFail();

		    return View::make('researches.edit')
						->with('title', "Editing Research")
						->with('research', $research);
		}
		catch(ModelNotFoundException $e)
		{
		   return "Page not found.";
		}
	}

	/**
	 * Do edit a research
	 * @param  string $url
	 * @return void
	 */
	public function doEdit($url)
	{
		if(!$this->permission['researches']) return Redirect::to('/');
		
		$rules = array
		(
	    	'name' 			=> 'required|unique:researches,name,'.Input::get('researchId'),
	    	'url' 			=> 'required|unique:researches,url,'.Input::get('researchId'),
	    	'description' 	=> 'required'
		);

		$validation = Validator::make(Input::all(), $rules);
		
		if($validation->fails())
			return Redirect::back()
								->withInput()
								->withErrors($validation);
		else
		{
			$research               = Research::find(Input::get('researchId'));
			$research->name         = Input::get('name');
			$research->url          = Input::get('url');
			$research->description  = Input::get('description');

			if($research->save())
			{
			    return Redirect::route('admin.researches.show', array('url' => $research->url))
			    					->with('success', "Research '$research->name' has updated successfully.");
			}
			else
				return Redirect::back()
									->withInput()
									->with('error', 'Some error occured. Try again.');
		}
	}

	/**
	 * Delete a research
	 * @param  string $url
	 * @return void
	 */
	public function delete($id)
	{
		if(!$this->permission['researches']) return Redirect::to('/');

		$research = Research::find($id);
		
		if($research->delete())
			return Redirect::route('admin.researches')
									->with('success', "The research topic has been deleted.");
		else
			return Redirect::route('admin.researches')
									->with('error', 'Some error occured. Try again.');
	}
}

