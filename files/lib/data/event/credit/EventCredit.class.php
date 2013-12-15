<?php
namespace gms\data\event\credit;
use wcf\data\event\Event;
use wcf\data\DatabaseObjectDecorator;
use wcf\system\WCF;

/**
 * Decorates the credit object and provides data about event.
 * 
 * @author	Jeffrey Reichardt
 * @copyright	2012-2013 DevLabor UG (haftungsbeschränkt)
 * @license	CC BY-NC-SA 3.0 <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	data.event.credit
 * @category	Guilded 2.0
 */
class EventCredit extends GMSDatabaseObjectDecorator implements ICreditableObject {
	/**
	 * @see wcf\data\DatabaseObjectDecorator::$baseClass
	 */
	protected static $baseClass = 'wcf\data\credit\Credit';
	
	/**
	 * holds event object by objectID
	 * @type	wcf\data\event\Event
	 */
	protected $event = null;
	
	/**
	 * Gets object by objectID.
	 * 
	 * @return	wcf\data\DatabaseObject
	 */
	public function getObject() {
		if ($this->event === null) {
			$this->event = new Event($this->getObjectID());
		}
		
		return $this->event;
	}
}
