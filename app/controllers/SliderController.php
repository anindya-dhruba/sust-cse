<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;

class SliderController extends BaseController {

	public function index()
	{
		$sliders = Slider::orderBy('updated_at', 'desc')->get();

		return View::make('sliders.index')
						->with('title', 'Viewing Silder Images')
						->with('sliders', $sliders);
	}

	public function select()
	{
		$pictures = Picture::paginate(10);

		return View::make('sliders.select')
						->with('title', 'Choose Picture To Home Slider')
						->with('pictures', $pictures);
	}

	public function crop($id)
	{
		$picture = Picture::find($id);

		return View::make('sliders.crop')
						->with('title', 'Edit Slider Picture')
						->with('picture', $picture);
	}

	public function doCrop($id)
	{
		$rules = array
		(
	    	'caption' 	=> 'required'
		);

		$validation = Validator::make(Input::all(), $rules);

		
		if($validation->fails())
			return Redirect::route('admin.slider.crop', ['id' => $id])
								->withInput()
								->withErrors($validation);

		else
		{
			$file = Input::get('picture');
			$destinationPath = public_path('uploads/slider_images');
			$fileName = strtotime(date('Y-m-d H:i:s')).".jpg";

			Image::make(public_path($file))
						->crop(Input::get('w'), Input::get('h'), Input::get('x'), Input::get('y'))
						->save($destinationPath."/".$fileName);

			Image::make($destinationPath."/".$fileName)
						->resize(200, null, true)
						->save($destinationPath."/thumbnail_".$fileName);

			$slider = new Slider;
			$slider->caption = Input::get('caption');
			$slider->file_url = $fileName;
			$slider->is_active = Input::get('is_active', 0);

			if($slider->save())
			    return Redirect::route('admin.slider')
			    					->with('success', "Slider image has added successfully.");
			else
				return Redirect::route('admin.slider.edit', ['id' => $id])
									->withInput()
									->with('error', 'Some error occured. Try again.');
		}	
	}

	/**
	 * Edit a slider image
	 * @param  string $id
	 * @return void
	 */
	public function edit($id)
	{
		try
		{
		    $picture = Slider::findOrFail($id);

		    return View::make('sliders.edit')
						->with('title', "Editing Slider Picture Information")
						->with('picture', $picture);
		}
		catch(ModelNotFoundException $e)
		{
		   return "Page not found.";
		}
	}

	/**
	 * Do edit a slider picture
	 * @param  string $id
	 * @return void
	 */
	public function doEdit($id)
	{
		$rules = array
		(
	    	'caption' 	=> 'required',
		);

		$validation = Validator::make(Input::all(), $rules);
		
		if($validation->fails())
			return Redirect::route('admin.slider.edit', array('id' => $id))
								->withInput()
								->withErrors($validation);
		else
		{
			$slider = Slider::find($id);
			$slider->caption = Input::get('caption');
			$slider->is_active = Input::get('is_active', 0);

			if($slider->save())
			    return Redirect::route('admin.slider')
			    					->with('success', "Slider Picture has updated successfully.");
			else
				return Redirect::route('admin.slider.edit', array('id' => $id))
									->withInput()
									->with('error', 'Some error occured. Try again.');
		}
	}

	/**
	 * Delete a slider picture
	 * @param  string $id
	 * @return void
	 */
	public function delete($id)
	{
		$slider = Slider::find($id);
		if($slider->delete())
			return Redirect::route('admin.slider')
								->with('success', "The slider picture has been deleted.");
		else
			return Redirect::route('admin.slider')
								->with('errors', 'Some error occured. Try again.');
	}
}