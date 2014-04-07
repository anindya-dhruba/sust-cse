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

			if($notice->save())
			    return Redirect::route('notices.show', array('pageUrl' => $notice->url))
			    					->with('success', "Page '$notice->title' has added successfully.");
			else
				return Redirect::route('notice.add')
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
}