<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;

class NoticeController extends BaseController {
	
	/**
	 * View all notices
	 * @return void
	 */
	public function index()
	{
		$notices = Notice::paginate(10);

		return View::make('notices.index')
						->with('title', 'View All Notices')
						->with('notices', $notices);
	}


	/**
	 * Generates slug/url for page
	 * @return string
	 */
	public function slug()
	{
		$slug = Str::slug(Input::get('title'));
		$slugCount = count(Notice::where('url', '=', $slug)->get());
		return ($slugCount > 0) ? "{$slug}-{$slugCount}" : $slug;
	}

	/**
	 * Add new notice
	 */
	public function add()
	{
		return View::make('notices.add')
						->with('title', 'Add New Notice');
	}


	/**
	 * Do Add a Notice
	 * @return void
	 */
	public function doAdd()
	{
		$rules = array
		(
	    	'title' 	=> 'required',
	    	'url' 		=> 'required|unique:notices',
	    	'notice' 	=> 'required'
		);

		$validation = Validator::make(Input::all(), $rules);

		
		if($validation->fails())
			return Redirect::route('notices.add')
								->withInput()
								->withErrors($validation);

		else
		{
			$notice = new Notice;
			$notice->title      = Input::get('title');
			$notice->url        = Input::get('url');
			$notice->notice     = Input::get('notice');
			$notice->user_id	= Auth::user()->id;

			if($notice->save())
			    return Redirect::route('notices.show', array('pageUrl' => $notice->url))
			    					->with('success', "Notice '$notice->title' has added successfully.");
			else
				return Redirect::route('notices.add')
									->withInput()
									->with('error', 'Some error occured. Try again.');
		}
	}


	/**
	 * Show a  page
	 * @param  string $pageUrl
	 * @return void
	 */
	public function show($pageUrl)
	{
		try
		{
		    $notice = Notice::where('url', '=', $pageUrl)->firstOrFail();

		    return View::make('notices.show')
						->with('title', "View $notice->title Page")
						->with('notice', $notice);
		}
		catch(ModelNotFoundException $e)
		{
		   return "Page not found.";
		}
	}

	/**
	 * Edit a page
	 * @param  string $pageUrl
	 * @return void
	 */
	public function edit($pageUrl)
	{
		try
		{
		    $notice = Notice::where('url', '=', $pageUrl)->firstOrFail();

		    return View::make('notices.edit')
						->with('title', "Edit $notice->title ")
						->with('notice', $notice);
		}
		catch(ModelNotFoundException $e)
		{
		   return "Page not found.";
		}
	}

	/**
	 * Do edit a page
	 * @param  string $pageUrl
	 * @return void
	 */
	public function doEdit($pageUrl)
	{
		$rules = array
		(
	    	'title' 	=> 'required',
	    	'url' 		=> 'required|unique:notices,url,'.Input::get('noticeId'),
	    	'notice' 	=> 'required'
		);

		$validation = Validator::make(Input::all(), $rules);
		
		if($validation->fails())
			return Redirect::route('notices.edit', array('pageUrl' => $pageUrl))
								->withInput()
								->withErrors($validation);
		else
		{
			$notice = Notice::where('url', '=', $pageUrl)->first();
			$notice->title      = Input::get('title');
			$notice->url        = Input::get('url');
			$notice->notice    = Input::get('notice');

			if($notice->save())
			    return Redirect::route('notices.show', array('pageUrl' => $notice->url))
			    					->with('success', "Notice '$notice->title' has updated successfully.");
			else
				return Redirect::route('notices.edit', array('pageUrl' => $pageUrl))
									->withInput()
									->with('error', 'Some error occured. Try again.');
		}
	}

	/**
	 * Delete a page
	 * @param  string $pageUrl
	 * @return void
	 */
	public function delete($pageUrl)
	{
		$notice = Notice::where('url', '=', $pageUrl);
		if($notice->delete())
			return Redirect::route('notices')
								->with('success', "The notice has been deleted.");
		else
			return Redirect::route('notices')
								->with('errors', 'Some error occured. Try again.');
	}



}