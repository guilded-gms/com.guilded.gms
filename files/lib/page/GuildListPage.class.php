<?php
namespace gms\page;
use wcf\page\SortablePage;
use wcf\system\dashboard\DashboardHandler;
use wcf\system\menu\page\PageMenu;
use wcf\system\request\LinkHandler;
use wcf\system\user\collapsible\content\UserCollapsibleContentHandler;
use wcf\system\WCF;
use wcf\util\HeaderUtil;

/**
 * Shows the guild list page.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
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
	public $objectListClassName = 'gms\data\guild\GuildProfileList';

	/**
	 * game id
	 * @var	integer
	 */
	public $gameID = 0;

	/**
	 * @see	wcf\page\Page::readParameters()
	 */
	public function readParameters() {
		parent::readParameters();

		if (isset($_GET['gameID'])) $this->gameID = intval($_GET['gameID']);
	}

	/**
	 * @see	wcf\page\MultipleLinkPage::initObjectList()
	 */
	protected function initObjectList() {
		parent::initObjectList();

		if ($this->gameID) {
			$this->objectList->getConditionBuilder()->add('guild.gameID IN (?)', array($this->gameID));
		}
	}

	/**
	 * @see	wcf\page\Page::assignVariables()
	 */
	public function assignVariables() {
		parent::assignVariables();

		DashboardHandler::getInstance()->loadBoxes('com.guilded.gms.GuildListPage', $this);

		WCF::getTPL()->assign(array(
			'sidebarCollapsed' => UserCollapsibleContentHandler::getInstance()->isCollapsed('com.woltlab.wcf.collapsibleSidebar', 'com.guilded.gms.GuildListPage'),
			'sidebarName' => 'com.guilded.gms.GuildListPage',
			'allowSpidersToIndexThisPage' => true,
			'gameID' => $this->gameID
		));
	}

	/**
	 * @see	\wcf\page\IPage::show()
	 */
	public function show() {
		PageMenu::getInstance()->setActiveMenuItem('gms.guild.guilds');
		
		parent::show();
	}
}
