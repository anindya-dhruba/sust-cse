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

		$rules = [
	    	'type' 	=> 'required',
	    	'year' 	=> 'required|digits:4'
		];

		$validation = Validator::make(Input::all(), $rules);
		
		if($validation->fails())
			return Redirect::back()
								->withInput()
								->withErrors($validation);
		else
		{
			$batch = new Batch();
			$batch->type = Input::get('type');
			$batch->year = Input::get('year');

			if($batch->save())
			    return Redirect::route('admin.batches.show', ['type' => $batch->type, 'year' => $batch->year])
			    					->with('success', "batch '$batch->year' has added successfully.");
			else
				return Redirect::back()
									->withInput()
									->with('error', 'Some error occurred. Try again.');
		}
	}

	/**
	 * Show a  page
	 * @param  string $year
	 * @return void
	 */
	public function show($type, $year)
	{
		if(!$this->permission['batches']) return Redirect::to('/');

		try
		{
		    $batch = Batch::where('year', '=', $year)->where('type', '=', $type)->firstOrFail();

		    return View::make('batches.show')
						->with('title', "$batch->type - $batch->year")
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
	public function edit($type, $year)
	{
		if(!$this->permission['batches']) return Redirect::to('/');

		try
		{
		    $batch = Batch::where('year', '=', $year)->where('type', $type)->firstOrFail();

		    return View::make('batches.edit')
						->with('title', "Editing $batch->type - $batch->year")
						->with('batch', $batch);
		}
		catch(ModelNotFoundException $e)
		{
		   return "Page not found.";
		}
	}

	/**
	 * Do edit a batch
	 * @param  sting  $type
	 * @param  string $year
	 */
	public function doEdit($type, $year)
	{
		if(!$this->permission['batches']) return Redirect::to('/');

		$rules = [
	    	'type' 	=> 'required',
	    	'year' 	=> 'required|digits:4'
		];

		$validation = Validator::make(Input::all(), $rules);
		
		if($validation->fails())
			return Redirect::back()
								->withInput()
								->withErrors($validation);
		else
		{
			$batch = Batch::where('year', '=', $year)->where('type', '=', $type)->first();
			$batch->type = Input::get('type');
			$batch->year = Input::get('year');

			if($batch->save())
			    return Redirect::route('admin.batches.show', ['type' => $batch->type, 'year' => $batch->year])
			    					->with('success', "batch '$batch->year' has updated successfully.");
			else
				return Redirect::back()
									->withInput()
									->with('error', 'Some error occurred. Try again.');
		}
	}

	/**
	 * Delete a batch
	 * @param  string $year
	 * @return void
	 */
	public function delete($type, $year)
	{
		if(!$this->permission['batches']) return Redirect::to('/');

		$batch = Batch::where('year', '=', $year)->where('type', '=', $type);

		if($batch->delete())
			return Redirect::route('admin.batches')
								->with('success', "The batch has been deleted.");
		else
			return Redirect::route('admin.batches')
								->with('errors', 'Some error occurred. Try again.');
	}
}