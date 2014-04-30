<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;

class FaqController extends BaseController {

	/**
	 * View all faq
	 * @return void
	 */
	public function index()
	{
		$faqs = Faq::paginate(10);

		return View::make('faq.index')
						->with('title', "View All FAQ's")
						->with('faqs', $faqs);
	}

	/**
	 * Add new faq
	 */
	public function add()
	{
		return View::make('faq.create')
						->with('title', 'Add New FAQ');
	}

	/**
	 * Do Add a faq
	 * @return void
	 */
	public function doAdd()
	{
		$rules = array
		(
	    	'question' 	=> 'required',
	    	'url' 		=> 'required|unique:faq',
	    	'answer'	=> 'required'
		);

		$validation = Validator::make(Input::all(), $rules);
		
		if($validation->fails())
			return Redirect::route('admin.faqs.add')
								->withInput()
								->withErrors($validation);
		else
		{
			$faq = new Faq;
			$faq->url        = Input::get('url');
			$faq->question    = Input::get('question');
			$faq->answer    = Input::get('answer');

			if($faq->save())
			    return Redirect::route('admin.faqs.show', array('pageUrl' => $faq->url))
			    					->with('success', "FAQ '$faq->title' has added successfully.");
			else
				return Redirect::route('admin.faqs.add')
									->withInput()
									->with('error', 'Some error occured. Try again.');
		}
	}

	/**
	 * Generates slug/url for faq
	 * @return string
	 */
	public function slug()
	{
		$slug = Str::slug(Input::get('title'));
		$slugCount = count(Faq::where('url', '=', $slug)->get());
		return ($slugCount > 0) ? "{$slug}-{$slugCount}" : $slug;
	}

	/**
	 * Show a  faq
	 * @param  string $faqUrl
	 * @return void
	 */
	public function show($pageUrl)
	{
		try
		{
		    $faq = Faq::where('url', '=', $pageUrl)->firstOrFail();

		    return View::make('faq.show')
						->with('title', "$faq->question")
						->with('faq', $faq);
		}
		catch(ModelNotFoundException $e)
		{
		   return "Page not found.";
		}
	}

	/**
	 * Edit a faq
	 * @param  string $faqUrl
	 * @return void
	 */
	public function edit($pageUrl)
	{
		try
		{
		    $faq = Faq::where('url', '=', $pageUrl)->firstOrFail();

		    return View::make('faq.edit')
						->with('title', "Edit $faq->question Page")
						->with('faq', $faq);
		}
		catch(ModelNotFoundException $e)
		{
		   return "Page not found.";
		}
	}

	/**
	 * Do edit a faq
	 * @param  string $faqUrl
	 * @return void
	 */
	public function doEdit($pageUrl)
	{
		$rules = array
		(
	    	'question' 	=> 'required',
	    	'answer'	=> 'required',
	    	'url' 		=> 'required|unique:faq,url,'.Input::get('faqID')
		);

		$validation = Validator::make(Input::all(), $rules);
		
		if($validation->fails())
			return Redirect::route('admin.faqs.edit', array('pageUrl' => $pageUrl))
								->withInput()
								->withErrors($validation);
		else
		{
			$faq = Faq::where('url', '=', $pageUrl)->first();

			$faq->url        = Input::get('url');
			$faq->question    = Input::get('question');
			$faq->answer    = Input::get('answer');


			if($faq->save())
			    return Redirect::route('admin.faqs.show', array('pageUrl' => $faq->url))
			    					->with('success', "Page '$faq->question' has updated successfully.");
			else
				return Redirect::route('admin.faqs.edit', array('pageUrl' => $pageUrl))
									->withInput()
									->with('error', 'Some error occured. Try again.');
		}
	}

	/**
	 * Delete a faq
	 * @param  string $faqUrl
	 * @return void
	 */
	public function delete($pageUrl)
	{
		$faq = Faq::where('url', '=', $pageUrl);
		if($faq->delete())
			return Redirect::route('admin.faqs')
								->with('success', "The FAQ has been deleted.");
		else
			return Redirect::route('admin.faqs')
								->with('errors', 'Some error occured. Try again.');
	}


}