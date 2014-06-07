<?php
namespace gms\page;
use gms\data\event\date\EventDate;
use wcf\page\AbstractPage;
use wcf\system\breadcrumb\Breadcrumb;
use wcf\system\comment\CommentHandler;
use wcf\system\dashboard\DashboardHandler;
use wcf\system\exception\IllegalLinkException;
use wcf\system\MetaTagHandler;
use wcf\system\request\LinkHandler;
use wcf\system\user\collapsible\content\UserCollapsibleContentHandler;
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
	public $neededPermissions = array('user.gms.event.canView');

	/**
	 * date id
	 * @var integer
	 */
	public $eventDateID = 0;
	
	/**
	 * event object
	 * @var \gms\data\event\date\EventDate
	 */
	public $eventDate = null;

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
		
		if (isset($_REQUEST['id'])) $this->eventDateID = intval($_REQUEST['id']);
		
		$this->eventDate = new EventDate($this->eventDateID);
		if (!$this->eventDate->eventDateID) {
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
		$this->commentObjectTypeID = CommentHandler::getInstance()->getObjectTypeID('com.guilded.gms.event.date.comment');
		$this->commentManager = CommentHandler::getInstance()->getObjectType($this->commentObjectTypeID)->getProcessor();
		$this->commentList = CommentHandler::getInstance()->getCommentList($this->commentManager, $this->commentObjectTypeID, $this->eventDateID);

		// set breadcrumb
		WCF::getBreadcrumbs()->add(new Breadcrumb(WCF::getLanguage()->get('gms.calendar.title'), LinkHandler::getInstance()->getLink('Calendar', array('application' => 'gms'))));
		WCF::getBreadcrumbs()->add(new Breadcrumb($this->eventDate->getEvent()->getCategory()->getTitle(), LinkHandler::getInstance()->getLink('Calendar', array('application' => 'gms', 'categoryID' => $this->eventDate->getEvent()->getCategory()->categoryID))));

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

		DashboardHandler::getInstance()->loadBoxes('com.guilded.gms.EventPage', $this);

		WCF::getTPL()->assign(array(
			'sidebarCollapsed' => UserCollapsibleContentHandler::getInstance()->isCollapsed('com.woltlab.wcf.collapsibleSidebar', 'com.guilded.gms.EventPage'),
			'sidebarName' => 'com.guilded.gms.EventPage',
			'eventDateID' => $this->eventDateID,
			'eventDate' => $this->eventDate,
			'event' => $this->eventDate->getEvent(),
			'commentList' => $this->commentList,
			'commentObjectTypeID' => $this->commentObjectTypeID,
			'lastCommentTime' => ($this->commentList ? $this->commentList->getMinCommentTime() : 0),
		));
	}
}
