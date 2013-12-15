<?php
namespace gms\system\log\modification;
use wcf\data\event\Event;
use wcf\system\database\util\PreparedStatementConditionBuilder;
use wcf\system\log\modification\ModificationLogHandler;

class EventModificationLogHandler extends ModificationLogHandler {
	/**
	 * Adds a log entry for event close.
	 * 
	 * @param	wcf\data\event\Event	$event
	 */
	public function close(Event $event) {
		$this->add($event, 'close');
	}
	
	/**
	 * Adds a log entry for event delete.
	 * 
	 * @param	wcf\data\event\Event	$event
	 */
	public function delete(Event $event) {
		$this->add($event, 'delete');
	}
	
	/**
	 * Adds a log entry for event open.
	 *
	 * @param	wcf\data\event\Event	$event
	 */
	public function open(Event $event) {
		$this->add($event, 'open');
	}
	
	/**
	 * Adds a log entry for event restore.
	 *
	 * @param	wcf\data\event\Event	$event
	 */
	public function restore(Event $event) {
		$this->add($event, 'restore');
	}
	
	/**
	 * Adds a log entry for event soft-delete (trash).
	 *
	* @param	wcf\data\event\Event	$event
	 * @param	string	$reason
	 */
	public function trash(Event $event, $reason = '') {
		$this->add($event, 'trash', array('reason' => $reason));
	}
	
	/**
	 * Adds a event modification log entry.
	 * 
	 * @param	wcf\data\event\Event	$event
	 * @param	string	$action
	 * @param	array		$additionalData
	 */
	public function add(Event $event, $action, array $additionalData = array()) {
		parent::_add('com.guilded.gms', $event->eventID, $action, $additionalData);
	}
}