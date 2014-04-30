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
					$lastMenuItem = Menu::orderBy('order','desc')->get()->first();

					$menuItem = new Menu;
					$menuItem->page_type = 'custom';
					$menuItem->page_id = $page->id;
					$menuItem->order = $lastMenuItem->order+1;

					$menuItem->save();
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
	 * @param  string $url
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
	public function doEdit($url)
	{
		$rules = array
		(
	    	'title' 	=> 'required',
	    	'url' 		=> 'required|unique:pages,url,'.Input::get('pageId'),
	    	'content' 	=> 'required'
		);

		$validation = Validator::make(Input::all(), $rules);
		
		if($validation->fails())
			return Redirect::route('admin.pages.edit', array('url' => $url))
								->withInput()
								->withErrors($validation);
		else
		{
			$page            = Page::where('url', '=', $url)->first();
			$page->title     = Input::get('title');
			$page->is_public = Input::get('is_public', 0);
			$page->url       = Input::get('url');
			$page->content   = Input::get('content');

			// if home page
			if($page->id == 1) $page->is_public = 1;

			if($page->save())
			{
				// add page at menu
				if($page->is_public == 1)
				{
					// if already exists at menu, than skip
					if(!Menu::where('page_id', '=', $page->id)->first())
					{
						$lastMenuItem = Menu::orderBy('order','desc')->get()->first();

						$menuItem = new Menu;
						$menuItem->page_type = 'custom';
						$menuItem->page_id = $page->id;
						$menuItem->order = $lastMenuItem->order+1;

						$menuItem->save();
					}
				}
				else
				{
					// delete from menu
					Menu::where('page_id', '=', $page->id)->delete();
				}

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
		if($page->id == 1)
		{
			return Redirect::route('admin.pages')
								->with('error', 'You can not delete Home page');
		}
		if($page->delete())
			return Redirect::route('admin.pages')
								->with('success', "The page has been deleted.");
		else
			return Redirect::route('admin.pages')
								->with('error', 'Some error occured. Try again.');
	}
}