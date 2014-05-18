<?php
namespace gms\system\event\type;
use wcf\data\object\type\AbstractObjectTypeProcessor;

/**
 * Every EventType should inherit of this abstract implementation.
 * EventTypes handle participation mode and auto-generated event dates.
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
	 * list of events
	 * @var	\gms\data\event\EventDateList
	 */
	protected $eventList = null;

	/**
	 * participation action object.
	 * @var \gms\data\event\date\participation\EventDateParticipationAction
	 */
	protected $objectAction = '';

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
	 * @return \gms\data\event\date\participation\EventDateParticipationAction
	 */
	public function getAction() {
		if (!empty($this->participationAction)) {
			$this->objectAction = new $this->participationAction;
		}
		
		return null;
	}
}
