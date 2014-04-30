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
	// pages DONE
	Route::get('admin/pages', array('as' => 'admin.pages', 'uses' => 'PageController@index'));
	Route::get('admin/pages/add', array('as' => 'admin.pages.add', 'uses' => 'PageController@add'));
	Route::post('admin/pages/add', array('uses' => 'PageController@doAdd'));
	Route::get('admin/pages/{url}', array('as' => 'admin.pages.show', 'uses' => 'PageController@show'));
	Route::get('admin/pages/{url}/edit', array('as' => 'admin.pages.edit', 'uses' => 'PageController@edit'));
	Route::put('admin/pages/{url}/edit', array('uses' => 'PageController@doEdit'));
	Route::delete('admin/pages/{url}', array('as' => 'admin.pages.delete', 'uses' => 'PageController@delete'));
	Route::post('admin/pages/slug', array('as' => 'admin.pages.slug', 'uses' => 'PageController@slug'));
	Route::post('admin/pages/generateUrl', array('as' => 'admin.pages.generateUrl', 'uses' => 'PageController@generateUrl'));

	// build menu DONE
	Route::get('admin/build-menu', array('as' => 'admin.menu.build', 'uses' => 'MenuController@buildMenu'));
	Route::post('admin/build-menu', array('uses' => 'MenuController@doBuildMenu'));

	// Notices DONE
	Route::get('admin/notices', array('as' => 'admin.notices', 'uses' => 'NoticeController@index'));
	Route::get('admin/notices/add', array('as' => 'admin.notices.add', 'uses' => 'NoticeController@add'));
	Route::post('admin/notices/add', array('uses' => 'NoticeController@doAdd'));
	Route::get('admin/notices/{url}', array('as' => 'admin.notices.show', 'uses' => 'NoticeController@show'));
	Route::get('admin/notices/{url}/edit', array('as' => 'admin.notices.edit', 'uses' => 'NoticeController@edit'));
	Route::put('admin/notices/{url}/edit', array('uses' => 'NoticeController@doEdit'));
	Route::delete('admin/notices/{url}', array('as' => 'admin.notices.delete', 'uses' => 'NoticeController@delete'));

	Route::post('admin/notices/generate-url', array('as' => 'admin.notices.generateUrl', 'uses' => 'NoticeController@generateUrl'));

	// faq DONE
	Route::get('admin/faqs', array('as' => 'admin.faqs', 'uses' => 'FaqController@index'));
	Route::get('admin/faqs/add', array('as' => 'admin.faqs.add', 'uses' => 'FaqController@add'));
	Route::post('admin/faqs/add', array('uses' => 'FaqController@doAdd'));
	Route::get('admin/faqs/{pageUrl}', array('as' => 'admin.faqs.show', 'uses' => 'FaqController@show'));
	Route::get('admin/faqs/{pageUrl}/edit', array('as' => 'admin.faqs.edit', 'uses' => 'FaqController@edit'));
	Route::put('admin/faqs/{pageUrl}/edit', array('uses' => 'FaqController@doEdit'));
	Route::delete('admin/faqs/{pageUrl}', array('as' => 'admin.faqs.delete', 'uses' => 'FaqController@delete'));
	Route::post('admin/faqs/slug', array('as' => 'admin.faqs.slug', 'uses' => 'FaqController@slug'));

	// batch DONE
	Route::get('admin/batches', array('as' => 'admin.batches', 'uses' => 'BatchController@index'));
	Route::get('admin/batches/add', array('as' => 'admin.batches.add', 'uses' => 'BatchController@add'));
	Route::post('admin/batches/add', array('uses' => 'BatchController@doAdd'));
	Route::get('admin/batches/{year}', array('as' => 'admin.batches.show', 'uses' => 'BatchController@show'));
	Route::get('admin/batches/{year}/edit', array('as' => 'admin.batches.edit', 'uses' => 'BatchController@edit'));
	Route::put('admin/batches/{year}/edit', array('uses' => 'BatchController@doEdit'));
	Route::delete('admin/batches/{year}', array('as' => 'admin.batches.delete', 'uses' => 'BatchController@delete'));

	// students DONE
	Route::get('admin/students', array('as' => 'admin.students', 'uses' => 'StudentController@index'));
	Route::get('admin/students/add', array('as' => 'admin.students.add', 'uses' => 'StudentController@add'));
	Route::post('admin/students/add', array('uses' => 'StudentController@doAdd'));
	Route::get('admin/students/{reg}', array('as' => 'admin.students.show', 'uses' => 'StudentController@show'));
	Route::get('admin/students/{reg}/edit', array('as' => 'admin.students.edit', 'uses' => 'StudentController@edit'));
	Route::put('admin/students/{reg}/edit', array('uses' => 'StudentController@doEdit'));
	Route::delete('admin/students/{user_id}', array('as' => 'admin.students.delete', 'uses' => 'StudentController@delete'));
});



// public pages [ keep them at last]
Route::get('/', array('as' => 'home', 'uses' => 'PublicController@pages'));
Route::get('faqs', array('as' => 'faqs', 'uses' => 'PublicController@faqs'));
Route::get('notices', array('as' => 'notices', 'uses' => 'PublicController@notices'));
Route::get('notices/{url}', array('as' => 'notices.show', 'uses' => 'PublicController@noticesShow'));
Route::get('faculty', function() {
	return "Under Construction";
});
Route::get('stuff', function() {
	return "Under Construction";
});
Route::get('batches', array('as' => 'batches', 'uses' => 'PublicController@batches'));
Route::get('batches/{year}', array('as' => 'batches.show', 'uses' => 'PublicController@batchesShow'));

Route::get('{pageUrl}', array('uses' => 'PublicController@pages'));


