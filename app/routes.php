<?php

// for guest only
Route::group(array('before' => 'guest'), function()
{
	// login
	Route::get('login', array('as' => 'login', 'uses' => 'UserController@login'));
	Route::post('login', array('uses' => 'UserController@doLogin'));

	// register
	Route::get('register', array('as' => 'register', 'uses' => 'UserController@register'));
	Route::post('register', array('uses' => 'UserController@doRegister'));

	// forgot password
	Route::get('forgot-password', array('as' =>'password.forgot', 'uses' => 'UserController@forgotPassword'));
	Route::post('forgot-password', array('as' =>'password.forgot', 'uses' => 'UserController@savePasswordToken'));

	// reset password
	Route::get('reset-password/{token}', array('as' => 'password.reset', 'uses'	=> 'UserController@resetPassword'));
	Route::post('reset-password/{token}', array('as' => 'password.reset', 'uses' => 'UserController@doResetPassword'));
});

// for any logged in user
Route::group(array('before' => 'auth'), function()
{
	// logout
	Route::get('logout', array('as' => 'logout', 'uses' => 'UserController@logout'));
	
	// pages
	Route::get('admin/pages', array('as' => 'admin.pages', 'uses' => 'PageController@index'));
	Route::get('admin/pages/add', array('as' => 'admin.pages.add', 'uses' => 'PageController@add'));
	Route::post('admin/pages/add', array('uses' => 'PageController@doAdd'));
	Route::get('admin/pages/{url}', array('as' => 'admin.pages.show', 'uses' => 'PageController@show'));
	Route::get('admin/pages/{url}/edit', array('as' => 'admin.pages.edit', 'uses' => 'PageController@edit'));
	Route::put('admin/pages/{url}/edit', array('uses' => 'PageController@doEdit'));
	Route::delete('admin/pages/{url}', array('as' => 'admin.pages.delete', 'uses' => 'PageController@delete'));
	Route::post('admin/pages/slug', array('as' => 'admin.pages.slug', 'uses' => 'PageController@slug'));
	Route::post('admin/pages/generateUrl', array('as' => 'admin.pages.generateUrl', 'uses' => 'PageController@generateUrl'));

	// build menu
	Route::get('admin/build-menu', array('as' => 'admin.menu.build', 'uses' => 'MenuController@buildMenu'));
	Route::post('admin/build-side-menu', array('uses' => 'MenuController@doBuildSideMenu'));
	Route::post('admin/build-top-menu', array('uses' => 'MenuController@doBuildTopMenu'));
	Route::post('admin/select-icon-location', array('as'=> 'admin.selectIconLocation', 'uses' => 'MenuController@doSelectIcon'));

	// News
	Route::get('admin/news', array('as' => 'admin.news', 'uses' => 'NewsController@index'));
	Route::get('admin/news/add', array('as' => 'admin.news.add', 'uses' => 'NewsController@add'));
	Route::post('admin/news/add', array('uses' => 'NewsController@doAdd'));
	Route::get('admin/news/{url}', array('as' => 'admin.news.show', 'uses' => 'NewsController@show'));
	Route::get('admin/news/{url}/edit', array('as' => 'admin.news.edit', 'uses' => 'NewsController@edit'));
	Route::put('admin/news/{url}/edit', array('uses' => 'NewsController@doEdit'));
	Route::delete('admin/news/{url}', array('as' => 'admin.news.delete', 'uses' => 'NewsController@delete'));

	Route::post('admin/news/generate-url', array('as' => 'admin.news.generateUrl', 'uses' => 'NewsController@generateUrl'));

	// Events
	Route::get('admin/events', array('as' => 'admin.events', 'uses' => 'EventController@index'));
	Route::get('admin/events/add', array('as' => 'admin.events.add', 'uses' => 'EventController@add'));
	Route::post('admin/events/add', array('uses' => 'EventController@doAdd'));
	Route::get('admin/events/{url}', array('as' => 'admin.events.show', 'uses' => 'EventController@show'));
	Route::get('admin/events/{url}/edit', array('as' => 'admin.events.edit', 'uses' => 'EventController@edit'));
	Route::put('admin/events/{url}/edit', array('uses' => 'EventController@doEdit'));
	Route::delete('admin/events/{url}', array('as' => 'admin.events.delete', 'uses' => 'EventController@delete'));

	Route::post('admin/events/generate-url', array('as' => 'admin.events.generateUrl', 'uses' => 'EventController@generateUrl'));

	// faq
	Route::get('admin/faqs', array('as' => 'admin.faqs', 'uses' => 'FaqController@index'));
	Route::get('admin/faqs/add', array('as' => 'admin.faqs.add', 'uses' => 'FaqController@add'));
	Route::post('admin/faqs/add', array('uses' => 'FaqController@doAdd'));
	Route::get('admin/faqs/{pageUrl}', array('as' => 'admin.faqs.show', 'uses' => 'FaqController@show'));
	Route::get('admin/faqs/{pageUrl}/edit', array('as' => 'admin.faqs.edit', 'uses' => 'FaqController@edit'));
	Route::put('admin/faqs/{pageUrl}/edit', array('uses' => 'FaqController@doEdit'));
	Route::delete('admin/faqs/{pageUrl}', array('as' => 'admin.faqs.delete', 'uses' => 'FaqController@delete'));
	Route::post('admin/faqs/slug', array('as' => 'admin.faqs.slug', 'uses' => 'FaqController@slug'));

	// batch
	Route::get('admin/batches', array('as' => 'admin.batches', 'uses' => 'BatchController@index'));
	Route::get('admin/batches/add', array('as' => 'admin.batches.add', 'uses' => 'BatchController@add'));
	Route::post('admin/batches/add', array('uses' => 'BatchController@doAdd'));
	Route::get('admin/batches/{type}/{year}', array('as' => 'admin.batches.show', 'uses' => 'BatchController@show'));
	Route::get('admin/batches/{type}/{year}/edit', array('as' => 'admin.batches.edit', 'uses' => 'BatchController@edit'));
	Route::put('admin/batches/{type}/{year}/edit', array('uses' => 'BatchController@doEdit'));
	Route::delete('admin/batches/{type}/{year}', array('as' => 'admin.batches.delete', 'uses' => 'BatchController@delete'));

	// students
	Route::get('admin/students', array('as' => 'admin.students', 'uses' => 'StudentController@index'));
	Route::get('admin/students/add', array('as' => 'admin.students.add', 'uses' => 'StudentController@add'));
	Route::post('admin/students/add', array('uses' => 'StudentController@doAdd'));
	Route::get('admin/students//{reg}', array('as' => 'admin.students.show', 'uses' => 'StudentController@show'));
	Route::get('admin/students/{reg}/edit', array('as' => 'admin.students.edit', 'uses' => 'StudentController@edit'));
	Route::put('admin/students/{reg}/edit', array('uses' => 'StudentController@doEdit'));
	Route::delete('admin/students/{user_id}', array('as' => 'admin.students.delete', 'uses' => 'StudentController@delete'));


	// faculty
	Route::get('admin/faculty', array('as' => 'admin.faculty', 'uses' => 'FacultyController@index'));
	Route::get('admin/faculty/add', array('as' => 'admin.faculty.add', 'uses' => 'FacultyController@add'));
	Route::post('admin/faculty/add', array('uses' => 'FacultyController@doAdd'));
	Route::get('admin/faculty/{tagname}', array('as' => 'admin.faculty.show', 'uses' => 'FacultyController@show'));
	Route::get('admin/faculty/{tagname}/edit', array('as' => 'admin.faculty.edit', 'uses' => 'FacultyController@edit'));
	Route::put('admin/faculty/{tagname}/edit', array('uses' => 'FacultyController@doEdit'));
	Route::delete('admin/faculty/{user_id}', array('as' => 'admin.faculty.delete', 'uses' => 'FacultyController@delete'));
	Route::post('admin/faculty/research/add', array('as' => 'admin.faculty.research.add', 'uses' => 'FacultyController@doAddResearch'));

	// staff
	Route::get('admin/staff', array('as' => 'admin.staff', 'uses' => 'StaffController@index'));
	Route::get('admin/staff/add', array('as' => 'admin.staff.add', 'uses' => 'StaffController@add'));
	Route::post('admin/staff/add', array('uses' => 'StaffController@doAdd'));
	Route::get('admin/staff/{tagname}', array('as' => 'admin.staff.show', 'uses' => 'StaffController@show'));
	Route::get('admin/staff/{tagname}/edit', array('as' => 'admin.staff.edit', 'uses' => 'StaffController@edit'));
	Route::put('admin/staff/{tagname}/edit', array('uses' => 'StaffController@doEdit'));
	Route::delete('admin/staff/{user_id}', array('as' => 'admin.staff.delete', 'uses' => 'StaffController@delete'));
	Route::post('admin/staff/research/add', array('as' => 'admin.staff.research.add', 'uses' => 'FacultyController@doAddResearch'));

	// gallery
	Route::get('admin/albums', array('as' => 'admin.albums', 'uses' => 'AlbumController@albums'));
	Route::get('admin/albums/add', array('as' => 'admin.albums.add', 'uses' => 'AlbumController@add'));
	Route::post('admin/albums/add', array('uses' => 'AlbumController@doAdd'));
	Route::get('admin/albums/{pageUrl}', array('as' => 'admin.albums.show', 'uses' => 'AlbumController@show'));
	Route::get('admin/albums/{pageUrl}/edit', array('as' => 'admin.albums.edit', 'uses' => 'AlbumController@edit'));
	Route::put('admin/albums/{pageUrl}/edit', array('uses' => 'AlbumController@doEdit'));
	Route::delete('admin/albums/{id}', array('as' => 'admin.albums.delete', 'uses' => 'AlbumController@delete'));

	Route::post('admin/albums/generate-url', array('as' => 'admin.albums.generateUrl', 'uses' => 'AlbumController@generateUrl'));

	// pictures
	Route::get('admin/pictures', array('as' => 'admin.pictures', 'uses' => 'PictureController@index'));
	Route::get('admin/pictures/add', array('as' => 'admin.pictures.add', 'uses' => 'PictureController@add'));
	Route::post('admin/pictures/add', array('uses' => 'PictureController@doAdd'));
	Route::get('admin/pictures/{url}', array('as' => 'admin.pictures.show', 'uses' => 'PictureController@show'));
	Route::get('admin/pictures/{url}/edit', array('as' => 'admin.pictures.edit', 'uses' => 'PictureController@edit'));
	Route::put('admin/pictures/{url}/edit', array('uses' => 'PictureController@doEdit'));
	Route::delete('admin/pictures/{id}', array('as' => 'admin.pictures.delete', 'uses' => 'PictureController@delete'));

	Route::post('admin/pictures/generate-url', array('as' => 'admin.pictures.generateUrl', 'uses' => 'PictureController@generateUrl'));


	// courses
	Route::get('admin/courses', array('as' => 'admin.courses', 'uses' => 'CourseController@index'));
	Route::get('admin/courses/add', array('as' => 'admin.courses.add', 'uses' => 'CourseController@add'));
	Route::post('admin/courses/add', array('uses' => 'CourseController@doAdd'));
	Route::get('admin/courses/{url}', array('as' => 'admin.courses.show', 'uses' => 'CourseController@show'));
	Route::get('admin/courses/{url}/edit', array('as' => 'admin.courses.edit', 'uses' => 'CourseController@edit'));
	Route::put('admin/courses/{url}/edit', array('uses' => 'CourseController@doEdit'));
	Route::delete('admin/courses/{id}', array('as' => 'admin.courses.delete', 'uses' => 'CourseController@delete'));

	Route::post('admin/courses/generate-url', array('as' => 'admin.courses.generateUrl', 'uses' => 'CourseController@generateUrl'));

	// research
	Route::get('admin/researches', array('as' => 'admin.researches', 'uses' => 'ResearchController@index'));
	Route::get('admin/researches/add', array('as' => 'admin.researches.add', 'uses' => 'ResearchController@add'));
	Route::post('admin/researches/add', array('uses' => 'ResearchController@doAdd'));
	Route::get('admin/researches/{url}', array('as' => 'admin.researches.show', 'uses' => 'ResearchController@show'));
	Route::get('admin/researches/{url}/edit', array('as' => 'admin.researches.edit', 'uses' => 'ResearchController@edit'));
	Route::put('admin/researches/{url}/edit', array('uses' => 'ResearchController@doEdit'));
	Route::delete('admin/researches/{id}', array('as' => 'admin.researches.delete', 'uses' => 'ResearchController@delete'));
	Route::post('admin/researches/generate-url', array('as' => 'admin.researches.generateUrl', 'uses' => 'ResearchController@generateUrl'));

	
	// Slider
	 Route::get('admin/slider', array('as' => 'admin.slider', 'uses' => 'SliderController@index'));
	 Route::get('admin/slider/select', array('as' => 'admin.slider.select', 'uses' => 'SliderController@select'));
	 Route::get('admin/slider/{id}/crop', array('as' => 'admin.slider.crop', 'uses' => 'SliderController@crop'));
	 Route::post('admin/slider/{id}/crop', array('as' => 'admin.slider.crop', 'uses' => 'SliderController@doCrop'));
	 Route::get('admin/slider/{id}/edit', array('as' => 'admin.slider.edit', 'uses' => 'SliderController@edit'));
	 Route::put('admin/slider/{id}/edit', array('uses' => 'SliderController@doEdit'));
	 Route::delete('admin/slider/{id}', array('as' => 'admin.slider.delete', 'uses' => 'SliderController@delete'));

	// profile
	Route::get('profile', array('as' => 'profile.show', 'uses' => 'PublicController@profile'));
	Route::get('profile/edit', array('as' => 'profile.edit', 'uses' => 'PublicController@editProfile'));
	Route::put('profile/edit', array('as' => 'profile.edit', 'uses' => 'PublicController@doEditProfile'));
	Route::get('password/edit', array('as' => 'password.edit', 'uses' => 'PublicController@editPassword'));
	Route::put('password/edit', array('as' => 'password.edit', 'uses' => 'PublicController@doEditPassword'));

	// wysiwyg routes
	Route::post('upload', array('as' => 'upload', 'uses' => 'BaseController@uploadFileFromEditor'));

});

Route::group(array('before' => 'auth|facultyOrHead'), function()
{
	Route::post('notices/generate-url', array('as' => 'notices.generateUrl', 'uses' => 'PublicController@noticeGenerateUrl'));
	Route::get('courses/{url}/notices/add', array('as' => 'notices.add', 'uses' => 'PublicController@noticeAdd'));
	Route::post('courses/{url}/notices/add', array('as' => 'notices.add', 'uses' => 'PublicController@noticeDoAdd'));
	Route::get('courses/{url}/notices/{noticeUrl}/edit', array('as' => 'notices.edit', 'uses' => 'PublicController@noticeEdit'));
	Route::put('courses/{url}/notices/{noticeUrl}/edit', array('as' => 'notices.edit', 'uses' => 'PublicController@noticeDoEdit'));
	Route::delete('courses/{url}/notices/{noticeId}', array('as' => 'notices.delete', 'uses' => 'PublicController@noticeDelete'));
});



// public pages [ keep them at last]
Route::get('/', array('as' => 'home', 'uses' => 'PublicController@pages'));

Route::get('faqs', array('as' => 'faqs', 'uses' => 'PublicController@faqs'));

Route::get('news', array('as' => 'news', 'uses' => 'PublicController@news'));
Route::get('news/{url}', array('as' => 'news.show', 'uses' => 'PublicController@newsShow'));

Route::get('events', array('as' => 'events', 'uses' => 'PublicController@events'));
Route::get('events/{url}', array('as' => 'events.show', 'uses' => 'PublicController@eventsShow'));

Route::get('courses', array('as' => 'courses', 'uses' => 'PublicController@courses'));
Route::get('courses/{url}', array('as' => 'courses.show', 'uses' => 'PublicController@coursesShow'));
Route::get('courses/{url}/notices/{noticeUrl}', array('as' => 'notices.show', 'uses' => 'PublicController@noticeShow'));

Route::get('faculty', array('as' => 'faculty', 'uses' => 'PublicController@faculty'));
Route::get('faculty/{tagname}', array('as' => 'faculty.show', 'uses' => 'PublicController@facultyShow'));

Route::get('staff', array('as' => 'staff', 'uses' => 'PublicController@staff'));
Route::get('staff/{tagname}', array('as' => 'staff.show', 'uses' => 'PublicController@staffShow'));

Route::get('students', array('as' => 'students', 'uses' => 'PublicController@students'));
Route::get('batches/{type}', array('as' => 'batches.type', 'uses' => 'PublicController@batchesTypeShow'));
Route::get('batches/{type}/{year}', array('as' => 'batches.show', 'uses' => 'PublicController@batchesShow'));
Route::get('batches/{type}/{year}/{reg}', array('as' => 'students.show', 'uses' => 'PublicController@studentsShow'));

Route::get('researches', array('as' => 'researches', 'uses' => 'PublicController@researches'));
Route::get('researches/{url}', array('as' => 'researches.show', 'uses' => 'PublicController@researchShow'));

Route::get('albums', array('as' => 'albums', 'uses' => 'PublicController@albums'));
Route::get('albums/{url}', array('as' => 'albums.show', 'uses' => 'PublicController@albumShow'));
Route::get('albums/{url}/pictures/{picUrl}', array('as' => 'pictures.show', 'uses' => 'PublicController@pictureShow'));


Route::get('{pageUrl}', array('uses' => 'PublicController@pages'));


