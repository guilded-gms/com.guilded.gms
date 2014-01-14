<?php
namespace gms\system\menu\calendar\content;
use gms\data\event\EventList;

class DailyCalendarMenuContent extends AbstractCalendarMenuContent {
	/**
	 * @see	\gms\system\menu\calendar\content\AbstractCalendarMenuContent::$templateName
	 */
	protected $templateName = 'calendarDaily';

	/**
	 * @see	\gms\system\menu\calendar\content\AbstractCalendarMenuContent::setEvents()
	 */
	public function setEvents(EventList $eventList) {
		parent::setEvents($eventList);

		// @todo handle filter
	}
}
