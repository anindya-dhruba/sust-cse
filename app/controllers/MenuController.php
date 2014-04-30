<?php

class MenuController extends BaseController {

	/**
	 * show build menu page
	 * @return void
	 */
	public function buildMenu()
	{
		$pages = Helper::getPublicPages();

		return View::make('menus.buildMenu')
						->with('title', 'Menus')
						->with('pages', $pages);
	}

	/**
	 * Do build menu
	 * @return string
	 */
	public function doBuildMenu()
	{
		$orders = Input::get('orders');

		foreach ($orders as $key => $order)
		{
			$menu = Menu::find($order);
			$menu->order = $key+1;
			$menu->save();
		}

		return 'Menus has been updated. Refresh the sidebar to see.';
	}
}