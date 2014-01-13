<?php
namespace gms\system\menu\calendar\content;
use gms\data\event\EventList;

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
