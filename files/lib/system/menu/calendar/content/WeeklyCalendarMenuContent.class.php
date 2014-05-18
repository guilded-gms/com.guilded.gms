<?php
namespace gms\system\menu\calendar\content;
use gms\data\event\date\EventDateList;

/**
 * Weekly view of event dates.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons <BY-NC-SA> (http://creativecommons.org/licenses/by-nc-sa/3.0/legalcode)
 * @package	com.guilded.gms
 * @subpackage	system.menu.calendar.content
 * @category	Guilded 2.0
 */
class WeeklyCalendarMenuContent extends AbstractCalendarMenuContent {
	/**
	 * @see	\gms\system\menu\calendar\content\AbstractCalendarMenuContent::$templateName
	 */
	protected $templateName = 'calendarWeekly';

	/**
	 * @see	\gms\system\menu\calendar\content\AbstractCalendarMenuContent::setEventDates()
	 */
	public function setEventDates(EventDateList $eventDateList) {
		parent::setEventDates($eventDateList);

		// @todo handle filter: selected week
	}
}
