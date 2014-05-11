<?php
namespace gms\system\option;
use gms\data\game\role\GameRoleList;
use wcf\data\option\Option;

/**
 * Select Option for game-roles.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	system.option
 * @category	Guilded 2.0
*/
class GameRoleSelectOptionType extends GameSelectOptionType {
	/**
	 * @see	\gms\system\option\GameSelectOptionType::$templateName
	 */
	public $templateName = 'multiSelectOptionType';

	/**
	 * @see	\wcf\system\option\IOptionType::getFormElement()
	 */
	public function getFormElement(Option $option, $value) {
		if (!is_array($value)) {
			$value = explode(',', $value);
		}

		return parent::getFormElement($option, $value);
	}

	/**
	 * @see	\gms\system\option\GameSelectOptionType::parseSelectOptions()
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
