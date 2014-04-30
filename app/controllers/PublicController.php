<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;

class PublicController extends BaseController {

	/**
	 * Show a  page
	 * @param  string $pageUrl
	 * @return void
	 */
	public function pages($pageUrl = 'home')
	{
		try
		{
		    $page = Page::where('url', '=', $pageUrl)->firstOrFail();

		    if($page->id == 1) 	$layout = 'layouts.home';
		    else 				$layout = 'layouts.default';

		    return View::make('public.pages.show')
						->with('title', "$page->title")
						->with('page', $page)
						->with('layout', $layout);
		}
		catch(ModelNotFoundException $e)
		{
		   return "Page not found.";
		}
	}

	public function faqs()
	{
	    $faqs = Faq::get();

	    return View::make('public.faqs.index')
					->with('title', "Frequently Asked Questions")
					->with('faqs', $faqs);
	}

	public function notices()
	{
	    $notices = Notice::where('is_public', '=', 1)
	    					->orderBy('created_at', 'desc')
	    					->paginate(5);

	    return View::make('public.notices.index')
					->with('title', "All Notices")
					->with('notices', $notices);
	}

	public function noticesShow($url)
	{
		try
		{
		    $notice = Notice::where('url', '=', $url)->firstOrFail();

		    return View::make('public.notices.show')
						->with('title', "$notice->title")
						->with('notice', $notice);
		}
		catch(ModelNotFoundException $e)
		{
		   return "Page not found.";
		}
	}
}
