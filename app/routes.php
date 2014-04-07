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
	// pages
	Route::get('pages', array('as' => 'pages', 'uses' => 'PageController@index'));
	Route::get('pages/add', array('as' => 'pages.add', 'uses' => 'PageController@add'));
	Route::post('pages/add', array('uses' => 'PageController@doAdd'));
	Route::get('pages/{pageUrl}', array('as' => 'pages.show', 'uses' => 'PageController@show'));
	Route::get('pages/{pageUrl}/edit', array('as' => 'pages.edit', 'uses' => 'PageController@edit'));
	Route::put('pages/{pageUrl}/edit', array('uses' => 'PageController@doEdit'));
	Route::delete('pages/{pageUrl}', array('as' => 'pages.delete', 'uses' => 'PageController@delete'));
	Route::post('pages/slug', array('as' => 'pages.slug', 'uses' => 'PageController@slug'));

	// build menu
	Route::get('build-menu', array('as' => 'pages.buildMenu', 'uses' => 'PageController@buildMenu'));
	Route::post('build-menu', array('uses' => 'PageController@doBuildMenu'));

	// batch
	Route::get('batches', array('as' => 'batches', 'uses' => 'BatchController@index'));
	Route::get('batches/add', array('as' => 'batches.add', 'uses' => 'BatchController@add'));
	Route::post('batches/add', array('uses' => 'BatchController@doAdd'));
	Route::get('batches/{year}', array('as' => 'batches.show', 'uses' => 'BatchController@show'));
	Route::get('batches/{year}/edit', array('as' => 'batches.edit', 'uses' => 'BatchController@edit'));
	Route::put('batches/{year}/edit', array('uses' => 'BatchController@doEdit'));
	Route::delete('batches/{year}', array('as' => 'batches.delete', 'uses' => 'BatchController@delete'));
});



// public pages [ keep them at last]
Route::get('/', array('as' => 'home', 'uses' => 'PublicController@show'));
Route::get('{pageName}', array('uses' => 'PublicController@show'));


