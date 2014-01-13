<?php
namespace gms\data\alliance;
use wcf\data\AbstractDatabaseObjectAction;

/**
 * Alliance-related actions
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	data.alliance
 * @category	Guilded 2.0
 */
class AllianceAction extends AbstractDatabaseObjectAction {
	/**
	 * @see	\wcf\data\AbstractDatabaseObjectAction::$className
	 */
	public $className = 'gms\data\alliance\AllianceEditor';
	
	/**
	 * @see	\wcf\data\AbstractDatabaseObjectAction::$permissionsCreate
	 */
	protected $permissionsCreate = array('admin.gms.alliance.canManage');
	
	/**
	 * @see	\wcf\data\AbstractDatabaseObjectAction::$permissionsDelete
	 */
	protected $permissionsDelete = array('admin.gms.alliance.canManage');
	
	/**
	 * @see	\wcf\data\AbstractDatabaseObjectAction::$permissionsUpdate
	 */
	protected $permissionsUpdate = array('admin.gms.alliance.canManage');

	/**
	 * Validates assign method.
	 */
	public function validateAssign() {
		$this->validateUpdate();
	}	
	
	/**
	 * Validates assign remove.
	 */
	public function validateRemove() {
		$this->validateUpdate();
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
