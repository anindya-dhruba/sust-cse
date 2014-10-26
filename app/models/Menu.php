<?php

class Menu extends Eloquent {

	protected $table = 'menus';
	public $timestamps = false;

	public static $menuPostions = array
	(
		'top'	=>	'At Top Side',
		'side'	=>	'At Bottom Side'
	);

	public function page()
	{
		return $this->belongsTo('Page');
	}

	public function subMenus()
	{
		return $this->hasMany('Menu', 'parent_id')
					->where('page_location', '=', 'top')
					->orderBy('order');
	}

	/**
	 * generates HTML for menu
	 * @param  menu  $menu
	 * @param  integer $parentid
	 * @return string/html
	 */
	public function buildMenu($menu, $parentid = 0) 
	{
	  	$result = null;
		foreach ($menu as $item)
		{ 
	    	if ($item->parent_id == $parentid)
	    	{ 
				$result .= "<li class='dd-item nested-list-item' data-order='{$item->order}' data-id='{$item->id}'>
					<div class='dd-handle nested-list-handle'>
					<span class='glyphicon glyphicon-move'></span>
					</div> <div class='nested-list-content'>{$item->page->title}";
			
				$result .= "</div>".$this->buildMenu($menu, $item->id) . "</li>";
			}
	    } 
	  	
	  	return $result ?  "\n<ol class=\"dd-list\">\n$result</ol>\n" : null; 
	}

	/**
	 * get HTML of pages for menu
	 * @param  pagelist $items 
	 * @return string/html
	 */
	public function getHTML($items)
	{
		return $this->buildMenu($items);
	}
}