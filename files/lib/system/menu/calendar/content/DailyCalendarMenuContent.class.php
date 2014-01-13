<?php
namespace gms\system\menu\calendar\content;
use gms\data\event\EventList;
use wcf\system\SingletonFactory;
use wcf\system\WCF;

class DailyCalendarMenuContent extends SingletonFactory implements ICalendarMenuContent {
	/**
	 * list of events
	 * @var    \gms\data\event\EventList
	 */
	protected $eventList = null;

	/**
	 * Sets events.
	 *
	 * @param    \gms\data\event\EventList $eventList
	 * @return    string
	 */
	public function setEvents(EventList $eventList) {
		$this->eventList = $eventList;

		// @todo handle filter

		$this->eventList->readObjects();
	}


	/**
	 * @see	\wcf\system\menu\calendar\content\ICalendarMenuContent::getContent()
	 */
	public function getContent() {
		WCF::getTPL()->assign(array(
			'events' => $this->eventList
		));
		
		return WCF::getTPL()->fetch('calendarDaily');
	}
}
