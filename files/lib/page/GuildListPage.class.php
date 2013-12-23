<?php
namespace gms\page;
use wcf\page\SortablePage;
use wcf\system\menu\page\PageMenu;
use wcf\system\request\LinkHandler;
use wcf\util\HeaderUtil;

/**
 * Shows the guild list page.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2013 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	page
 * @category	Guilded 2.0
 */
class GuildListPage extends SortablePage {
	/**
	 * @see	\wcf\page\AbstractPage::$neededPermissions
	 */
	public $neededPermissions = array('user.gms.guild.canViewList');
	
	/**
	 * @see	\wcf\page\SortablePage::$defaultSortField
	 */
	public $defaultSortField = 'name';
	
	/**
	 * @see	\wcf\page\SortablePage::$validSortFields
	 */
	public $validSortFields = array('name');
	
	/**
	 * @see	\wcf\page\MultipleLinkPage::$objectListClassName
	 */	
	public $objectListClassName = 'gms\data\guild\GuildList';

	/**
	 * @see	\wcf\page\IPage::show()
	 */
	public function readData() {
		parent::readData();

		//redirect to guild profile
		if ($this->countItems() == 1) {
			HeaderUtil::redirect(LinkHandler::getInstance()->getLink('Guild', array('object' => $this->objectList->current())));
			exit;
		}
	}
	
	/**
	 * @see	\wcf\page\IPage::show()
	 */
	public function show() {
		PageMenu::getInstance()->setActiveMenuItem('gms.guild.guilds');
		
		parent::show();
	}
}
