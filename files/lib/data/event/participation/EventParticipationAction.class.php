<?php
namespace gms\data\event\participation;
use wcf\data\AbstractDatabaseObjectAction;

class EventParticipationAction extends AbstractDatabaseObjectAction {
	/**
	 * @see wcf\data\AbstractDatabaseObjectAction::$className
	 */
	protected $className = 'gms\data\event\participation\EventParticipationEditor';
	
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
