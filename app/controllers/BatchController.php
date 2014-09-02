<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;

class BatchController extends BaseController {

	/**
	 * View all batches
	 * @return void
	 */
	public function index()
	{
		if(!$this->permission['batches']) return Redirect::to('/');

		$batches = Batch::orderBy('year', 'desc')->paginate(10);

		return View::make('batches.index')
						->with('title', 'View All Batches')
						->with('batches', $batches);
	}

	/**
	 * Add new batch
	 */
	public function add()
	{
		if(!$this->permission['batches']) return Redirect::to('/');

		return View::make('batches.add')
						->with('title', 'Add New Batch');
	}

	/**
	 * Do Add a batch
	 * @return void
	 */
	public function doAdd()
	{
		if(!$this->permission['batches']) return Redirect::to('/');

		$rules = array
		(
	    	'name' 	=> 'required|unique:batches',
	    	'year' 	=> 'required|digits:4|unique:batches'
		);

		$validation = Validator::make(Input::all(), $rules);
		
		if($validation->fails())
			return Redirect::back()
								->withInput()
								->withErrors($validation);
		else
		{
			$batch = new Batch();
			$batch->name = Input::get('name');
			$batch->year = Input::get('year');

			if($batch->save())
			    return Redirect::route('admin.batches.show', array('year' => $batch->year))
			    					->with('success', "batch '$batch->year' has added successfully.");
			else
				return Redirect::back()
									->withInput()
									->with('error', 'Some error occured. Try again.');
		}
	}

	/**
	 * Show a  page
	 * @param  string $year
	 * @return void
	 */
	public function show($year)
	{
		if(!$this->permission['batches']) return Redirect::to('/');

		try
		{
		    $batch = Batch::where('year', '=', $year)->firstOrFail();

		    return View::make('batches.show')
						->with('title', "View $batch->year batch")
						->with('batch', $batch);
		}
		catch(ModelNotFoundException $e)
		{
		   return "Page not found.";
		}
	}

	/**
	 * Edit a batch
	 * @param  string $year
	 * @return void
	 */
	public function edit($year)
	{
		if(!$this->permission['batches']) return Redirect::to('/');

		try
		{
		    $batch = Batch::where('year', '=', $year)->firstOrFail();

		    return View::make('batches.edit')
						->with('title', "Edit $batch->year batch")
						->with('batch', $batch);
		}
		catch(ModelNotFoundException $e)
		{
		   return "Page not found.";
		}
	}

	/**
	 * Do edit a batch
	 * @param  string $year
	 * @return void
	 */
	public function doEdit($year)
	{
		if(!$this->permission['batches']) return Redirect::to('/');

		$rules = array
		(
	    	'name' 	=> 'required|unique:batches,name,'.Input::get('batchId'),
	    	'year' 	=> 'required|digits:4|unique:batches,year,'.Input::get('batchId')
		);

		$validation = Validator::make(Input::all(), $rules);
		
		if($validation->fails())
			return Redirect::back()
								->withInput()
								->withErrors($validation);
		else
		{
			$batch = Batch::where('year', '=', $year)->first();
			$batch->name = Input::get('name');
			$batch->year = Input::get('year');

			if($batch->save())
			    return Redirect::route('admin.batches.show', array('year' => $batch->year))
			    					->with('success', "batch '$batch->year' has updated successfully.");
			else
				return Redirect::back()
									->withInput()
									->with('error', 'Some error occured. Try again.');
		}
	}

	/**
	 * Delete a batch
	 * @param  string $year
	 * @return void
	 */
	public function delete($year)
	{
		if(!$this->permission['batches']) return Redirect::to('/');

		$batch = Batch::where('year', '=', $year);
		if($batch->delete())
			return Redirect::route('admin.batches')
								->with('success', "The batch has been deleted.");
		else
			return Redirect::route('admin.batches')
								->with('errors', 'Some error occured. Try again.');
	}
}