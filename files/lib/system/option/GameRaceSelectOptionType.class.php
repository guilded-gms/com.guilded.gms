<?php
namespace gms\system\option;
use gms\data\game\Game;
use gms\data\game\race\GameRaceList;
use wcf\system\option\SelectOptionType;

/**
 * Select Option for game-races.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	system.option
 * @category	Guilded 2.0
 *
 * @todo handle output by $game->maxRaces
*/
class GameRaceSelectOptionType extends GameSelectOptionType {
	/**
	 * Get possible select-options.
	 *
	 * @return array
	 */
	public function parseSelectOptions(){
		$result = array();

		$raceList = new GameRaceList();
		$raceList->getConditionBuilder()->add('gameID = ?', array($this->game->gameID));
		$raceList->readObjects();
		
		foreach ($raceList->getObjects() as $race) {
			$result[$race->raceID] = $race->getTitle();
		}
		
		return $result;
	}
}
