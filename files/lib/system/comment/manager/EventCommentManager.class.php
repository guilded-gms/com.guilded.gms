<?php
namespace gms\system\comment\manager;
use gms\data\event\Event;
use wcf\system\comment\manager\AbstractCommentManager;
use wcf\system\WCF;

/**
 * Event comment manager implementation.
 */
class EventCommentManager extends AbstractCommentManager {
	/**
	 * Returns a link to given object type id and object id.
	 *
	 * @param    integer $objectTypeID
	 * @param    integer $objectID
	 * @return    string
	 */
	public function getLink($objectTypeID, $objectID) {
		// TODO: Implement getLink() method.
	}

	/**
	 * Returns the title for a comment or response.
	 *
	 * @param    integer $objectTypeID
	 * @param    integer $objectID
	 * @param    boolean $isResponse
	 * @return    string
	 */
	public function getTitle($objectTypeID, $objectID, $isResponse = false) {
		// TODO: Implement getTitle() method.
	}

	/**
	 * Returns true if comments and responses for given object id are accessible
	 * by current user.
	 *
	 * @param    integer $objectID
	 * @param    boolean $validateWritePermission
	 * @return    boolean
	 */
	public function isAccessible($objectID, $validateWritePermission = false) {
		// TODO: Implement isAccessible() method.
	}

	/**
	 * Updates total count of comments (includes responses).
	 *
	 * @param    integer $objectID
	 * @param    integer $value
	 */
	public function updateCounter($objectID, $value) {
		// TODO: Implement updateCounter() method.
	}

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
