<?php
namespace gms\data\event\date\invitation;
use gms\data\event\date\participation\EventDateParticipation;
use wcf\data\DatabaseObject;

/**
 * Represents an event invitation.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	CC BY-NC-SA 3.0 <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	data.event.date.invitation
 * @category	Guilded 2.0
 */
class EventDateInvitation extends DatabaseObject {
	/**
	 * @see	\wcf\data\DatabaseObject::$databaseTableName
	 */
	protected static $databaseTableName = 'event_date_invitation';
	
	/**
	 * @see	\wcf\data\DatabaseObject::$databaseTableIndexName
	 */
	protected static $databaseTableIndexName = 'invitationID';

	/**
	 * participation object
	 * @var	\gms\data\event\date\participation\EventDateParticipation
	 */
	protected $participation = null;

	/**
	 * Returns participation object.
	 *
	 * @return	\gms\data\event\date\participation\EventDateParticipation
	 */
	public function getParticipation() {
		if ($this->participation === null) {
			$this->participation = new EventDateParticipation($this->participationID);
		}

		return $this->participation;
	}
}
