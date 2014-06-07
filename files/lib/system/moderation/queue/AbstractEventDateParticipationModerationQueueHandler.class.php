<?php
namespace gms\system\moderation\queue;
use gms\data\event\date\participation\EventDateParticipation;
use gms\data\event\date\participation\EventDateParticipationAction;
use gms\data\event\date\participation\EventDateParticipationList;
use wcf\data\moderation\queue\ModerationQueue;
use wcf\system\moderation\queue\AbstractModerationQueueHandler;
use wcf\system\moderation\queue\ModerationQueueManager;
use wcf\system\WCF;

abstract class AbstractEventDateParticipationModerationQueueHandler extends AbstractModerationQueueHandler {
	/**
	 * @see	\wcf\system\moderation\queue\AbstractModerationQueueHandler::$className
	 */
	protected $className = 'gms\data\event\date\participation\EventDateParticipation';

	/**
	 * @see	\wcf\system\moderation\queue\AbstractModerationQueueHandler::$objectType
	 */
	protected $objectType = 'com.guilded.gms.event.date.participation';
	/**
	 * list of participation objects
	 * @var	array<\gms\data\event\date\participation\EventDateParticipation>
	 */
	protected static $participation = array();
	
	/**
	 * @see	\wcf\system\moderation\queue\IModerationQueueHandler::assignQueues()
	 */
	public function assignQueues(array $queues) {
		$assignments = array();
		foreach ($queues as $queue) {
			$assignUser = false;
			if (WCF::getSession()->getPermission('mod.gms.event.canModerate')) {
				$assignUser = true;
			}
				
			$assignments[$queue->queueID] = $assignUser;
		}
	
		ModerationQueueManager::getInstance()->setAssignment($assignments);
	}
	
	/**
	 * @see	\wcf\system\moderation\queue\IModerationQueueHandler::getContainerID()
	 */
	public function getContainerID($objectID) {
		return 0;
	}
	
	/**
	 * @see	\wcf\system\moderation\queue\IModerationQueueHandler::isValid()
	 */
	public function isValid($objectID) {
		if ($this->getParticipation($objectID) === null) {
			return false;
		}
		
		return true;
	}
	
	/**
	 * Returns a participation object by given id.
	 * 
	 * @param	integer		$objectID
	 * @return	\gms\data\event\date\participation\EventDateParticipation
	 */
	protected function getParticipation($objectID) {
		if (!array_key_exists($objectID, self::$participation)) {
			self::$participation[$objectID] = new EventDateParticipation($objectID);
			
			if (!self::$participation[$objectID]->participationID) {
				self::$participation[$objectID] = null;
			}
		}
		
		return self::$participation[$objectID];
	}
	
	/**
	 * @see	\wcf\system\moderation\queue\IModerationQueueHandler::populate()
	 */
	public function populate(array $queues) {
		$objectIDs = array();
		foreach ($queues as $object) {
			$objectIDs[] = $object->objectID;
		}
		
		// fetch entries
		$participationList = new EventDateParticipationList();
		$participationList->setObjectIDs($objectIDs);
		$participationList->readObjects();
		$participation = $participationList->getObjects();
		
		foreach ($queues as $object) {
			if (isset($participation[$object->objectID])) {
				$object->setAffectedObject($participation[$object->objectID]);
			}
			else {
				$object->setIsOrphaned();
			}
		}
	}
	
	/**
	 * @see	\wcf\system\moderation\queue\IModerationQueueHandler::removeContent()
	 */
	public function removeContent(ModerationQueue $queue, $message) {
		if ($this->isValid($queue->objectID)) {
			$action = new EventDateParticipationAction(array($this->getParticipation($queue->objectID)), 'delete');
			$action->executeAction();
		}
	}
}
