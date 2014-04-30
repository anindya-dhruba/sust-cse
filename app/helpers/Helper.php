<?php 

class Helper
{
	public static function getPublicPages()
	{
		return Menu::orderBy('order')->get();
	}

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

	public static function recentNotices($limit = 5)
	{
		return Notice::where('is_public', '=', 1)
						->limit($limit)
						->orderBy('created_at')
						->get();
	}	
}