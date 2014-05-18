<?php
namespace gms\data\event\date;
use gms\data\event\date\participation\EventDateParticipationList;
use wcf\data\DatabaseObject;
use wcf\system\WCF;

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
class EventDate extends DatabaseObject {
	/**
	 * @see	\wcf\data\DatabaseObject::$databaseTableName
	 */
	protected static $databaseTableName = 'event_date';
	
	/**
	 * @see	\wcf\data\DatabaseObject::$databaseTableIndexName
	 */
	protected static $databaseTableIndexName = 'eventDateID';

	/**
	 * list of participants
	 * @var	\gms\data\event\date\participation\EventDateParticipationList
	 */
	protected $participantList = array();

	/**
	 * Returns a list of all participants
	 *
	 * @return  array
	 */
	public function getParticipantList() {
		if (empty($this->participants)) {
			$participationList = new EventDateParticipationList();
			$participationList->getConditionBuilder()->add('event_participation.eventDateID = ?', array($this->eventID));
			$participationList->readObjects();
		}

		return $this->participantList;
	}

	/**
	 * Checks whether the participation time for this event is expired
	 *
	 * @return	bool
	 */
	public function isExpired() {
		return ($this->startTime >= TIME_NOW); // @todo check deadline
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
