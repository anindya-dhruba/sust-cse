<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;

class SliderController extends BaseController {

	/**
	 * show all pictures
	 * @return void
	 */
	public function index()
	{
		if(!$this->permission['sliders']) return Redirect::to('/');

		$sliders = Slider::orderBy('updated_at', 'desc')->get();

		return View::make('sliders.index')
						->with('title', 'Viewing Silder Images')
						->with('sliders', $sliders);
	}

	/**
	 * select a picture to crop
	 * @return void
	 */
	public function select()
	{
		if(!$this->permission['sliders']) return Redirect::to('/');

		$pictures = Picture::orderBy('updated_at', 'desc')->paginate(10);

		return View::make('sliders.select')
						->with('title', 'Choose Picture To Home Slider')
						->with('pictures', $pictures);
	}

	/**
	 * show crop picture page
	 * @param  int $id
	 * @return void
	 */
	public function crop($id)
	{
		if(!$this->permission['sliders']) return Redirect::to('/');

		$picture = Picture::find($id);

		return View::make('sliders.crop')
						->with('title', 'Edit Slider Picture')
						->with('picture', $picture);
	}

	/**
	 * do crop a picture
	 * @param  int $id
	 * @return void
	 */
	public function doCrop($id)
	{

		if(!$this->permission['sliders']) return Redirect::to('/');

		$rules = array
		(
	    	'caption' 	=> 'required'
		);

		$validation = Validator::make(Input::all(), $rules);

		
		if($validation->fails())
			return Redirect::back()
								->withInput()
								->withErrors($validation);

		else
		{
			$file = Input::get('picture');
			$destinationPath = public_path('uploads/slider_images');
			$fileName = strtotime(date('Y-m-d H:i:s')).".jpg";

			Image::make(public_path($file))
						->resize(1280, null, true)
						->crop(1280, 700, 0, 0)
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
				return Redirect::back()
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
		if(!$this->permission['sliders']) return Redirect::to('/');

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
		if(!$this->permission['sliders']) return Redirect::to('/');

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
		if(!$this->permission['sliders']) return Redirect::to('/');

		$slider = Slider::find($id);
		if($slider->delete())
			return Redirect::route('admin.slider')
								->with('success', "The slider picture has been deleted.");
		else
			return Redirect::route('admin.slider')
								->with('errors', 'Some error occured. Try again.');
	}
}