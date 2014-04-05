<?php

// for guest only
Route::group(array('before' => 'guest'), function()
{
	Route::get('login', array('as' => 'login', 'uses' => 'UserController@login'));
	Route::post('login', array('uses' => 'UserController@doLogin'));
});

// for any logged in user
Route::group(array('before' => 'auth'), function()
{
	Route::get('logout', array('as' => 'logout', 'uses' => 'UserController@logout'));
});

// for student
Route::group(array('before' => 'auth|student'), function()
{
	
});

// for stuff
Route::group(array('before' => 'auth|stuff'), function()
{
	
});

// for faculty
Route::group(array('before' => 'auth|faculty'), function()
{
	
});

// for head
Route::group(array('before' => 'auth|head'), function()
{
	
});

// for admin
Route::group(array('before' => 'auth|admin'), function()
{
	
});



// public pages [ keep them at last]
Route::get('/', array('as' => 'home', 'uses' => 'PageController@show'));
Route::get('{pageName}', array('uses' => 'PageController@show'));


