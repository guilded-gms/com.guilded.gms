<?php
namespace gms\data\event\date;
use gms\data\event\date\participation\EventDateParticipationList;
use gms\data\event\Event;
use wcf\data\DatabaseObject;
use wcf\system\breadcrumb\Breadcrumb;
use wcf\system\breadcrumb\IBreadcrumbProvider;
use wcf\system\request\IRouteController;
use wcf\system\request\LinkHandler;

/**
 * Represents an event date.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	CC BY-NC-SA 3.0 <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	data.event.date
 * @category	Guilded 2.0
 */
class EventDate extends DatabaseObject implements IRouteController, IBreadcrumbProvider {
	/**
	 * @see	\wcf\data\DatabaseObject::$databaseTableName
	 */
	protected static $databaseTableName = 'event_date';
	
	/**
	 * @see	\wcf\data\DatabaseObject::$databaseTableIndexName
	 */
	protected static $databaseTableIndexName = 'eventDateID';

	/**
	 * event object
	 * @var	\gms\data\event\Event
	 */
	protected $event = null;

	/**
	 * list of participants
	 * @var	\gms\data\event\date\participation\EventDateParticipationList
	 */
	protected $participantList = array();

	/**
	 * @see	\wcf\system\request\IRoutController::getTitle()
	 */
	public function getTitle() {
		return $this->getEvent()->getTitle();
	}

	/**
	 * Returns event object.
	 *
	 * @return	\gms\data\event\Event
	 */
	public function getEvent() {
		if ($this->event === null) {
			$this->event = new Event($this->eventID);
		}

		return $this->event;
	}

	/**
	 * Returns a list of all participants
	 *
	 * @return  array
	 */
	public function getParticipantList() {
		if (empty($this->participants)) {
			$participationList = new EventDateParticipationList();
			$participationList->getConditionBuilder()->add('event_participation.eventID = ?', array($this->eventID));
			$participationList->readObjects();
		}

		return $this->participantList;
	}

	/**
	 * Checks whether the participation time for this event is expired
	 *
	 * @return	boolean
	 */
	public function isExpired() {
		return ($this->startTime >= TIME_NOW || $this->deadlineTime >= TIME_NOW);
	}

	/**
	 * Checks whether the announcement for this event is closed
	 *
	 * @return	boolean
	 */
	public function isClosed() {
		return $this->isClosed;
	}

	/**
	 * @see	\wcf\system\breadcrumb\IBreadcrumbProvider::getBreadcrumb()
	 */
	public function getBreadcrumb() {
		return new Breadcrumb($this->getTitle(), $this->getLink());
	}

	/**
	 * Returns the link to the object.
	 *
	 * @return	string
	 */
	public function getLink() {
		return LinkHandler::getInstance()->getLink('Event', array(
			'object' => $this,
			'application' => 'gms',
			'forceFrontend' => true
		));
	}
}
