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
						->with('title', 'Viewing All Pages')
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
			return Redirect::route('admin.pages.add')
								->withInput()
								->withErrors($validation);
		else
		{
			$page = new Page;
			$page->title      = Input::get('title');
			$page->is_public  = Input::get('is_public', 0);
			$page->url        = Input::get('url');
			$page->content    = Input::get('content');

			if($page->save())
			{
				// add page at menu
				if($page->is_public == 1)
				{
					Page::addToMenu($page);
				}
			    return Redirect::route('admin.pages.show', array('url' => $page->url))
			    					->with('success', "Page '$page->title' has added successfully.");
			}
			else
				return Redirect::route('admin.pages.add')
									->withInput()
									->with('error', 'Some error occured. Try again.');
		}
	}

	/**
	 * Generates slug/url for page
	 * @return string
	 */
	public function generateUrl()
	{
		$url = Str::slug(Input::get('title'));
		$urlCount = count(Page::where('url', '=', $url)->get());
		return ($urlCount > 0) ? "{$url}-{$urlCount}" : $url;
	}

	/**
	 * Show a  page
	 * @param  string $url
	 * @return void
	 */
	public function show($url)
	{
		try
		{
		    $page = Page::where('url', '=', $url)->firstOrFail();

		    return View::make('pages.show')
						->with('title', "Viewing Page")
						->with('page', $page);
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
	public function edit($pageUrl)
	{
		try
		{
		    $page = Page::where('url', '=', $pageUrl)->firstOrFail();
		    if(!$page->can_update) return;

		    return View::make('pages.edit')
						->with('title', "Editing Page")
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
	public function doEdit($url)
	{
		$page = Page::where('url', '=', $url)->first();

		// check permission
		if(!$page->can_update) return;
		
		// validation rules
		$rules['title']	= 'required';
		if($page->can_update && $page->can_delete)
		{
			$rules['url']	= 'required|unique:pages,url,'.Input::get('pageId');
			$rules['content'] = 'required';
		}

		$validation = Validator::make(Input::all(), $rules);
		
		if($validation->fails())
			return Redirect::route('admin.pages.edit', array('url' => $url))
								->withInput()
								->withErrors($validation);
		else
		{
			$page->title     = Input::get('title');
			$page->content   = Input::get('content');
			if($page->can_update && $page->can_delete)
			{
				$page->is_public = Input::get('is_public', 0);
				$page->url       = Input::get('url');
			}

			if($page->save())
			{
				if($page->is_public == 1)
					Page::addToMenu($page);
				else
					Page::removeFromMenu($page);

			    return Redirect::route('admin.pages.show', array('url' => $page->url))
			    					->with('success', "Page '$page->title' has updated successfully.");
			}
			else
				return Redirect::route('admin.pages.edit', array('url' => $url))
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
		$page = Page::where('url', '=', $url)->first();
		if($page->can_delete)
		{
			if($page->delete())
				return Redirect::route('admin.pages')
									->with('success', "The page has been deleted.");
			else
				return Redirect::route('admin.pages')
									->with('error', 'Some error occured. Try again.');
		}
		else
		{
			return Redirect::route('admin.pages')
								->with('error', 'You can not delete this page');
		}
	}
}