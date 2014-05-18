<?php
namespace gms\data\event\date\participation;
use wcf\data\AbstractDatabaseObjectAction;

/**
 * Participation-related actions.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	CC BY-NC-SA 3.0 <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	data.event.date.participation
 * @category	Guilded 2.0
 */
class EventDateParticipationAction extends AbstractDatabaseObjectAction {
	/**
	 * @see wcf\data\AbstractDatabaseObjectAction::$className
	 */
	protected $className = 'gms\data\event\date\participation\EventParticipationEditor';
	
	/**
	 * @see wcf\data\AbstractDatabaseObjectAction::$permissionsCreate
	 */
	protected $permissionsCreate = '';
	
	/**
	 * @see wcf\data\AbstractDatabaseObjectAction::$permissionsUpdate
	 */
	protected $permissionsUpdate = '';
	
	/**
	 * @see wcf\data\AbstractDatabaseObjectAction::$permissionsDelete
	 */
	protected $permissionsDelete = '';
}
