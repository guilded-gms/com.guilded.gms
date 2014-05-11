<?php
namespace gms\page;
use gms\data\event\Event;
use wcf\page\AbstractPage;
use wcf\system\comment\CommentHandler;
use wcf\system\exception\IllegalLinkException;
use wcf\system\MetaTagHandler;
use wcf\system\request\LinkHandler;
use wcf\system\WCF;
use wcf\util\StringUtil;

class EventPage extends AbstractPage {
	/**
	 * @see	\wcf\page\AbstractPage::$neededModules
	 */
	public $neededModules = array('GMS_MODULE_CALENDAR');

	/**
	 * @see	\wcf\page\AbstractPage::$neededPermissions
	 */
	public $neededPermissions = array('user.gms.event.canViewEvent');

	/**
	 * event id
	 * @var integer
	 */
	public $eventID = 0;
	
	/**
	 * event object
	 * @var \gms\data\event\Event
	 */
	public $event = null;

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
	 * @see wcf\page\IPage::readParameters()
	 */
	public function readParameters() {
		parent::readParameters();
		
		if (isset($_REQUEST['id'])) $this->eventID = intval($_REQUEST['id']);
		
		$this->event = new Event($this->eventID);
		if (!$this->event->eventID) {
			throw new IllegalLinkException();
		}
	}
	
	/**
	 * @see wcf\page\IPage::readData()
	 */	
	public function readData() {
		parent::readData();

		// get comments
		// @todo check commenting with ACL
		$this->commentObjectTypeID = CommentHandler::getInstance()->getObjectTypeID('com.guilded.gms.event.comment');
		$this->commentManager = CommentHandler::getInstance()->getObjectType($this->commentObjectTypeID)->getProcessor();
		$this->commentList = CommentHandler::getInstance()->getCommentList($this->commentManager, $this->commentObjectTypeID, $this->eventID);

		// @todo set breadcrump

		// add meta tags
		MetaTagHandler::getInstance()->addTag('og:title', 'og:title', $this->eventDate->getTitle() . ' (' . $this->eventDate->startTime . ') - ' . WCF::getLanguage()->get(PAGE_TITLE), true);
		MetaTagHandler::getInstance()->addTag('og:url', 'og:url', LinkHandler::getInstance()->getLink('Event', array('application' => 'gms', 'object' => $this->eventDate)), true);
		MetaTagHandler::getInstance()->addTag('og:type', 'og:type', 'article', true);
		MetaTagHandler::getInstance()->addTag('og:description', 'og:description', StringUtil::decodeHTML(StringUtil::stripHTML($this->eventDate->description)), true);
		// @todo og:image, article:expiration_time
	}
	
	/**
	 * @see wcf\page\IPage::assignVariables()
	 */
	public function assignVariables() {
		parent::assignVariables();
		
		WCF::getTPL()->assign(array(
			'eventID' => $this->eventID,
			'event' => $this->event,
			'commentList' => $this->commentList,
			'commentObjectTypeID' => $this->commentObjectTypeID,
			'lastCommentTime' => ($this->commentList ? $this->commentList->getMinCommentTime() : 0),
		));
	}
}
