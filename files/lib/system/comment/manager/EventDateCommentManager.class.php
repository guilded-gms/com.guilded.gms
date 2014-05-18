<?php
namespace gms\system\comment\manager;
use gms\data\event\date\EventDate;
use gms\data\event\date\EventDateEditor;
use wcf\system\comment\manager\AbstractCommentManager;
use wcf\system\request\LinkHandler;
use wcf\system\WCF;

/**
 * Event comment manager implementation.
 */
class EventDateCommentManager extends AbstractCommentManager {
	/**
	 * @see	\wcf\system\comment\manager\AbstractCommentManager::$permissionAdd
	 */
	protected $permissionAdd = 'user.gms.event.comment.canAddComment';

	/**
	 * @see	\wcf\system\comment\manager\AbstractCommentManager::$permissionCanModerate
	 */
	protected $permissionCanModerate = 'mod.gms.event.comment.canModerateComment';

	/**
	 * @see	\wcf\system\comment\manager\AbstractCommentManager::$permissionDelete
	 */
	protected $permissionDelete = 'user.gms.event.comment.canDeleteComment';

	/**
	 * @see	\wcf\system\comment\manager\AbstractCommentManager::$permissionEdit
	 */
	protected $permissionEdit = 'user.gms.event.comment.canEditComment';

	/**
	 * @see	\wcf\system\comment\manager\AbstractCommentManager::$permissionModDelete
	 */
	protected $permissionModDelete = 'mod.gms.event.comment.canDeleteComment';

	/**
	 * @see	\wcf\system\comment\manager\AbstractCommentManager::$permissionModEdit
	 */
	protected $permissionModEdit = 'mod.gms.event.comment.canEditComment';

	/**
	 * Returns a link to given object type id and object id.
	 *
	 * @param    integer $objectTypeID
	 * @param    integer $objectID
	 * @return    string
	 */
	public function getLink($objectTypeID, $objectID) {
		return LinkHandler::getInstance()->getLink('Event', array(
			'application' => 'gms',
			'id' => $objectID
		));
	}

	/**
	 * @see	\wcf\system\comment\manager\ICommentManager::getTitle()
	 */
	public function getTitle($objectTypeID, $objectID, $isResponse = false) {
		if ($isResponse) {
			return WCF::getLanguage()->get('gms.event.comment.response');
		}

		return WCF::getLanguage()->getDynamicVariable('gms.event.comment');
	}

	/**
	 * @see	\wcf\system\comment\manager\ICommentManager::isAccessible()
	 */
	public function isAccessible($objectID, $validateWritePermission = false) {
		// TODO: Implement isAccessible() method.
	}

	/**
	 * @see	\wcf\system\comment\manager\ICommentManager::updateCounter()
	 */
	public function updateCounter($objectID, $value) {
		$eventDate = new EventDate($objectID);
		$editor = new EventDateEditor($eventDate);
		$editor->updateCounters(array(
			'comments' => $value
		));
	}
}