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
			return Redirect::back()
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

	/**
	 * do register a student
	 * @return void
	 */
	public function register()
	{
		return View::make('users.register')
						->with('title', 'Register')
						->with('batches', ['' => '-- select --'] + Batch::orderBy('year', 'desc')->lists('year', 'id'));
	}

	/**
	 * do register a user(student)
	 * @return void
	 */
	public function doRegister()
	{
		$rules = array
		(
			'reg'             => 	'required|numeric',
			'first_name'      =>	'required',
			'last_name'       =>	'required',
			'email'           =>	'required|email',
			'batch'           =>	'required',
			'password'		  =>	'required'
		);

		$validation = Validator::make(Input::all(), $rules);
		
		if($validation->fails())
			return Redirect::back()
								->withInput()
								->withErrors($validation);
		else
		{
			$user = User::student()->where('reg', '=', Input::get('reg'))->first();
			
			// if user exists with this reg & user has an email -> notify user
			if($user && !is_null($user->email))
			{
				return Redirect::back()
								->withInput()
								->with('success', "You already have an account with registration no <code>".Input::get('reg')."</code> with an email address of <code>$user->email</code>. Click forgot password if you cannot access your account.");
			}
			// if user exists with this reg & user does not have an email -> update data
			else if($user)
			{
				$isEmailAlreadyRegistered = User::where('email', '=', Input::get('email'))->first();

				if($isEmailAlreadyRegistered)
				{
					return Redirect::back()
								->withInput()
								->with('error', "This Email Address is already registered.");
				}

				$user->first_name          = Input::get('first_name');
				$user->middle_name         = Input::get('middle_name');
				$user->last_name           = Input::get('last_name');
				$user->email               = Input::get('email');
				$user->reg                 = Input::get('reg');
				$user->batch_id            = Input::get('batch');
				$user->password            = Hash::make(Input::get('password'));
				
				if($user->save())
				{
					Auth::login($user);
				    return Redirect::route('profile.show')
				    					->with('success', "You have successfully registered.");
				}
				else
					return Redirect::back()
									->withInput()
									->with('error', 'Some error occured. Try again.');
			}
			// if user does not exist -> create new
			else
			{
				$isEmailAlreadyRegistered = User::where('email', '=', Input::get('email'))->first();

				if($isEmailAlreadyRegistered)
				{
					return Redirect::back()
								->withInput()
								->with('error', "This Email Address is already registered.");
				}

				$user 					   = new User;
				$user->first_name          = Input::get('first_name');
				$user->middle_name         = Input::get('middle_name');
				$user->last_name           = Input::get('last_name');
				$user->email               = Input::get('email');
				$user->reg                 = Input::get('reg');
				$user->role_id             = 5; // student
				$user->batch_id            = Input::get('batch');
				$user->password            = Hash::make(Input::get('password'));
				
				if($user->save())
				{
				    return Redirect::route('login')
				    					->with('success', "You have successfully registered. Please login below.");
				}
				else
					return Redirect::back()
									->withInput()
									->with('error', 'Some error occured. Try again.');
			}
		}
	}

	/**
	 * shows forgot password page
	 * @return void
	 */
	public function forgotPassword()
	{
		return View::make('users.forgotPassword')
							->with('title', 'Forgot Password');
	}

	/**
	 * save and send password reset link
	 * @return void
	 */
	public function savePasswordToken()
	{
		$rules = [
	    	'email' 	=> 'required|email'
		];

		$validation = Validator::make(Input::all(), $rules);
		
		if($validation->fails())
			return Redirect::back()
								->withInput()
								->withErrors($validation);
		else
		{
			// email has a account?
			if(User::where('email', '=', Input::get('email'))->first())
			{
				$credentials = ['email' => Input::get('email')];
		 
		  		$isEmailSent = Password::remind($credentials, function($message) {
								$message->subject('Reset Password'); 
							});

		  		if($isEmailSent)
		  			return Redirect::route('login')
								->with('success', 'A email has been sent to the email address containing a reset password link.');
				else
					return Redirect::back()
										->withInput()
										->with('error', 'Password could not be reset. Try again.');
			}
			else
			{
				return Redirect::back()
									->withInput()
									->with('error', 'No account found with this email address.');
			}
		}
	}

	/**
	 * shows reset password page
	 * @param  string $token
	 * @return void
	 */
	public function resetPassword($token)
	{
		if($tokenData = DB::table('password_reminders')->where('token', '=', $token)->first())
		{
			return View::make('users.resetPassword')
							->with('title', 'Reset Password')
							->with('tokenData', $tokenData);
		}
		else
		{
			return Redirect::route('login')
						->with('error', 'Sorry, Token does not match.');
		}
	}

	/**
	 * do reset password of a user
	 * @param  string $token
	 * @return void
	 */
	public function doResetPassword($token)
	{
		$rules = [
	    	'new_password' 				=> 'required|confirmed',
	    	'new_password_confirmation' => 'required'
		];

		$validation = Validator::make(Input::all(), $rules);
		
		if($validation->fails())
		{
			return Redirect::back()
								->withInput()
								->withErrors($validation);
		}
		else
		{
			$user = User::where('email', '=', Input::get('email'))->first();
			$user->password = Hash::make(Input::get('new_password'));
			$user->save();

			// delete token
			DB::table('password_reminders')->where('token', '=', $token)->delete();

			return Redirect::route('login')
									->with('success', 'Your password has been reset. Login with the new password.');
		}
	}
}