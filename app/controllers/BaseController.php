<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
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
		if(Input::hasFile('upload'))
	    {
	    	$file = Input::file('upload');

	        $destinationPath = public_path('uploads');
	        $fileName = Str::random(4, 'alpha').".".$file->getClientOriginalExtension();
	        $file->move($destinationPath, $fileName);
	       
	        return 'Success. Select the file by browsing server';
	    }
	}

	/**
	 * get list of public/uploads dir files
	 * @return json
	 */
	public function fileList()
	{
		$files = array();

		foreach (File::files('public/uploads') as $key => $file)
		{
			$file = str_replace('public/', '', $file);
			$files[] = array('image' => '/'.$file);
		}
		return json_encode($files);
	}

}