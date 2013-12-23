<?php
namespace gms\acp\page;

class EventCategoryListPage extends AbstractCategoryListPage {
	/**
	 * @see	AbstractCategoryListPage::$activeMenuItem
	 */
	public $activeMenuItem = 'wcf.acp.menu.link.community.event.category.list';

	/**
	 * @see	AbstractCategoryListPage::$objectTypeName
	 */	
	public $objectTypeName = 'com.guilded.gms.category';
}