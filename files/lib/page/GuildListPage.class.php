<?php
namespace wcf\page;
use wcf\system\menu\page\PageMenu;
use wcf\system\request\LinkHandler;
use wcf\util\HeaderUtil;

class GuildListPage extends SortablePage {
	/**
	 * @see wcf\page\AbstractPage::$neededPermissions
	 */
	public $neededPermissions = array();
	
	/**
	 * @see wcf\page\SortablePage::$defaultSortField
	 */
	public $defaultSortField = 'guildName';
	
	/**
	 * @see wcf\page\SortablePage::$validSortFields
	 */
	public $validSortFields = array('guildName');
	
	/**
	 * @see	wcf\page\MultipleLinkPage::$objectListClassName
	 */	
	public $objectListClassName = 'wcf\data\guild\GuildList';

	/**
	 * @see	wcf\page\IPage::show()
	 */
	public function readData() {
        parent::readData();

        //redirect to guild profile
        if ($this->countItems() == 1) {
            HeaderUtil::redirect(LinkHandler::getLink('Guild', array('object' => $this->objectList->current())));
            exit;
        }
	}
	
	/**
	 * @see	wcf\page\IPage::show()
	 */
	public function show() {
		PageMenu::getInstance()->setActiveMenuItem('wcf.character.guilds');
		
		parent::show();
	}
}
