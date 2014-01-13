<?php
namespace gms\data\game;
use wcf\data\AbstractDatabaseObjectAction;
use wcf\data\IToggleAction;

/**
 * Game-related actions.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	data.game
 * @category	Guilded 2.0
 */
class GameAction extends AbstractDatabaseObjectAction implements IToggleAction {
	/**
	 * @see	\wcf\data\AbstractDatabaseObjectAction::$className
	 */
	protected $className = 'gms\data\game\GameEditor';

	/**
	 * @see	\wcf\data\AbstractDatabaseObjectAction::$permissionsCreate
	 */
	protected $permissionsCreate = array('admin.gms.game.canManage');

	/**
	 * @see	\wcf\data\AbstractDatabaseObjectAction::$permissionsDelete
	 */
	protected $permissionsDelete = array('admin.gms.game.canManage');

	/**
	 * @see	\wcf\data\AbstractDatabaseObjectAction::$permissionsUpdate
	 */
	protected $permissionsUpdate = array('admin.gms.game.canManage');

	/**
	 * @see	\wcf\data\IToggleAction::validateToggle()
	 */
	public function validateToggle() {
		parent::validateUpdate();

		// @todo validate if gameID == DEFAULT_GAME_ID
	}
	
	/**
	 * @see	\wcf\data\IToggleAction::toggle()
	 */
	public function toggle() {
		if (empty($this->objects)) {
			$this->readObjects();
		}

		foreach ($this->objects as $object) {
			$object->update(array(
				'isEnabled' => ($object->isEnabled - 1)
			));
		}
	}
}
