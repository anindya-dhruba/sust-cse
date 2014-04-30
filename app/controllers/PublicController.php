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

	/**
	 * show all faqs
	 * @return void
	 */
	public function faqs()
	{
	    $faqs = Faq::get();

	    return View::make('public.faqs.index')
					->with('title', "Frequently Asked Questions")
					->with('faqs', $faqs);
	}

	/**
	 * show all notices 
	 * @return void
	 */
	public function notices()
	{
	    $notices = Notice::where('is_public', '=', 1)
	    					->orderBy('created_at', 'desc')
	    					->paginate(5);

	    return View::make('public.notices.index')
					->with('title', "All Notices")
					->with('notices', $notices);
	}

	/**
	 * show one notice
	 * @param  string $url
	 * @return void
	 */
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

	public function batches()
	{
		$batches = Batch::orderBy('year', 'desc')->get();

	    return View::make('public.batches.index')
					->with('title', "All Batches")
					->with('batches', $batches);
	}

	public function batchesShow($year)
	{
		$batch = Batch::where('year', '=', $year)->first();

	    return View::make('public.batches.show')
					->with('title', "$batch->name Batch")
					->with('batch', $batch);
	}
}
