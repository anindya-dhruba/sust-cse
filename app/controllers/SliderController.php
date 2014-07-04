<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;

class SliderController extends BaseController {

	public function index()
	{
		$picture = Picture::find(5);

		return View::make('Sliders.index')
						->with('title', 'Viewing All Sliders')
						->with('picture', $picture);
	}
}