<?php
namespace gms\system\option;
use gms\data\game\race\GameRaceList;

/**
 * Select Option for game-races.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2013 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	system.option
 * @category	Guilded 2.0
*/
class GameRaceSelectOptionType extends SelectOptionType {	
	/**
	 * Get possible select-options.
	 *
	 * @todo set gameID
	 */
	public function parseSelectOptions(){
		$result = array();

		$raceList = new GameRaceList();
		$raceList->getConditionBuilder()->add('gameID = ?', array(DEFAULT_GAME_ID));
		$raceList->readObjects();
		
		foreach ($raceList->getObjects() as $race) {
			$result[$race->raceID] = $race->getTitle();
		}
		
		return $result;
	}
}
