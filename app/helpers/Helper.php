<?php 

class Helper
{
	/**
	 * get public menu pages
	 * @param  string $location
	 * @return void
	 */
	public static function getPublicPages($location = null)
	{
		if(is_null($location))
			return Menu::orderBy('order')->get();
		else
			return Menu::where('page_location', '=', $location)
						->orderBy('order')
						->get();
	}

	/**
	 * Build top nav
	 * @return string/html
	 */
	public static function buildTopNavHTML() 
	{
		$result = '';
	  	$menu = Menu::where('parent_id', '=', 0)
	  				->where('page_location', '=', 'top')
	  				->orderBy('order')
	  				->get();

	  	foreach ($menu as $item)
	  	{
	  		if(count($item->subMenus) == 0)
	  		{
	  			$result .= "<li><a href='".URL::to($item->page->url)."'> <span class='fa ".$item->page_icon."'></span> {$item->page->title}</a></li>";
	  		}
	  		else
	  		{
	  			$result .= "<li class='dropdown'><a class='dropdown-toggle' href='".URL::to($item->page->url)."'> <span class='fa ".$item->page_icon."'></span> {$item->page->title} <b class='caret'></b></a><ul class='dropdown-menu'></b>";
	  			foreach ($item->subMenus as $subMenu)
		  		{
		  			$result .= "<li><a href='".URL::to($subMenu->page->url)."'> <span class='fa ".$subMenu->page_icon."'></span> {$subMenu->page->title}</a></li>";
		  		}

		  		$result .= "</ul>";
	  		}
	  	}
	  	return $result;
	}


	/**
	 * get profile picture for a user
	 * @param  user $anyKindOfUser
	 * @param  string $resolution
	 * @return string/html
	 */
	public static function currentPicture($anyKindOfUser, $resolution = 'medium')
	{
		if($picture = $anyKindOfUser->user->pictures()->first())
			return HTML::image('uploads/user_pictures/'.$resolution.'_'.$picture->url);
		else
		{
			if($resolution == 'thumbnail')
				return '<span class="fa fa-icon fa-user fa-2x"></span>';
			else
				return '<span class="fa fa-icon fa-user fa-avatar"></span>';
		}
	}

	/**
	 * Recent Notices
	 * @param  integer $limit
	 * @return array
	 */
	public static function recentNotices($limit = 5)
	{
		return Notice::where('is_public', '=', 1)
						->limit($limit)
						->orderBy('created_at', 'desc')
						->get();
	}

	/**
	 * Recent Events
	 * @param  integer $limit
	 * @return array
	 */
	public static function recentEvents($limit = 5)
	{
		return AppEvent::where('is_public', '=', 1)
						->limit($limit)
						->orderBy('start_date', 'desc')
						->get();
	}

	public static function date($date, $withTime = false)
	{
		if(is_null($date))
			return null;
		if($withTime)
			return date('j F Y h:i:s A', strtotime($date));
		else
			return date('j F Y', strtotime($date));
	}


	public static function daysDiff($date1 = null, $date2 = null)
	{
		$ts1 = strtotime($date1);
		$ts2 = strtotime($date2);

		$seconds_diff = $ts2 - $ts1;

		echo floor($seconds_diff/3600/24)+1;
	}
}