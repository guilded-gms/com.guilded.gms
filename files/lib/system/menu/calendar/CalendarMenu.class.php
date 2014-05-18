<?php
namespace gms\system\menu\calendar;
use gms\data\event\EventDateList;
use wcf\system\event\EventHandler;
use wcf\system\menu\user\profile\UserProfileMenu;

/**
 * Builds the calendar menu.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons <BY-NC-SA> (http://creativecommons.org/licenses/by-nc-sa/3.0/legalcode)
 * @package	com.guilded.gms
 * @subpackage	system.menu.calendar
 * @category	Guilded 2.0
 */
class CalendarMenu extends UserProfileMenu {
	/**
	 * @see	\wcf\system\menu\user\profile\UserProfileMenu::loadCache()
	 */
	protected function loadCache() {
		// call loadCache event
		EventHandler::getInstance()->fireAction($this, 'loadCache');

		$this->menuItems = CalendarMenuCacheBuilder::getInstance()->getData();

		foreach ($this->menuItems as &$menuItem) {
			$menuItem->getContentManager()->setEvents(new EventDateList());
		}
	}
}
