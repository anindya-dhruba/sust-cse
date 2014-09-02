<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;

class EventController extends BaseController {
	
	/**
	 * View all events
	 * @return void
	 */
	public function index()
	{
		if(!$this->permission['events']) return Redirect::to('/');
		
		$events = AppEvent::orderBy('created_at', 'desc')->paginate(10);

		return View::make('events.index')
						->with('title', 'Viewing All Events')
						->with('events', $events);
	}

	/**
	 * Generates url for event
	 * @return string
	 */
	public function generateUrl()
	{
		if(!$this->permission['events']) return Redirect::to('/');
		
		$url = Str::slug(Input::get('title'));
		$urlCount = count(AppEvent::where('url', '=', $url)->get());
		return ($urlCount > 0) ? "{$url}-{$urlCount}" : $url;
	}

	/**
	 * Add new event
	 */
	public function add()
	{
		if(!$this->permission['events']) return Redirect::to('/');
		
		return View::make('events.add')
						->with('title', 'Add New Event');
	}


	/**
	 * Do Add Event
	 * @return void
	 */
	public function doAdd()
	{
		if(!$this->permission['events']) return Redirect::to('/');
		
		$rules = array
		(
	    	'title' 		=> 'required',
	    	'url' 			=> 'required|unique:events',
	    	'event' 		=> 'required',
	    	'start_date'	=> 'required|date',
	    	'end_date' 		=> 'required|date'
		);

		$validation = Validator::make(Input::all(), $rules);

		
		if($validation->fails())
			return Redirect::back()
								->withInput()
								->withErrors($validation);

		else
		{
			$event = new AppEvent;
			$event->title     	= Input::get('title');
			$event->url       	= Input::get('url');
			$event->is_public 	= Input::get('is_public', 0);
			$event->event     	= Input::get('event');
			$event->start_date 	= Input::get('start_date');
			$event->end_date 	= Input::get('end_date');
			$event->user_id   	= Auth::user()->id;

			if($event->save())
			    return Redirect::route('admin.events.show', array('pageUrl' => $event->url))
			    					->with('success', "Event '$event->title' has added successfully.");
			else
				return Redirect::back()
									->withInput()
									->with('error', 'Some error occured. Try again.');
		}
	}


	/**
	 * Show an event
	 * @param  string $url
	 * @return void
	 */
	public function show($url)
	{
		if(!$this->permission['events']) return Redirect::to('/');
		
		try
		{
		    $event = AppEvent::where('url', '=', $url)->firstOrFail();

		    return View::make('events.show')
						->with('title', 'Viewing Event')
						->with('event', $event);
		}
		catch(ModelNotFoundException $e)
		{
		   return "Page not found.";
		}
	}

	/**
	 * Edit an event
	 * @param  string $url
	 * @return void
	 */
	public function edit($url)
	{
		if(!$this->permission['events']) return Redirect::to('/');
		
		try
		{
		    $event = AppEvent::where('url', '=', $url)->firstOrFail();

		    return View::make('events.edit')
						->with('title', "Editing event")
						->with('event', $event);
		}
		catch(ModelNotFoundException $e)
		{
		   return "Page not found.";
		}
	}

	/**
	 * Do edit an event
	 * @param  string $url
	 * @return void
	 */
	public function doEdit($url)
	{
		if(!$this->permission['events']) return Redirect::to('/');
		
		$rules = array
		(
	    	'title' 	=> 'required',
	    	'url' 		=> 'required|unique:events,url,'.Input::get('eventId'),
	    	'event' 	=> 'required',
	    	'start_date'=> 'required|date',
	    	'end_date'	=> 'required|date'
		);

		$validation = Validator::make(Input::all(), $rules);
		
		if($validation->fails())
			return Redirect::back()
								->withInput()
								->withErrors($validation);
		else
		{
			$event = AppEvent::where('url', '=', $url)->first();
			$event->title     	= Input::get('title');
			$event->url       	= Input::get('url');
			$event->is_public 	= Input::get('is_public', 0);
			$event->start_date 	= Input::get('start_date');
			$event->end_date 	= Input::get('end_date');
			$event->event     	= Input::get('event');

			if($event->save())
			    return Redirect::route('admin.events.show', array('url' => $event->url))
			    					->with('success', "Event '$event->title' has updated successfully.");
			else
				return Redirect::back()
									->withInput()
									->with('error', 'Some error occured. Try again.');
		}
	}

	/**
	 * Delete a event
	 * @param  string $url
	 * @return void
	 */
	public function delete($url)
	{
		if(!$this->permission['events']) return Redirect::to('/');
		
		$event = AppEvent::where('url', '=', $url);
		if($event->delete())
			return Redirect::route('admin.events')
								->with('success', "The event has been deleted.");
		else
			return Redirect::route('admin.events')
								->with('errors', 'Some error occured. Try again.');
	}



}