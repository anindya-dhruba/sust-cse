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
	Route::get('pages', array('as' => 'pages', 'uses' => 'PageController@index'));
	Route::get('pages/add', array('as' => 'pages.add', 'uses' => 'PageController@add'));
	Route::post('pages/add', array('uses' => 'PageController@doAdd'));
	Route::get('pages/{pageUrl}', array('as' => 'pages.show', 'uses' => 'PageController@show'));
	Route::get('pages/{pageUrl}/edit', array('as' => 'pages.edit', 'uses' => 'PageController@edit'));
	Route::put('pages/{pageUrl}/edit', array('uses' => 'PageController@doEdit'));
	Route::delete('pages/{pageUrl}', array('as' => 'pages.delete', 'uses' => 'PageController@delete'));
	
	Route::get('build-menu', array('as' => 'pages.buildMenu', 'uses' => 'PageController@buildMenu'));
	Route::post('build-menu', array('uses' => 'PageController@doBuildMenu'));

	Route::post('pages/slug', array('as' => 'pages.slug', 'uses' => 'PageController@slug'));

	//Notice Route Add
	Route::get('notices', array('as' => 'notices', 'uses' => 'NoticeController@index'));
	Route::get('notices/add', array('as' => 'notices.add', 'uses' => 'NoticeController@add'));
	Route::post('notices/add', array('uses' => 'NoticeController@doAdd'));
	Route::get('notices/{pageUrl}', array('as' => 'notices.show', 'uses' => 'NoticeController@show'));
	Route::get('notices/{pageUrl}/edit', array('as' => 'notices.edit', 'uses' => 'NoticeController@edit'));
	Route::put('notices/{pageUrl}/edit', array('uses' => 'NoticeController@doEdit'));
	Route::delete('notices/{pageUrl}', array('as' => 'notices.delete', 'uses' => 'NoticeController@delete'));

	Route::post('notices/slug', array('as' => 'notices.slug', 'uses' => 'NoticeController@slug'));
});



// public pages [ keep them at last]
Route::get('/', array('as' => 'home', 'uses' => 'PublicController@show'));
Route::get('{pageName}', array('uses' => 'PublicController@show'));


