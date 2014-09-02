<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;

class NoticeController extends BaseController {

	/**
	 * View all notices
	 * @return void
	 */
	public function index()
	{
		if(!$this->permission['notices']) return Redirect::to('/');

		$notices = Notice::with('user')->orderBy('updated_at', 'desc')->paginate(10);

		return View::make('notices.index')
						->with('title', 'Viewing All Notices')
						->with('notices', $notices);
	}

	/**
	 * Generates url for page
	 * @return string
	 */
	public function generateUrl()
	{
		if(!$this->permission['notices']) return Redirect::to('/');

		$url = Str::slug(Input::get('title'));
		$urlCount = count(Notice::where('url', '=', $url)->get());
		return ($urlCount > 0) ? "{$url}-{$urlCount}" : $url;
	}

	/**
	 * Add new notice
	 */
	public function add()
	{
		if(!$this->permission['notices']) return Redirect::to('/');

		return View::make('notices.add')
						->with('title', 'Add New Notice');
	}


	/**
	 * Do Add a Notice
	 * @return void
	 */
	public function doAdd()
	{
		if(!$this->permission['notices']) return Redirect::to('/');

		$rules = array
		(
	    	'title' 	=> 'required',
	    	'url' 		=> 'required|unique:notices',
	    	'notice' 	=> 'required'
		);

		$validation = Validator::make(Input::all(), $rules);

		
		if($validation->fails())
			return Redirect::back()
								->withInput()
								->withErrors($validation);

		else
		{
			$notice = new Notice;
			$notice->title     = Input::get('title');
			$notice->url       = Input::get('url');
			$notice->is_public = Input::get('is_public', 0);
			$notice->notice    = Input::get('notice');
			$notice->user_id   = Auth::user()->id;

			if($notice->save())
			    return Redirect::route('admin.notices.show', array('pageUrl' => $notice->url))
			    					->with('success', "Notice '$notice->title' has added successfully.");
			else
				return Redirect::back()
									->withInput()
									->with('error', 'Some error occured. Try again.');
		}
	}


	/**
	 * Show a  page
	 * @param  string $url
	 * @return void
	 */
	public function show($url)
	{
		if(!$this->permission['notices']) return Redirect::to('/');

		try
		{
		    $notice = Notice::where('url', '=', $url)->firstOrFail();

		    return View::make('notices.show')
						->with('title', 'Viewing Notice')
						->with('notice', $notice);
		}
		catch(ModelNotFoundException $e)
		{
		   return "Page not found.";
		}
	}

	/**
	 * Edit a page
	 * @param  string $url
	 * @return void
	 */
	public function edit($url)
	{
		if(!$this->permission['notices']) return Redirect::to('/');

		try
		{
		    $notice = Notice::where('url', '=', $url)->firstOrFail();

		    return View::make('notices.edit')
						->with('title', "Editing Notice")
						->with('notice', $notice);
		}
		catch(ModelNotFoundException $e)
		{
		   return "Page not found.";
		}
	}

	/**
	 * Do edit a page
	 * @param  string $url
	 * @return void
	 */
	public function doEdit($url)
	{
		if(!$this->permission['notices']) return Redirect::to('/');

		$rules = array
		(
	    	'title' 	=> 'required',
	    	'url' 		=> 'required|unique:notices,url,'.Input::get('noticeId'),
	    	'notice' 	=> 'required'
		);

		$validation = Validator::make(Input::all(), $rules);
		
		if($validation->fails())
			return Redirect::back()
								->withInput()
								->withErrors($validation);
		else
		{
			$notice = Notice::where('url', '=', $url)->first();
			$notice->title     = Input::get('title');
			$notice->url       = Input::get('url');
			$notice->is_public = Input::get('is_public', 0);
			$notice->notice    = Input::get('notice');

			if($notice->save())
			    return Redirect::route('admin.notices.show', array('url' => $notice->url))
			    					->with('success', "Notice '$notice->title' has updated successfully.");
			else
				return Redirect::back()
									->withInput()
									->with('error', 'Some error occured. Try again.');
		}
	}

	/**
	 * Delete a page
	 * @param  string $url
	 * @return void
	 */
	public function delete($url)
	{
		if(!$this->permission['notices']) return Redirect::to('/');
		
		$notice = Notice::where('url', '=', $url);
		if($notice->delete())
			return Redirect::route('admin.notices')
								->with('success', "The notice has been deleted.");
		else
			return Redirect::route('admin.notices')
								->with('errors', 'Some error occured. Try again.');
	}



}