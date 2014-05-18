<?php
namespace gms\data\event\date;
use wcf\data\AbstractDatabaseObjectAction;
use wcf\system\WCF;

/**
 * 
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	CC BY-NC-SA 3.0 <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	data.event.date
 * @category	Guilded 2.0
 */
class EventDateAction extends AbstractDatabaseObjectAction {
	/**
	 * @see	\wcf\data\AbstractDatabaseObjectAction::$className
	 */
	public $className = 'wcf\data\event\date\EventDateEditor';
	
	/**
	 * @see	\wcf\data\AbstractDatabaseObjectAction::$permissionsCreate
	 */
	protected $permissionsCreate = array('user.eventdate.canAddEventDate');
	
	/**
	 * @see	\wcf\data\AbstractDatabaseObjectAction::$permissionsDelete
	 */
	protected $permissionsDelete = array('user.eventdate.canDeleteEventDate');
	
	/**
	 * @see	\wcf\data\AbstractDatabaseObjectAction::$permissionsUpdate
	 */
	protected $permissionsUpdate = array('user.eventdate.canEditEventDate');
}
