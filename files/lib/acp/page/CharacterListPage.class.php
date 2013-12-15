<?php
namespace gms\acp\page;
use wcf\page\SortablePage;
use wcf\system\menu\acp\ACPMenu;

/**
 * Shows characters.
 */
class CharacterListPage extends SortablePage {
	/**
	 * @see	\wcf\page\AbstractPage::$neededPermissions
	 */
	public $neededPermissions = array('admin.character.canManageCharacter');
	
	/**
	 * @see	\wcf\page\SortablePage::$defaultSortField
	 */
	public $defaultSortField = 'name';
	
	/**
	 * @see	\wcf\page\SortablePage::$validSortFields
	 */
	public $validSortFields = array('name', 'characterID', 'gameID');
	
	/**
	 * @see	\wcf\page\MultipleLinkPage::$objectListClassName
	 */
	public $objectListClassName = 'gms\data\character\CharacterList';
	
	/**
	 * @see	\wcf\page\MultipleLinkPage::initObjectList()
	 */
	public function initObjectList() {
		parent::initObjectList();
		
		$this->sqlOrderBy = "character_table.".$this->sortField." ".$this->sortOrder;
	}
	
	/**
	 * @see	\wcf\page\IPage::show()
	 */
	public function show() {
		// set active menu item.
		ACPMenu::getInstance()->setActiveMenuItem('wcf.acp.menu.link.character.list');
		
		parent::show();
	}
}
