<?php
namespace gms\data\game\server;
use gms\data\GMSDatabaseObject;
use gms\data\game\Game;
use wcf\data\ITitledObject;
use wcf\system\WCF;

/**
 * Represents a game server.
 * 
 * @author	Jeffrey Reichardt
 * @copyright	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	data.game.server
 * @category	Guilded 2.0
 */
class GameServer extends GMSDatabaseObject implements ITitledObject {
	const POPULATION_LOW = 0;
	const POPULATION_MEDIUM = 1;
	const POPULATION_HIGH = 2;

	/**
	 * @see	\wcf\data\DatabaseObject::$databaseTableName
	 */
	protected static $databaseTableName = 'game_server';
	
	/**
	 * @see	\wcf\data\DatabaseObject::$databaseTableIndexName
	 */
	protected static $databaseTableIndexName = 'serverID';

	/**
	 * game object
	 * @var \gms\data\game\Game
	 */
	protected $game = null;

	/**
	 * Returns server by name.
	 *
	 * @param	integer	$gameID
	 * @param	string	$name
	 * @return	\gms\data\game\server\GameServer|null
	 */
	public static function getServerByName($gameID, $name) {
		$sql = "SELECT *
				FROM	".static::getDatabaseTableName()."
				WHERE	(gameID = ?) AND
						(name = ?)";
		$statement = WCF::getDB()->prepareStatement($sql);
		$statement->execute(array($gameID, $name));
		$object = $statement->fetchObject('gms\data\game\server\GameServer');

		if ($object) {
			return $object;
		}

		return null;
	}

	/**
	 * Returns the title of the object.
	 *
	 * @return	string
	 */
	public function getTitle() {
 		return $this->name;
	}

	/**
	 * Returns html tag for status icon.
	 *
	 * @param	integer	$size
	 * @return	string
	 */
	public function getStatusIcon($size = 32) {
		return '<i class="icon icon' . $size . ' icon-circle-arrow-' . ($this->isOnline ? 'up green' : 'down red') . ' jsTooltip" title="' . $this->getTitle() . '"></i>';
	}

	/**
	 * Returns game object.
	 *
	 * @return	\gms\data\game\Game
	 */
	public function getGame() {
		if ($this->game === null) {
			$this->game = new Game($this->gameID);
		}

		return $this->game;
	}
}
