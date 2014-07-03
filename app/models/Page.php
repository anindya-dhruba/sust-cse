<?php

class Page extends Eloquent {

	protected $table = 'pages';

	public function menu()
	{
		return $this->hasOne('Menu');
	}

	/**
	 * add a page to menu
	 * @param page $page
	 * @param string $location
	 */
	public static function addToMenu($page, $location = 'top')
	{
		// if already exists
		if(Menu::where('page_id', '=', $page->id)->first()) return true;

		$lastMenuItem = Menu::orderBy('order','desc')->get()->first();

		$menuItem = new Menu;
		$menuItem->page_id 			= $page->id;
		$menuItem->page_location 	= $location;
		$menuItem->order 			= $lastMenuItem->order+1;

		return $menuItem->save() ;
	}

	/**
	 * remove a page from menu
	 * @param  page $page
	 * @return boolean
	 */
	public static function removeFromMenu($page)
	{
		return Menu::where('page_id', '=', $page->id)->delete();
	}
}