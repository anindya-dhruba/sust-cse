<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;

class SliderController extends BaseController {

	public function index()
	{
		$picture = Picture::find(7);

		return View::make('Sliders.index')
						->with('title', 'Viewing All Sliders')
						->with('picture', $picture);
	}

	public function crop()
	{
		$file = Input::get('picture');
		$destinationPath = public_path('uploads/slider_images');
		$fileName = strtotime(date('Y-m-d H:i:s')).".jpg";

		Image::make(public_path($file))
					->crop(Input::get('w'), Input::get('h'), Input::get('x'), Input::get('y'))
					->save($destinationPath."/".$fileName);
		return;
	}
}