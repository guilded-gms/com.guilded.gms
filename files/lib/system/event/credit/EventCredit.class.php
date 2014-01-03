<?php
namespace gms\system\event\credit;
use wcf\data\event\Event;
use wcf\data\ICreditableObject;

/**
 * Implementation of CreditType for events.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	CC BY-NC-SA 3.0 <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	system.event.credit
 * @category	Guilded 2.0
 */
class EventCredit implements ICreditableObject {
	protected $event = null;

	/**
	 * @see wcf\data\ICreditableObject::getObjectID()
	 */
	public function getObjectID() {
		return $this->event->eventID;
	}

	/**
	 * @see wcf\data\ICreditableObject::setObject()
	 */
	public function setObject(&$object) {
		$this->event = $object;
	}

	/**
	 * @see wcf\data\ICreditableObject::getObject()
	 */
	public function getObject() {
		return $this->event;
	}

	/**
	 * @see	wcf\data\ICreditableObject::getShortOutput()
	 */
	public function getShortOutput() {
		return WCF::getLanguage()->getDynamicVariable('wcf.credit.type.event.output.short', array('event' => $this->event));
	}

	/**
	 * @see	wcf\data\ICreditableObject::getOutput()
	 */
	public function getOutput() {
		return WCF::getLanguage()->getDynamicVariable('wcf.credit.type.event.output', array('event' => $this->event));
	}
}
