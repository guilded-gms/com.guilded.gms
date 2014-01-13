<?php
namespace gms\system\comment\manager;
use wcf\data\event\Event;
use wcf\system\WCF;

/**
 * Event comment manager implementation.
 */
class EventCommentManager extends AbstractCommentManager {
	/**
	 * @see	wcf\system\SingletonFactory::init()
	 */
	protected function init() {
		if (WCF::getUser()->userID) {
			// validate general permissions
			if (WCF::getSession()->getPermission('user.event.comment.canAddComment')) {
				$this->canAdd = true;
			}
			
			if (WCF::getSession()->getPermission('user.event.comment.canDeleteComment')) {
				$this->canDelete = true;
			}
			
			if (WCF::getSession()->getPermission('user.event.comment.canEditComment')) {
				$this->canEdit = true;
			}
		}
	}
	
	/**
	 * @see	wcf\system\comment\manager\AbstractCommentManager::canAdd()
	 */
	public function canAdd($objectID) {
		if (!$this->canAdd) {
			return false;
		}
		
		// check object id
		$event = new Event($objectID);
		if ($event === null) {
			return false;
		}
		
		// check visibility
		if ($event->isExpired() || $event->isClosed()) {
			return false;
		}
		
		return true;
	}
}
