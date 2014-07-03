<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;

class PublicController extends BaseController {

	/**
	 * Show a  page
	 * @param  string $pageUrl
	 * @return void
	 */
	public function pages($pageUrl = 'home')
	{
		try
		{
		    $page = Page::where('url', '=', $pageUrl)->firstOrFail();

		    if($page->id == 1) 	$layout = 'layouts.home';
		    else 				$layout = 'layouts.default';

		    return View::make('public.pages.show')
						->with('title', "$page->title")
						->with('page', $page)
						->with('layout', $layout);
		}
		catch(ModelNotFoundException $e)
		{
		   return "Page not found.";
		}
	}

	/**
	 * show all faqs
	 * @return void
	 */
	public function faqs()
	{
	    $faqs = Faq::get();

	    return View::make('public.faqs.index')
					->with('title', "Frequently Asked Questions")
					->with('faqs', $faqs);
	}

	/**
	 * show all notices 
	 * @return void
	 */
	public function notices()
	{
	    $notices = Notice::where('is_public', '=', 1)
	    					->orderBy('created_at', 'desc')
	    					->paginate(5);

	    return View::make('public.notices.index')
					->with('title', "All Notices")
					->with('notices', $notices);
	}

	/**
	 * show one notice
	 * @param  string $url
	 * @return void
	 */
	public function noticesShow($url)
	{
		try
		{
		    $notice = Notice::where('url', '=', $url)->firstOrFail();

		    return View::make('public.notices.show')
						->with('title', "$notice->title")
						->with('notice', $notice);
		}
		catch(ModelNotFoundException $e)
		{
		   return "Page not found.";
		}
	}

	/**
	 * show all batches
	 * @return void
	 */
	public function batches()
	{
		$batches = Batch::orderBy('year', 'desc')->get();

	    return View::make('public.batches.index')
					->with('title', "All Batches")
					->with('batches', $batches);
	}

	/**
	 * show a batch details
	 * @param  digit $year
	 * @return void
	 */
	public function batchesShow($year)
	{
		$batch = Batch::where('year', '=', $year)->first();

	    return View::make('public.batches.show')
					->with('title', "$batch->name Batch")
					->with('batch', $batch);
	}

	/**
	 * shows a student details
	 * @param  digit $year
	 * @param  digit $reg
	 * @return void
	 */
	public function studentsShow($year, $reg)
	{
		$student = Student::where('reg', '=', $reg)->first();

	    return View::make('public.students.show')
					->with('title', $student->user->full_name)
					->with('student', $student);
	}

	/**
	 * show all faculty
	 * @return void
	 */
	public function faculty()
	{
		$faculty = Faculty::get();

	    return View::make('public.faculty.index')
					->with('title', "Faculty")
					->with('faculty', $faculty);
	}

	/**
	 * Show a faculty
	 * @param  string $tagname
	 * @return void
	 */
	public function facultyShow($tagname)
	{
		try
		{
		    $faculty = faculty::where('tagname', '=', $tagname)->firstOrFail();

		    return View::make('public.faculty.show')
						->with('title', $faculty->user->full_name)
						->with('faculty', $faculty);
		}
		catch(ModelNotFoundException $e)
		{
		   return "Page not found.";
		}
	}
	
}
