<?php
namespace gms\system\menu\calendar\content;
use gms\data\event\EventList;

class ListCalendarMenuContent extends AbstractCalendarMenuContent {
	/**
	 * @see	\gms\system\menu\calendar\content\AbstractCalendarMenuContent::$templateName
	 */
	protected $templateName = 'calendarList';

	/**
	 * @see	\gms\system\menu\calendar\content\AbstractCalendarMenuContent::setEvents()
	 */
	public function setEvents(EventList $eventList) {
		parent::setEvents($eventList);

		$this->eventList->sqlLimit = 50; // @todo as OPTION
	}
}
