<?php
namespace gms\page;
use gms\data\guild\recruitment\application\GuildRecruitmentApplication;
use wcf\page\AbstractPage;
use wcf\system\comment\CommentHandler;
use wcf\system\exception\IllegalLinkException;
use wcf\system\WCF;

/**
 * Represents an guild recruitment application page.
 * 
 * @author	Jeffrey Reichardt
 * @copyright	{{COPYRIGHT}}
 * @package	com.guilded.gms
 * @subpackage	page
 * @category	{{PROJECT-CATEGORY}}
 *
 * @todo	acl check on guild
 */
class GuildRecruitmentApplicationPage extends AbstractPage {
	/**
	 * id of object
	 * @var integer
	 */
	public $objectID = 0;

	/**
	 * database object
	 * @var \gms\data\guild\recruitment\application\GuildRecruitmentApplication
	 */
	public $object = null;

	/**
	 * comment object type id
	 * @var	integer
	 */
	public $commentObjectTypeID = 0;

	/**
	 * comment manager object
	 * @var	\wcf\system\comment\manager\ICommentManager
	 */
	public $commentManager = null;

	/**
	 * list of comments
	 * @var	\wcf\data\comment\StructuredCommentList
	 */
	public $commentList = null;

	/**
	 * @see \wcf\page\IPage::readParameters()
	 */
	public function readParameters() {
		parent::readParameters();

		if (isset($_REQUEST['id'])) $this->objectID = intval($_REQUEST['id']);
		
		$this->object = new GuildRecruitmentApplication($this->objectID);
		if (!$this->object->applicationID) {
			throw new IllegalLinkException();
		}
	}

	/**
	 * @see \wcf\page\IPage::readData()
	 */
	public function readData() {
		parent::readData();

		$this->commentObjectTypeID = CommentHandler::getInstance()->getObjectTypeID('com.guilded.gms.guild.recruitment.application.comment');
		$this->commentManager = CommentHandler::getInstance()->getObjectType($this->commentObjectTypeID)->getProcessor();
		$this->commentList = CommentHandler::getInstance()->getCommentList($this->commentManager, $this->commentObjectTypeID, $this->objectID);
	}

	/**
	 * @see \wcf\page\IPage::assignVariables()
	 */
	public function assignVariables() {
		parent::assignVariables();

		WCF::getTPL()->assign(array(
			'applicationID' => $this->object->getObjectID(),
			'application' => $this->object,
			'commentCanAdd' => (WCF::getUser()->userID && true), // @todo getPermission
			'commentList' => $this->commentList,
			'commentObjectTypeID' => $this->commentObjectTypeID,
			'lastCommentTime' => ($this->commentList ? $this->commentList->getMinCommentTime() : 0)
		));
	}
}

