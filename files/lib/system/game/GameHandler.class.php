<?php
namespace gms\system\game;
use gms\data\game\Game;
use gms\data\game\GameList;
use wcf\data\object\type\ObjectTypeCache;
use wcf\system\SingletonFactory;

/**
 * GameHandler for core object.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	system.game
 * @category	Guilded 2.0
 */
class GameHandler extends SingletonFactory {
	/**
	 * game object
	 * @var	\gms\data\game\Game|null
	 */
	protected $game = null;

	/**
	 * list of installed enabled games
	 * @var	array
	 */
	protected static $games = array();
	
	/**
	 * @see	\wcf\system\SingletonFactory::init()
	 */
	protected function init() {
		$this->game = new Game(DEFAULT_GAME_ID);
	}
	
	/**
	 * @see	\wcf\system\SingletonFactory::__get()
	 */
	public function __get($name) {
		return $this->game->$name;
	}

	/**
	 * Sets game object
	 *
	 * @param	\gms\data\game\Game
	 */
	public function setGame(Game $game) {
		$this->game = $game;
	}

	/**
	 * Returns game object
	 *
	 * @return	\gms\data\game\Game
	 */
	public function getGame() {
		return $this->game;
	}

	/**
	 * Returns a list of available games.
	 * 
	 * @return	array
	 */
	public static function getGames() {
		if (!count(self::$games)) {
			$gameList = new GameList();
			$gameList->readObjects();
			
			self::$games = $gameList->getObjects();
		}
		
		return self::$games;
	}

	/**
	 * Returns tooltip object.
	 *
	 * @return	\wcf\data\object\type\ObjectType | null
	 */
	public function getTooltip() {
		foreach (ObjectTypeCache::getInstance()->getObjectTypes('com.guilded.gms.item.tooltip') as $objectType) {
			if ($objectType->packageID == $this->game->packageID) {
				return $objectType->getProcessor();
			}
		}

		return null;
	}
}
