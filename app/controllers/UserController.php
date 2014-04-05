<?php

class UserController extends BaseController {

	/**
	 * login page
	 * @return void
	 */
	public function login()
	{
		return View::make('users.login')
						->with('title', 'Log in');
	}

	/**
	 * process to login a user
	 * @return void
	 */
	public function doLogin()
	{
		$rules = array
		(
	    	'email' 	=> 'required|email',
	    	'password' 	=> 'required'
		);
		$validation = Validator::make(Input::all(), $rules);
		
		if($validation->fails())
			return Redirect::to('login')
								->withInput()
								->withErrors($validation);
		else
		{
			$credentials = array
			(
				'email'		=>	Input::get('email'),
				'password'	=>	Input::get('password')
			);

			if(Auth::attempt($credentials))
			{
				Session::put('role', Auth::user()->role_id);
			    return Redirect::intended('/');
			}
			else
				return Redirect::route('login')
									->withInput()
									->with('error', 'Error in Email Address or Password.');
		}
	}

	/**
	 * logout a user
	 * @return void
	 */
	function logout()
	{
		Auth::logout();
		Session::forget('role');

		return Redirect::route('login')
						->with('success', 'You have been logged out.');
	}
}