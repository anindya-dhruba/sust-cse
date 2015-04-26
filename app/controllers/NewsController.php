<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;

class NewsController extends BaseController {

	/**
	 * View all news
	 * @return void
	 */
	public function index()
	{
		if(!$this->permission['news']) return Redirect::to('/');

		$news = News::with('user')->orderBy('updated_at', 'desc')->paginate(10);

		return View::make('news.index')
						->with('title', 'Viewing All News')
						->with('news', $news);
	}

	/**
	 * Generates url for page
	 * @return string
	 */
	public function generateUrl()
	{
		if(!$this->permission['news']) return Redirect::to('/');

		$url = Str::slug(Input::get('title'));
		$urlCount = count(News::where('url', '=', $url)->get());
		return ($urlCount > 0) ? "{$url}-{$urlCount}" : $url;
	}

	/**
	 * Add new news
	 */
	public function add()
	{
		if(!$this->permission['news']) return Redirect::to('/');

		return View::make('news.add')
						->with('title', 'Add New News');
	}


	/**
	 * Do Add a News
	 * @return void
	 */
	public function doAdd()
	{
		if(!$this->permission['news']) return Redirect::to('/');

		$rules = array
		(
	    	'title' 	=> 'required',
	    	'url' 		=> 'required|unique:news',
	    	'news'	 	=> 'required'
		);

		$validation = Validator::make(Input::all(), $rules);

		
		if($validation->fails())
			return Redirect::back()
								->withInput()
								->withErrors($validation);

		else
		{
			$news = new News;
			$news->title     = Input::get('title');
			$news->url       = Input::get('url');
			$news->is_public = Input::get('is_public', 0);
			$news->news      = Input::get('news');
			$news->user_id   = Auth::user()->id;

			if($news->save())
			    return Redirect::route('admin.news.show', array('pageUrl' => $news->url))
			    					->with('success', "News '$news->title' has added successfully.");
			else
				return Redirect::back()
									->withInput()
									->with('error', 'Some error occurred. Try again.');
		}
	}


	/**
	 * Show a  page
	 * @param  string $url
	 * @return void
	 */
	public function show($url)
	{
		if(!$this->permission['news']) return Redirect::to('/');

		try
		{
		    $news = News::where('url', '=', $url)->firstOrFail();

		    return View::make('news.show')
						->with('title', 'Viewing News')
						->with('news', $news);
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
		if(!$this->permission['news']) return Redirect::to('/');

		try
		{
		    $news = News::where('url', '=', $url)->firstOrFail();

		    return View::make('news.edit')
						->with('title', "Editing News")
						->with('news', $news);
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
		if(!$this->permission['news']) return Redirect::to('/');

		$rules = array
		(
	    	'title' 	=> 'required',
	    	'url' 		=> 'required|unique:news,url,'.Input::get('newsId'),
	    	'news' 		=> 'required'
		);

		$validation = Validator::make(Input::all(), $rules);
		
		if($validation->fails())
			return Redirect::back()
								->withInput()
								->withErrors($validation);
		else
		{
			$news = News::where('url', '=', $url)->first();
			$news->title     = Input::get('title');
			$news->url       = Input::get('url');
			$news->is_public = Input::get('is_public', 0);
			$news->news      = Input::get('news');

			if($news->save())
			    return Redirect::route('admin.news.show', array('url' => $news->url))
			    					->with('success', "News '$news->title' has updated successfully.");
			else
				return Redirect::back()
									->withInput()
									->with('error', 'Some error occurred. Try again.');
		}
	}

	/**
	 * Delete a page
	 * @param  string $url
	 * @return void
	 */
	public function delete($url)
	{
		if(!$this->permission['news']) return Redirect::to('/');
		
		$news = News::where('url', '=', $url);
		if($news->delete())
			return Redirect::route('admin.news')
								->with('success', "The news has been deleted.");
		else
			return Redirect::route('admin.news')
								->with('errors', 'Some error occurred. Try again.');
	}



}