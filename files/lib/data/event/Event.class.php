<?php
namespace gms\data\event;
use gms\data\event\participation\EventParticipationList;
use gms\data\GMSDatabaseObject;
use gms\system\event\type\EventTypeHandler;
use wcf\system\request\IRouteController;

/**
 * Represents an event.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	CC BY-NC-SA 3.0 <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	data.event
 * @category	Guilded 2.0
 */
class Event extends GMSDatabaseObject implements IRouteController {
	/**
	 * @see	wcf\data\DatabaseObject::$databaseTableName
	 */
	protected static $databaseTableName = 'event';
	
	/**
	 * @see	wcf\data\DatabaseObject::$databaseTableIndexName
	 */
	protected static $databaseTableIndexName = 'eventID';

	/**
	 * list of participants
	 * @var array
	 */
	protected $participants = array();

	/**
	 * @see IRoutController::getTitle()
	 */
	public function getTitle() {
		return $this->title;
	}
	
	/**
	 * Returns type of event.
	 *
	 * @return	\gms\system\event\type\IEventType
	 */	
	public function getType() {
		return EventTypeHandler::getInstance()->getObjectTypeByID($this->objectTypeID);
	}

	/**
	 * Returns a list of all participants
	 *
	 * @return  array
	 */
	public function getParticipants() {
		if (empty($this->participants)) {
			$participationList = new EventParticipationList();
			$participationList->getConditionBuilder()->add('event_participation.eventID = ?', array($this->eventID));
			$participationList->readObjects();

			$this->participants = $participationList->getObjects();
		}
	
		return $this->participants;
	}
	
	/**
	 * Checks whether the announcement time for this event is expired
	 * 
	 * @return	bool
	 */
	public function isExpired() {
		return false; // @todo check
	}

	/**
	 * Checks whether the announcement for this event is closed
	 *
	 * @return	bool
	 */
	public function isClosed() {
		return false; // @todo check
	}
}
