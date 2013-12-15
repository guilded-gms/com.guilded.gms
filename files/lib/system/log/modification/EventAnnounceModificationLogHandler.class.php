<?php
namespace gms\system\log\modification;
use wcf\data\event\participation\EventParticipation;
use wcf\system\database\util\PreparedStatementConditionBuilder;
use wcf\system\log\modification\ModificationLogHandler;

class EventAnnounceModificationLogHandler extends ModificationLogHandler {
	/**
	 * Adds a log entry for event participation accept.
	 * 
	 * @param	wcf\data\event\participation\EventParticipation	$participation
	 */
	public function accept(EventParticipation $participation) {
		$this->add($participation, 'accept');
	}	
	
	/**
	 * Adds a log entry for event participation decline.
	 * 
	 * @param	wcf\data\event\participation\EventParticipation	$participation
	 */
	public function decline(EventParticipation $participation) {
		$this->add($participation, 'close');
	}
	
	/**
	 * Adds a event participation modification log entry.
	 * 
	 * @param	wcf\data\event\participation\EventParticipation	$participation
	 * @param	string	$action
	 * @param	array		$additionalData
	 */
	public function add(EventParticipation $participation, $action, array $additionalData = array()) {
		parent::_add('com.guilded.gms.participation', $participation->participationID, $action, $additionalData);
	}
}