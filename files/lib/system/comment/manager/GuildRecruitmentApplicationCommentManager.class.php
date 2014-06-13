<?php
namespace gms\system\comment\manager;
use gms\data\guild\recruitment\application\GuildRecruitmentApplication;
use gms\data\guild\recruitment\application\GuildRecruitmentApplicationEditor;
use wcf\system\comment\manager\AbstractCommentManager;
use wcf\system\request\LinkHandler;
use wcf\system\WCF;


class GuildRecruitmentApplicationCommentManager extends AbstractCommentManager {
	/**
	 * @see	\wcf\system\comment\manager\AbstractCommentManager::$commentsPerPage
	 */
	public $commentsPerPage = 10; // @todo

	/**
	 * @see	\wcf\system\comment\manager\AbstractCommentManager::$permissionCanModerate
	 */
	protected $permissionCanModerate = 'mod.gms.guild.canManageRecruitment';

	/**
	 * @see	\wcf\system\comment\manager\AbstractCommentManager::$permissionModDelete
	 */
	protected $permissionModDelete = 'mod.gms.guild.canManageRecruitment';

	/**
	 * @see	\wcf\system\comment\manager\AbstractCommentManager::$permissionModEdit
	 */
	protected $permissionModEdit = 'mod.gms.guild.canManageRecruitment';

	/**
	 * @see	\wcf\system\comment\manager\AbstractCommentManager::$permissionAdd
	 */
	protected $permissionAdd = 'user.gms.guild.recruitment.application.canAddComment'; // @todo

	/**
	 * @see	\wcf\system\comment\manager\AbstractCommentManager::$permissionDelete
	 */
	protected $permissionDelete = 'user.gms.guild.recruitment.application.canDeleteComment'; // @todo

	/**
	 * @see	\wcf\system\comment\manager\AbstractCommentManager::$permissionEdit
	 */
	protected $permissionEdit = 'user.gms.guild.recruitment.application.canEditComment'; // @todo

	/**
	 * object object
	 * @var	\gms\data\guild\recruitment\application\GuildRecruitmentApplication
	 */
	protected $object = null;

	/**
	 * Sets current book.
	 *
	 * @param	integer		$objectID
	 */
	public function setObject($objectID) {
		$this->object = new GuildRecruitmentApplication($objectID);
	}

	/**
	 * @see	\wcf\system\comment\manager\ICommentManager::getTitle()
	 */
	public function getTitle($objectTypeID, $objectID, $isResponse = false) {
		if ($isResponse) {
			return WCF::getLanguage()->get('gms.guild.recruitment.application.comment.response');
		}

		return WCF::getLanguage()->getDynamicVariable('gms.guild.recruitment.application.comment');
	}

	/**
	 * @see	\wcf\system\comment\manager\ICommentManager::updateCounter()
	 */
	public function updateCounter($objectID, $value) {
		// get editor
		$applicationEditor = new GuildRecruitmentApplicationEditor(new GuildRecruitmentApplication($objectID));

		// update comments counter
		$applicationEditor->updateCounters(array(
			'comments' => $value
		));
	}

	/**
	 * @see	\wcf\system\comment\manager\ICommentManager::getLink()
	 */
	public function getLink($objectTypeID, $objectID) {
		return LinkHandler::getInstance()->getLink('GuildRecruitmentApplication', array('id' => $objectID, 'application' => 'gms'));
	}

	/**
	 * @see	\wcf\system\comment\manager\ICommentManager::isAccessible()
	 */
	public function isAccessible($objectID, $validateWritePermission = false) {
		$this->setObject($objectID);

		// check object id
		if (!$this->object->applicationID) {
			return false;
		}

		// check view permission
		if (!$this->object->canView()) {
			return false;
		}

		return true;
	}
}
