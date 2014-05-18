<?php
namespace gms\data\event;
use gms\data\GMSDatabaseObject;
use gms\system\event\type\EventTypeHandler;
use wcf\data\category\Category;
use wcf\system\request\IRouteController;

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
	 * Returns category object.
	 *
	 * @return	\wcf\data\category\Category
	 */
	public function getCategory() {
		if ($this->category === null) {
			$this->category = new Category($this->categoryID);
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
		return true; // @todo
	}
}
