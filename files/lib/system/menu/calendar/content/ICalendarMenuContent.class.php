<?php
namespace gms\system\menu\calendar\content;
use gms\data\event\EventList;

/**
 * Every content provider should implement this interface.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	system.menu.calendar.content
 * @category	Guilded 2.0
 */
interface ICalendarMenuContent {
	/**
	 * Sets events.
	 *
	 * @param	\gms\data\event\EventList	$eventList
	 * @return	string
	 */
	public function setEvents(EventList $eventList);

	/**
	 * Returns content for this calendar menu item.
	 *
	 * @return	string
	 */
	public function getContent();
}
