<?php

class PageController extends BaseController {

	public function home()
	{
		return View::make('pages.home')
						->with('title', 'Home');
	}

	public function show($pageName)
	{
		return View::make('pages.'.$pageName)
						->with('title', 'Home');
	}
}