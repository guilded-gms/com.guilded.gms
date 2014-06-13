<?php
namespace gms\page;
use wcf\data\user\online\UsersOnlineList;
use wcf\page\AbstractPage;
use wcf\system\cache\builder\UserStatsCacheBuilder;
use wcf\system\dashboard\DashboardHandler;
use wcf\system\menu\page\PageMenu;
use wcf\system\MetaTagHandler;
use wcf\system\request\LinkHandler;
use wcf\system\user\collapsible\content\UserCollapsibleContentHandler;
use wcf\system\WCF;

/**
 * Shows IndexPage (Dashboard).
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	CC BY-NC-SA 3.0 <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	page
 * @category	Guilded 2.0
 */
class IndexPage extends AbstractPage {
	/**
	 * @see	\wcf\page\AbstractPage::$activeMenuItem
	 */
	public $activeMenuItem = 'gms.header.menu.index';

	/**
	 * @see	\wcf\page\AbstractPage::$enableTracking
	 */
	public $enableTracking = true;

	/**
	 * users online list
	 * @var	\wcf\data\user\online\UsersOnlineList
	 */
	public $usersOnlineList = null;

	/**
	 * simple forum statistics
	 * @var	array
	 */
	public $stats = array();

	/**
	 * @see	\wcf\page\IPage::readData()
	 */
	public function readData() {
		parent::readData();

		// stats
		if (GMS_INDEX_ENABLE_STATS) {
			$this->stats = array_merge(
				UserStatsCacheBuilder::getInstance()->getData()
			);
		}

		// remove default breadcrumb entry
		if (PageMenu::getInstance()->getLandingPage()->menuItem == $this->activeMenuItem) {
			WCF::getBreadcrumbs()->remove(0);

			MetaTagHandler::getInstance()->addTag('og:url', 'og:url', LinkHandler::getInstance()->getLink('', array('application' => 'gms', 'appendSession' => false)), true);
			MetaTagHandler::getInstance()->addTag('og:type', 'og:type', 'website', true);
			MetaTagHandler::getInstance()->addTag('og:title', 'og:title', WCF::getLanguage()->get(PAGE_TITLE), true);
			MetaTagHandler::getInstance()->addTag('og:description', 'og:description', WCF::getLanguage()->get(PAGE_DESCRIPTION), true);
		}

		// users online
		if (MODULE_USERS_ONLINE && GMS_INDEX_ENABLE_ONLINE_LIST) {
			$this->usersOnlineList = new UsersOnlineList();
			$this->usersOnlineList->readStats();
			$this->usersOnlineList->checkRecord();
			$this->usersOnlineList->getConditionBuilder()->add('session.userID IS NOT NULL');
			$this->usersOnlineList->readObjects();
		}
	}

	/**
	 * @see	\wcf\page\AbstractPage::assignVariables()
	 */
	public function assignVariables() {
		parent::assignVariables();

		DashboardHandler::getInstance()->loadBoxes('com.guilded.gms.IndexPage', $this);

		WCF::getTPL()->assign(array(
			'sidebarCollapsed' => UserCollapsibleContentHandler::getInstance()->isCollapsed('com.woltlab.wcf.collapsibleSidebar', 'com.guilded.gms.IndexPage'),
			'sidebarName' => 'com.guilded.gms.IndexPage',
			'allowSpidersToIndexThisPage' => true,
			'stats' => $this->stats,
			'usersOnlineList' => $this->usersOnlineList,
		));
	}
}
