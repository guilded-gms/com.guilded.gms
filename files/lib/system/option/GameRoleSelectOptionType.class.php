<?php
namespace gms\system\option;
use gms\data\game\role\GameRoleList;

/**
 * Select Option for game-roles.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	system.option
 * @category	Guilded 2.0
 *
 * @todo show multi-checkbox
*/
class GameRoleSelectOptionType extends GameSelectOptionType {
	/**
	 * Get possible select-options.
	 *
	 * @return array
	 */
	public function parseSelectOptions(){
		$result = array();

		$roleList = new GameRoleList();
		$roleList->getConditionBuilder()->add('gameID = ?', array($this->game->gameID));
		$roleList->readObjects();

		foreach ($roleList->getObjects() as $role) {
			$result[$role->roleID] = $role->getTitle();
		}
		
		return $result;
	}
}
