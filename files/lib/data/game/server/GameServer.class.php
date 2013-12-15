<?php
namespace gms\data\game\server;
use gms\data\GMSDatabaseObject;
use gms\data\game\Game;
use wcf\data\ITitledObject;

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
	 * Returns the title of the object.
	 *
	 * @return	string
	 */
	public function getTitle() {
 		return $this->name;
	}

	/**
	 * Returns status icon.
	 *
	 * @param int $size
	 * @return string
	 */
	public function getStatusIcon($size = 24) {
		return '<span class="icon' . $size . ' icon-chevron-sign-' . ($this->isOnline ? 'up' : 'down') . '"></span>';
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
