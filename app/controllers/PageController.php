<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;

class PageController extends BaseController {

	/**
	 * View all pages
	 * @return void
	 */
	public function index()
	{
		$pages = Page::paginate(10);

		return View::make('pages.index')
						->with('title', 'View All Pages')
						->with('pages', $pages);
	}

	/**
	 * Add new page
	 */
	public function add()
	{
		return View::make('pages.add')
						->with('title', 'Add New Page');
	}

	/**
	 * Do Add a page
	 * @return void
	 */
	public function doAdd()
	{
		$rules = array
		(
	    	'title' 	=> 'required',
	    	'url' 		=> 'required|unique:pages',
	    	'content' 	=> 'required'
		);

		$validation = Validator::make(Input::all(), $rules);
		
		if($validation->fails())
			return Redirect::route('pages.add')
								->withInput()
								->withErrors($validation);
		else
		{
			$page = new Page;
			$page->title   = Input::get('title');
			$page->url     = Input::get('url');
			$page->content = Input::get('content');

			if($page->save())
			    return Redirect::route('pages.show', array('pageUrl' => $page->url))
			    					->with('success', "Page '$page->title' has added successfully.");
			else
				return Redirect::route('pages.add')
									->withInput()
									->with('error', 'Some error occured. Try again.');
		}
	}

	/**
	 * Generates slug/url for page
	 * @return string
	 */
	public function slug()
	{
		$slug = Str::slug(Input::get('title'));
		$slugCount = count(Page::where('url', '=', $slug)->get());
		return ($slugCount > 0) ? "{$slug}-{$slugCount}" : $slug;
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
		    $page = Page::where('url', '=', $pageUrl)->firstOrFail();

		    return View::make('pages.show')
						->with('title', "View $page->title Page")
						->with('page', $page);
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
		    $page = Page::where('url', '=', $pageUrl)->firstOrFail();

		    return View::make('pages.edit')
						->with('title', "Edit $page->title Page")
						->with('page', $page);
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
	    	'url' 		=> 'required|unique:pages,url,'.Input::get('pageId'),
	    	'content' 	=> 'required'
		);

		$validation = Validator::make(Input::all(), $rules);
		
		if($validation->fails())
			return Redirect::route('pages.edit', array('pageUrl' => $pageUrl))
								->withInput()
								->withErrors($validation);
		else
		{
			$page = Page::where('url', '=', $pageUrl)->first();
			$page->title   = Input::get('title');
			$page->url     = Input::get('url');
			$page->content = Input::get('content');

			if($page->save())
			    return Redirect::route('pages.show', array('pageUrl' => $page->url))
			    					->with('success', "Page '$page->title' has updated successfully.");
			else
				return Redirect::route('pages.edit', array('pageUrl' => $pageUrl))
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
		$page = Page::where('url', '=', $pageUrl);
		if($page->delete())
			return Redirect::route('pages')
								->with('success', "The page has been deleted.");
		else
			return Redirect::route('pages')
								->with('errors', 'Some error occured. Try again.');
	}
}