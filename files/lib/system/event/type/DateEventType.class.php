<?php
namespace gms\system\event\type;
use gms\system\event\type\EventType;
use wcf\system\WCF;

/**
 * Represents a type for regular events.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	CC BY-NC-SA 3.0 <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	system.event.type
 * @category	Guilded 2.0
 */
class DateEventType extends AbstractEventType implements IEventType{
	/**
	 * @see IEventType::$participationAction
	 */
	protected $participationAction = 'gms\data\event\participation\UserEventDateParticipationAction';
	
	/**
	 * @see IEventType::$permissions
	 */
	protected $permissions = array();

	/**
	 * @see IEventType::getTitle()
	 */	
	public function getTitle(){
		return WCF::getLanguage()->get('gms.event.type.date');
	}
	
	/**
	 * @see IEventType::getIcon()
	 */
	public function getIcon(){
		return 'event';
	}
}
