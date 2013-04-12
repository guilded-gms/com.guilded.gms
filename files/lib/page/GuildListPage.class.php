<?php
namespace wcf\page;
use wcf\system\menu\page\PageMenu;
use wcf\system\request\LinkHandler;
use wcf\util\HeaderUtil;

/**
 * Shows the guild list page.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2013 DevLabor UG (haftungsbeschränkt)
 * @license	CC BY-NC-SA 3.0 <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.wcf.character
 * @subpackage	page
 * @category	Guilded 2.0
 */
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
