<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;

class PageController extends BaseController {

	public function show($pageName = 'home')
	{
		try
		{
		    $page = Page::where('url', '=', $pageName)->firstOrFail();

		    return View::make('pages.show')
						->with('title', 'Home')
						->with('page', $page);
		}
		catch(ModelNotFoundException $e)
		{
		   return "Page not found.";
		}
	}
}