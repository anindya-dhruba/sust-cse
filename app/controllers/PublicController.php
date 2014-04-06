<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;

class PublicController extends BaseController {

	/**
	 * Show a  page
	 * @param  string $pageUrl
	 * @return void
	 */
	public function show($pageUrl = 'home')
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
}
