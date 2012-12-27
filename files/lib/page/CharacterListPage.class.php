<?php
namespace wcf\page;
use wcf\system\menu\page\PageMenu;

class CharacterListPage extends SortablePage {
	/**
	 * @see wcf\page\AbstractPage::$neededPermissions
	 */
	public $neededPermissions = array();
	
	/**
	 * @see wcf\page\SortablePage::$defaultSortField
	 */
	public $defaultSortField = 'name';
	
	/**
	 * @see wcf\page\SortablePage::$validSortFields
	 */
	public $validSortFields = array('name');
	
	/**
	 * @see	wcf\page\MultipleLinkPage::$objectListClassName
	 */	
	public $objectListClassName = 'wcf\data\character\CharacterList';
	
	/**
	 * @see	wcf\page\IPage::show()
	 */
	public function show() {
		PageMenu::getInstance()->setActiveMenuItem('wcf.character.characters');
		
		parent::show();
	}
}
