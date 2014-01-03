<?php
namespace gms\system\event\type;
use wcf\data\event\EventList;
use wcf\system\event\type\IEventType;

/**
 * Every EventType should extended by this abstract implementation.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	CC BY-NC-SA 3.0 <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	system.event.type
 * @category	Guilded 2.0
 */
abstract class AbstractEventType extends AbstractObjectTypeProcessor implements IEventType {
	/**
	 * wcf\data\event\EventList
	 */
	protected $eventList = null;

	/**
	 * Holds the participation action.
	 */
	protected $participationAction = '';

	/**
	 * participation action object.
	 * @var wcf\data\event\participation\EventParticipationAction
	 */
	protected $objectAction = '';
	
	/**
	 *  Permissions to check, whether the user can add.
	 */	
	protected $permissionsCreate = array();
	
	/**
	 *  Permissions to check, whether the user can add.
	 */	
	protected $permissionsUpdate = array();
	
	/**
	 *  Permissions to check, whether the user can add.
	 */	
	protected $permissionsDelete = array();
	
	/**
	 *  Permissions to check, whether the user can add.
	 */	
	protected $permissionsView = array();
	
	/**
	 * List of events
	 */
	protected $events = array();

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->eventList = new EventList();
	}
	
	/**
	 * @see IEventType::getTitle()
	 */	
	public function getTitle() {
		return '';	
	}
	
	/**
	 * @see IEventType::getIcon()
	 */
	public function getIcon() {
		return '';
	}
	
	/**
	 * Returns participation action name
	 *
	 * @return wcf\data\event\participation\EventParticipationAction
	 */
	public function getAction() {
		if (!empty($this->participationAction)) {
			$this->objectAction = new $this->participationAction;
		}
		
		return null;
	}

	/**
	 * Returns EventList object
	 *
	 * @return wcf\data\event\EventList
	 */
	public function getEventList() {
		return $this->eventList;
	}

	/**
	 * Returns events of EventList
	 *
	 * @return array
	 */
	public function getEvents() {
		if (!count($this->events)) {
			$this->eventList->readObjects();
			$this->events = $this->eventList->getObjects();
		}

		return $this->events;
	}
}
