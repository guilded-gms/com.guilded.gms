<?php
namespace wcf\data\guild\alliance;
use wcf\data\AbstractDatabaseObjectAction;
use wcf\system\database\util\PreparedStatementConditionBuilder;
use wcf\system\exception\PermissionDeniedException;
use wcf\system\exception\ValidateActionException;
use wcf\system\WCF;
use wcf\util\StringUtil;

class GuildAllianceAction extends AbstractDatabaseObjectAction {
	/**
	 * @see	wcf\data\AbstractDatabaseObjectAction::$className
	 */
	public $className = 'wcf\data\guild\alliance\GuildAllianceEditor';
	
	/**
	 * @see	wcf\data\AbstractDatabaseObjectAction::$permissionsCreate
	 */
	protected $permissionsCreate = array('user.guild.alliance.canAddAlliance');
	
	/**
	 * @see	wcf\data\AbstractDatabaseObjectAction::$permissionsDelete
	 */
	protected $permissionsDelete = array('user.guild.alliance.canDeleteAlliance');
	
	/**
	 * @see	wcf\data\AbstractDatabaseObjectAction::$permissionsUpdate
	 */
	protected $permissionsUpdate = array('user.guild.alliance.canEditAlliance');

	/**
	 * Validates assign method.
	 */
	public function validateAssign() {
		return parent::validateUpdate();
	}	
	
	/**
	 * Validates assign remove.
	 */
	public function validateRemove() {
		return parent::validateUpdate();
	}
	
	/**
	 * Assigns a guild or character to alliance.
	 */
	public function assign() {
	
	}
	
	/**
	 * Removes guild or character from alliance.
	 */
	public function remove() {
	
	}
}
