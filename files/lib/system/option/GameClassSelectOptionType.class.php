<?php
namespace gms\system\option;
use gms\data\game\classification\GameClassificationList;
use gms\data\game\Game;
use wcf\system\option\SelectOptionType;

/**
 * Select Option for game-classes.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	system.option
 * @category	Guilded 2.0
*/
class GameClassSelectOptionType extends SelectOptionType implements IGameOptionType {
	/**
	 * game object
	 * @var	\gms\data\game\Game
	 */
	protected $game = null;

	/**
	 * Get possible select-options.
	 *
	 * @return array
	 */
	public function parseSelectOptions(){
		$result = array();

		$classList = new GameClassificationList();
		$classList->getConditionBuilder()->add('gameID = ?', array($this->game->gameID));
		$classList->readObjects();

		foreach ($classList->getObjects() as $class) {
			$result[$class->classificationID] = $class->getTitle();
		}
		
		return $result;
	}

	/**
	 * @see \gms\system\option\IGameOptionType::setGame()
	 */
	public function setGame(Game $game) {
		$this->game = $game;
	}
}
