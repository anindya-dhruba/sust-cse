<?php

class BaseController extends Controller {

	public $permission = null;
	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if(Auth::check())
		{
			$permission = Auth::user()->role;
			$this->permission = Auth::user()->role->toArray();
			View::share('permission', $permission);
		}
		else
		{
			View::share('permission', null);	
		}

		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	/**
	 * upload file from editor
	 * @return string
	 */
	public function uploadFileFromEditor()
	{
		if(Input::hasFile('summernotefile'))
	    {
	    	$file = Input::file('summernotefile');

	        $destinationPath = public_path('uploads/summernote_images');
	        $fileName = strtotime(date('Y-m-d H:i:s')).".".$file->getClientOriginalExtension();
	        if($file->move($destinationPath, $fileName))
			{
				echo URL::to("uploads/summernote_images/".$fileName);
				return;
			}
			else
			{
				echo "Some error occured to upload image. Try Again!";
				return;
			}

		}
	}

}