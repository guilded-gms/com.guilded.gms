<?php
namespace gms\page;
use wcf\data\event\Event;
use wcf\system\exception\IllegalLinkException;
use wcf\system\WCF;

class EventPage extends AbstractPage {
	/**
	 * event id
	 * @var integer
	 */
	public $eventID = 0;
	
	/**
	 * user object
	 * @var wcf\data\event\Event
	 */
	public $event = null;
	
	/**
	 * @see wcf\page\IPage::readParameters()
	 */
	public function readParameters() {
		parent::readParameters();
		
		if (isset($_REQUEST['id'])) $this->eventID = intval($_REQUEST['id']);
		
		$this->event = new Event($this->eventID);
		if (!$this->event->eventID) {
			throw new IllegalLinkException();
		}
	}
	
	/**
	 * @see wcf\page\IPage::readData()
	 */	
	public function readData() {
		parent::readData();

		// \todo get comments
	}
	
	/**
	 * @see wcf\page\IPage::assignVariables()
	 */
	public function assignVariables() {
		parent::assignVariables();
		
		WCF::getTPL()->assign(array(
			'eventID' => $this->eventID,
			'event' => $this->event
		));
	}
}
