<?php
namespace gms\data\event\credit;
use gms\data\event\Event;
use wcf\data\DatabaseObjectDecorator;

/**
 * Decorates the credit object and provides data about event.
 * 
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	CC BY-NC-SA 3.0 <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	data.event.credit
 * @category	Guilded 2.0
 */
class EventCredit extends DatabaseObjectDecorator implements ICreditableObject {
	/**
	 * @see wcf\data\DatabaseObjectDecorator::$baseClass
	 */
	protected static $baseClass = 'gms\data\credit\Credit';
	
	/**
	 * holds event object by objectID
	 * @type	\gms\data\event\Event
	 */
	protected $event = null;
	
	/**
	 * Gets object by objectID.
	 * 
	 * @return	\gms\data\DatabaseObject
	 */
	public function getObject() {
		if ($this->event === null) {
			$this->event = new Event($this->getObjectID());
		}
		
		return $this->event;
	}
}
