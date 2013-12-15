<?php
namespace gms\data\game;
use wcf\data\AbstractDatabaseObjectAction;
use wcf\data\IToggleAction;

class GameAction extends AbstractDatabaseObjectAction implements IToggleAction {
	/**
	 * @see	\wcf\data\AbstractDatabaseObjectAction::$className
	 */
	protected $className = 'gms\data\game\GameEditor';

	/**
	 * @see	\wcf\data\AbstractDatabaseObjectAction::$permissionsCreate
	 */
	protected $permissionsCreate = array('admin.system.game.canManageGame');

	/**
	 * @see	\wcf\data\AbstractDatabaseObjectAction::$permissionsDelete
	 */
	protected $permissionsDelete = array('admin.system.game.canManageGame');

	/**
	 * @see	\wcf\data\AbstractDatabaseObjectAction::$permissionsUpdate
	 */
	protected $permissionsUpdate = array('admin.system.game.canManageGame');
	/**
	 * Validates permissions and parameters
	 */
	public function validateToggle() {
		parent::validateUpdate();
	}
	
	/**
	 * Toggles status.
	 */
	public function toggle() {
		if (empty($this->objects)) {
			$this->readObjects();
		}

		foreach ($this->objects as $object) {
			$object->update(array('enabled' => (bool)!$object->isEnabled));
		}
	}
}
