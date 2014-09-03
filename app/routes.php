<?php

// for guest only
Route::group(array('before' => 'guest'), function()
{
	Route::get('login', array('as' => 'login', 'uses' => 'UserController@login'));
	Route::post('login', array('uses' => 'UserController@doLogin'));
	Route::get('register', array('as' => 'register', 'uses' => 'UserController@register'));
	Route::post('register', array('uses' => 'UserController@doRegister'));
	Route::get('forgot-password', array('as' =>'password.forgot', 'uses' => 'UserController@forgotPassword'));
	Route::post('forgot-password', array('as' =>'password.forgot', 'uses' => 'UserController@savePasswordToken'));
	Route::get('reset-password/{token}', array('as' => 'password.reset', 'uses'	=> 'UserController@resetPassword'));
	Route::post('reset-password/{token}', array('as' => 'password.reset', 'uses' => 'UserController@doResetPassword'));
});

// for any logged in user
Route::group(array('before' => 'auth'), function()
{
	Route::get('logout', array('as' => 'logout', 'uses' => 'UserController@logout'));
	
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
	Route::post('admin/build-side-menu', array('uses' => 'MenuController@doBuildSideMenu'));
	Route::post('admin/build-top-menu', array('uses' => 'MenuController@doBuildTopMenu'));
	Route::post('admin/select-icon-location', array('as'=> 'admin.selectIconLocation', 'uses' => 'MenuController@doSelectIcon'));

	// Notices DONE
	Route::get('admin/notices', array('as' => 'admin.notices', 'uses' => 'NoticeController@index'));
	Route::get('admin/notices/add', array('as' => 'admin.notices.add', 'uses' => 'NoticeController@add'));
	Route::post('admin/notices/add', array('uses' => 'NoticeController@doAdd'));
	Route::get('admin/notices/{url}', array('as' => 'admin.notices.show', 'uses' => 'NoticeController@show'));
	Route::get('admin/notices/{url}/edit', array('as' => 'admin.notices.edit', 'uses' => 'NoticeController@edit'));
	Route::put('admin/notices/{url}/edit', array('uses' => 'NoticeController@doEdit'));
	Route::delete('admin/notices/{url}', array('as' => 'admin.notices.delete', 'uses' => 'NoticeController@delete'));

	Route::post('admin/notices/generate-url', array('as' => 'admin.notices.generateUrl', 'uses' => 'NoticeController@generateUrl'));

	// Events DONE
	Route::get('admin/events', array('as' => 'admin.events', 'uses' => 'EventController@index'));
	Route::get('admin/events/add', array('as' => 'admin.events.add', 'uses' => 'EventController@add'));
	Route::post('admin/events/add', array('uses' => 'EventController@doAdd'));
	Route::get('admin/events/{url}', array('as' => 'admin.events.show', 'uses' => 'EventController@show'));
	Route::get('admin/events/{url}/edit', array('as' => 'admin.events.edit', 'uses' => 'EventController@edit'));
	Route::put('admin/events/{url}/edit', array('uses' => 'EventController@doEdit'));
	Route::delete('admin/events/{url}', array('as' => 'admin.events.delete', 'uses' => 'EventController@delete'));

	Route::post('admin/events/generate-url', array('as' => 'admin.events.generateUrl', 'uses' => 'EventController@generateUrl'));

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


	// faculty DONE
	Route::get('admin/faculty', array('as' => 'admin.faculty', 'uses' => 'FacultyController@index'));
	Route::get('admin/faculty/add', array('as' => 'admin.faculty.add', 'uses' => 'FacultyController@add'));
	Route::post('admin/faculty/add', array('uses' => 'FacultyController@doAdd'));
	Route::get('admin/faculty/{tagname}', array('as' => 'admin.faculty.show', 'uses' => 'FacultyController@show'));
	Route::get('admin/faculty/{tagname}/edit', array('as' => 'admin.faculty.edit', 'uses' => 'FacultyController@edit'));
	Route::put('admin/faculty/{tagname}/edit', array('uses' => 'FacultyController@doEdit'));
	Route::delete('admin/faculty/{user_id}', array('as' => 'admin.faculty.delete', 'uses' => 'FacultyController@delete'));
	Route::post('admin/faculty/research/add', array('as' => 'admin.faculty.research.add', 'uses' => 'FacultyController@doAddResearch'));

	// stuffs DONE
	Route::get('admin/stuffs', array('as' => 'admin.stuffs', 'uses' => 'StuffController@index'));
	Route::get('admin/stuffs/add', array('as' => 'admin.stuffs.add', 'uses' => 'StuffController@add'));
	Route::post('admin/stuffs/add', array('uses' => 'StuffController@doAdd'));
	Route::get('admin/stuffs/{tagname}', array('as' => 'admin.stuffs.show', 'uses' => 'StuffController@show'));
	Route::get('admin/stuffs/{tagname}/edit', array('as' => 'admin.stuffs.edit', 'uses' => 'StuffController@edit'));
	Route::put('admin/stuffs/{tagname}/edit', array('uses' => 'StuffController@doEdit'));
	Route::delete('admin/stuffs/{user_id}', array('as' => 'admin.stuffs.delete', 'uses' => 'StuffController@delete'));
	Route::post('admin/stuffs/research/add', array('as' => 'admin.stuffs.research.add', 'uses' => 'FacultyController@doAddResearch'));

	// gallery DONE
	Route::get('admin/albums', array('as' => 'admin.albums', 'uses' => 'AlbumController@albums'));
	Route::get('admin/albums/add', array('as' => 'admin.albums.add', 'uses' => 'AlbumController@add'));
	Route::post('admin/albums/add', array('uses' => 'AlbumController@doAdd'));
	Route::get('admin/albums/{pageUrl}', array('as' => 'admin.albums.show', 'uses' => 'AlbumController@show'));
	Route::get('admin/albums/{pageUrl}/edit', array('as' => 'admin.albums.edit', 'uses' => 'AlbumController@edit'));
	Route::put('admin/albums/{pageUrl}/edit', array('uses' => 'AlbumController@doEdit'));
	Route::delete('admin/albums/{id}', array('as' => 'admin.albums.delete', 'uses' => 'AlbumController@delete'));

	Route::post('admin/albums/generate-url', array('as' => 'admin.albums.generateUrl', 'uses' => 'AlbumController@generateUrl'));

	// pictures Done
	Route::get('admin/pictures', array('as' => 'admin.pictures', 'uses' => 'PictureController@index'));
	Route::get('admin/pictures/add', array('as' => 'admin.pictures.add', 'uses' => 'PictureController@add'));
	Route::post('admin/pictures/add', array('uses' => 'PictureController@doAdd'));
	Route::get('admin/pictures/{url}', array('as' => 'admin.pictures.show', 'uses' => 'PictureController@show'));
	Route::get('admin/pictures/{url}/edit', array('as' => 'admin.pictures.edit', 'uses' => 'PictureController@edit'));
	Route::put('admin/pictures/{url}/edit', array('uses' => 'PictureController@doEdit'));
	Route::delete('admin/pictures/{id}', array('as' => 'admin.pictures.delete', 'uses' => 'PictureController@delete'));

	Route::post('admin/pictures/generate-url', array('as' => 'admin.pictures.generateUrl', 'uses' => 'PictureController@generateUrl'));


	// courses Done
	Route::get('admin/courses', array('as' => 'admin.courses', 'uses' => 'CourseController@index'));
	Route::get('admin/courses/add', array('as' => 'admin.courses.add', 'uses' => 'CourseController@add'));
	Route::post('admin/courses/add', array('uses' => 'CourseController@doAdd'));
	Route::get('admin/courses/{url}', array('as' => 'admin.courses.show', 'uses' => 'CourseController@show'));
	Route::get('admin/courses/{url}/edit', array('as' => 'admin.courses.edit', 'uses' => 'CourseController@edit'));
	Route::put('admin/courses/{url}/edit', array('uses' => 'CourseController@doEdit'));
	Route::delete('admin/courses/{id}', array('as' => 'admin.courses.delete', 'uses' => 'CourseController@delete'));

	Route::post('admin/courses/generate-url', array('as' => 'admin.courses.generateUrl', 'uses' => 'CourseController@generateUrl'));

	
	// Slider
	Route::get('admin/slider', array('as' => 'admin.slider', 'uses' => 'SliderController@index'));
	Route::get('admin/slider/select', array('as' => 'admin.slider.select', 'uses' => 'SliderController@select'));
	Route::get('admin/slider/{id}/crop', array('as' => 'admin.slider.crop', 'uses' => 'SliderController@crop'));
	Route::post('admin/slider/{id}/crop', array('as' => 'admin.slider.crop', 'uses' => 'SliderController@doCrop'));
	Route::get('admin/slider/{id}/edit', array('as' => 'admin.slider.edit', 'uses' => 'SliderController@edit'));
	Route::put('admin/slider/{id}/edit', array('uses' => 'SliderController@doEdit'));
	Route::delete('admin/slider/{id}', array('as' => 'admin.slider.delete', 'uses' => 'SliderController@delete'));

	Route::get('profile', array('as' => 'profile.show', 'uses' => 'PublicController@profile'));
	Route::get('profile/edit', array('as' => 'profile.edit', 'uses' => 'PublicController@editProfile'));
	Route::put('profile/edit', array('as' => 'profile.edit', 'uses' => 'PublicController@doEditProfile'));
	Route::get('password/edit', array('as' => 'password.edit', 'uses' => 'PublicController@editPassword'));
	Route::put('password/edit', array('as' => 'password.edit', 'uses' => 'PublicController@doEditPassword'));

	// wysiwyg routes
	Route::post('upload', array('as' => 'upload', 'uses' => 'BaseController@uploadFileFromEditor'));
	Route::get('list', array('as' => 'list', 'uses' => 'BaseController@fileList'));
	
});



// public pages [ keep them at last]
Route::get('/', array('as' => 'home', 'uses' => 'PublicController@pages'));
Route::get('faqs', array('as' => 'faqs', 'uses' => 'PublicController@faqs'));
Route::get('notices', array('as' => 'notices', 'uses' => 'PublicController@notices'));
Route::get('notices/{url}', array('as' => 'notices.show', 'uses' => 'PublicController@noticesShow'));
Route::get('events', array('as' => 'events', 'uses' => 'PublicController@events'));
Route::get('events/{url}', array('as' => 'events.show', 'uses' => 'PublicController@noticesShow'));
Route::get('events', array('as' => 'events', 'uses' => 'PublicController@events'));
Route::get('events/{url}', array('as' => 'events.show', 'uses' => 'PublicController@eventsShow'));
Route::get('courses', array('as' => 'courses', 'uses' => 'PublicController@courses'));
Route::get('courses/{url}', array('as' => 'courses.show', 'uses' => 'PublicController@coursesShow'));

Route::get('faculty', array('as' => 'faculty', 'uses' => 'PublicController@faculty'));
Route::get('faculty/{tagname}', array('as' => 'faculty.show', 'uses' => 'PublicController@facultyShow'));

Route::get('stuffs', array('as' => 'stuffs', 'uses' => 'PublicController@stuffs'));
Route::get('stuffs/{tagname}', array('as' => 'stuffs.show', 'uses' => 'PublicController@stuffsShow'));

Route::get('batches', array('as' => 'batches', 'uses' => 'PublicController@batches'));
Route::get('batches/{year}', array('as' => 'batches.show', 'uses' => 'PublicController@batchesShow'));
Route::get('batches/{year}/reg/{reg}', array('as' => 'students.show', 'uses' => 'PublicController@studentsShow'));

Route::get('{pageUrl}', array('uses' => 'PublicController@pages'));


