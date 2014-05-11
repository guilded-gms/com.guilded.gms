<?php
namespace gms\page;
use gms\system\menu\calendar\CalendarMenu;
use wcf\page\AbstractPage;
use wcf\system\WCF;

/**
 * Shows Calendar Page with different views.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	page
 * @category	Guilded 2.0
 */
class CalendarPage extends AbstractPage {
	/**
	 * @see	\wcf\page\AbstractPage::$activeMenuItem
	 */
	public $activeMenuItem = 'gms.header.menu.calendar';

	/**
	 * @see	\wcf\page\AbstractPage::$enableTracking
	 */
	public $enableTracking = true;

	/**
	 * @see	\wcf\page\AbstractPage::$neededModules
	 */
	public $neededModules = array('GMS_MODULE_CALENDAR');

	/**
	 * @see	\wcf\page\AbstractPage::$neededPermissions
	 */
	public $neededPermissions = array('user.gms.event.canViewCalendar');

	/**
	 * @see \wcf\page\IPage::assignVariables()
	 */
	public function assignVariables() {
		parent::assignVariables();

		WCF::getTPL()->assign(array(
			'calendarMenu' => CalendarMenu::getInstance()
		));
	}

	// @todo add breadcrumb
}

