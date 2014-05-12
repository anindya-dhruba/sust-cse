<?php

class MenuController extends BaseController {

	/**
	 * show build menu page
	 * @return void
	 */
	public function buildMenu()
	{
		$menu = new Menu;
		$allMenus = Helper::getPublicPages();
		$sideMenus = Helper::getPublicPages('side');
		$topMenus = $menu->getHTML(Helper::getPublicPages('top'));

		return View::make('menus.buildMenu')
						->with('title', 'Menus')
						->with('allMenus', $allMenus)
						->with('sideMenus', $sideMenus)
						->with('topMenus', $topMenus);
	}

	/**
	 * Do build side menu
	 * @return string
	 */
	public function doBuildSideMenu()
	{
		$orders = Input::get('orders');

		foreach ($orders as $key => $order)
		{
			$menu = Menu::find($order);
			$menu->order = $key+1;
			$menu->save();
		}

		return 'ok';
	}

	/**
	 * do build top menu
	 * @return string
	 */
	public function doBuildTopMenu()
	{
		$source       = e(Input::get('source'));
	    $destination  = e(Input::get('destination',0));

	    $item             = Menu::find($source);
	    $item->parent_id  = $destination;  
	    $item->save();

	    $ordering       = json_decode(Input::get('order'));
	    $rootOrdering   = json_decode(Input::get('rootOrder'));

	    if($ordering){
	      foreach($ordering as $order=>$item_id){
	        if($itemToOrder = Menu::find($item_id)){
	            $itemToOrder->order = $order;
	            $itemToOrder->save();
	        }
	      }
	    } else {
	      foreach($rootOrdering as $order=>$item_id){
	        if($itemToOrder = Menu::find($item_id)){
	            $itemToOrder->order = $order;
	            $itemToOrder->save();
	        }
	      }
	    }

	    return 'ok';
	}

	/**
	 * do update icon and location of menu
	 * @return void
	 */
	public function doSelectIcon()
	{
		$pages = Input::get('pages');
		$locations = Input::get('locations');

		foreach ($pages as $key => $page)
		{
			$menu = Menu::find($key);
			$menu->page_icon = $page;
			$menu->page_location  = $locations[$key];
			$menu->save();
		}

		return Redirect::route('admin.menu.build')
						->with('success', 'Icons has been updated.');
	}
}