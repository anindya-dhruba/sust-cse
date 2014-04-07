<?php 

class Menu
{
	static function getPublicPages()
	{
		return Page::where('is_visible', '=', 1)
						->orderBy('order')
						->get();
	}
}