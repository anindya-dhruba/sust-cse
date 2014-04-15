<?php 

class Picture
{
	static function currentPicture($anyKindOfUser, $resolution = 'medium')
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
}