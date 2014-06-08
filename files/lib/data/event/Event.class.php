<?php
namespace gms\data\event;
use gms\data\event\category\EventCategory;
use gms\data\event\date\EventDateList;
use gms\data\GMSDatabaseObject;
use gms\system\event\type\EventTypeHandler;
use wcf\data\category\Category;
use wcf\system\request\IRouteController;
use wcf\system\WCF;

/**
 * Represents an event.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	CC BY-NC-SA 3.0 <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	data.event
 * @category	Guilded 2.0
 */
class Event extends GMSDatabaseObject implements IRouteController {
	/**
	 * @see	wcf\data\DatabaseObject::$databaseTableName
	 */
	protected static $databaseTableName = 'event';
	
	/**
	 * @see	wcf\data\DatabaseObject::$databaseTableIndexName
	 */
	protected static $databaseTableIndexName = 'eventID';

	/**
	 * category object
	 * @var	\wcf\data\category\Category
	 */
	protected $category = null;

	/**
	 * dateList object
	 * @var	\gms\data\event\date\EventDateList
	 */
	protected $dateList = null;

	/**
	 * Returns dateList object.
	 *
	 * @return	\gms\data\event\date\EventDateList
	 */
	public function getDates() {
		if ($this->dateList === null) {
			$this->dateList = new EventDateList();
			$this->dateList->getConditionBuilder()->add('event.eventID = ?', array($this->eventID));
			$this->dateList->readObjects();
		}

		return $this->dateList;
	}

	/**
	 * Returns category object.
	 *
	 * @return	\wcf\data\category\Category
	 */
	public function getCategory() {
		if ($this->category === null) {
			$this->category = new EventCategory(new Category($this->categoryID));
		}

		return $this->category;
	}

	/**
	 * @see	\wcf\system\request\IRoutController::getTitle()
	 */
	public function getTitle() {
		return $this->title;
	}
	
	/**
	 * Returns type of event.
	 *
	 * @return	\gms\system\event\type\IEventType
	 */	
	public function getType() {
		return EventTypeHandler::getInstance()->getObjectTypeByID($this->objectTypeID);
	}

	/**
	 * Returns if event can viewed by current user.
	 *
	 * @return	boolean
	 */
	public function canView() {
		if (!$this->getCategory()->isAccessible()) {
			return false;
		}

		return WCF::getSession()->getPermission('user.gms.event.canView');
	}
}
