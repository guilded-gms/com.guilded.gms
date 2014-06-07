<?php
namespace gms\system\log\modification;
use gms\data\event\date\EventDate;
use wcf\system\log\modification\ModificationLogHandler;

class EventDateModificationLogHandler extends ModificationLogHandler {
	/**
	 * Adds a log entry for event close.
	 * 
	 * @param	\gms\data\event\date\EventDate	$eventDate
	 */
	public function close(EventDate $eventDate) {
		$this->add($eventDate, 'close');
	}
	
	/**
	 * Adds a log entry for event delete.
	 * 
	 * @param	\gms\data\event\date\EventDate	$eventDate
	 */
	public function delete(EventDate $eventDate) {
		$this->add($eventDate, 'delete');
	}

	/**
	 * Adds a log entry for event edit.
	 *
	 * @param	\gms\data\event\date\EventDate	$eventDate
	 * @param	string				$reason
	 */
	public function edit(EventDate $eventDate, $reason = '') {
		$this->add($eventDate, 'edit', array('reason' => $reason));
	}
	
	/**
	 * Adds a log entry for event restore.
	 *
	 * @param	\gms\data\event\date\EventDate	$eventDate
	 */
	public function restore(EventDate $eventDate) {
		$this->add($eventDate, 'restore');
	}
	
	/**
	 * Adds a log entry for event soft-delete (trash).
	 *
	* @param	\gms\data\event\date\EventDate	$eventDate
	 * @param	string	$reason
	 */
	public function trash(EventDate $eventDate, $reason = '') {
		$this->add($eventDate, 'trash', array('reason' => $reason));
	}
	
	/**
	 * Adds a event modification log entry.
	 * 
	 * @param	\gms\data\event\date\EventDate	$eventDate
	 * @param	string	$action
	 * @param	array	$additionalData
	 */
	public function add(EventDate $eventDate, $action, array $additionalData = array()) {
		parent::_add('com.guilded.gms.event.date', $eventDate->eventDateID, $action, $additionalData);
	}
}
