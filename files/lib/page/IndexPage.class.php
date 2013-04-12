<?php
namespace gms\page;
use wcf\page\AbstractPage;
use wcf\data\user\online\UsersOnlineList;
use wcf\data\option\OptionAction;
use wcf\system\dashboard\DashboardHandler;
use wcf\system\WCF;
use wcf\util\FileUtil;
use wcf\util\HeaderUtil;

/**
 * Shows the index page.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2013 DevLabor UG (haftungsbeschränkt)
 * @license	CC BY-NC-SA 3.0 <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	page
 * @category	Guilded 2.0
*/
class IndexPage extends AbstractPage {
	/**
	 * users online list
	 * @var	wcf\data\user\online\UsersOnlineList
	 */
	public $usersOnlineList = null;

	/**
	 * @see	wcf\page\IPage::readData()
	 */
	public function readData() {
		parent::readData();

		// users online
		if (INDEX_ENABLE_ONLINE_LIST) {
			$this->usersOnlineList = new UsersOnlineList();
			$this->usersOnlineList->readStats();
			$this->usersOnlineList->getConditionBuilder()->add('session.userID IS NOT NULL');
			$this->usersOnlineList->readObjects();

			// check users online record
			$usersOnlineTotal = (USERS_ONLINE_RECORD_NO_GUESTS ? $this->usersOnlineList->stats['members'] : $this->usersOnlineList->stats['total']);
			if ($usersOnlineTotal > USERS_ONLINE_RECORD) {
				// save new record
				$optionAction = new OptionAction(array(), 'import', array('data' => array(
						'users_online_record' => $usersOnlineTotal,
						'users_online_record_time' => TIME_NOW
				)));
				$optionAction->executeAction();
			}
		}

		// remove index breadcrumb
		WCF::getBreadcrumbs()->remove(0);
	}

	/**
	 * @see	wcf\page\AbstractPage::assignVariables()
	 */
	public function assignVariables() {
		parent::assignVariables();
		
		DashboardHandler::getInstance()->loadBoxes('com.guilded.gms.IndexPage', $this);

		WCF::getTPL()->assign(array(
			'usersOnlineList' => $this->usersOnlineList
		));
	}
}
