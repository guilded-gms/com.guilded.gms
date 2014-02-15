<?php
namespace gms\system\menu\page;
use wcf\system\menu\page\DefaultPageMenuItemProvider;

/**
 * The CalendarPageMenuItemProvider handles notifications.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons <BY-NC-SA> (http://creativecommons.org/licenses/by-nc-sa/3.0/legalcode)
 * @package	com.guilded.gms
 * @subpackage	system.menu.page
 * @category	Guilded 2.0
 */
class CalendarPageMenuItemProvider extends DefaultPageMenuItemProvider {
	/**
	 * @see	\wcf\system\menu\page\IPageMenuItemProvider::isVisible()
	 */
	public function getNotifications() {
		return 23;
	}
}
