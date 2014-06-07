<?php
namespace gms\system\log\modification;
use gms\data\event\date\participation\EventDateParticipation;
use wcf\system\log\modification\ModificationLogHandler;

class EventDateParticipationModificationLogHandler extends ModificationLogHandler {
	/**
	 * Adds a log entry for event participation accept.
	 * 
	 * @param	\gms\data\event\date\participation\EventDateParticipation	$participation
	 */
	public function accept(EventDateParticipation $participation) {
		$this->add($participation, 'accept');
	}	
	
	/**
	 * Adds a log entry for event participation decline.
	 * 
	 * @param	\gms\data\event\date\participation\EventDateParticipation	$participation
	 */
	public function decline(EventDateParticipation $participation) {
		$this->add($participation, 'close');
	}
	
	/**
	 * Adds a event participation modification log entry.
	 * 
	 * @param	\gms\data\event\date\participation\EventDateParticipation	$participation
	 * @param	string	$action
	 * @param	array	$additionalData
	 */
	public function add(EventDateParticipation $participation, $action, array $additionalData = array()) {
		parent::_add('com.guilded.gms.event.date.participation', $participation->participationID, $action, $additionalData);
	}
}