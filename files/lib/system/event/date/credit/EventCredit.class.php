<?php
namespace gms\system\event\credit;
use gms\data\ICreditableObject;
use wcf\data\DatabaseObject;
use wcf\system\WCF;

/**
 * Implementation of CreditType for event dates.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	CC BY-NC-SA 3.0 <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	system.event.credit
 * @category	Guilded 2.0
 */
class EventDateCredit implements ICreditableObject {
	/**
	 * date object
	 * @var	\gms\data\event\date\EventDate
	 */
	protected $eventDate = null;

	/**
	 * @see wcf\data\ICreditableObject::getObjectID()
	 */
	public function getObjectID() {
		return $this->eventDate->eventDateID;
	}

	/**
	 * @see wcf\data\ICreditableObject::setObject()
	 */
	public function setObject(DatabaseObject $object) {
		$this->eventDate = $object;
	}

	/**
	 * @see wcf\data\ICreditableObject::getObject()
	 */
	public function getObject() {
		return $this->eventDate;
	}

	/**
	 * @see	wcf\data\ICreditableObject::getShortOutput()
	 */
	public function getShortOutput() {
		return WCF::getLanguage()->getDynamicVariable('gms.event.date.credit.output.short', array('eventDate' => $this->eventDate));
	}

	/**
	 * @see	wcf\data\ICreditableObject::getOutput()
	 */
	public function getOutput() {
		return WCF::getLanguage()->getDynamicVariable('gms.event.date.credit.output', array('eventDate' => $this->eventDate));
	}
}
