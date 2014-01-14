<?php
namespace gms\system\menu\calendar\content;
use gms\data\event\EventList;
use wcf\system\event\EventHandler;
use wcf\system\SingletonFactory;
use wcf\system\WCF;

class AbstractCalendarMenuContent extends SingletonFactory implements ICalendarMenuContent {
	/**
	 * template file
	 * @var    string
	 */
	protected $templateName = '';

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
	}

	/**
	 * Fetches data.
	 */
	public function fetch() {
		// fire listener
		EventHandler::getInstance()->fireAction($this, 'fetched');

		// read objects
		$this->eventList->readObjects();
	}

	/**
	 * @see	\wcf\system\menu\calendar\content\ICalendarMenuContent::getContent()
	 */
	public function getContent() {
		if (empty($this->templateName)) {
			return '';
		}

		$this->fetch();

		WCF::getTPL()->assign(array(
			'events' => $this->eventList
		));
		
		return WCF::getTPL()->fetch($this->templateName, 'gms');
	}
}
