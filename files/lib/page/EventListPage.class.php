<?php
namespace gms\page;
use gms\system\event\view\EventViewHandler;
use wcf\page\SortablePage;
use wcf\system\WCF;

/**
 * Shows the event list page.
 */
class EventListPage extends SortablePage {
	/**
	 * list of event views
	 * 
	 * @var	array<\wcf\system\event\view\IEventView>
	 */
	public $views = array();
	
	/**
	 * @see wcf\page\AbstractPage::readData()
	 */
	public function readData() {
		parent::readData();
		
		$this->views = EventViewHandler::getInstance()->getObjectTypes();
	}
	
	/**
	 * @see wcf\page\AbstractPage::assignVariables()
	 */
	public function assignVariables() {
		parent::assignVariables();
		
		WCF::getTPL()->assign(array(
			'views' => $this->views,
			'activeView' => WCF::getUser()->activeEventView
		));
	}
}
